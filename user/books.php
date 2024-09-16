<?php

// Include the database connection
include 'db.php';

// Initialize $result variable
$result = null;

// Check if the book ID is provided in the URL
if(isset($_GET['id'])) {
    // Retrieve the book ID from the URL
    $book_id = $_GET['id'];
    
    // Prepare and execute a SQL query to fetch the details of the book with the given ID
    $sql = "SELECT * FROM books WHERE id = $book_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the book details
        $row = $result->fetch_assoc();
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
}

// Fetch all books from the database if $result is null
if ($result === null) {
    // Check if the database connection is valid
    if ($conn) {
        // Check if a search query is provided
        if(isset($_GET['query'])) {
            $search_query = $_GET['query'];

            // Prepare and execute a SQL query to search for books
            $sql = "SELECT * FROM books WHERE title LIKE '%$search_query%' OR author LIKE '%$search_query%'";
            $result = $conn->query($sql);

            if ($result === false) {
                echo "Error: " . $conn->error;
            }
        } else {
            // Prepare and execute the query to fetch all books
            $sql = "SELECT id, title, author, price, description, coverImageUrl FROM books";
            $result = $conn->query($sql);

            // Check if the query executed successfully
            if (!$result) {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Error: Database connection is not established.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include('main_head.php') ?>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Books - Ebook</title>
</head>
<body>
    <?php 
    include('bg_video.php');
    include('header.php');
    ?>

    <!-- Floating cart button -->
    <?php 
    $count = 0;
    if(isset($_SESSION['cart']))
    {
        $count = count($_SESSION['cart']);
    }
    ?>
    <a class="floating-button" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>

    <div class="sec1_books">
        <div class="container">
            <div class="news ">
                <div class="container">
                    <h1 class="news-heading">Search for Books</h1>
                    <input id="searchField" class="letter_input" type="search" name="query" maxlength="50" required placeholder="Search">
                </div>
            </div>
        </div>
    </div>

    <div class="sec2_books" id='book_section2'>
        <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4 row_books">
            <?php
            // Fetch all books from the database
            $sql = "SELECT id, title, author, price, description, coverImageUrl FROM books ORDER BY id DESC";
            $result = $conn->query($sql);

            // Check if the query executed successfully
            if ($result) {
                // Display each book as a card
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col">
                           
                                <div class="card h-100 card_sec2">
                                    <img src="../admin/' . $row['coverImageUrl'] . '" class="card-img-top" alt="Book Cover">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row['title'] . '</h5>
                                        <p class="card-text">Author: ' . $row['author'] . '</p>
                                        <p class="card-text">Price: $' . $row['price'] . '</p>
                                        <div class="rate">
                                            <!-- Rating stars can be added here -->
                                        </div>
                                        <form action="index.php" method="post">
                                        <input type="hidden" name="book_id" value="' . $row['id'] . '">
                                        <button type="submit" class="card_btn mb-2" name="add_to_cart">Add To Cart</button>
                                    </form>
                                        <a href="book_details.php?id=' . $row['id'] . '" class="card_btn"><i class="fa-regular fa-eye"></i></a>
                                        <!-- Add to cart button with onclick event -->
                                       
                                        
                                    </div>
                                </div>
                           
                        </div>';
                }
            } else {
                // Display an error message if the query fails
                echo "Error: " . $conn->error;
            }
            ?>
            <p id="noBooksMessage" style="display: none;color: white;">No books found</p>
        </div>
    </div>
    </div>


    <?php include('subs.php') ?>

<?php include('footer.php') ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
       document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("searchField").addEventListener("keyup", function() {
        var searchQuery = this.value.trim().toLowerCase(); // Trim whitespace and convert to lowercase
        var cards = document.querySelectorAll(".col");
        var foundBooks = false; // Flag to track if any books are found

        cards.forEach(function(card) {
            var title = card.querySelector(".card-title").innerText.trim().toLowerCase();
            var author = card.querySelector(".card-text").innerText.trim().toLowerCase();

            if (title.includes(searchQuery) || author.includes(searchQuery)) {
                card.style.display = "block";
                foundBooks = true; // Set flag to true if a book is found
            } else {
                card.style.display = "none"; // Hide the parent element
            }
        });

        // Display message if no books are found
        var noBooksMessage = document.getElementById("noBooksMessage");
        if (!foundBooks) {
            noBooksMessage.style.display = "block";
        } else {
            noBooksMessage.style.display = "none";
        }
    });
});

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


<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>
