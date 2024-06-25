<?php
session_start(); // Start the session

// Clear all session data
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired destination
header('Location: login.php');
exit;
?>
