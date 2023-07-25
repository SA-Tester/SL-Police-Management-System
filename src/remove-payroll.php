<?php
require "./classes/class-db-connector.php";
require "./classes/class-payroll.php";

use classes\DBConnector;
use classes\CalculateSalary;

$dbcon = new DBConnector();

$emp_id = $_GET["empID"];
$con = $dbcon->getConnection();
$addEmployee = new CalculateSalary($emp_id, 0);
$addEmployee->setCon($con);
$addEmployee->removeEmployee();

?>