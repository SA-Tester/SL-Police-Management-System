<?php
require "./classes/class-db-connector.php";
require "./classes/class-payroll.php";

use classes\DBConnector;
use classes\CalculateSalary;

$dbcon = new DBConnector();

$emp_id = $_GET["empID"];
$email = $_GET["email"];
$base_salary = $_GET["base_salary"];
$bartar_amount = $_GET["bartar_amount"];
$total_salary = $_GET["total_salary"];
$pension_amount = $_GET["pension_amount"];
$year = date("Y");
$month = date("F");
$con = $dbcon->getConnection();

$query = "SELECT * FROM employee";
    $pstmt = $con->prepare($query);
    $pstmt->execute();
    $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($rs as $employee){
        if($emp_id == $employee->empID){ 
            $name = $employee->first_name." ".$employee->last_name;
            $rank = $employee->rank;
        }
    }

    $salarySheet = new CalculateSalary($emp_id, $base_salary);
    $salarySheet->setCon($con);
    $mail=$salarySheet->sendSalarySheet();
    $mail->addAddress($email);

if($pension_amount == NULL){
    $mail->Subject = "Salary Sheet for [$month/$year]";
    $mail->Body = "<p>Dear $name,</p>
                   <p>I hope this email finds you well. We are pleased to share the salary details for the month of $month $year with you.</p>
                   <h1>Salary Details for $month $year</h1>
                   <h3>Employee Name : $name</h3>
                   <h3>Employee ID : $emp_id</h3>
                   <h3>Employee Rank : $rank</h3>
                   <h3>Basic Salary : Rs.$base_salary.00</h3>
                   <h3>Bartar Amount : Rs.$bartar_amount.00</h3>
                   <h3>Total Salary : Rs.$total_salary.00</h3>
                   <p>If you have any concerns regarding your salary, please don't hesitate to reach out to the Admin Branch.</p>
                   <p>Thank you for your continued commitment for the Sri lanka Police.</p>
                   <p>Wishing you a fantastic month ahead!</p>
                   <p>Best regards,</p>
                   <p>Admin Branch</P>";
    if ($mail->send()){
        header("Location: payroll.php?message=4");
        exit;
    } else{
        echo $mail->ErrorInfo;
    }
} else{
    $mail->Subject = "Pension Details for [$month/$year]";
    $mail->Body = "<p>Dear $name,</p>
                   <p>I hope this email finds you well. We are pleased to share the pension details for the month of $month $year with you.</p>
                   <h1>Pension Details for $month $year</h1>
                   <h3>Employee Name : $name</h3>
                   <h3>Employee ID : $emp_id</h3>
                   <h3>Employee Rank : $rank</h3>
                   <h3>Basic Salary : Rs.$base_salary.00</h3>
                   <h3>Pension Amount : Rs.$pension_amount.00</h3>
                   <p>If you have any concerns regarding your pension details, please don't hesitate to reach out to the Admin Branch.</p>
                   <p>Thank you for your valuable contributions for the Sri lanka Police.</p>
                   <p>Wishing you a fulfilling retirement and a prosperous future ahead!</p>
                   <p>Best regards,</p>
                   <p>Admin Branch</P>";
    if ($mail->send()){
        header("Location: payroll.php?message=5");
        exit;
    } else{
        echo $mail->ErrorInfo;
    }
}

?>