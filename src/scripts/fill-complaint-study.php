<?php

require_once("/Applications/XAMPP/xamppfiles/htdocs/sl-police/src/classes/class-db-connector.php");
require_once("/Applications/XAMPP/xamppfiles/htdocs/sl-police/src/classes/class-complaints.php");
require_once("/Applications/XAMPP/xamppfiles/htdocs/sl-police/src/classes/class-people.php");
require_once("/Applications/XAMPP/xamppfiles/htdocs/sl-police/src/classes/class-employee.php");

use classes\DBConnector;
use classes\Complaints;
use classes\People;
use classes\Employee;

function fillSuspectsCulprits($complaint_id){
    try{
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();

        $query = "SELECT * FROM `role_in_case` INNER JOIN people WHERE role_in_case.nic = people.nic AND complaint_id=?";
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

if(isset($_POST["addNew"])){
    if(isset($_POST["new_role"], $_POST["new_nic"], $_POST["new_name"], $_POST["new_address"], $_POST["new_contact"], $_POST["new_email"])){
        if(!empty($_POST["new_nic"]) || !empty($_POST["new_name"]) || !empty($_POST["new_address"]) || !empty($_POST["new_contact"]) || !empty($_POST["new_email"])){

            $complaint_id = $_POST["new_comp_id"];
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
                $status1 = $person->addPerson();

                $complaint->setCon($con);
                $complaint->setComplaintID($complaint_id);
                $status2 = $complaint->addRoleInCase($new_nic, $new_role);

                if($status1 && $status2){
                    
                }
            }
            catch(PDOException $e){
                die("Error occured: ".$e->getMessage());
            }
        }
    }
}

if(isset($_POST["update"])){
    echo $_POST["suspectCulpritNIC"];
}

if(isset($_POST["delete"])){
    echo $_POST["suspectCulpritNIC"];
}

if(isset($_REQUEST["comp_id"]) && !empty($_REQUEST["comp_id"])){
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();

    $complaint_id = $_REQUEST["comp_id"];

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
        $array2 = array(fillSuspectsCulprits($complaint_id));
        $response = array($array1, $array2);
        $json = json_encode($response);
        echo $json;
    }
}