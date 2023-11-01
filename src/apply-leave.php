<?php
require "./classes/class-db-connector.php";
require "./classes/class-leave.php";

use classes\DBConnector;
use classes\Leave;

$dbcon = new DBConnector();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST["submit"])){
        if(empty($_POST["emp_id"]) || empty($_POST["from_date"]) || empty($_POST["from_date"]) || empty($_POST["from_date"]) || empty($_POST["from_date"])){
            header("Location: submit-leave-medical.php?message=5");
            exit;
        } else if($_POST["reason_type"] == "Health" && empty($_FILES["upload_medical"]['name'])){
            header("Location: submit-leave-medical.php?message=6");
            exit;
        } else{
            $con = $dbcon->getConnection();

            $emp_id = $_POST["emp_id"];
            $from_date = $_POST["from_date"];
            $to_date = $_POST["to_date"];
            $reason_type = $_POST["reason_type"];
            $reason_desc = filter_var($_POST["reason_desc"], FILTER_SANITIZE_STRING);
            $upload_medical = $_FILES['upload_medical']['name'];
            $upload_medical_tem_name = $_FILES['upload_medical']['tmp_name'];
            $upload_medical_folder = __DIR__."/../uploads/medicals/".$upload_medical;

            $applyLeaveObject = new Leave($emp_id, $from_date, $to_date, $reason_type, $reason_desc, $upload_medical);
            $applyLeaveObject->setCon($con);

            if(!$applyLeaveObject->checkPendingApplication()){
                if($applyLeaveObject->applyLeave()){
                    move_uploaded_file($upload_medical_tem_name, $upload_medical_folder);
                    header("Location: submit-leave-medical.php?message=1");
                    exit;
                } else{
                    header("Location: submit-leave-medical.php?message=2");
                    exit;
                }
            } else{
                header("Location: submit-leave-medical.php?message=7");
                exit;
            }
        }
    } else{
        header("Location: submit-leave-medical.php?message=4");
        exit;
    } 
} else{
    header("Location: submit-leave-medical.php?message=3");
    exit;
}


?>