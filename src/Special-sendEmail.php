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

use classes\DBConnector;


if (isset($_POST['submit'])) {

    SendEmail();
}

function SendEmail()
{

    $name = "ADMIN";
    $email = "slpsms23@gmail.com";
    $subject = "Special Duty Assignment";
    $body = "<p>You have been assigned to special duty. Please check your account for more details. For any questions or clarifications, please contact us at 045-356-6667.</p>";

    $mail = new PHPMailer();

    //SMTP Settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "slpsms23@gmail.com";
    $mail->Password = "wloxdhhwlfhmqmuc";
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    try {
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        $query = "SELECT empID FROM duty WHERE `duty`.`duty_type` = 'Special'";
        $pstmt = $con->prepare($query);
        $pstmt->execute();
        $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($rs as $user) {
            $query1 = "SELECT email FROM employee WHERE empID = ?";
            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $user->empID);
            $pstmt1->execute();
            $rs1 = $pstmt1->fetch(PDO::FETCH_OBJ);
            //Email Settings
            $mail->isHTML(true);
            $mail->setFrom($email, $name);
            $mail->addAddress($rs1->email);
            $mail->Subject = $subject;
            $mail->Body = $body;
        }
            if ($mail->send()) {
                header("Location: ./special-duty.php?mail=1");
                exit;
            }else{
                header("Location: ./special-duty.php?mail=2");
                exit;
            }
        
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }

}
