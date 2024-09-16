<?php
session_start();
include 'db.php';

// Function to get user profile picture
function getUserProfilePicture($conn, $username) {
    $sql = "SELECT profile_picture FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['profile_picture'];
    } else {
        return 'default_profile_picture.jpg'; // Default profile picture if not found
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <?php include('main_head.php') ?>
    <title>Home - Ebook</title>
    <link rel="stylesheet" href="style-------__.css?v=1">
    <link rel="stylesheet" href="media_____.css?v=1">
    <link rel="stylesheet" href="nav____2.css?v=1">
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
</head>
<body>
<div class="main_nav">
    <nav>
        <div class="logo">
            <h3><a href="index.php"><img src="web_imgs/logo.png" alt="" class="logo_img" style="height: 6vh;"> Ebook</a></h3>
        </div>
        <div class="main_part nav_media">
        <i class="fa-solid fa-bars" id="menu_btn"></i>
            <ul class="all_links" id="menu">
                <li>
                    <a class="links <?php if(strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) echo 'active'; ?>" href="index.php">HOME</a>
                </li>
                <li>
                    <a class="links <?php if(strpos($_SERVER['REQUEST_URI'], 'books.php') !== false) echo 'active'; ?>" href="books.php">BOOKS</a>
                </li>
                <li>
                    <a class="links genre <?php if(strpos($_SERVER['REQUEST_URI'], 'genres.php') !== false) echo 'active'; ?>" href="genres.php">GENRES</a>
                </li>
                <li>
                    <a class="links <?php if(strpos($_SERVER['REQUEST_URI'], 'essay.php') !== false) echo 'active'; ?>" href="essay.php">Essay Competition</a>
                </li>
            </ul>
        </div>
        <div class="side_part nav_media">
            <?php
            // Check if the user is logged in
            if(isset($_SESSION['username'])) {
                // If logged in, display username and profile picture with dropdown
                $username = $_SESSION['username'];
                $profile_picture = getUserProfilePicture($conn, $username);
                echo '<div class="dropdown user_info">';
                echo '<h4 class="main_user profile_picture_main" onclick="toggleDropdown()">' . $username . '<img src="../admin/' . $profile_picture . '" alt="Profile Picture" class="profile_picture profile_picture_main"></h4>';
                echo '<div id="dropdownMenu" class="dropdown-menu">';
                echo '<a class="dropdown-item" href="profile.php">My Profile</a>';
                echo '<a class="dropdown-item" href="logout.php">Logout</a>';
                echo '</div>';
                echo '</div>';
            } else {
                // If not logged in, display login and signup buttons
                echo '<a href="page_login.php" class="login_btn">Login</a>';
                echo '<a href="page_signup.php" class="signup_btn">SignUp</a>';
            }
            ?>
        </div>
    </nav>
</div>

<script>
  // Get references to the buttons
var toggleMenuBtn = document.getElementById("menu_btn");
var menu = document.getElementById("menu");

// Add click event listener to the toggle button
toggleMenuBtn.addEventListener("click", function() {
    // Check if the menu button is currently visible
    var isMenuVisible = menu.style.opacity === "1";

    // Toggle the visibility of the menu button
    if (isMenuVisible) {
        // If visible, hide it
        menu.style.opacity = "0";
        menu.style.top = "-100rem";
    } else {
        // If hidden, show it
        menu.style.opacity = "1";
        menu.style.top = "2rem"; // Adjust the top position as needed
    }
});

// Function to toggle dropdown
function toggleDropdown() {
    var dropdownMenu = document.getElementById("dropdownMenu");
    dropdownMenu.classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.profile_picture_main')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
</script>
</body>
</html>
