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
    $senderName = $_POST['name']; 
    $recipientEmail = $_POST['email']; 
    $message = $_POST['message'];

    
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "slpsms23@gmail.com"; 
        $mail->Password = "wloxdhhwlfhmqmuc"; 
        $mail->Port = 465; 
        $mail->SMTPSecure = "ssl";

        $mail->setFrom($recipientEmail, $senderName);
        $mail->addAddress($recipientEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Duty assigning';
        $mail->Body = "Duty assign description:\n$message assigned by: $senderName\n";

        $mail->send();
        header("Location: ./general-duty.php?status=1");
        exit;
    } catch (Exception $e) {
        header("Location: ./general-duty.php?status=2");
        exit;
    }
}
