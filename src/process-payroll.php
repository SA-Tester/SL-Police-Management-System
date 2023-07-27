<?php
require "./classes/class-db-connector.php";
require "./classes/class-payroll.php";

use classes\DBConnector;
use classes\CalculateSalary;

$dbcon = new DBConnector();

if(isset($_POST["add"])){

    $con = $dbcon->getConnection();

    $emp_id = $_POST["empID"];
    $base_salary = $_POST["base_salary"];

    $addEmployee = new CalculateSalary($emp_id, $base_salary);
    $addEmployee->setCon($con);
    $addEmployee->setServiceYears();
    $addEmployee->setTotalSalary();
    $addEmployee->setBartar();
    $addEmployee->setPension();
    $addEmployee->addEmployee();
}

if(isset($_POST["refresh"])){
    $con = $dbcon->getConnection();
    $query = "SELECT * FROM salary";
    $pstmt = $con->prepare($query);
    $pstmt->execute();
    $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($rs as $employee){
        $emp_id = $employee->empID;
        $base_salary = $employee->base_salary;
        if($employee->pension_amount==NULL){
            $addEmployee = new CalculateSalary($emp_id, $base_salary);
            $addEmployee->setCon($con);
            $addEmployee->setServiceYears();
            $addEmployee->setTotalSalary();
            $addEmployee->setBartar();
            $addEmployee->reset();
        }

    }
}


?>