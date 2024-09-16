<?php
// Start the session (if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include your database connection file
require 'db.php'; // Adjust the path as needed

// Check if the user is logged in and get their user ID
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    // Prepare and execute the query to delete cart items
    $sql = "DELETE FROM carts";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    
    if ($stmt->execute()) {
        // Successfully deleted cart items
    } else {
        echo "<p>Error clearing cart: " . $conn->error . "</p>";
    }
    
    $stmt->close();
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the desired page after logout (e.g., home page)
header("Location: index.php");
exit();
?>
