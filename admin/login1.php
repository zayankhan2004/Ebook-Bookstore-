<?php
// Establishing database connection
include('../user/db.php');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieving and sanitizing input data
$username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
$userpass = isset($_POST['userpassword']) ? mysqli_real_escape_string($conn, $_POST['userpassword']) : '';

// Performing the query
$result = mysqli_query($conn, "SELECT * FROM admins WHERE username = '$username' AND userpassword = '$userpass'");
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Starting session
session_start();

// Checking if there is a match for username and password
if (mysqli_num_rows($result) > 0) {
    // Setting session variable for admin
    $_SESSION['admin'] = $username;
    // Redirecting to admin.php on successful login
    echo "
    <script>
    alert('Login Successful');
    window.location.href = 'dashboard.php';
    </script>
    ";
} 
else {
    // Redirecting back to login.php if login fails
    echo "
    <script>
    alert('Invalid username or password');
    window.location.href = 'index.php';
    </script>
    ";
}

// Closing database connection
mysqli_close($conn);
?>
