<?php
    /*error_reporting(E_ALL);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);*/

    require "./classes/class-db-connector.php";
    require "./classes/class-people.php";
    require "./classes/class-complaints.php";
    require "./classes/class-location.php";
    require "./classes/class-fine.php";

    use classes\DBConnector;
    use classes\People;
    use classes\Complaints;
    use classes\Location;
    use classes\Fine;

    $dbcon = new DBConnector();

    if(isset($_POST["add"])){
        // Construct a Complaint Object
        $complaintObject = new Complaints();

        // Get DB Connection
        $con = $dbcon->getConnection();
        
        // Getting Data from Form
        $date = $_POST["date"];
        $category = $complaintObject->convertCategory($_POST["category"]);
        $title = $_POST["title"];
        $recording = $_POST["audio"];
        $description = $_POST["comp_desc"];
        $complaint_status = $_POST["comp_status"];
        $emp_id = $_POST["emp_id"];

        $people_type = $_POST["people_type"];
        $people_nic = $_POST["people_nic"];
        $people_name = $_POST["people_name"];
        $people_address = $_POST["people_address"];
        $people_contact = $_POST["people_contact"];
        $people_email = $_POST["people_email"];

        $vehicle_number = $_POST["vehicle_number"];
        $temp_license_start = $_POST["temp_start"];;
        $temp_license_end = $_POST["temp_end"];
        $fine_amount = $_POST["fine_amount"];
        if($_POST["fine_status"] == "unpaid"){
            $fine_status = 0;
        }
        else{
            $fine_status = 1;
        }
        $license_issued = 0;

        $district = "Badulla";
        $city = $_POST["selectedCity"];
        $lat = $_POST["selectedLat"];
        $lon = $_POST["selectedLon"];

        $complaintObject->setDate($date);
        $complaintObject->setCategory($category);
        $complaintObject->setTitle($title);
        $complaintObject->setRecording($recording); //$complaintObject->setRecording($complaintObject->saveAudio()); //should return uploads/recordings/FILENAME.mp3
        $complaintObject->setDescription($description);
        $complaintObject->setComplaintStatus($complaint_status);
        $complaintObject->setEmpID($emp_id);

        // Construct a People Object
        $peopleObject = new People($people_nic, $people_name, $people_address, $people_contact, $people_email); // $nic, $name, $address, $contact, $email
    
        //location null
        if(empty($city)){
            $peopleObject->setCon($con);
            $peopleObject->addPerson();

            $complaintObject->setCon($con);
            $complaintObject->addComplaint("");
            $complaintObject->addRoleInCase($peopleObject->getNIC(), $people_type);
        }
        else{
            $locationObject = new Location("Case Location", $district, $city, $lat, $lon);
            $locationObject->setCon($con);
            $locationObject->addLocation();

            $peopleObject->setCon($con);
            $peopleObject->addPerson();

            $complaintObject->setCon($con);
            $complaintObject->addComplaint($locationObject->getLocationID());
            $complaintObject->addRoleInCase($peopleObject->getNIC(), $people_type);
        }

        if(!empty($vehicle_number)){
            $fineObejct = new Fine($vehicle_number, $temp_license_start, $temp_license_end, $fine_amount, $fine_status, $license_issued);
            $fineObejct->setComplaintID($complaintObject->getComplaintID());
            $fineObejct->setNIC($peopleObject->getNIC());
            $fineObejct->setCon($con);
            $fineObejct->addFine();
        }
    }

    else if(isset($_POST["update"])){
        echo "update";
    }