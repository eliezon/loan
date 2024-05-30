<?php
include "../model/database.php";
// Connect to the database
$conn = $database->connect();

// Get the user ID and transaction ID from the URL parameters
$user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;
$transaction_id = isset($_GET['transaction_id']) ? $_GET['transaction_id'] : '';

if ($user_id === 0 || empty($transaction_id)) {
    echo "Invalid user ID or transaction ID.";
    exit;
}

// Fetch user details and their loans
$sql = "
    SELECT 
        users.id, 
        users.acc_type, 
        users.f_name, 
        users.l_name, 
        users.email, 
        users.phone, 
        users.address, 
        users.birthdate, 
        users.gender, 
        users.age, 
        users.bank_name, 
        users.bank_account, 
        users.card_holder, 
        users.tin_number, 
        users.company_working, 
        users.company_name, 
        users.company_address, 
        users.company_contact, 
        users.position, 
        users.money_earnings, 
        users.proof_of_billing, 
        users.valid_id, 
        users.coe, 
        users.profile_img, 
        loans.l_id, 
        loans.date, 
        loans.transaction_id, 
        loans.amount, 
        loans.payable_months, 
        loans.status, 
        loans.note 
    FROM users 
    LEFT JOIN loans ON users.id = loans.id
    WHERE users.id = ? AND loans.transaction_id = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("is", $user_id, $transaction_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user_loans = [];
        while ($row = $result->fetch_assoc()) {
            $user_loans[] = $row;
        }
    } else {
        echo "Failed to execute the SQL statement.";
    }
    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}

$conn->close();
?>
