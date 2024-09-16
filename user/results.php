<?php
require 'db.php';

$result = $conn->query("SELECT * FROM submissions ORDER BY score ASC LIMIT 1");
$best_submission = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Results</title>
</head>
<body>
    <div class="container">
        <h1>Competition Results</h1>
        <?php if ($best_submission): ?>
            <p>Start Time: <?php echo $best_submission['start_time']; ?></p>
            <p>End Time: <?php echo $best_submission['end_time']; ?></p>
            <p>Best Score (Time in seconds): <?php echo $best_submission['score']; ?></p>
        <?php else: ?>
            <p>No submissions yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
