<?php
// Start session - This must be at the very top before any HTML output
session_start();

// Destroy all session data - This will log out the user
session_destroy();

// Redirect to home page
header("Location: index.php");
exit();
?>
