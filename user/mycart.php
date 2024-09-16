<?php
ob_start(); // Start output buffering
include 'db.php';
include 'header.php';
include 'bg_video.php';

$userId = 1; // Assuming user is always logged in
$totalBooks = 0;
$totalPrice = 0;
$productData = array();
$productIds = array();

// Handle removal of cart items
if (isset($_POST['remove_from_cart'])) {
    $cart_id = $_POST['cart_id'];
    $sql = "DELETE FROM carts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cart_id);

    if ($stmt->execute()) {
        // Successfully removed item, redirect to refresh the cart
        header("Location: mycart.php");
        exit();
    } else {
        echo "<p>Error removing item: " . $conn->error . "</p>";
    }
    $stmt->close();
}

// Fetch cart items from the database
$sql = "SELECT carts.id AS cart_id, books.id AS book_id, books.title, books.author, books.price, carts.quantity
        FROM carts
        INNER JOIN books ON carts.book_id = books.id
        WHERE carts.user_id = $userId";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cart</title>
    <style>
        .main_nav{
            display:none;
        }
        .cart-table {
            margin: 7rem auto;
            width: 80%;
            border-collapse: collapse;
            background: #202020;
            color: #fff;
        }
        .cart-table th, .cart-table td {
            padding: 1rem;
            border: 1px solid #d1a75b;
            text-align: center;
        }
        .cart-table th {
            background: #454545;
            color: #d1a75b;
        }
        .cart-table td input {
            width: 60px;
            padding: 0.5rem;
            text-align: center;
        }
        .cart-table .actions {
            width: 100px;
        }
        .cart-summary {
            margin: 2rem auto;
            width: 80%;
            text-align: right;
            padding: 1rem;
            background: #202020;
            border: 2px solid #d1a75b;
            color: #fff;
        }
        .cart-summary h4 {
            margin-bottom: 1rem;
        }
        .cart-summary button {
            padding: 0.5rem 1rem;
            background-color: #d1a75b;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
<a class="floating-button" href="index.php">Back &emsp14;<i class="fa-solid fa-arrow-right"></i></a>
<div class="section__1">
    <div class="main__">
        <?php
        if ($result->num_rows > 0) {
            echo '<table class="cart-table">';
            echo '<tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                  </tr>';

            while ($row = $result->fetch_assoc()) {
                $bookTotal = $row['price'] * $row['quantity'];
                $totalBooks += $row['quantity'];
                $totalPrice += $bookTotal;
                
                $productData[] = array(
                    'title' => $row['title'],
                    'author' => $row['author'],
                    'price' => $row['price']
                );

                $productIds[] = $row['book_id'];

                echo '<tr>
                        <td>' . $row['title'] . '</td>
                        <td>' . $row['author'] . '</td>
                        <td>$' . $row['price'] . '</td>
                        <td><input type="number" class="input_cart" min="1" value="' . $row['quantity'] . '" onchange="updateQuantity(this, ' . $row['cart_id'] . ', ' . $row['price'] . ')"></td>
                        <td>$<span class="bookTotal">' . $bookTotal . '</span></td>
                        <td class="actions">
                            <form action="mycart.php" method="post">
                                <input type="hidden" name="cart_id" value="' . $row['cart_id'] . '">
                                <button type="submit" name="remove_from_cart" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                      </tr>';
            }

            echo '</table>';
        } else {
            echo "<h2 class='text-center text-white' style='margin-top: 7rem !important;'>Your cart is empty.</h2>";
        }

        $conn->close();
        ?>

        <div class="cart-summary">
            <h4>Total: $<?php echo $totalPrice; ?></h4>
            <form action="checkout.php" method="GET">
                <input type="hidden" id="hiddenTotalProducts" name="total_products" value="<?php echo $totalBooks; ?>">
                <input type="hidden" id="hiddenTotalPrice" name="totalPrice" value="<?php echo $totalPrice; ?>">
                
                <?php foreach ($productData as $index => $product): ?>
                    <input type="hidden" name="products[<?php echo $index; ?>][title]" value="<?php echo $product['title']; ?>">
                    <input type="hidden" name="products[<?php echo $index; ?>][author]" value="<?php echo $product['author']; ?>">
                    <input type="hidden" name="products[<?php echo $index; ?>][price]" value="<?php echo $product['price']; ?>">
                <?php endforeach; ?>

                <button type="submit" class="btn btn-warning">Proceed to Checkout</button>
            </form>
        </div>
    </div>
</div>

<?php include 'subs.php'; ?>
<?php include 'footer.php'; ?>

<script>
function updateQuantity(input, cartId, price) {
    var newQuantity = input.value;
    var bookTotalElement = input.parentNode.parentNode.querySelector('.bookTotal');
    var newTotal = parseFloat(newQuantity) * parseFloat(price);

    // Update the individual book total price
    bookTotalElement.innerHTML = newTotal.toFixed(2);

    // Update the overall cart total price
    updateCartTotal();

    // Send an AJAX request to update the quantity in the database
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Quantity updated successfully.");
        }
    };
    xhttp.open("GET", "update_quantity.php?cart_id=" + cartId + "&quantity=" + newQuantity, true);
    xhttp.send();
}

function updateCartTotal() {
    var cartRows = document.querySelectorAll('.cart-table tr');
    var totalPrice = 0;
    var totalBooks = 0;

    cartRows.forEach(function(row) {
        var bookTotalElement = row.querySelector('.bookTotal');
        if (bookTotalElement) {
            var bookTotal = parseFloat(bookTotalElement.innerHTML);
            totalPrice += bookTotal;
            var quantity = row.querySelector('.input_cart').value;
            totalBooks += parseInt(quantity);
        }
    });

    // Update the hidden fields with the new totals
    document.getElementById('hiddenTotalPrice').value = totalPrice.toFixed(2);
    document.getElementById('hiddenTotalProducts').value = totalBooks;

    // Update the total price display
    document.querySelector('.cart-summary h4').innerHTML = "Total: $" + totalPrice.toFixed(2);
}
</script>
</body>
</html>
