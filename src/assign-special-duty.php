<?php
require "./classes/class-db-connector.php";
require "./classes/class-duties.php";

use classes\DBConnector;
use classes\Duties;

$dbcon = new DBConnector();

if(isset($_POST["submit"])){

    $con = $dbcon->getConnection();

    $empID = ($_POST['empID']);
    $duty_type = ($_POST['duty_type']);
    $duty_cause = ($_POST['duty_cause']);
    $start = ($_POST['start']);
    $end = ($_POST['end']); 
    $location_id = ($_POST['location_id']);

    $SpecialObject = new Duties($duty_type, $duty_cause, $start, $end);
    $SpecialObject->setCon($con);
    $SpecialObject->setEmpID($empID);
    $SpecialObject->setLocationID($location_id);   
    $a = $SpecialObject->addDuty();
    if($a){
        header("Location: special-duty.php?message=1");
    }
}

?>