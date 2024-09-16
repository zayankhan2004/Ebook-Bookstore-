<?php

// Include the database connection
include 'db.php';

// Check if the book ID is provided in the URL
if(isset($_GET['id'])) {
    // Retrieve the book ID from the URL
    $book_id = $_GET['id'];
    
    // Prepare and execute a SQL query to fetch the details of the book with the given ID
    $sql = "SELECT * FROM books WHERE id = $book_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the book details
        $row = $result->fetch_assoc();
        $book_id = $row['id'];
        $title = $row['title'];
        $author = $row['author'];
        $price = $row['price'];
        $description = $row['description'];
        $coverImageUrl = $row['coverImageUrl'];

        // Set the page title
        $titlee = $title;
    } else {
        echo "<title>No book found with the provided ID.</title>";
    }
} else {
    echo "<title>Book ID not provided.</title>";
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style---.css">
    <title><?php echo $titlee; ?></title>
    <?php include('main_head.php') ?>
    <link rel="stylesheet" href="style---.css">
</head>
<body>

<?php include('bg_video.php') ?>

    <!-- Floating cart button -->
    <?php 

    include('header.php');
    $count = 0;
    if(isset($_SESSION['cart'])) {
        $count = count($_SESSION['cart']);
    }
    ?>
    <a class="floating-button" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
 


    <div class="container sec1_book_details">


        <?php
        // Display the book details
        if(isset($row)) {
            echo '<div class="container book_main_cont">
                    <div class="main_book">
                        <div class="main_2">
                            <div class="main_img">
                                <img src="../admin/' . $coverImageUrl . '" class="" alt="Book Cover">
                            </div>
                            <div class="main_text">
                                <h5 class="main_title">' . $title . '</h5>
                                <p class="main_desc">
                                    <h3>Description:</h3>
                                    ' . $description . '
                                </p>
                                <p class="main_a">Author: <span>' . $author . '</span></p>
                                <p class="main_p">Price: <span> $' . $price . '</span></p>
                                <!-- Add to cart button with form submission -->
                            
                                    
                                <form action="index.php" method="post">
                                <input type="hidden" name="book_id" value="' . $row['id'] . '">
                                <button type="submit" class="card_btn mb-2" name="add_to_cart">Add To Cart</button>
                            </form>

                                <a class="card_btn" href="order.php?id=' . $book_id . '&title=' . urlencode($title) . '&author=' . urlencode($author) . '&price=' . $price . '">Buy Now</a>

                                   
                           
                            </div>
                        </div>
                    </div>
                </div>';
        }
        ?>
 </div>
        <div class="sec3_book_details">
            <div class="container">
        <h1 class="heading_sec2">Recommended</h1>

        <div class="row row-cols-1 row-cols-md-3 g-4 row_books">


            
        <?php

             

// Included database connection
include 'db.php';

// Fetch the latest 8 books from the database
$sql = "SELECT id, title, author, price, description, coverImageUrl FROM books ORDER BY id DESC LIMIT 8";
$result = $conn->query($sql);

// Check if the query executed successfully
if ($result) {
    // Display each book as a card
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col"  data-aos="fade-up" data-aos-duration="1000">
        <form action="manage_cart.php" method="POST">
                <div class="card h-100 card_sec2">
                    <img src="../admin/' . $row['coverImageUrl'] . '" class="card-img-top" alt="Book Cover">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['title'] . '</h5>
                        <p class="card-text">Author: ' . $row['author'] . '</p>
                        <p class="card-text">Price: $' . $row['price'] . '</p>
                        <div class="rate">
                            <!-- Rating stars can be added here -->
                        </div>
                        <a href="book_details.php?id=' . $row['id'] . '" class="card_btn"><i class="fa-regular fa-eye"></i></a>
                        <!-- Add to cart button with onclick event -->
                        <button class="card_btn" name="add_to_cart"><i class="fa-solid fa-cart-shopping"></i></button>
                        <input type="hidden" name="Book_Id" value="' . $row['id'] . '" />
                        <input type="hidden" name="Book_Name" value="' . $row['title'] . '" />
                        <input type="hidden" name="Author_Name" value="' . $row['author'] . '" />
                        <input type="hidden" name="Price" value="' . $row['price'] . '" />
                    </div>
                </div>
                </form>
            </div>
            ';
    }
} else {
    // Display an error message if the query fails
    echo "Error: " . $conn->error;
}
?>
</div>

        </div>
        </div>


<?php include('subs.php') ?>

<?php include('review.php') ?>

<?php include('footer.php') ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to hide the login/signup alert
        function hideLoginSignupAlert() {
            const loginSignupAlert = document.getElementById('loginSignupAlert');
            if(loginSignupAlert) {
                loginSignupAlert.style.display = 'none';
            }
        }

        // Check if the URL parameter indicates login/signup success
        const urlParams = new URLSearchParams(window.location.search);
        const loginSuccess = urlParams.get('login_success');
        if (loginSuccess === 'true') {
            // Hide the login/signup alert
            hideLoginSignupAlert();
        }

        // Disable add to cart buttons if user is not logged in
        const addToCartButtons = document.querySelectorAll('.card_btn[name="add_to_cart"]');
        const isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
        if (!isLoggedIn) {
            addToCartButtons.forEach(function(button) {
                button.disabled = true;
            });
        }

        // Floating cart button
        const floatingButton = document.querySelector('.floating-button');
        floatingButton.addEventListener('click', function(event) {
            // Prevent default link behavior
            event.preventDefault();

            // Check if user is logged in
            const isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
            if (!isLoggedIn) {
                // If user is not logged in, show the login/signup alert
                const loginSignupAlert = document.getElementById('loginSignupAlert');
                if (loginSignupAlert) {
                    loginSignupAlert.style.display = 'block';
                }
                // Fade out the alert after a delay
                setTimeout(hideLoginSignupAlert, 3000); // Adjust duration as needed (e.g., 3000ms for 3 seconds)
            } else {
                // If user is logged in, redirect to mycart.php
                window.location.href = 'mycart.php';
            }
        });
    });
</script>
</body>
</html>
