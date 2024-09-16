<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="popup.css">
</head>
<body>
<div id="latestBookPopup" class="popup" data-aos="fade-up" data-aos-duration="1000">
    <div class="popup-content">
        <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
        <div class="pop_txt">
        <h2>Latest Released Book</h2>
        <p>Step into the world of our newest arrival, where imagination knows no bounds. Whether you're a fan of gripping mysteries, heartwarming romances, or epic adventures, there's something for everyone in our latest collection. From acclaimed authors to exciting newcomers, each book offers a journey into uncharted territories of the mind. </p>
        <img class="pop_img" src="web_imgs/new_rel.png" alt="">
        </div>
        <div id="latestBookDetails">
            <!-- Book details will be dynamically inserted here -->
            <?php

             
// Included database connection
include 'db.php';

// Fetch the latest 8 books from the database
$sql = "SELECT id, title, author, categories, price, description, coverImageUrl FROM books ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

// Check if the query executed successfully
if ($result) {
    // Display each book as a card
    while ($row = $result->fetch_assoc()) {
        
            echo '<div class="card card_sec2 popup_card" style="width: 15rem;margin-right: 0rem;">
            <img src="../admin/' . $row['coverImageUrl'] . '" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">' . $row['title'] . '</p>
              <p class="card-text">Author: ' . $row['author'] . '</p>
              <p class="card-text">Price: ' . $row['price'] . '</p>
              <a href="book_details.php?id=' . $row['id'] . '"  class="card_btn"><i class="fa-regular fa-eye"></i></a>
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
</body>
</html>
