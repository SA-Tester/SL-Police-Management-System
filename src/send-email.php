<?php
require_once './classes/class-db-connector.php';
use classes\DBConnector;

class EmailChecker
{
    private $conn;

    public function __construct()
    {
        // Create a new instance of DbConnector to connect to the database
        $dbConnector = new DbConnector();
        $this->conn = $dbConnector->getConnection();
    }

    public function checkEmailExists($recipientEmail)
    {
        try {
            // Check if the email already exists in the database
            $stmt = $this->conn->prepare("SELECT * FROM people WHERE email = :email");
            $stmt->bindParam(':email', $recipientEmail);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // The email exists in the database
                return true;
            } else {
                // The email does not exist in the database
                return false;
            }
        } catch (PDOException $e) {
            // Return an error message if there's an exception
            return false;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the recipient email from the AJAX request
    $recipientEmail = $_POST["recipientEmail"];

    // Create a new instance of the EmailChecker class
    $emailChecker = new EmailChecker();

    // Check if the email exists in the database
    if ($emailChecker->checkEmailExists($recipientEmail)) {
        echo "email_exists";
    } else {
        echo "email_not_exists";
    }
}
?>
