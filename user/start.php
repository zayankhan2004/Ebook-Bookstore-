<?php
session_start();
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time(); // Store the start time as the current timestamp
}
?>
