<?php 

namespace Complaints;

use DBConnector\DBConnector;
use PDOException;
use PDO;

include "./interface-complaints.php";
include "./class-db-connector.php";

class ComplaintManager implements Complaints{
    private $date;
    private $category;
    private $title;
    private $recording;
    private $description;
    private $plantiff_name;
    private $plantiff_nic;
    private $plantiff_address;
    private $plantiff_contact;
    private $plantiff_email;
    private $complaint_status;
    private $emp_id;

    private $vehicle_number;
    private $temp_license_start;
    private $temp_license_end;
    private $fine_amount;
    private $city;
    private $latitude;
    private $longitude;

    // SETTERS 
    function setDate($date){
        $this->date = $date;
    }

    function setCategory($category){
        $this->category = $category;
    }

    function setTitle($title){
        $this->title = $title;
    }

    function setRecording($recording){
        $this->recording = $recording;
    }

    function setDescription($description){
        $this->description = $description;
    }

    function setPlantiffName($plantiff_name){
        $this->plantiff_name = $plantiff_name; 
    }

    function setPlantiffNIC($plantiff_nic){
        $this->plantiff_nic = $plantiff_nic;
    }

    function setPlantiffAddress($plantiff_address){
        $this->plantiff_address = $plantiff_address;
    }

    function setPlantiffContact($plantiff_contact){
        $this->plantiff_contact = $plantiff_contact;
    }

    function setPlantiffEmail($plantiff_email){
        $this->plantiff_email = $plantiff_email;
    }

    function setComplaintStatus($complaint_status){
        $this->complaint_status = $complaint_status;
    }

    function setEmpID($emp_id){
        $this->emp_id = $emp_id;
    }

    function setVehicleNumber($vehicle_number){
        $this->vehicle_number = $vehicle_number;
    }

    function setTempLicenseStart($temp_license_start){
        $this->temp_license_start = $temp_license_start;
    }

    function setTempLicenseEnd($temp_license_end){
        $this->temp_license_end = $temp_license_end;
    }

    function setFineAmount($fine_amount){
        $this->fine_amount = $fine_amount;
    }

    function setCity($city){
        $this->city = $city;
    }

    function setLatitude($latitude){
        $this->latitude = $latitude;
    }

    function setLongitude($longitude){
        $this->longitude = $longitude;
    }

    // GETTERS
    function getDate(){
        return $this->date;
    }

    function getCategory(){
        return $this->category;
    }

    function getTitle(){
        return $this->title;
    }

    function getRecording(){
        return $this->recording;
    }

    function getDescription(){
        return $this->description;
    }

    function getPlantiffName(){
        return $this->plantiff_name;
    }

    function getPlantiffNIC(){
        return $this->plantiff_nic;
    }

    function getPlantiffAddress(){
        return $this->plantiff_address;
    }

    function getPlantiffContact(){
        return $this->plantiff_contact;
    }

    function getPlantiffEmail(){
        return $this->plantiff_email;
    }

    function getComplaintStatus(){
        return $this->complaint_status;
    }

    function getEmpID(){
        return $this->emp_id;
    }

    function getVehicleNumber(){
        return $this->vehicle_number;
    }

    function getTempLicenseStart(){
        return $this->temp_license_start;
    }

    function getTempLicenseEnd(){
        return $this->temp_license_end;
    }

    function getFineAmount(){
        return $this->fine_amount;
    }

    function getCity(){
        return $this->city;
    }

    function getLatitude(){
        return $this->latitude;
    }

    function getLongitude(){
        return $this->longitude;
    }

    function convertCategory($category)
    {
        switch($category){
            case "1":
                return "Abuse of Women or Children";
                break;
            case "2":
                return "Appreciation";
                break;
            case "3":
                return "Archeological Issue";
                break;
            case "4":
                return "Assault";
                break;
            case "5":
                return "Bribery and Corruption";
                break;
            case "6":
                return "Complaint against Police";
                break;
            case "7":
                return "Criminal Offence";
                break;
            case "8":
                return "Cybercrime";
                break;
            case "9":
                return "Demonstration / Protest / Strike";
                break;
            case "10":
                return "Environmental Issue";
                break;
            case "11":
                return "Exchange Fault";
                break;
            case "12":
                return "Foreign Employment Issue";
                break;
            case "13":
                return "Frauds / Cheating";
                break;
            case "14":
                return "House Breaking";
                break;
            case "15":
                return "Illegal Mining";
                break;
            case "16":
                return "Industrial / Labour Dispute";
                break;
            case "17":
                return "Information";
                break;
            case "18":
                return "Intellectual Property Dispute";
                break;
            case "19":
                return "Miscellaneous";
                break;
            case "20":
                return "Mischief / Sabotage";
                break;
            case "21":
                return "Murder";
                break;
            case "22":
                return "Narcotics / Dangerous Drugs";
                break;
            case "23":
                return "National Security";
                break;
            case "24":
                return "Natural Disaster";
                break;
            case "25":
                return "Offence / Act against Public Health";
                break;
            case "26":
                return "Offence against Public Property";
                break;
            case "27":
                return "Organized Crime";
                break;
            case "28":
                return "Personal Complaint";
                break;
            case "29":
                return "Police Clearance";
                break;
            case "30":
                return "Property Disputes";
                break;
            case "31":
                return "Robbery";
                break;
            case "32":
                return "Sexual Offences";
                break;
            case "33":
                return "Suggestion";
                break;
            case "34":
                return "Terrorism Related";
                break;
            case "35":
                return "Theft";
                break;
            case "36":
                return "Threat & Intimidation";
                break;
            case "37":
                return "Tourist Harassment";
                break;
            case "38":
                return "Traffic & Road Safety";
                break;
            case "39":
                return "Treasure Hunting";
                break;
            case "40":
                return "Vice Related";
                break;
            case "41":
                return "Violation of Immigration Laws";
                break;
        }
    }

