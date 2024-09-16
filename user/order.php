<?php
// Include the database connection
include 'db.php';

// Check if book ID is provided in the URL
if(isset($_GET['id'], $_GET['title'], $_GET['author'], $_GET['price'])) {
    // Retrieve the book details from the URL parameters
    $book_id = $_GET['id'];
    $title = $_GET['title'];
    $author = $_GET['author'];
    $price = $_GET['price'];
    // die("Book ID is missing!");
}

$book_id = $_GET['id'];

// Prepare SQL query to retrieve product details based on product_id
$sql = "SELECT price FROM books WHERE id = $book_id";

// Execute SQL query
$result = $conn->query($sql);

// Check if query execution was successful
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Fetch product details
    $row = $result->fetch_assoc();
    $price = $row['price'];
} else {
    $price = 0; // Set default price if product not found
}

// Close connection
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compplete Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* Add your custom CSS styles here */
    </style>
</head>

<body>
<div class="video-background">
        <div class="video-wrap">
          <video autoplay muted loop id="bg-video">
            <source src="book_bg2.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
    </div>
<?php include('header.php') ?>
<div class="sec">
        <div class="container order_cont">
            <h2 class="text-white">Place Your Order</h2>
            <!-- Display book details -->
            <div class="card_sec2 p-5 w-50 text-start mb-5">
            <div class="mb-3">
                <h3><span class="form-label">Book Title: <h4><?php echo $title; ?></h4></span></h3>
                
            </div>
            <div class="mb-3">
                <h3><label class="form-label">Author: <h4><?php echo $author; ?></h4></label></h3>
                
            </div>
            <div class="mb-3">
                <h3><label class="form-label">Price: <h4><?php echo "$" . $price; ?></h4></label></h3>
                
            </div>
            </div>
            <!-- Form for placing the order -->
            <form action="submit_order.php" class="text-white" method="POST">
                <!-- Hidden input fields for book details -->
                <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                <input type="hidden" name="title" value="<?php echo $title; ?>">
                <input type="hidden" name="author" value="<?php echo $author; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
               
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="method" class="form-label">Payment Method</label>
                    <select class="form-select" id="method" name="method" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="cash_on_delivery">Cash on Delivery</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="flat" class="form-label">Flat / Apartment</label>
                    <input type="text" class="form-control" id="flat" name="flat" required>
                </div>
                <div class="mb-3">
                    <label for="street" class="form-label">Street Address</label>
                    <input type="text" class="form-control" id="street" name="street" required>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" required>
                </div>
                <div class="mb-3">
                    <label for="pin_code" class="form-label">Pin Code</label>
                    <input type="text" class="form-control" id="pin_code" name="pin_code" required>
                </div>
                <div class="mb-3">
                    <label for="total_products" class="form-label">Total Products</label>
                    <input type="number" class="form-control" id="total_products" name="total_products" required onchange="updateTotalPrice(this.value)">
                </div>
                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Price ($)</label>
                    <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" value="<?php echo $price; ?>" required readonly>
                </div>
                <button type="submit" class="card_btn">Place Order</button>
            </form>
        </div>
    </div>

  <?php include('footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        
        function updateTotalPrice(quantity) {
            // Assuming $price is available here
            var totalPriceInput = document.getElementById("total_price");
            totalPriceInput.value = (parseFloat(quantity) * <?php echo $price; ?>).toFixed(2);
        }
    </script>
</body>

</html>
