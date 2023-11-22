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
require_once "./classes/class-employee.php";

use classes\DBConnector;
use classes\Employee;

if (isset($_POST['submit'])) {

    SendEmail();
}

function SendEmail()
{
    $name = "ADMIN";
    $email = "slpsms23@gmail.com";
    $subject = "Special Duty Assignment";
    /*$body = "<p>
                Dear $rank $empName,
                You have been assigned for a Special Duty by the District Police Administration for a $dutycause.
                Your duty will start on $start and end on $end.
                The higher administration will contact you in the meantime to inform you more about the above duty.
                Please attend to any necessary procedures immediately.
                Thank you.
            </p>";*/

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
        $currentDate = date("Y-m-d H:i:s");

        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        $query = "SELECT empID, duty_cause, start, end FROM duty WHERE `duty`.`duty_type` = 'Special' and end >= ?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $currentDate);
        $pstmt->execute();
        $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($rs as $user) {
            $query1 = "SELECT rank, first_name, last_name, email FROM employee WHERE empID = ?";
            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $user->empID);
            $pstmt1->execute();
            $rs1 = $pstmt1->fetch(PDO::FETCH_OBJ);

            //Email Settings
            $rank = $rs1->rank;
            $empName = $rs1->first_name. " " . $rs1->last_name;
            $dutycause = $user->duty_cause;
            $start = $user->start;
            $end = $user->end;

            $mail->isHTML(true);
            $mail->setFrom($email, $name);
            $mail->addAddress($rs1->email);
            $mail->Subject = $subject;
            $mail->Body = "<p>
                    Dear $rank $empName,
                    <br>You have been assigned for a Special Duty by the District Police Administration for a $dutycause.
                    <br>Your duty will start on $start and end on $end.
                    <br>The higher administration will contact you in the meantime to inform you more about the above duty.
                    <br>Please attend to any necessary procedures immediately.
                    <br>Thank you.
                    <br>Sri Lankan Police Department
                </p>";
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
