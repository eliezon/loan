<?php
// Connect to the database
$conn = $database->connect();

// Fetch user data from the database
$sql = "SELECT l_id, date, transaction_id, amount, payable_months, status, note FROM loans WHERE l_id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($l_id, $date, $transaction_id, $amount, $payable_months, $status, $note);
            if ($stmt->fetch()) {
                // Format the birthdate
                $birthdateFormatted = (new DateTime($birthdate))->format('F j, Y');
            }
        }
    } else {
        echo "Failed to execute the SQL statement.";
    }
    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}



// Fetch all loans for the current user
$users_sql = "SELECT l_id, date, transaction_id, amount, payable_months, status, note FROM loans WHERE id = ?";
$stmt = $conn->prepare($users_sql);
$stmt->bind_param("i", $user_id); // Assuming user_id is an integer, adjust the type accordingly
if ($stmt->execute()) {
    $users_result = $stmt->get_result();
    // Further processing of the result
} else {
    echo "Failed to execute the SQL statement: " . $stmt->error;
}
$stmt->close();

$conn->close();
?>