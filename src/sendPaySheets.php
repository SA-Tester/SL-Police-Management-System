<?php
require "./classes/class-db-connector.php";
require "./classes/class-payroll.php";

use classes\DBConnector;
use classes\CalculateSalary;

$dbcon = new DBConnector();
$con = $dbcon->getConnection();

$emp_id = $_POST["empID"];

$query = "SELECT * FROM salary";
$pstmt = $con->prepare($query);
$pstmt->execute();
$rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
foreach ($rs as $emp){
    if($emp_id == $emp->empID){ 
        $base_salary = $emp->base_salary;
        $bartar_amount = $emp->bartar_amount;
        $total_salary = $emp->total_salary;
        $pension_amount = $emp->pension_amount;
    }
}


$year = date("Y");
$month = date("F");

$query = "SELECT * FROM employee";
$pstmt = $con->prepare($query);
$pstmt->execute();
$rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
foreach ($rs as $employee){
    if($emp_id == $employee->empID){ 
        $name = $employee->first_name." ".$employee->last_name;
        $rank = $employee->rank;
        $email = $employee->email;
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