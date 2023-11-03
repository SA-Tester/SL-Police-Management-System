<?php

require_once($_SERVER['DOCUMENT_ROOT']."/sl-police/src/classes/class-db-connector.php");
require_once($_SERVER['DOCUMENT_ROOT']."/sl-police/src/classes/class-complaints.php");
require_once($_SERVER['DOCUMENT_ROOT']."/sl-police/src/classes/class-people.php");
require_once($_SERVER['DOCUMENT_ROOT']."/sl-police/src/classes/class-employee.php");
require_once($_SERVER['DOCUMENT_ROOT']."/sl-police/src/classes/class-evidence.php");

use classes\DBConnector;
use classes\Complaints;
use classes\People;
use classes\Employee;
use classes\Evidence;

function fillComplaintSummary($con, $complaint_id){
    $complaint = new Complaints();
    $person = new People("", "", "", "", "");
    $employee = new Employee("", "", "", "", "", "", "", "", "", "", "", "", "", "");

    $complaint->setCon($con);
    $complaint->setComplaintID($complaint_id);

    if($complaint->initComplaint()){
        $date = $complaint->getDate();

        $plantiff_nic = $complaint->getPersonNIC("Plantiff");
        if(!empty($plantiff_nic)){
            $person->setCon($con);
            $person->setNIC($plantiff_nic);
    
            if($person->initPerson()){
                $plantiff_name = $person->getName();
            }
        }
        else{
            $plantiff_nic = "NA";
            $plantiff_name = "NA";
        }
    
        $category = $complaint->getCategory();
        $title = $complaint->getTitle();
        $description = $complaint->getDescription();
        
        $employee_id = $complaint->getEmpID();
        $employee->setEmpID($employee_id);
        if($employee->initEmployee()){
            $employee_name = $employee->getName();
        }

        $array1 = array($complaint_id, $date, $category, $plantiff_nic, $plantiff_name, $title, $description, $employee_id, $employee_name);
    }
    return $array1;
}

function fillPeople($con, $complaint_id){
    try{
        $query = "SELECT * FROM role_in_case INNER JOIN people WHERE role_in_case.nic = people.nic AND complaint_id=? AND role_in_case.role_in_case != 'Plantiff'";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $complaint_id);
        $pstmt->execute();
        if($pstmt->rowCount() > 0){
            $rows = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
    }
    catch(PDOException $e){
        die("Error Occured: ".$e->getMessage());
    }
}

function fillWitnesses($con, $complaint_id){
    $witnesses = new Evidence();
    $rows = $witnesses->getWinesses($con, $complaint_id);
    return $rows;
}

function fillFingerprints($con, $complaint_id){
    $witnesses = new Evidence();
    $rows = $witnesses->getFingerprints($con, $complaint_id);
    return $rows;
}

function fillPhotos($con, $complaint_id){
    $witnesses = new Evidence();
    $rows = $witnesses->getPhotos($con, $complaint_id);
    return $rows;
}

function fillCourtMedicalReports($con, $complaint_id){
    $witnesses = new Evidence();
    $rows = $witnesses->getCourtMedicalReports($con, $complaint_id);
    return $rows;
}

function fillAccidentCharts($con, $complaint_id){
    $witnesses = new Evidence();
    $rows = $witnesses->getAccidentCharts($con, $complaint_id);
    return $rows;
}

function checkFileUploads($file, $expectedTypes, $maxSize){
    $errorMsg = "";
    $temp = explode(".", $file["name"]);
    $fileType = end($temp);

    // CHECK FOR UPLOAD ERRORS
    switch ($file['error']) {
        case UPLOAD_ERR_OK:
            // CHECK FILE SIZE
            if($file["size"] <= $maxSize){

                // CHECK WHETHER THE UPLOADED FILE MATHCES WITH EXPECTED TYPES
                if(in_array($fileType, $expectedTypes)){
                    $errorMsg = "";
                    break;
                } 
                else{
                    $errorMsg = "File type doesn't match the specified";
                    break;
                }
            }
            else{
                $errorMsg = "File size exceeds the limit";
                break;
            }

        case UPLOAD_ERR_NO_FILE:
            $errorMsg = 'No file sent';
            break;

        default:
            $errorMsg = 'Unknown errors';
    }

    return $errorMsg;
}

function convertImageToJPEG($originalImage, $outputImage, $quality){
    $binary = imagecreatefromstring(file_get_contents($originalImage));
    imageJpeg($binary, $outputImage, $quality);
    return 'test.'."jpeg";
}

