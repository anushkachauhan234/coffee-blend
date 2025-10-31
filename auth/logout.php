<?php
session_start();

// Remove all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to home page (or login page)
require_once "../config/config.php"; // Include config to use APPURL
header("Location: " . APPURL);
exit();
?>
