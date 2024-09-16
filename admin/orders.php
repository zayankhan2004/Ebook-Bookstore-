<?php
session_start();

// Session verification for access control
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="style-.css"> Custom styles -->
    <title>Admin Panel</title>
    <style>
   
    </style>
</head>
<body>
    <?php include('nav_admin.php') ?>
<aside class="text-white dash_aside">
<h1 class="text-white">Total Orders</h1>
    <div class="container orders_cont">
        <div class="orders_inner_cont">
            
<?php
// Include the database connection
include '../user/db.php';

// Fetch all orders from the database
$sql = "SELECT * FROM orders ORDER BY ID DESC";

$result = $conn->query($sql);

// Check if there are any orders
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Display order details
        echo "<div class='card_sec2_'>";
        // echo "<p>Book Title: " . $row["title"] . "</p>";
        // echo "<p>Author: " . $row["author"] . "</p>";
        // echo "<p>Price: " . $row["price"] . "</p>";
        echo "<p>Name: " . $row["name"] . "</p>";
        echo "<p>Email: " . $row["email"] . "</p>";
        echo "<p>Payment Method: " . $row["method"] . "</p>";
        echo "<p>Address: " . $row["flat"] . ", " . $row["street"] . ", " . $row["city"] . ", " . $row["country"] . " - " . $row["pin_code"] . "</p>";
        echo "<p>Total Books: " . $row["total_products"] . "</p>";
        echo "<p>Total Price: $" . $row["total_price"] . "</p>";
        echo "<p>Status: " . $row["status"] . "</p>"; // Assuming there's a 'status' column in your 'orders' table
        // Buttons to approve or mark as pending
        echo "<form action='update_order_status.php' method='POST'>";
        echo "<input type='hidden' name='order_id' value='" . $row["ID"] . "'>"; // Assuming 'id' is the primary key of your 'orders' table
        echo "<button class='card_btn' type='submit' name='approve_order'>Approve</button>";
        echo "<button class='card_btn' type='submit' name='mark_pending_order'>Mark as Pending</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "No orders found.";
}

// Close the database connection
$conn->close();
?>
</div>
</div>
    </aside>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="menu.js"></script>
</body>
</html>
