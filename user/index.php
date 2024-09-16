



    <?php include('header.php');?>
<?php include('bg_video.php') ?>
<div id="sideNotification" class="side-notification">
    <span class="close" onclick="closeSideNotification()">&times;</span>
    <p>Please login or signup to continue.</p>
    <button onclick="redirectToLogin()">Login</button>
    <button onclick="redirectToSignup()">Signup</button>
</div>

<?php include('popup.php'); ?>


     <!-- Floating cart button -->
     <?php
// Fetch total products and product IDs from POST data
$total_products = isset($_POST['total_products']) ? $_POST['total_products'] : 0;
$product_ids = isset($_POST['product_ids']) ? $_POST['product_ids'] : array();

include('floating_btn.php');
?>
    


    

    <div class="section_1 container">
      

        <div class="container mid_sec1">
            <div class="text_sec1" data-aos="fade-right" data-aos-duration="1500">
                <h1 class="heading_sec1">Your Ultimate eBook Destination</h1>
                <p class="para_sec1">Welcome to our digital library, where every page turns into a captivating adventure. Explore boundless realms of knowledge and imagination at your fingertips.</p>
                <div>
                    <a href="books.php" class="btn_exp">EXPLORE</a>
                </div>
            </div>
            <div class="image_sec1" data-aos="fade-left" data-aos-duration="1500">
                <img src="web_imgs/studio-media-9DaOYUYnOls-unsplash-removebg-preview.png" alt="">
            </div>
            
        </div>
    </div>

    <div class="sub_sec1 text-center">
        <a href="#section2" class="dwn_btn"><i class="fa-solid fa-arrow-down"></i> SCROLL DOWN <i class="fa-solid fa-arrow-down"></i></a>
    </div>

    <div class="section_2" id="section2">
    <div class="container sec2_container">
        <h1 class="heading_sec2" >Recent Released</h1>
        <div class="card_main">
            <div class="row row-cols-1 row-cols-md-3 g-4 row_books">


            
            <?php
// Included database connection
include 'db.php';

// Function to add book to cart
function addToCart($bookId, $userId, $quantity) {
    global $conn;
    $sql = "INSERT INTO carts (user_id, book_id, quantity) VALUES ('$userId', '$bookId', '$quantity')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        return false;
    }
}

// Check if "Add to Cart" button is clicked
if (isset($_POST['add_to_cart'])) {
    // Get book ID and quantity from the form
    $bookId = $_POST['book_id'];
    $quantity = 1; // You can customize this to allow users to specify the quantity

    // Assuming user is always logged in
    $userId = 1;

    // Add the book to the cart
    $result = addToCart($bookId, $userId, $quantity);

    if ($result) {
        echo "<script>alert('Book added to cart successfully.'); window.location.href = 'mycart.php';</script>";
    } else {
        echo "<script>alert('Failed to add book to cart.');</script>";
    }
}

// Fetch the latest 8 books from the database
$sql = "SELECT id, title, author, price, description, coverImageUrl FROM books ORDER BY id DESC LIMIT 8";
$result = $conn->query($sql);

// Check if the query executed successfully
if ($result) {
    // Display each book as a card
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col"  data-aos="fade-up" data-aos-duration="1000">
        
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
                            <button type="submit" class="card_btn mb-2" name="add_to_cart"><i class="fa-solid fa-cart-shopping"></i></button>
                        </form>
                        <a href="book_details.php?id=' . $row['id'] . '" class="card_btn"><i class="fa-regular fa-eye"></i></a>
                        
                    </div>
                </div>
              
            </div>';
    }
} else {
    // Display an error message if the query fails
    echo "Error: " . $conn->error;
}
?>


            </div>
        </div>
        </div>
    </div>
</div>




<?php
require '../user/db.php';

// Fetch the top 5 submissions based on the best time (score)
$top_submissions = [];
$result = $conn->query("SELECT * FROM submissions ORDER BY score ASC LIMIT 5");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $top_submissions[] = $row;
    }
}
?>
<div class="sec2_sub">
    <div class="container">
    <div class="highscore pb-5 pt-5">
    <h2 class="heading_sec3">Top 5 Scores Of Essay Competition</h2>
    <?php if (!empty($top_submissions)): ?>
        <ul>
            <?php foreach ($top_submissions as $submission): ?>
                <li>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($submission['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($submission['email']); ?></p>
                    <p><strong>Start Time:</strong> <?php echo $submission['start_time']; ?></p>
                    <p><strong>End Time:</strong> <?php echo $submission['end_time']; ?></p>
                    <p><strong>Score (Time in seconds):</strong> <?php echo $submission['score']; ?></p>
                </li>
                <hr>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p style="margin:0;">No submissions yet.</p>
    <?php endif; ?>
</div>


    </div>
</div>

    <div class="section_3">
        <div class="container sec3_container">
        <div class="text_sec3">
            <h1 class="heading_sec3">About Us</h1>
            <p class="para_sec3">
            Welcome to Ebook, where we believe that every reader deserves access to an endless library of knowledge and imagination. Founded by passionate bibliophiles, our platform is dedicated to providing a diverse range of eBooks across various genres, from timeless classics to contemporary bestsellers. We strive to create a seamless and immersive reading experience for our users, empowering them to explore, discover, and indulge in the magic of literature from anywhere, at any time. Join us on this journey as we celebrate the written word and embark on endless literary adventures together. 
            </p>

        </div>
        <div class="img_sec3">
            <img src="web_imgs/about_img.png" alt="">
        </div>
        </div>
    </div>


   


   

<?php include('subs.php') ?>

<?php include('footer.php') ?>
  

<script>
      // Disable add to cart buttons if user is not logged in
      const addToCartButtons = document.querySelectorAll('.card_btn[name="add_to_cart"]');
        const isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
        if (!isLoggedIn) {
            addToCartButtons.forEach(function(button) {
                button.disabled = true;
            });
        }


document.addEventListener('DOMContentLoaded', function() {
    // Automatically open the side notification after a delay
    setTimeout(function() {
        // Open the side notification only if the user is not logged in
        if (!<?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>) {
            openSideNotification();
        }
    }, 1000); // Adjust the delay as needed

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

    // Add this JavaScript code to fetch the latest book details and display the popup
    // Delay the display of the popup by 3 seconds (3000 milliseconds)
    setTimeout(function() {
        var popup = document.getElementById('latestBookPopup');
        if (popup) {
            popup.style.display = 'block'; // Display the popup after the delay
        }
    }, 3000);
});

function openSideNotification() {
    var sideNotification = document.getElementById('sideNotification');
    if (sideNotification) {
        sideNotification.style.right = '0'; // Move the notification into view
        sideNotification.style.opacity = '1'; // Make the notification visible
    }
}

function closeSideNotification() {
    var sideNotification = document.getElementById('sideNotification');
    if (sideNotification) {
        sideNotification.style.right = '-300px'; // Move the notification out of view
        sideNotification.style.opacity = '0'; // Make the notification invisible
    }
}

function redirectToLogin() {
    // Redirect to the login page
    window.location.href = 'page_login.php';
}

function redirectToSignup() {
    // Redirect to the signup page
    window.location.href = 'page_signup.php';
}

function closePopup() {
    // Close the popup
    document.getElementById('latestBookPopup').style.display = 'none';
}
</script>

    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>


<script src="file.js"></script>



</body>
</html>





