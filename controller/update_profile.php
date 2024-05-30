<?php
session_start(); // Start or resume the session

class User {
    private $conn;

    // Constructor to initialize database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to update an existing user in the database
    public function updateUser($id, $data) {
        // Prepare and bind parameters
        $sql = "UPDATE users SET  f_name=?, l_name=?, email=?, phone=?, address=?, birthdate=?, gender=?, age=?, bank_name=?, bank_account=?, card_holder=?, tin_number=?, company_working=?, company_name=?, company_address=?, company_contact=?, position=?, money_earnings=?, proof_of_billing=?, valid_id=?, coe=?, profile_img=? WHERE id=?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ssssssssssssssssssssssi", 
                $data['first_name'], $data['last_name'], $data['email'], 
                $data['phone'], $data['address'], $data['birthdate'], $data['gender'], 
                $data['age'], $data['bank_name'], $data['bank_account'], $data['card_holder'], 
                $data['tin_number'], $data['company_working_with'], $data['company_name'], 
                $data['company_address'], $data['company_contact'], $data['position'], 
                $data['money_earnings'], $data['proof_of_billing'], $data['valid_id'], $data['certificate_of_employment'], $data['profile_img'], $id);

            // Execute the statement
            if ($stmt->execute()) {
                // Close statement
                $stmt->close();
                return true; // Return true if update is successful
            } else {
                // Handle execution error
                $stmt->close();
                return false;
            }
        }
        return false; // Return false if preparation failed
    }
}

// Include the Database class
include '../model/database.php';

// Connect to the database
$conn = $database->connect();

// Create a new instance of the User class
$user = new User($database->getConnection());

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $data = array(
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'address' => $_POST['address'] ?? '',
        'birthdate' => $_POST['birthdate'] ?? '',
        'gender' => $_POST['gender'] ?? '',
        'age' => 0, // Will be calculated later
        'bank_name' => $_POST['bank_name'] ?? '',
        'bank_account' => $_POST['bank_account'] ?? '',
        'card_holder' => $_POST['card_holder'] ?? '',
        'tin_number' => $_POST['tin_number'] ?? '',
        'company_working_with' => $_POST['company_working_with'] ?? '',
        'company_name' => $_POST['company_name'] ?? '',
        'company_address' => $_POST['company_address'] ?? '',
        'company_contact' => $_POST['company_contact'] ?? '',
        'position' => $_POST['position'] ?? '',
        'money_earnings' => $_POST['money_earnings'] ?? '',
        'proof_of_billing' => '', // This will be handled separately
        'valid_id' => '', // This will be handled separately
        'certificate_of_employment' => '', // This will be handled separately
        'profile_img' => ''
    );

   // Check if files were uploaded
    if (!empty($_FILES['proof_of_billing']['name'])) {
    // Move the uploaded proof_of_billing file to the directory
    $proof_of_billing_file = $target_dir . basename($_FILES["proof_of_billing"]["name"]);
    if (move_uploaded_file($_FILES["proof_of_billing"]["tmp_name"], $proof_of_billing_file)) {
        $data['proof_of_billing'] = $proof_of_billing_file;
    } else {
        echo "Failed to move uploaded proof_of_billing file.";
        exit;
    }
    } else {
        // If no new file is uploaded, retain the existing file path
        $data['proof_of_billing'] = $initialValues['proof_of_billing'];
    }

    // // Hash the password if it's being changed
    // if (!empty($data['password'])) {
    //     $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    // } else {
    //     // If password field is empty, retain the existing password
    //     $data['password'] = $initialValues['password'];
    // }


    // Calculate the age
    $birthdate = date_create($data['birthdate']);
    if ($birthdate) {
        $data['age'] = date_diff($birthdate, date_create('now'))->y;
    } else {
        $data['age'] = 0; // Default to 0 if birthdate is invalid
    }

    // Retrieve the user ID from the session or POST data
    $user_id = $_SESSION['id'] ?? $_POST['id'] ?? 0;

    // Update user in the database
    if ($user->updateUser($user_id, $data)) {
        // User updated successfully
        header("location: ../view/user_dashboard.php");
    } else {
        echo "Failed to update user. Please try again.";
    }
}

// Close database connection
$database->closeConnection();
?>
