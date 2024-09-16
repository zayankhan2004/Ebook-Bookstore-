<?php 
session_start();
    // Handle form submission and redirection after HTML content
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Remove_Book"])) {
        // Check if the Book_Name is set in the POST data
        if(isset($_POST['Book_Name'])) {
            $bookNameToRemove = $_POST['Book_Name'];

            // Loop through the cart and remove the book with matching name
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['Book_Name'] == $bookNameToRemove) {
                    unset($_SESSION['cart'][$key]);
                    // Re-index the array after removal
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    break; // Exit the loop after removing the book
                }
            }
        }
        // Redirect back to the cart page
        header("Location: mycart.php");
        exit();
    }
?>