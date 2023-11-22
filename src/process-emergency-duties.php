<?php

require_once "./classes/class-db-connector.php";
require_once "./classes/class-duties.php";
require_once "./classes/class-location.php";
require_once "./classes/class-employee.php";
require_once "./ultramsg-api/config.php";

use classes\DBConnector;
use classes\Duties;
use classes\Employee;
use classes\Location;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();

    if(isset($_POST["assign"])){
        if(empty($_POST["start"]) || empty($_POST["end"]) || empty($_POST["district"]) || empty($_POST["city"])){
            header("Location: emergency-duties.php?status=2");
        }
        else{
            $empID = $_POST["emp_id"];
            $duty_type = "Emergency";
            $duty_cause = $_POST["duty_cause"];
            $start = $_POST["start"];
            $end = $_POST["end"];
            $district = ucfirst($_POST["district"]);
            $location_name = "Crime Scene";
            $city = $_POST["city"];
            $lat = $_POST["lat"];
            $lon = $_POST["lon"];
    
            $locationObj = new Location($location_name, $district, $city, $lat, $lon);
            $locationObj->setCon($con);
            $status = $locationObj->addLocation();
            $location_id = $locationObj->getLocationID();
    
            $dutyObj = new Duties($duty_type, $duty_cause, $start, $end);
            $dutyObj->setCon($con);
            $dutyObj->setEmpID($empID);
            $dutyObj->setLocationID($location_id);
            $status = $dutyObj->addDuty();

            $empObj = new Employee("","","","","","","","","","","","","","","");
            $empObj->setEmpID($empID);
            $empObj->initEmployee();
            $empName = $empObj->getName();
            $empTel = "94". ltrim($empObj->getTelephone(), "0");
            $startInfo = explode("T", $start);
            $endInfo = explode("T", $end);
            $empRank = $empObj->getRank();

            $msg = "Dear $empRank $empName,
                    \nYou are assigned for an emergency duty for a $duty_cause at
                    \n$city, $district 
                    \non $startInfo[0] from $startInfo[1] 
                    \nto $endInfo[0], $endInfo[1].
                    \nPlease attend to the above mentioned duty immediatly.
                    \nThank you.
                    \n-Sri Lanka Police Department-
                    ";
    
            if($status){
                sendMessage($empTel, $msg);
                header("Location: emergency-duties.php?status=0&emp=$empID");
            }
            else{
                header("Location: emergency-duties.php?status=1");
            }
        }
    }
    else{
        header("Location: emergency-duties.php");
    }
}
else{
    header("Location: emergency-duties.php");
}