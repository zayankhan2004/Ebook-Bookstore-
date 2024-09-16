<?php
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']); // Decode URL-encoded string
    $filepath = "../admin/uploads/" . $file;

    if (file_exists($filepath)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    } else {
        echo "File does not exist.";
    }
} else {
    echo "No file specified.";
}
?>
