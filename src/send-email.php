<?php

namespace classes;
use PDO;
use PDOException;

require "./classes/includes/PHPMailer.php";
require "./classes/includes/SMTP.php";
require "./classes/includes/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "./classes/class-db-connector.php";


if (isset($_POST['submit'])) {
    try {
        
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();

    
        $mail = new PHPMailer();

        $name = "SL-POLICE Court calling unit";
        $email = "slpsms23@gmail.com";
        $subject = "Reminder of next Court Date";

        // Set SMTP settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "slpsms23@gmail.com";
        $mail->Password = "wloxdhhwlfhmqmuc";
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        // Define the SQL query to fetch relevant data from the people and court_order tables
        $query = "SELECT p.nic, p.email, co.complaint_id, co.next_court_date
                FROM people p
                INNER JOIN court_order co ON p.nic = co.nic";

        $stmt = $con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Compose the email for each relevant person
            $recipient = $row['email'];
            $mail->isHTML(true); // Assuming plain text email
            $mail->setFrom($email, $name);
            $mail->addAddress($recipient);
            $mail->Subject = $subject;

           
            $message = "Hello,\n\n";
            $message .= "NIC Of: " . $row['nic'] . "\n";
            $message .= "Your Complaint ID: is" . $row['complaint_id'] . "\n";
            $message .= "And Your Next Court Date is: " . $row['next_court_date'] . "\n\n";

            $mail->Body = $message;

            // Send the email
            if ($mail->send()) {
                header("Location: ./view-people.php?status=1");
                exit;
               
            } else {
                header("Location: ./view-people.php?status=2");
                exit;
                
            }
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
