<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <title>Subscribe - Ebook</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="nav.css">
</head>
<style>
   body {
       background: transparent !important;
   }
   h1 {
       padding: 8rem;
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
       top: 20px;
       right: 20px;
       background-color: #d1a75b;
       color: #fff;
       border: none;
       border-radius: 10%;
       padding: 5px 10px;
       height: 60px;
       font-size: 20px;
       text-align: center;
       line-height: 60px;
       cursor: pointer;
       box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
   }
</style>
<body>
<a class="floating-button" href="../index.php">Back &emsp14;<i class="fa-solid fa-arrow-right"></i></a>
<div class="video-background">
    <div class="video-wrap">
        <video autoplay muted loop id="bg-video">
            <source src="book_bg2.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
</div>

<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include PHPMailer autoloader
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['subscribe'])) {
    $email = $_POST['email'];

    // Validate the email (you may want to add more robust validation)
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Process the subscription
        if (!checkIfEmailExists($email)) {
            if (subscribeUser($email)) {
                sendNewsletterNotification($email);
            } else {
                echo '<h1>Subscription failed. Please try again.</h1>';
            }
        } else {
            echo '<h1>You have already subscribed!</h1>';
        }
    } else {
        echo '<h1>Invalid email address</h1>';
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["email"])) {
    // Check if the email is set in the query parameters
    $subscriberEmail = $_GET["email"];

    // Validate the email (you may want to add more robust validation)
    if (filter_var($subscriberEmail, FILTER_VALIDATE_EMAIL)) {
        // Process the subscription
        if (!checkIfEmailExists($subscriberEmail)) {
            if (subscribeUser($subscriberEmail)) {
                sendNewsletterNotification($subscriberEmail);
            } else {
                echo '<h1>Subscription failed. Please try again.</h1>';
            }
        } else {
            echo '<h1>You have already subscribed!</h1>';
        }
    } else {
        echo '<h1>Invalid email address</h1>';
    }
} else {
    echo '<h1>Invalid request method or email parameter not set</h1>';
}

function checkIfEmailExists($email)
{
    // Establish database connection
    include('../db.php');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM subscribers WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result === false) {
        die("Get result failed: " . $conn->error);
    }

    // Check if the email exists
    $exists = $result->num_rows > 0;

    // Close connections
    $stmt->close();
    mysqli_close($conn);
    
    return $exists;
}

function subscribeUser($email)
{
    // Establish database connection
    include('../db.php');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $success = $stmt->execute();
    
    if (!$success) {
        // Check if the error is due to duplicate entry
        if (mysqli_errno($conn) == 1062) {
            // Email already exists, but handle it gracefully
            $success = true;
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close connections
    $stmt->close();
    mysqli_close($conn);
    
    return $success;
}

function sendNewsletterNotification($subscriberEmail)
{
    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0; // Set to 2 for debugging
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Assuming you're using Gmail SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ebook247.store@gmail.com'; // Your Gmail address
        $mail->Password   = 'zfkl qcfc lhlv xzew'; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender and recipient
        $mail->setFrom('ebook247.store@gmail.com', 'Ebook'); // Your Gmail address and your name
        $mail->addAddress($subscriberEmail);  // Use the subscriber's email address as the recipient

        // Subject and body
        $mail->Subject = 'Subscription Confirmation';
        $mail->isHTML(true);
        $mail->Body    = 'Thank you for subscribing to our newsletter!';

        // Send email notification
        $mail->send();

        echo '<h1>Notification sent successfully!</h1>';
    } catch (Exception $e) {
        echo "Failed to send notification. Error: {$mail->ErrorInfo}";
    }
}
?>

<script src="cart.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="file.js"></script>
</body>
</html>
