<?php
include_once '../model/database.php';
include_once '../model/clean_up.php';
$conn = $database->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $userId = $_POST['userId'];
    $acc_type = $_POST['account_type'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $bank_name = $_POST['bank_name'];
    $bank_account = $_POST['bank_account'];
    $card_holder = $_POST['card_holder'];
    $tin_number = $_POST['tin_number'];
    $company_working = $_POST['company_working'];
    $company_name = $_POST['company_name'];
    $company_address = $_POST['company_address'];
    $company_contact = $_POST['company_contact'];
    $position = $_POST['position'];
    $registration_status = $_POST['registration_status'];
    $block_email = isset($_POST['block_email']) ? $_POST['block_email'] : ""; // Assuming block_email is a checkbox value
    $status = $_POST['status'];

    // Handle image upload
    // ...

    // Check if registration status is "Approved"
    if ($registration_status === 'Approved') {
        // Update status to "Active"
        $status = 'Active';
    }

    // Check if registration status is "Rejected"
    if ($registration_status === 'Rejected') {
        // Update rejection timestamp
        $rejection_timestamp = date('Y-m-d H:i:s'); // Current timestamp
        deleteExpiredRegistrations();
    } else {
        $rejection_timestamp = null; // Set to null if status is not "Rejected"
    }


    if ($status === 'Active') {
        // Ensure that it can only be updated to "Active"
        $status = 'Disabled';
    }
    
    

    // Prepare and execute SQL update statement
    $query = "UPDATE users SET 
                acc_type = ?,
                f_name = ?, 
                l_name = ?, 
                email = ?, 
                phone = ?, 
                address = ?, 
                birthdate = ?, 
                gender = ?,
                age = ?, 
                bank_name = ?, 
                bank_account = ?, 
                card_holder = ?, 
                tin_number = ?, 
                company_working = ?, 
                company_name = ?, 
                company_address = ?, 
                company_contact = ?, 
                position = ?, 
                registration_status = ?, 
                blocked = ?,
                status = ?,
                rejection_timestamp = ?
              WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssssssssssssssssssss', $acc_type, $f_name, $l_name, $email, $phone, $address, $birthdate, $gender, $age, $bank_name, $bank_account, $card_holder, $tin_number, $company_working, $company_name, $company_address, $company_contact, $position, $registration_status, $block_email, $status, $rejection_timestamp, $userId);

    if ($stmt->execute()) {
        echo "User updated successfully";
        header("location: ../view/admin_dashboard.php");
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
