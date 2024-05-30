<?php
session_start(); // Start or resume the session

class User {
    private $conn;

    // Constructor to initialize database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to check if an email already exists in the database and whether it is blocked
    public function emailStatus($email) {
        $sql = "SELECT blocked FROM users WHERE email = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($blocked);
                $stmt->fetch();
                $stmt->close();
                if ($blocked == 'Blocked') {
                    return 'blocked';
                } else {
                    return 'exists';
                }
            }
            $stmt->close();
        }
        return 'available';
    }

    // Method to check if a password already exists in the database
    public function passwordExists($password) {
        $sql = "SELECT id FROM users WHERE password = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $password);
            $stmt->execute();
            $stmt->store_result();
            $exists = $stmt->num_rows > 0;
            $stmt->close();
            return $exists;
        }
        return false;
    }

    // Method to insert a new user into the database
    public function insertUser($data) {
        // Prepare and bind parameters
        $sql = "INSERT INTO users (acc_type, f_name, l_name, email, password, phone, address, birthdate, gender, age, bank_name, bank_account, card_holder, tin_number, company_working, company_name, company_address, company_contact, position, money_earnings, proof_of_billing, valid_id, coe) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sssssssssssssssssssssss", 
                $data['account_type'], $data['first_name'], $data['last_name'], $data['email'], 
                $data['password'], $data['phone'], $data['address'], $data['birthdate'], $data['gender'], 
                $data['age'], $data['bank_name'], $data['bank_account'], $data['card_holder'], 
                $data['tin_number'], $data['company_working_with'], $data['company_name'], 
                $data['company_address'], $data['company_contact'], $data['position'], 
                $data['money_earnings'], $data['proof_of_billing'], $data['valid_id'], $data['certificate_of_employment']);

            // Execute the statement
            if ($stmt->execute()) {
                // Close statement
                $stmt->close();
                return true; // Return true if insertion is successful
            } else {
                // Handle execution error
                $stmt->close();
                return false;
            }
        }
        return false; // Return false if preparation failed
    }

    // Method to count the number of Premium members
    public function countPremiumMembers() {
        $sql = "SELECT COUNT(*) FROM users WHERE acc_type = 'Premium'";
        $result = $this->conn->query($sql);
        if ($result) {
            $row = $result->fetch_array();
            return $row[0];
        } else {
            return 0;
        }
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
        'account_type' => $_POST['account_type'] ?? '',
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'address' => $_POST['address'] ?? '',
        'birthdate' => ($_POST['year'] ?? '') . '-' . ($_POST['month'] ?? '') . '-' . ($_POST['day'] ?? ''), // Combine year, month, and day
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
        'certificate_of_employment' => '' // This will be handled separately
    );

    // Check the email status
    $emailStatus = $user->emailStatus($data['email']);
    if ($emailStatus == 'exists') {
        echo "Email is already taken. Please use a different email.";
        exit;
    } elseif ($emailStatus == 'blocked') {
        echo "Email is blocked, you can't register again with this email!";
        exit;
    }


    // Check if the password already exists
    // Note: Storing passwords in plaintext and checking them directly is not a secure practice.
    // Ideally, passwords should be hashed and compared in a secure manner.
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    if ($user->passwordExists($hashedPassword)) {
        echo "Password is already taken. Please use a different password.";
        exit;
    }

    // Check if the account type is Premium and the maximum limit is reached
    if ($data['account_type'] == 'Premium') {
        $premiumCount = $user->countPremiumMembers();
        if ($premiumCount >= 50) {
            echo "Premium account registration limit reached. Register to basic account!";
            exit;
        }
    }

    // Hash the password
    $data['password'] = $hashedPassword;

    // Calculate the age
    $birthdate = date_create($data['birthdate']);
    if ($birthdate) {
        $data['age'] = date_diff($birthdate, date_create('now'))->y;
    } else {
        $data['age'] = 0; // Default to 0 if birthdate is invalid
    }

    // Check if files were uploaded
    if (isset($_FILES['proof_of_billing']) && isset($_FILES['valid_id']) && isset($_FILES['certificate_of_employment'])) {
        // Check for file upload errors
        if ($_FILES['proof_of_billing']['error'] !== UPLOAD_ERR_OK || $_FILES['valid_id']['error'] !== UPLOAD_ERR_OK || $_FILES['certificate_of_employment']['error'] !== UPLOAD_ERR_OK) {
            echo "Error during file upload.";
            exit;
        }

        // Move the uploaded files to the directory
        $target_dir = "../controller/uploads/";
        $proof_of_billing_file = $target_dir . basename($_FILES["proof_of_billing"]["name"]);
        $valid_id_file = $target_dir . basename($_FILES["valid_id"]["name"]);
        $certificate_of_employment_file = $target_dir . basename($_FILES["certificate_of_employment"]["name"]);

        if (move_uploaded_file($_FILES["proof_of_billing"]["tmp_name"], $proof_of_billing_file) && move_uploaded_file($_FILES["valid_id"]["tmp_name"], $valid_id_file) && move_uploaded_file($_FILES["certificate_of_employment"]["tmp_name"], $certificate_of_employment_file)) {
            // Update the data array with file paths
            $data['proof_of_billing'] = $proof_of_billing_file;
            $data['valid_id'] = $valid_id_file;
            $data['certificate_of_employment'] = $certificate_of_employment_file;

            // Insert user into the database
            if ($user->insertUser($data)) {
                // User inserted successfully
                header("location: ../view/login_page.php");
            } else {
                echo "Failed to register user. Please try again.";
            }
        } else {
            echo "Failed to move uploaded files.";
        }
    } else {
        echo "Files not uploaded. Please try again.";
    }
}

// Close database connection
$database->closeConnection();
?>