    function saveAudio()
    {
        $url =  $this->recording;
        //echo $url;
        // ADD CODE TO UPLOAD THE FILE TO UPLOADS FOLDER
    }

    function addComplaint($type){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        
        $query1 = "INSERT INTO location(location_name, district, city, latitude, longitude) VALUES(?, ?, ?, ?, ?)";
        $query2 = "INSERT INTO people(nic, name, address, contact, email) VALUES(?, ?, ?, ?, ?)";
        $query3 = "INSERT INTO complaint(date, complaint_type, complaint_title, audio_src, complaint_text, complaint_status, empID) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $query4 = "INSERT INTO complaint(date, complaint_type, complaint_title, audio_src, complaint_text, complaint_status, empID, location_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $query5 = "INSERT INTO role_in_case(nic, role_in_case, complaint_id) VALUES(?, ?, ?)";
        $query6 = "INSERT INTO fine(complaint_id, nic, vehicle_number, temp_license_start_date, temp_license_end_date, fine_amount, fine_status, license_issued) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        
        switch($type){
            case "1":
                $pstmt1 = $con->prepare($query2);
                $pstmt1->bindValue(1, $this->plantiff_nic);
                $pstmt1->bindValue(2, $this->plantiff_name);
                $pstmt1->bindValue(3, $this->plantiff_address);
                $pstmt1->bindValue(4, $this->plantiff_contact);
                $pstmt1->bindValue(5, $this->plantiff_email);
                try{
                    $a = $pstmt1->execute();
                    if($a > 0){
                        echo "Record added to the people table successfully";
                    }
                    else{
                        echo "An Error occured";
                    }
                }catch(PDOException $e){
                    $e->getMessage();
                }

                $pstmt2 = $con->prepare($query3);
                $pstmt2->bindValue(1, $this->date);
                $pstmt2->bindValue(2, $this->category);
                $pstmt2->bindValue(3, $this->title);
                $pstmt2->bindValue(4, $this->recording);
                $pstmt2->bindValue(5, $this->description);
                $pstmt2->bindValue(6, $this->complaint_status);
                $pstmt2->bindValue(7, $this->emp_id);
                /*try{
                    $b = 0;//$pstmt2->execute();
                    if($b > 0){
                        echo "Record added to the complaint table successfully";
                    }
                    else{
                        echo "An Error occured";
                    }
                }catch(PDOException $e){
                    $e->getMessage();
                }*/

                $query7 = "SELECT last_insert_id() FROM complaint";
                $pstmt3 = $con->prepare($query7);
                $pstmt3->execute();
                $complaint_id = $con->lastInsertId();;
                echo $complaint_id;
                /*$pstmt3 = $con->prepare($query5);
                $pstmt3->bindValue(1, $this->plantiff_nic);
                $pstmt3->bindValue(2, "Plantiff");
                $pstmt3->bindValue(3, $complaint_id);*/

                

                break;
        }

        /*//if location is NULL
        $complaint_id = "SELECT last_insert_id()";
        
        //if location is not null
        $query1 = "INSERT INTO location(location_name, district, city, latitude, longitude) VALUES(?, ?, ?, ?, ?)";
        $location_id = "SELECT last_insert_id()";
        $query2 = "INSERT INTO people(nic, name, address, contact, email) VALUES(?, ?, ?, ?, ?)";
        $query3 = "INSERT INTO complaint(date, complaint_type, complaint_title, audio_src, complaint_text, complaint_status, empID, location_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $complaint_id = "SELECT last_insert_id()";
        $query4 = "INSERT INTO role_in_case(nic, role_in_case, complaint_id) VALUES(?, ?, ?)";

        // if complaint = traffic
        $query1 = "INSERT INTO location(location_name, district, city, latitude, longitude) VALUES(?, ?, ?, ?, ?)";
        $query2 = "INSERT INTO people(nic, name, address, contact, email) VALUES(?, ?, ?, ?, ?)";
        $location_id = "SELECT last_insert_id()";
        $query3 = "INSERT INTO complaint(date, complaint_type, complaint_title, audio_src, complaint_text, complaint_status, empID, location_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $complaint_id = "SELECT last_insert_id()";
        $query4 = "INSERT INTO role_in_case(nic, role_in_case, complaint_id) VALUES(?, ?, ?)";
        $query4 = "INSERT INTO fine(complaint_id, nic, vehicle_number, temp_license_start_date, temp_license_end_date, fine_amount, fine_status, license_issued) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        */
    }

    function updateComplaint()
    {
        
    }
}