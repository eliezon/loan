<?php
// Connect to the database
$conn = $database->connect();

// Fetch user loans and associated user name from the database
$sql = "
    SELECT 
        loans.l_id, 
        users.id AS id,
        CONCAT(users.f_name, ' ', users.l_name) AS full_name, 
        loans.date, 
        loans.transaction_id, 
        loans.amount, 
        loans.payable_months, 
        loans.status, 
        loans.note 
    FROM loans 
    JOIN users ON loans.id = users.id
    WHERE loans.id = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($l_id, $fname, $date, $transaction_id, $amount, $payable_months, $status, $note);
            $loans = [];
            while ($stmt->fetch()) {
                $loans[] = [
                    'l_id' => $l_id,
                    'full_name' => $full_name,
                    'date' => $date,
                    'transaction_id' => $transaction_id,
                    'amount' => $amount,
                    'payable_months' => $payable_months,
                    'status' => $status,
                    'note' => $note
                ];
            }
        }
    } else {
        echo "Failed to execute the SQL statement.";
    }
    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}

// Check if the "Approve" button is clicked
if (isset($_POST['approve'])) {
    // Get the user ID from the form
    $user_id_to_approve = $_POST['user_id'];

    // Update the registration status to "Approved"
    $update_sql = "UPDATE users SET registration_status = 'Approved' WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $user_id_to_approve);
    if ($stmt->execute()) {
        echo "User registration status updated to Approved successfully.";
    } else {
        echo "Failed to update user registration status.";
    }
    $stmt->close();
}

// Fetch all loans with user names for the manage users section
$users_sql = "
    SELECT 
        loans.l_id, 
        users.id AS id,
        CONCAT(users.f_name, ' ', users.l_name) AS full_name, 
        loans.date, 
        loans.transaction_id, 
        loans.amount, 
        loans.payable_months, 
        loans.status, 
        loans.note 
    FROM loans 
    JOIN users ON loans.id = users.id";

$users_result = $conn->query($users_sql);



$conn->close();
?>
