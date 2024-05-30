<?php
// Connect to the database
$conn = $database->connect();

// Fetch user loans and associated user name from the database
$sql = "
    SELECT 
        billings.b_id,
        CONCAT(users.f_name, ' ', users.l_name) AS full_name, 
        users.acc_type AS acc_type,
        loans.transaction_id AS transaction_id,
        loans.amount AS loaned_amount, 
        billings.interest, 
        billings.penalty, 
        billings.received_amount, 
        billings.amount_to_pay, 
        billings.due_date,
        billings.b_date,
        billings.b_status
    FROM billings
    JOIN loans ON billings.l_id = loans.l_id
    JOIN users ON loans.id = users.id
    WHERE billings.l_id = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($b_id, $fullname, $acc_type, $transaction_id, $loaned_amount, $interest, $penalty, $received_amount, $amount_to_pay, $due_date, $b_date, $b_status);
            $billings = [];
            while ($stmt->fetch()) {
                $billings[] = [
                    'b_id' => $b_id,
                    'fullname' => $fullname,
                    'acc_type' => $acc_type,
                    'transaction_id' => $transaction_id,
                    'amount' => $loaned_amount,
                    'interest' => $interest,
                    'penalty' => $penalty,
                    'received_amount' => $received_amount,
                    'amount_to_pay' => $amount_to_pay,
                    'due_date' => $due_date,
                    'b_date' => $b_date,
                    'b_status' => $b_status
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

// Fetch all loans with user names for the manage users section
$users_sql = "
    SELECT 
        billings.b_id,
        CONCAT(users.f_name, ' ', users.l_name) AS full_name,
        users.acc_type AS acc_type,
        loans.transaction_id AS transaction_id,
        loans.amount AS loaned_amount, 
        billings.interest, 
        billings.penalty, 
        billings.received_amount, 
        billings.amount_to_pay, 
        billings.due_date,
        billings.b_date,
        billings.b_status
    FROM billings 
    JOIN loans ON billings.l_id = loans.l_id
    JOIN users ON loans.id = users.id";

$users_result = $conn->query($users_sql);

$conn->close();
?>