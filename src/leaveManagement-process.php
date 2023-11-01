<?php
require "./classes/class-db-connector.php";
require "./classes/class-leave.php";

use classes\DBConnector;
use classes\Leave;

$dbcon = new DBConnector();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST["status"])){
        $empID = $_POST["emp_id"];
        if($_POST["status"] == "ACCEPT"){
            $status = 1;
        } else{
            $status = 0;
        }
        
        $con = $dbcon->getConnection();
        $leaveObject = new Leave($empID, NULL, NULL, NULL, NULL, NULL);
        $leaveObject->setCon($con);

        if($leaveObject->updateStatus($status)){
            header("Location: leaveManagement.php?message=1");
            exit;
        } else{
            header("Location: leaveManagement.php?message=2");
            exit;
        }

    } else{
        header("Location: leaveManagement.php");
    }
} else{
    header("Location: leaveManagement.php");
}