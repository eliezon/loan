<?php
session_start(); // Start or resume the session

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("location: ../view/login_page.php");
exit;
?>