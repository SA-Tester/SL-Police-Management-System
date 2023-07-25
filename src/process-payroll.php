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
    $service_years = $_POST["service_years"];

    $addEmployee = new CalculateSalary($emp_id, $base_salary, $service_years);
    $addEmployee->setCon($con);
    $addEmployee->setTotalSalary($base_salary, $service_years);
    $addEmployee->setBartar($base_salary, $service_years);
    $addEmployee->addEmployee();
}
?>