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
    $addEmployee->addEmployee();
}

?>