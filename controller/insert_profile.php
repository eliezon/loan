<?php
session_start(); // Start or resume the session

class User {
    private $conn;

    // Constructor to initialize database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to update user's profile image in the database
    public function updateUserProfileImage($userId, $profileImgPath) {
        // Prepare and bind parameters
        $sql = "UPDATE users SET profile_img = ? WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("si", $profileImgPath, $userId);

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
    // Check if the user is logged in
    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id']; // Get the logged-in user's ID

        // Check if files were uploaded
        if (isset($_FILES['profile_img'])) {
            // Check for file upload errors
            if ($_FILES['profile_img']['error'] !== UPLOAD_ERR_OK) {
                echo "Error during file upload.";
                exit;
            }

           

            // Move the uploaded file to the directory
            $target_dir = "../controller/uploads/";
            $profile_img_file = $target_dir . basename($_FILES["profile_img"]["name"]);
            if (move_uploaded_file($_FILES["profile_img"]["tmp_name"], $profile_img_file)) {
                // Update the user's profile image in the database
                if ($user->updateUserProfileImage($userId, $profile_img_file)) {
                    // Profile image updated successfully
                    // Redirect to user dashboard
                    header("location: ../view/user_dashboard.php");
                } else {
                    echo "Failed to update profile image. Please try again.";
                }
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "File not uploaded. Please try again.";
        }
    } else {
        echo "User not logged in.";
    }
}

// Close database connection
$database->closeConnection();
?>
