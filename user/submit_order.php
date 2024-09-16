<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks For Ordering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>

</head>

<style>
   body
   {
    background: transparent !important;
   }
    h1
    {
        padding: 5rem;
        background: #45454556;
    border-radius: 100rem;
    backdrop-filter: blur(10px);
    border: 2px solid #d1a75b;
    filter: drop-shadow(0px 0px 10px #d1a75b);
        position: absolute;
        top: 25%;
        left: 20%;
        color: #fff !important;
    }

    
.video-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -100;
  }
  
  .video-wrap {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
  
  #bg-video {
    position: absolute;
    top: 0;
    left: 0;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -1;
  }

  .floating-button {
    display: flex;
    align-items: center;
    position: fixed;
    z-index: 10000;
    top: 20px; /* Adjust the distance from the bottom */
    right: 20px; /* Adjust the distance from the right */
    background-color: #d1a75b; /* Button background color */
    color: #fff; /* Text color */
    border: none;
    border-radius: 10%;
    padding: 2px 2px;
    /* width: 80px; Button width */
    padding: 5px 10px;
    height: 60px; /* Button height */
    font-size: 20px; /* Font size */
    text-align: center;
    line-height: 60px; /* Center text vertically */
    cursor: pointer;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow */
}

</style>
<body>


<a class="floating-button" href="index.php">Back &emsp14;<i class="fa-solid fa-arrow-right"></i></a>
    <div class="video-background">
        <div class="video-wrap">
          <video autoplay muted loop id="bg-video">
            <source src="book_bg2.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
    </div>
    <?php
// Include the database connection
include 'db.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$method = $_POST['method'];
$flat = $_POST['flat'];
$street = $_POST['street'];
$city = $_POST['city'];
$country = $_POST['country'];
$pin_code = $_POST['pin_code'];
$total_products = $_POST['total_products'];
$total_price = $_POST['total_price']; // Corrected to POST

// Get book details
$book_id = $_POST['book_id'];
$title = $_POST['title'];
$author = $_POST['author'];
$price = $_POST['price'];

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO orders (name, email, method, flat, street, city, country, pin_code, total_products, total_price, book_id, title, author, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    // Error preparing statement
    echo "Error preparing statement: " . $conn->error;
    exit();
}

$bind_result = $stmt->bind_param("ssssssssddsssd", $name, $email, $method, $flat, $street, $city, $country, $pin_code, $total_products, $total_price, $book_id, $title, $author, $price);

if ($bind_result === false) {
    // Error binding parameters
    echo "Error binding parameters: " . $stmt->error;
    exit();
}

// Execute SQL statement
if ($stmt->execute()) {
    // Order placed successfully, echo message
    echo "<h1>Order placed successfully!</h1>";
    exit();
} else {
    echo "Error executing statement: " . $stmt->error;
    exit();
}

// Close statement
$stmt->close();

$conn->close();
?>

</body>
</html>



