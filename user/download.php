<?php
// Include the database connection
include 'db.php';

if (isset($_GET['file'])) {
    // Ensure the file parameter is safe
    $file = urldecode($_GET['file']);
    $filePath = __DIR__ . '/uploads/' . $file;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers to initiate a file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Clear the output buffer
        ob_clean();
        flush();

        // Read the file and send it to the output
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>
