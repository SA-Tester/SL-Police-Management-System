<?php

namespace classes;

use PDOException;
use PDO;
require_once './classes/class-db-connector.php';

class EmailHandler {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function validateEmail($email) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM employee WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $exc) {
            // Handle the error appropriately
            return false;
        }
    }

    public function sendEmail($to, $subject, $message) {
      
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $dbConnector = new DbConnector();
    $con = $dbConnector->getConnection();

    $emailHandler = new EmailHandler($conn);

    if ($emailHandler->validateEmail($email)) {
        $subject = "Message from Sri Lanka Police";
        $emailHandler->sendEmail($email, $subject, $message);
        echo "Email sent successfully!";
    } else {
        echo "Email doesn't exist.";
    }

    // Close the database connection
    $con = null;
}
