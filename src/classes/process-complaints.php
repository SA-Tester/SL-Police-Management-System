<?php

namespace Complaints;
include "./class-complaints.php";

$complaintObject = new ComplaintManager();

if(isset($_POST["add"])){

    $date = $_POST["date"];
    $category = $complaintObject->convertCategory($_POST["category"]);
    $title = $_POST["title"];
    $recording = $_POST["audio"];
    $description = $_POST["comp_desc"];
    $plantiff_name = $_POST["plantiff_name"];
    $plantiff_nic = $_POST["plantiff_nic"];
    $plantiff_address = $_POST["plantiff_address"];
    $plantiff_contact = $_POST["plantiff_contact"];
    $plantiff_email = $_POST["plantiff_email"];
    $complaint_status = $_POST["comp_status"];
    $emp_id = $_POST["emp_id"];

    $vehicle_number = $_POST["vehicle_number"];
    $temp_license_start = $_POST["temp_start"];;
    $temp_license_end = $_POST["temp_end"];
    $fine_amount = $_POST["fine_amount"];
    $fine_status = $_POST["fine_status"];
    $city = $_POST["city"];
    $lat = $_POST["selectedLat"];
    $lon = $_POST["selectedLon"];

    $complaintObject->setDate($date);
    $complaintObject->setCategory($category);
    $complaintObject->setTitle($title);
    $complaintObject->setRecording($recording);
    //$recording = $complaintObject->saveAudio(); //should return uploads/recordings/FILENAME.mp3
    $complaintObject->setDescription($description);
    $complaintObject->setPlantiffName($plantiff_name);
    $complaintObject->setPlantiffNIC($plantiff_nic);
    $complaintObject->setPlantiffAddress($plantiff_address);
    $complaintObject->setPlantiffContact($plantiff_contact);
    $complaintObject->setPlantiffEmail($plantiff_email);
    $complaintObject->setComplaintStatus($complaint_status);
    $complaintObject->setEmpID($emp_id);

    $complaintObject->setVehicleNumber($vehicle_number);
    $complaintObject->setTempLicenseStart($temp_license_start);
    $complaintObject->setTempLicenseEnd($temp_license_end);
    $complaintObject->setFineAmount($fine_amount);
    $complaintObject->setCity($city);
    $complaintObject->setLatitude($lat);
    $complaintObject->setLongitude($lon);

    if(empty($city)){
        $complaintObject->addComplaint("1");
    }

    /* // TEST CODE
    echo $complaintObject->getDate()."<br>";
    echo $complaintObject->getCategory()."<br>";
    echo $complaintObject->getTitle()."<br>";
    echo $complaintObject->getRecording()."<br>";
    echo $complaintObject->getDescription()."<br>";
    echo $complaintObject->getPlantiffName()."<br>";
    echo $complaintObject->getPlantiffNIC()."<br>";
    echo $complaintObject->getPlantiffAddress()."<br>";
    echo $complaintObject->getPlantiffContact()."<br>";
    echo $complaintObject->getPlantiffEmail()."<br>";
    echo $complaintObject->getComplaintStatus()."<br>";
    echo $complaintObject->getEmpID()."<br>";

    echo $complaintObject->getVehicleNumber()."<br>";
    echo $complaintObject->getTempLicenseStart()."<br>";
    echo $complaintObject->getTempLicenseEnd()."<br>";
    echo $complaintObject->getFineAmount()."<br>";
    echo $complaintObject->getCity()."<br>";
    echo $complaintObject->getLatitude()."<br>";
    echo $complaintObject->getLongitude()."<br>";
    */
    
}
else if(isset($_POST["update"])){
    echo "update";
}