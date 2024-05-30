<?php
include "../model/database.php";

// Connect to the database
$conn = $database->connect();

// Get the transaction ID and new status from the POST data
$transaction_id = isset($_POST['transaction_id']) ? $_POST['transaction_id'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$note = isset($_POST['note']) ? $_POST['note'] : 'None'; // Set default note value

if (empty($transaction_id) || empty($status)) {
    echo "Invalid request.";
    exit;
}

// Update the loan status and note in the database
$sql = "UPDATE loans SET status = ?, note = ? WHERE transaction_id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sss", $status, $note, $transaction_id);
    if ($stmt->execute()) {
        echo "Loan status updated successfully.";
        // Redirect back to the user detail page
        header("Location: ../view/admin_dashboard.php?show=admin_loans");
        exit;
    } else {
        echo "Failed to update the loan status.";
    }
    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}

$conn->close();
?>


<script>
    var showAdminLoans = getUrlParameter('show') === 'admin_loans';

// If 'show' parameter is set to 'login', display the login form
if (showAdminLoans) {
    document.getElementById('admin_loans').style.display = "block";
}
</script>