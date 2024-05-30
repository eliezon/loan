<?php 
session_start(); // Start the session

// Check if user is not logged in
if (!isset($_SESSION["id"])) {
    // Redirect user to login page
    header("location: login_page.php");
    exit;
}

class Database1{
  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $conn;

  public function __construct($servername, $username, $password, $dbname) {
      $this->servername = $servername;
      $this->username = $username;
      $this->password = $password;
      $this->dbname = $dbname;
  }

  public function connect() {
      // Create connection
      $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

      // Check connection
      if ($this->conn->connect_error) {
          die("Connection failed: " . $this->conn->connect_error);
      }
      return $this->conn;
  }

  public function getConnection() {
      return $this->conn;
  }

  public function closeConnection() {
      $this->conn->close();
  }
}


// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loan";

// Create a new instance of the Database class
$database = new Database1($servername, $username, $password, $dbname);

// Connect to the database
$conn = $database->connect();

// Get the user ID from session
$user_id = $_SESSION['id'];
?>
