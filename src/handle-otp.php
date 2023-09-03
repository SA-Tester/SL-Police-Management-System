<?php
session_start();
require_once './classes/class-db-connector.php';
require_once './classes/includes/PHPMailer.php';
require_once './classes/includes/Exception.php';
require_once './classes/includes/SMTP.php';

use classes\DBConnector;

$conn = new DBConnector();
$conn = $conn->getConnection();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['username'])) {
    //username validation
    $result = $conn->query("SELECT * FROM login WHERE username = '" . $_POST['username'] . "'");

    if ($result->rowCount() > 0) {
        //generating otp
        $otp = rand(100000, 999999);

        //getting email from database
        $empID = $result->fetch(PDO::FETCH_ASSOC)['empID'];
        $result = $conn->query("SELECT email FROM employee WHERE emplD = '$empID'");
        $email = $result->fetch(PDO::FETCH_ASSOC)['email'];

        //sending email
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
//            $mail->SMTPDebug = 3; //SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//            $mail->Debugoutput = 'html';
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'slpsms23@gmail.com';                     // SMTP username
            $mail->Password = 'jeuaalkkfczfhjgm';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('slpsms23@gmail.com', 'Admin - SL Police');
            $mail->addAddress($email);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->Subject = 'Reset Password - SL Police';
            $mail->Body =
                '<center style="margin: 0">
                    <div style="padding: 20px; margin: 0;">
                        <img style="width: 100px; height: 100px;" src="cid:logo" alt="SL Police logo">
                    </div>
                    <h3 style="color: darkblue; padding: 10px 0;">Use the following OTP to reset your password</h3>
                    <div style="margin: 30px 0 40px;">
                        <h1 style="display: inline-grid; color: midnightblue; background-color: lavender; border-radius: 20px; padding: 15px 25px; width: fit-content; font-weight: bold;">'.$otp.'</h1>
                    </div>
                    <div style="color: white; background-color: midnightblue; padding: 25px 10px 15px;">
                        <p style="margin-bottom: 10px">&copy; 2023 Sri Lanka Police. All rights reserved.</p>
                        <p style="color: #bbbbbb;">This is an automated email. Please do not reply to this email.</p>
                    </div>
                </center>';
            
            $mail->AltBody = 'Use the following OTP to reset your password: <b>' . $otp . '</b>';
            $mail->AddEmbeddedImage('../assets/logo.png', 'logo');
            
            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header('Location: reset-password.php?msg=There was an error while sending OTP, Try again!');
            exit();
        }
        //storing data in session
        $_SESSION['email'] = $email;
        $_SESSION['otp'] = $otp;
        $_SESSION['uname'] = $_POST['username'];
        header('Location: reset-password.php?msg=OTP has been sent to your email address : ');
    } else {
        header('Location: reset-password.php?msg=Username does not exist!');
    }
} else if (isset($_POST['otp'])) {
    $_SESSION['email'] = '';
    //otp validation
    if ($_SESSION['otp'] == $_POST['otp']) {
        //reset password with random string
        $new_password = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

        $conn->query("UPDATE login SET password = '$new_password' WHERE username = '" . $_SESSION['uname'] . "'");

        session_unset();
        header("Location: loginForm.php?status=3&pwd=".$new_password);
    } else {
        header('Location: reset-password.php?msg=OTP is invalid, Try again!');
    }
} else {
    session_unset();
    header('Location: reset-password.php');
    exit();
}

?>