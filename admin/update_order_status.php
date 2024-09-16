<?php
// Include the PHPMailer Autoload file
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Include the database connection
include '../user/db.php';

// Function to send email
function sendEmail($to, $subject, $message) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // Enable SMTP debugging
    $mail->SMTPDebug = 2;

    // Set up SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    // Gmail username and password
    $mail->Username = 'ebook247.store@gmail.com';
    $mail->Password = 'zfkl qcfc lhlv xzew';

    // Set sender and recipient
    $mail->setFrom('ebook247.store@gmail.com', 'Ebook');
    $mail->addAddress($to);

    // Email subject and body
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send email
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}
// Check if the form is submitted and the order ID is set
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Check if the 'Approve' button is clicked
    if (isset($_POST['approve_order'])) {
        // Update the status of the order to 'Approved'
        $status = 'Approved';
        $sql = "UPDATE orders SET status = '$status' WHERE id = $order_id";
        if ($conn->query($sql) === TRUE) {
            // Get the email of the user who placed the order
            $sql_order = "SELECT * FROM orders WHERE id = $order_id";
            $result_order = $conn->query($sql_order);
            if ($result_order->num_rows > 0) {
                $row_order = $result_order->fetch_assoc();
                $user_email = $row_order['email'];
                $book_title = $row_order['title'];
                $book_author = $row_order['author'];
                $book_price = $row_order['price'];
                $total_price = $row_order['total_price'];

                // Send email notification
                $subject = 'Get Ready To Rcieve Your Order';
                $message = 'Your order from ebook has been approved.';
                // $message .= "\n\nBook Title: " . $book_title;
                // $message .= "\nAuthor: " . $book_author;
                // $message .= "\nPrice: $" . $book_price;
                
                if (sendEmail($user_email, $subject, $message)) {
                    echo "Email notification sent successfully.";
                } else {
                    echo "Error sending email notification.";
                }
            } else {
                echo "Error: No order found with ID $order_id.";
            }

            // Redirect back to the admin dashboard
            header("Location: orders.php");
            exit();
        } else {
            echo "Error updating order status: " . $conn->error;
        }
    }

    // Check if the 'Mark as Pending' button is clicked
    if (isset($_POST['mark_pending_order'])) {
        // Update the status of the order to 'Pending'
        $status = 'Pending';
        $sql = "UPDATE orders SET status = '$status' WHERE id = $order_id";
        if ($conn->query($sql) === TRUE) {
            // Redirect back to the admin dashboard
            header("Location: orders.php");
            exit();
        } else {
            echo "Error updating order status: " . $conn->error;
        }
    }
} else {
    // If order ID is not set, redirect back to the admin dashboard
    header("Location: orders.php");
    exit();
}


    



// Close the database connection
$conn->close();
?>
