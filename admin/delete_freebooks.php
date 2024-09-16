<?php
session_start();

// Session verification for access control
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
?>
<?php
include('../user/db.php');

// Check if book ID is set and not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the book ID
    $id = $_GET['id'];

    // Delete the book from the database
    $sql = "DELETE FROM free_books WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Book deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Redirect back to the homepage or any other desired page
    header("Location:manage_freebooks.php");
    exit();
} else {
    echo "Invalid book ID";
}
?>
