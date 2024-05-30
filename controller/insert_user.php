<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include '../model/database.php';

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO user (fname, lname, email, password, phone, address, birthday) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $password, $phone, $address, $birthday);

    // Set parameters and execute
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $birthday = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day']; // Concatenate year, month, and day

    if ($stmt->execute()) {
        // Redirect to success page
        header("Location: ../view/login_page.php");
        exit();
    } else {
        // Redirect to error page
        header("Location: ../error.php");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if accessed directly
    header("Location: ../view/index.php");
    exit();
}
?>
