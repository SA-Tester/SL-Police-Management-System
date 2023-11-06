<?php
require "./classes/class-db-connector.php";
require "./classes/class-payroll.php";

use classes\DBConnector;
use classes\CalculateSalary;

$dbcon = new DBConnector();

$emp_id = $_POST["empID"];
$con = $dbcon->getConnection();
$addEmployee = new CalculateSalary($emp_id, 0);
$addEmployee->setCon($con);
if ($addEmployee->removeEmployee()) {
    header("Location: payroll.php?message=7");
}

?>