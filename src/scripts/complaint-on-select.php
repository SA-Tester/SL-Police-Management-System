<?php

require "../classes/class-db-connector.php";
require "../classes/class-complaints.php";

use classes\DBConnector;
use classes\Complaints;

if(isset($_REQUEST["comp_id"]) && isset($_REQUEST["nic"])){
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();
    $complaintObj = new Complaints();

    $complaint_id = $_REQUEST["comp_id"];
    $sel_nic = $_REQUEST["nic"];

    $response = array();

    try{
        $query0 = "SELECT location_id FROM complaint WHERE complaint_id=?";
        $pstmt0 = $con->prepare($query0);
        $pstmt0->bindValue(1, $complaint_id);
        $pstmt0->execute();
        $result0 = $pstmt0->fetch(PDO::FETCH_NUM);

        if(!is_null($result0[0])){
            $query1 = "SELECT complaint.date, complaint.complaint_type, complaint.complaint_title, complaint.audio_src, 
                complaint.complaint_text, role_in_case.role_in_case, people.nic, people.name, people.address, people.contact, people.email, 
                complaint.complaint_status, complaint.empID, location.city 
                FROM people, complaint, role_in_case, location 
                WHERE role_in_case.nic = people.nic AND role_in_case.complaint_id = complaint.complaint_id AND location.location_id = complaint.location_id 
                AND complaint.complaint_id=? AND role_in_case.nic=?";
        }
        else{
            $query1 = "SELECT complaint.date, complaint.complaint_type, complaint.complaint_title, complaint.audio_src, 
                complaint.complaint_text, role_in_case.role_in_case, people.nic, people.name, people.address, people.contact, people.email, 
                complaint.complaint_status, complaint.empID 
                FROM people, complaint, role_in_case
                WHERE role_in_case.nic = people.nic AND role_in_case.complaint_id = complaint.complaint_id 
                AND complaint.complaint_id=? AND role_in_case.nic=?";
        }

        try{
            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $complaint_id);
            $pstmt1->bindValue(2, $sel_nic);
            $pstmt1->execute();
            $result1 = $pstmt1->fetch(PDO::FETCH_NUM);
            
            $date = $result1[0];
            $type = $complaintObj->convertToValue($result1[1]);
            $title = $result1[2];
            $rec = $result1[3];
            $desc = $result1[4];
            $ric = $result1[5];
            $nic = $result1[6];
            $name = $result1[7];
            $address = $result1[8];
            $contact = $result1[9];
            $email = $result1[10];
            $status = $result1[11];
            $emp = $result1[12];

            array_push($response, $date, $type, $title, $rec, $desc, $ric, $nic, $name, $address, $contact, $email, $status, $emp);

            if(!is_null($result0[0])){
                $city = $result1[13];
                array_push($response, $city);
                array_push($response, $result0[0]);
            }
    
        }catch(PDOException $e1){
            $e1->getMessage();
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

    if($result1[1] == "Traffic & Road Safety"){
        try{
            $query2 = "SELECT vehicle_number, temp_license_start_date, temp_license_end_date, fine_amount, fine_status, license_issued 
            FROM fine 
            WHERE complaint_id = ?";

            $pstmt2 = $con->prepare($query2);
            $pstmt2->bindValue(1, $complaint_id);
            $pstmt2->execute();
            $result2 = $pstmt2->fetch(PDO::FETCH_NUM);

            $vehicle_no = $result2[0];
            $temp_start = $result2[1];
            $temp_end = $result2[2];
            $fine_amount = $result2[3];
            $fine_status = $result2[4];
            $license_issued = $result2[5];

            array_push($response, $vehicle_no, $temp_start, $temp_end, $fine_amount, $fine_status, $license_issued);
            
        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    $json = json_encode($response);
    echo $json;
}