<?php
session_start();
require '../user/db.php';

// Initialize error message variable
$error_message = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $essay = trim($_POST['essay']);
    $start_time = $_SESSION['start_time'] ?? null;

    // Check if start_time is available
    if (!$start_time) {
        $error_message = "Warning: Undefined start time. Please start the competition first.";
    } elseif (str_word_count($essay) < 120) {
        $error_message = "Error: Essay must be at least 120 words.";
    } else {
        // Process the submission (Insert into the database, etc.)
        // Save the submission details, calculate score, etc.
        
        // Example: Inserting the submission into the database
        $end_time = time();
        $score = $end_time - $start_time; // Calculate score based on time taken

        $stmt = $conn->prepare("INSERT INTO submissions (name, email, essay, start_time, end_time, score) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $name, $email, $essay, date("Y-m-d H:i:s", $start_time), date("Y-m-d H:i:s", $end_time), $score);

        if ($stmt->execute()) {
            // Redirect to the competition page after successful submission
            header("Location: essay.php?success=true");
            exit;
        } else {
            $error_message = "Error submitting your essay. Please try again.";
        }
    }
}

// Pass error message to JavaScript if it exists and redirect back to the essay page
if ($error_message) {
    echo "<script>
        alert('$error_message');
        window.location.href = 'essay.php';
    </script>";
    exit;
}
?>