if(isset($_POST["addPerson"])){
    if(isset($_POST["new_role"], $_POST["new_nic"], $_POST["new_name"], $_POST["new_address"], $_POST["new_contact"], $_POST["new_email"])){
        if(!empty($_POST["new_nic"]) || !empty($_POST["new_name"]) || !empty($_POST["new_address"]) || !empty($_POST["new_contact"]) || !empty($_POST["new_email"])){

            $complaint_id = $_POST["comp_id"];
            $new_role = $_POST["new_role"];
            $new_nic = $_POST["new_nic"];
            $new_name = $_POST["new_name"];
            $new_address = $_POST["new_address"];
            $new_contact = $_POST["new_contact"];
            $new_email = $_POST["new_email"];

            $person = new People($new_nic, $new_name, $new_address, $new_contact, $new_email);
            $complaint = new Complaints();
            
            try{
                $dbcon = new DBConnector();
                $con = $dbcon->getConnection();

                $person->setCon($con);
                $person->addPerson();

                $complaint->setCon($con);
                $complaint->setComplaintID($complaint_id);
                $status = $complaint->addRoleInCase($new_nic, $new_role);

                if($status){
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(PDOException $e){
                die("Error occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["updatePerson"])){
    if(isset($_POST["role"], $_POST["personNIC"], $_POST["personName"], $_POST["personAddress"], $_POST["personContact"], $_POST["personEmail"])){
        if(!empty($_POST["comp_id"]) || !empty($_POST["personNIC"]) || !empty($_POST["personName"]) || !empty($_POST["personAddress"]) || !empty($_POST["personContact"]) || !empty($_POST["personEmail"])){

            $complaint_id = $_POST["comp_id"];
            $role = $_POST["role"];
            $nic = $_POST["personNIC"];
            $name = $_POST["personName"];
            $address = $_POST["personAddress"];
            $contact = $_POST["personContact"];
            $email = $_POST["personEmail"];

            $person = new People($nic, $name, $address, $contact, $email);
            $complaint = new Complaints();
            
            try{
                $dbcon = new DBConnector();
                $con = $dbcon->getConnection();

                $person->setCon($con);
                $status1 = $person->updatePerson();

                $complaint->setCon($con);
                $complaint->setComplaintID($complaint_id);
                $status2 = $complaint->updateRoleInCase($role, $nic);

                if($status1 && $status2){
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id&role=$role");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(PDOException $e){
                die("Error occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["deletePerson"])){
    if(isset($_POST["personNIC"])){
        if(!empty($_POST["comp_id"]) || !empty($_POST["personNIC"])){

            $complaint_id = $_POST["comp_id"];
            $nic = $_POST["personNIC"];
            
            $complaint = new Complaints();
            
            try{
                $dbcon = new DBConnector();
                $con = $dbcon->getConnection();

                $complaint->setCon($con);
                $complaint->setComplaintID($complaint_id);
                $status1 = $complaint->deleteFromRoleInCase($nic);

                if($status1){
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(PDOException $e){
                die("Error occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["addWitness"])){
    if(isset($_POST["comp_id"]) && isset($_POST["witness_nics"]) && isset($_POST["description"])){
        if(!empty($_POST["comp_id"]) || !empty($_POST["description"])){

            $complaint_id = $_POST["comp_id"];
            $nic = $_POST["witness_nics"];
            $description = $_POST["description"];

            try{    
                $dbcon = new DBConnector();
                $con = $dbcon->getConnection();

                $evidence = new Evidence();
                $evidence->setWitnessNIC($nic);
                $evidence->setWitnessDescription($description);
                $status = $evidence->recordEvidence($con, "add", "witness", $complaint_id);
                if($status){
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(PDOException $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["updateWitness"])){
    if(isset($_POST["comp_id"]) && isset($_POST["nic"]) && isset($_POST["description"])){
        if(!empty($_POST["comp_id"]) || !empty($_POST["nic"]) || !empty($_POST["description"])){

            $complaint_id = $_POST["comp_id"];
            $nic = $_POST["nic"];
            $description = $_POST["description"];

            try{    
                $dbcon = new DBConnector();
                $con = $dbcon->getConnection();

                $evidence = new Evidence();
                $evidence->setWitnessNIC($nic);
                $evidence->setWitnessDescription($description);
                $status = $evidence->recordEvidence($con, "update", "witness", $complaint_id);
                if($status){
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(PDOException $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["deleteWitness"])){
    if(isset($_POST["comp_id"]) && isset($_POST["description"])){
        if(!empty($_POST["comp_id"]) || !empty($_POST["description"])){

            $complaint_id = $_POST["comp_id"];
            $description = $_POST["description"];

            try{    
                $dbcon = new DBConnector();
                $con = $dbcon->getConnection();

                $evidence = new Evidence();
                $evidence->setWitnessDescription($description);
                $status = $evidence->recordEvidence($con, "delete", "witness", $complaint_id);
                if($status){
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(PDOException $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["addFingerprint"])){
    
    if(isset($_FILES["fingerprintFile"], $_POST["comp_id"]) && !empty($_POST["comp_id"])){
        $fingerprint = $_FILES["fingerprintFile"];
        $complaint_id = $_POST["comp_id"];

        $status = checkFileUploads($fingerprint, array("png", "jpeg", "jpg"), 5000000);

        if($status == ""){
            $dbcon = new DBConnector();
            $con = $dbcon->getConnection();
            $evidence = new Evidence();

            $oldFileName = $fingerprint["name"];
            $newFileName = $complaint_id. "F". time();

            $path = "uploads/fingerprints/";
            $newFilePath = $path. $newFileName. ".jpeg";

            try{    
                $evidence->setFingerprintDescription($newFilePath);
                $status = $evidence->recordEvidence($con, "add", "fingerprint", $complaint_id);
                convertImageToJPEG($fingerprint["tmp_name"], "../../". $newFilePath, 100);

                if($status){
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(Exception $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false&msg=$status");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["deleteFingerprint"])){
    if(isset($_POST["comp_id"]) && isset($_POST["fingerprint"])){
        if(!empty($_POST["comp_id"]) || !empty($_POST["fingerprint"])){

            $complaint_id = $_POST["comp_id"];
            $fingerprint = $_POST["fingerprint"];

            try{    
                $dbcon = new DBConnector();
                $con = $dbcon->getConnection();

                $evidence = new Evidence();
                $evidence->setFingerprintDescription($fingerprint);
                $status = $evidence->recordEvidence($con, "delete", "fingerprint", $complaint_id);

                if($status){
                    unlink("../../".$fingerprint);
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(PDOException $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["addPhoto"])){
    if(isset($_FILES["photoFile"], $_POST["comp_id"]) && !empty($_POST["comp_id"])){
        $photo = $_FILES["photoFile"];
        $complaint_id = $_POST["comp_id"];

        $status = checkFileUploads($photo, array("png", "jpeg", "jpg"), 5000000);

        if($status == ""){
            $dbcon = new DBConnector();
            $con = $dbcon->getConnection();
            $evidence = new Evidence();

            $oldFileName = $photo["name"];
            $newFileName = $complaint_id. "P". time();

            $path = "uploads/case-imagery/";
            $newFilePath = $path. $newFileName. ".jpeg";

            try{    
                $evidence->setPhotoDescription($newFilePath);
                $status = $evidence->recordEvidence($con, "add", "photo", $complaint_id);
                convertImageToJPEG($photo["tmp_name"], "../../". $newFilePath, 100);

                if($status){
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(Exception $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false&msg=$status");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["deletePhoto"])){
    if(isset($_POST["comp_id"]) && isset($_POST["photo"])){
        if(!empty($_POST["comp_id"]) || !empty($_POST["photo"])){

            $complaint_id = $_POST["comp_id"];
            $photo = $_POST["photo"];

            try{    
                $dbcon = new DBConnector();
                $con = $dbcon->getConnection();

                $evidence = new Evidence();
                $evidence->setPhotoDescription($photo);
                $status = $evidence->recordEvidence($con, "delete", "photo", $complaint_id);

                if($status){
                    unlink("../../".$photo);
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(PDOException $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["addMedical"])){
    if(isset($_FILES["medicalFile"], $_POST["comp_id"]) && !empty($_POST["comp_id"])){
        $medical = $_FILES["medicalFile"];
        $complaint_id = $_POST["comp_id"];

        $status = checkFileUploads($medical, array("png", "jpeg", "jpg", "pdf"), 5000000);

        if($status == ""){
            $dbcon = new DBConnector();
            $con = $dbcon->getConnection();
            $evidence = new Evidence();

            $oldFileName = $medical["name"];
            $newFileName = $complaint_id. "M". time();

            $path = "uploads/court-medicals/";
            $newFilePath = $path. $newFileName. ".jpeg";

            try{    
                $evidence->setCourtMedicalReport($newFilePath);
                $status = $evidence->recordEvidence($con, "add", "court_medical", $complaint_id);
                convertImageToJPEG($medical["tmp_name"], "../../". $newFilePath, 100);

                if($status){
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(Exception $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false&msg=$status");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["deleteMedical"])){
    if(isset($_POST["comp_id"]) && isset($_POST["medical"])){
        if(!empty($_POST["comp_id"]) || !empty($_POST["medical"])){

            $complaint_id = $_POST["comp_id"];
            $medical = $_POST["medical"];

            try{    
                $dbcon = new DBConnector();
                $con = $dbcon->getConnection();

                $evidence = new Evidence();
                $evidence->setCourtMedicalReport($medical);
                $status = $evidence->recordEvidence($con, "delete", "court_medical", $complaint_id);

                if($status){
                    unlink("../../".$medical);
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(PDOException $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["addAccidentChart"])){
    if(isset($_FILES["accidentFile"], $_POST["comp_id"]) && !empty($_POST["comp_id"])){
        $accidentChart = $_FILES["accidentFile"];
        $complaint_id = $_POST["comp_id"];

        $status = checkFileUploads($accidentChart, array("png", "jpeg", "jpg", "pdf"), 5000000);

        if($status == ""){
            $dbcon = new DBConnector();
            $con = $dbcon->getConnection();
            $evidence = new Evidence();

            $oldFileName = $accidentChart["name"];
            $newFileName = $complaint_id. "A". time();

            $path = "uploads/accident-charts/";
            $newFilePath = $path. $newFileName. ".jpeg";

            try{    
                $evidence->setAccidentChart($newFilePath);
                $status = $evidence->recordEvidence($con, "add", "accident_chart", $complaint_id);
                convertImageToJPEG($accidentChart["tmp_name"], "../../". $newFilePath, 100);

                if($status){
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(Exception $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false&msg=$status");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_POST["deleteAccidentChart"])){
    if(isset($_POST["comp_id"]) && isset($_POST["accidentChart"])){
        if(!empty($_POST["comp_id"]) || !empty($_POST["accidentChart"])){

            $complaint_id = $_POST["comp_id"];
            $accidentChart = $_POST["accidentChart"];

            try{    
                $dbcon = new DBConnector();
                $con = $dbcon->getConnection();

                $evidence = new Evidence();
                $evidence->setAccidentChart($accidentChart);
                $status = $evidence->recordEvidence($con, "delete", "accident_chart", $complaint_id);

                if($status){
                    unlink("../../".$accidentChart);
                    header("Location: ../complaint-study.php?status=true&comp_id=$complaint_id");
                }
                else{
                    header("Location: ../complaint-study.php?status=false");
                }
            }
            catch(PDOException $e){
                die("Error Occured: ".$e->getMessage());
            }
        }
        else{
            header("Location: ../complaint-study.php?status=false");
        }
    }
    else{
        header("Location: ../complaint-study.php?status=false");
    }
}

elseif(isset($_REQUEST["request"])){
    $people_nics = $_REQUEST["request"];

    if($people_nics == "people_nics"){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();

        $person = new People("", "", "", "", "", "",);
        $person->setCon($con);
        $rows = $person->getPeopleData();

        $response = $rows;
        $json = json_encode($response);
        echo $json;
    }
}

elseif(isset($_REQUEST["complaint_id"]) && !empty($_REQUEST["complaint_id"])){
    $complaint_id = strip_tags($_REQUEST["complaint_id"]);

    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();

    // Data for Case Summary
    $array1 = fillComplaintSummary($con, $complaint_id);
    
    // Data for People Involved in a Case for Manage People Table
    $array2 = array(fillPeople($con, $complaint_id));

    // Data of Witnesses
    $array3 = array(fillWitnesses($con, $complaint_id));

    // Data of Fingerprints
    $array4 = array(fillFingerprints($con, $complaint_id));

    // Case Imagery
    $array5 = array(fillPhotos($con, $complaint_id));

    // Court Medical Reports
    $array6 = array(fillCourtMedicalReports($con, $complaint_id));

    // Accident Charts
    $array7 = array(fillAccidentCharts($con, $complaint_id));

    $response = array($array1, $array2, $array3, $array4, $array5, $array6, $array7);
    $json = json_encode($response);
    echo $json;   
}