<?php
require "./classes/class-db-connector.php";
require "./classes/class-payroll.php";

use classes\DBConnector;
use classes\CalculateSalary;

$dbcon = new DBConnector();

$emp_id = $_GET["empID"];
$base_salary = $_GET["base_salary"];
$con = $dbcon->getConnection();
$addEmployee = new CalculateSalary($emp_id, $base_salary);
$addEmployee->setCon($con);
$addEmployee->setServiceYears();
$addEmployee->setPension();
$addEmployee->retiredEmployee(); 
?>