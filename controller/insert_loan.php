<?php
session_start();

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertLoan($data) {
        $currentDate = date('Y-m-d H:i:s');

        $sql = "INSERT INTO loans (date, transaction_id, amount, payable_months, id) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ssssi", $currentDate, $data['transaction_id'], $data['loanAmount'], $data['payableMonths'], $data['id']);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
        return false;
    }

    public function getTotalLoanAmount($user_id) {
        $sql = "SELECT SUM(amount) AS total_amount FROM loans WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($total_loan_amount);
            $stmt->fetch();
            $stmt->close();
            return $total_loan_amount;
        }
        return 0;
    }
}

include '../model/database.php';
$conn = $database->connect();

$user = new User($conn);

// Check if the total loan amount exceeds $10,000
$user_id = $_SESSION['id'];
$total_loan_amount = $user->getTotalLoanAmount($user_id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = array(
        'transaction_id' => $_POST['transaction_id'] ?? '',
        'loanAmount' => $_POST['loanAmount'] ?? '',
        'payableMonths' => $_POST['payableMonths'] ?? '',
        'id' => $_SESSION['id']
    );

    // Check if the new loan amount will exceed $10,000
    if ($total_loan_amount + $data['loanAmount'] > 10000) {
        echo "You have reached the maximum loan limit of 10,000.";
        exit(); // Stop further processing
    }

    // Insert the new loan
    if ($user->insertLoan($data)) {
        header("Location: ../view/user_dashboard.php");
        exit();
    } else {
        echo "Failed to submit the loan application.";
    }
}

$database->closeConnection();
?>

