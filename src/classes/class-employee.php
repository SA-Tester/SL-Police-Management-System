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

class Employee
{

    private $empID;
    private $nic;
    private $first_name;
    private $last_name;
    private $dob;
    private $gender;
    private $tel_no;
    private $email;
    private $address;
    private $marital_status;
    private $rank;
    private $appointment_date;
    private $retired_status;
    private $username;
    private $password;

    public function __construct($empID, $nic, $first_name, $last_name, $dob, $gender, $tel_no, $email, $address, $marital_status, $rank, $appointment_date, $retired_status, $username)
    {
        $this->empID = $empID;
        $this->nic = $nic;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->dob = $dob;
        $this->gender = $gender;
        $this->tel_no = $tel_no;
        $this->email = $email;
        $this->address = $address;
        $this->marital_status = $marital_status;
        $this->rank = $rank;
        $this->appointment_date = $appointment_date;
        if ($retired_status == "Yes") {
            $this->retired_status = "1";
        } else {
            $this->retired_status = "0";
        }
        $this->username = $username;
    }

    // SETTERS
    public function setEmpID($emp_id){
        $this->empID = $emp_id;
    }

    public function initEmployee(){

    }

    public function register()
    {      
       $length = 12;
       $randomPassword=0;

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_+=<>?';
        $charCount = strlen($characters);
        for ($i = 0; $i < $length; $i++) {

            $index = random_int(0, $charCount - 1);
            $this->password .= $characters[$index];
        }
        $randomPassword = password_hash($this->password, PASSWORD_BCRYPT);

        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();

        try {
            $query1 = "INSERT INTO employee(empID, nic, first_name, last_name, dob, gender, tel_no, email, address, marital_status, rank, appointment_date, retired_status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $this->empID);
            $pstmt1->bindValue(2, $this->nic);
            $pstmt1->bindValue(3, $this->first_name);
            $pstmt1->bindValue(4, $this->last_name);
            $pstmt1->bindValue(5, $this->dob);
            $pstmt1->bindValue(6, $this->gender);
            $pstmt1->bindValue(7, $this->tel_no);
            $pstmt1->bindValue(8, $this->email);
            $pstmt1->bindValue(9, $this->address);
            $pstmt1->bindValue(10, $this->marital_status);
            $pstmt1->bindValue(11, $this->rank);
            $pstmt1->bindValue(12, $this->appointment_date);
            $pstmt1->bindValue(13, $this->retired_status);

            $a = $pstmt1->execute();

            $query2 = "INSERT INTO login(empID,username,password,role) VALUES(?, ?, ?, ?);";

            $pstmt2 = $con->prepare($query2);
            $pstmt2->bindValue(1, $this->empID);
            $pstmt2->bindValue(2, $this->username);
            $pstmt2->bindValue(3, $randomPassword);
            $pstmt2->bindValue(4, "user");

            $b = $pstmt2->execute();

            if (($a > 0) && ($b > 0)) {
                $this->SendEmail();
            } else {
                header("Location: ../src/new-employee.php?message=2");
                exit;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    function SendEmail()
    {

        $name = "ADMIN";
        $email = "slpsms23@gmail.com";
        $subject = "Important: Change Your Temporary Password for SRI LANKA POLICE STATIONS MANAGEMENT SYSTEM Account";
        $body = "<p>Dear $this->first_name,</p>
                 <p>Welcome to our SRI LANKA POLICE STATIONS MANAGEMENT SYSTEM! We're thrilled to have you on board.</p>
                   <h2>This is your Temporary Password : $this->password</h2>                
                   <p>Your account has been created, and to ensure your security, we have assigned you a temporary password for your initial login. However, it's crucial to change this password to a unique one that only you know. You can change Your Password using Forgot Password option.</p>
                   <p>Best regards,<br>Admin Branch</p>";
                   
        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "slpsms23@gmail.com";
        $mail->Password = "wloxdhhwlfhmqmuc";
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress($this->email);
        $mail->Subject = $subject;
        $mail->Body = $body;

        if ($mail->send()) {
            header("Location: ../src/new-employee.php?message=1");
            exit;
        }
    }

    function viewEmployeeAvalability()
    {
        date_default_timezone_set('Asia/Colombo');
        $currentDate = date("Y-m-d");

        $dbcon = new DBConnector();
        try {
            $con = $dbcon->getConnection();
            $employeeQuery = "SELECT empID, first_name, last_name, tel_no FROM employee";
            $epstmt = $con->prepare($employeeQuery);
            $epstmt->execute();

            if ($epstmt->rowCount() > 0) {
                echo '<tbody>';
                $count = 1;
                while ($employeeRow = $epstmt->fetch(PDO::FETCH_ASSOC)) {
                    $empID = $employeeRow['empID'];
                    $empName = $employeeRow['first_name'] . ' ' . $employeeRow['last_name'];
                    $empContactNo = $employeeRow['tel_no'];

                    echo '<tr>';
                    echo '<th scope="row">' . $count . '</th>';
                    echo '<td data-title="Employee ID">' . $empID . '</td>';
                    echo '<td data-title="Name">' . $empName . '</td>';
                    echo '<td data-title="Contact Number">' . $empContactNo . '</td>';

                    //duty
                    $dutyQuery = "SELECT duty_type FROM duty WHERE empID = ? AND start <= ? AND end >= ?";
                    $dpstmt = $con->prepare($dutyQuery);
                    $dpstmt->bindValue(1, $empID);
                    $dpstmt->bindValue(2, $currentDate);
                    $dpstmt->bindValue(3, $currentDate);
                    $dpstmt->execute();

                    //leave
                    $leaveQuery = "SELECT leaveID FROM leaves WHERE empID = ? AND leave_start <= ? AND leave_end >= ?";
                    $lpstmt = $con->prepare($leaveQuery);
                    $lpstmt->bindValue(1, $empID);
                    $lpstmt->bindValue(2, $currentDate);
                    $lpstmt->bindValue(3, $currentDate);
                    $lpstmt->execute();



                    $isOnDuty = $dpstmt->rowCount() > 0;
                    $isOnLeave = $lpstmt->rowCount() > 0;

                    echo '<td data-title="Duty">';
                    if ($isOnDuty) {
                        $dutyType = $dpstmt->fetch(PDO::FETCH_ASSOC)['duty_type'];
                        echo $dutyType;
                    } else {
                        echo 'No Duty';
                    }
                    echo '</td>';

                    echo '<td data-title="Avalability">';
                    if ($isOnLeave) {
                        echo 'Not Available(On Leave)';
                    } else {
                        echo 'Available';
                    }
                    echo '</td>';

                    echo '</tr>';
                    $count++;
                }
                echo '</tbody>';
            } else {
                echo '<tbody><tr><td colspan="6">No records found.</td></tr></tbody>';
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
