<?php
// Include database connection and any required dependencies
include_once '../model/database.php';

// Function to delete expired registrations
function deleteExpiredRegistrations() {
    $database = new Database();
    $conn = $database->connect();

    // Calculate the timestamp one minute ago
    $toDelete = date('Y-m-d H:i:s', strtotime('5 seconds'));

   

    // Prepare SQL statement to delete rejected registrations older than one minute
    $query = "DELETE FROM users WHERE registration_status = 'Rejected' AND rejection_timestamp < ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $toDelete); // Bind as string
    
    // Debugging: Check how many records will be affected
    $selectQuery = "SELECT * FROM users WHERE registration_status = 'Rejected' AND rejection_timestamp < ?";
    $selectStmt = $conn->prepare($selectQuery);
    $selectStmt->bind_param('s', $toDelete);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $count = $result->num_rows;

    // Execute the delete query
    if ($stmt->execute()) {
        echo "";
    } else {
        echo "Error deleting expired registrations: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
