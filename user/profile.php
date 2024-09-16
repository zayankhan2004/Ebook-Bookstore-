<?php
// session_start();
include 'db.php';
include('header.php');
include('bg_video.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: page_login.php");
    exit();
}

// Get username from session
$username = $_SESSION['username'];

// Retrieve user information from database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $profile_picture = $row['profile_picture'];
} else {
    // User not found, handle error
    echo "User not found.";
    exit();
}

// Handle profile information update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_username']) && isset($_POST['new_email'])) {
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];

    // Update username and email in the database
    $update_sql = "UPDATE users SET username = '$new_username', email = '$new_email' WHERE username = '$username'";
    if ($conn->query($update_sql) === TRUE) {
        $username = $new_username; // Update username variable
        $email = $new_email; // Update email variable
    } else {
        echo "Error updating profile information: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
                }

        .profile {
            background-color: #ffffff45;
            backdrop-filter: blur(10px);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 6rem;
        }

        .profile img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .profile form {
            display: flex;
            flex-direction: column;
        }

        .profile form label {
            margin-bottom: 10px;
        }

        .profile form input[type="text"],
        .profile form input[type="email"] {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .profile form input[type="text"],
        .profile form input[type="email"]:focus{
            outline: none;
        }

        .profile form button {
            padding: 10px 20px;
            background-color: #d1a75b;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: .4s;
        }

        .profile form button:hover {
            background-color: #a38345;
        }

    </style>
</head>
<body>
    <?php ?>
   
   
<div class="container">
<div class="profile">
    <h1>Profile</h1>
        <img src="../admin/<?php echo $profile_picture; ?>" alt="Profile Picture">
        <div class="profile-info">
            <form action="profile.php" method="post">
                <label for="new_username">Username:</label>
                <input type="text" name="new_username" id="new_username" disabled  value="<?php echo $username; ?>">
                <label for="new_email">Email:</label>
                <input type="email" name="new_email" id="new_email" disabled value="<?php echo $email; ?>">
                <!-- <button class="card_btn" type="submit">Update Profile</button> -->
            </form>
        </div>
    </div>
</div>
</body>
</html>
