<?php
include '../model/database.php';

// Connect to the database
$conn = $database->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Approve'])) {
        $id = $_POST['id'];
        approveLoan($conn, $transaction_id);
    } elseif (isset($_POST['Reject'])) {
        // Implement reject functionality if needed
    }
}

function approveLoan($conn, $transaction_id) {
    $sql = "UPDATE loan SET registration_status = 'Approved' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $transaction_id);
    if ($stmt->execute()) {
        echo "Approved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all loan transactions
$users_sql = "SELECT id FROM loans WHERE registration_status = 'Pending'";
$users_result = $conn->query($users_sql);

$conn->close();
?>
