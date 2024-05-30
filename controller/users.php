<?php
include '../model/database.php';
include '../model/user_manager.php';

$conn = $database->connect();

// Create a new instance of the UserManager class
$userManager = new UserManager($conn);

// Fetch all pending users
$Users = $userManager->getUsers();
?>
