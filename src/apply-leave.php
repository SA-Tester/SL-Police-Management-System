<?php
require "./classes/class-db-connector.php";
require "./classes/class-leave.php";

use classes\DBConnector;
use classes\Leave;

$dbcon = new DBConnector();

if(isset($_POST["submit"])){

    $con = $dbcon->getConnection();

    $emp_id = $_POST["emp_id"];
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];
    $reason_type = $_POST["reason_type"];
    $reason_desc = $_POST["reason_desc"];
    $upload_medical = $_POST["upload_medical"];

    $applyLeaveObject = new Leave($emp_id, $from_date, $to_date, $reason_type, $reason_desc, $upload_medical);
    $applyLeaveObject->setCon($con);
    $applyLeaveObject->applyLeave();
}

?>