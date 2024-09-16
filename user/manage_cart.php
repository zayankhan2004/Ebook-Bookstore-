
<?php 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
    // Check if the cart session variable exists
    if (isset($_SESSION["cart"])) {
        // Cart already exists, you can add more logic here if needed
       $mybooks = array_column($_SESSION['cart'], 'Book_Name');
        $bookNamesInCart = array();
        foreach ($mybooks as $bookName) {
    $bookNamesInCart[] = $bookName;
}
if (in_array($_POST['Book_Name'], $bookNamesInCart)) {
    echo "<script>alert('Book Already Exists');
    window.location.href='mycart.php';
    </script>";
} else {
    // Access book name and author from the form submission
    $bookId = $_POST['Book_Id'];
    $bookName = $_POST['Book_Name'];
    $authorName = $_POST['Author_Name'];
    $price = $_POST['Price'];
    // Make sure to define the $quantity variable before using it
    $quantity = 1;
    $_SESSION['cart'][] = array(
        'Book_Name' => $bookName,
        'Author_Name' => $authorName,
        'Price' => $price,
        'Quantity' => $quantity
    );

    echo "<script>alert('Book Added');
    window.location.href='mycart.php';
    </script>";
}
    } else {
        // Cart doesn't exist, initialize it
        // Access book name and author from the form submission
        $bookId = $_POST['Book_Id'];
        $bookName = $_POST['Book_Name'];
        $authorName = $_POST['Author_Name'];
        $price = $_POST['Price'];
        // Make sure to define the $quantity variable before using it
        $quantity = 1;
        // Initialize cart with the first book
        $_SESSION['cart'][] = array(
            'Book_Name' => $bookName,
            'Author_Name' => $authorName,
            'Price' => $price,
            'Quantity' => $quantity
        );

        echo "<script>alert('Book Added');
        window.location.href='mycart.php';
        </script>";
    }
}
?>
