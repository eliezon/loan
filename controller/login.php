<?php
session_start(); // Start or resume the session

class Authentication {
    private $conn;

    // Constructor to initialize database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to authenticate user
    public function authenticateUser($username, $password) {
        // Check if username and password fields are empty
        if (empty($username) || empty($password)) {
            return "<span style='color: red;'>All fields are required.<br><br></span>";
        }

        // Check if username contains "@" and ".com"
        if (!(strpos($username, '@') !== false && strpos($username, '.com') !== false)) {
            return "<span style='color: red;'>Username must contain '@' and '.com'.<br><br></span>";
        }

        // Attempt to authenticate the user
        return $this->attemptLogin($username, $password);
    }

    // Method to attempt login
    private function attemptLogin($username, $password) {
        $sql = "SELECT id, acc_type, f_name, l_name, email, phone, birthdate, address, gender, age, bank_name, bank_account, card_holder, tin_number, company_working, company_name, company_address, company_contact, position, money_earnings, proof_of_billing, valid_id, coe, profile_img, password, user_type FROM users WHERE email = ? AND registration_status = 'Approved' ";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $acc_type, $f_name, $l_name, $email, $phone, $birthdate, $address, $gender, $age, $bank_name, $bank_account, $card_holder, $tin_number, $company_working, $company_name, $company_address, $company_contact, $position, $money_earnings, $proof_of_billing, $valid_id, $coe, $profile_img, $hashed_password, $user_type);

                    if ($stmt->fetch()) {
                        // Verify password
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["acc_type"] = $acc_type;
                            $_SESSION["email"] = $email;
                            $_SESSION["f_name"] = $f_name;
                            $_SESSION["l_name"] = $l_name;
                            $_SESSION["phone"] = $phone;
                            $_SESSION["address"] = $address;
                            $_SESSION["birthdate"] = $birthdate;
                            $_SESSION["age"] = $age;
                            $_SESSION["gender"] = $gender;
                            $_SESSION["bank_name"] = $bank_name;
                            $_SESSION["bank_account"] = $bank_account;
                            $_SESSION["card_holder"] = $card_holder;
                            $_SESSION["tin_number"] = $tin_number;
                            $_SESSION["company_working"] = $company_working;
                            $_SESSION["company_name"] = $company_name;
                            $_SESSION["company_address"] = $company_address;
                            $_SESSION["company_contact"] = $company_contact;
                            $_SESSION["position"] = $position;
                            $_SESSION["money_earnings"] = $money_earnings;
                            $_SESSION["proof_of_billing"] = $proof_of_billing;
                            $_SESSION["valid_id"] = $valid_id;
                            $_SESSION["coe"] = $coe;
                            $_SESSION["profile_img"] = $profile_img;
                            $_SESSION["plain_password"] = $password;
                            $_SESSION["user_type"] = $user_type;

                            // Redirect user to appropriate dashboard
                            if ($user_type == 'Admin') {
                                header("location: ../view/admin_dashboard.php");
                            } else {
                                header("location: ../view/user_dashboard.php");
                            }
                            exit;
                        } else {
                            // Display an error message if password is not valid
                            return "<span style='color: rgb(253, 38, 38);'>Incorrect password.<br><br></span>";
                        }
                    }
                } else {
                    return "<span style='color: rgb(253, 38, 38);'>Email not found.<br><br></span>";
                }
            } else {
                return "<span style='color: rgb(253, 38, 38);'>Oops! Something went wrong. Please try again later.<br><br></span>";
            }
            // Close statement
            $stmt->close();
        }
        return "<span style='color: rgb(253, 38, 38);'>Email not found.<br><br></span>";
    }
}

// Include database connection
include '../model/database.php';


// Connect to the database
$conn = $database->connect();

// Create a new instance of the Authentication class
$authentication = new Authentication($database->getConnection());

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Authenticate user
    $authenticationResult = $authentication->authenticateUser($username, $password);

    // Display authentication result
    echo $authenticationResult;
}

// Close database connection
$database->closeConnection();
?>
