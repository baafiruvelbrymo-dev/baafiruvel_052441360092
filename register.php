<?php
// Start session - This must be at the very top before any HTML output
session_start();

// Check if user is already logged in, redirect to dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php");
    exit();
}

// Redirect to login page where registration is combined
header("Location: login.php");
exit();
?>
