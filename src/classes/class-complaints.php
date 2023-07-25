<?php 

namespace classes;
use PDOException;

class Complaints{
    private $complaint_id;
    private $date;
    private $category;
    private $title;
    private $recording;
    private $description;
    private $complaint_status;
    private $emp_id;
    private $con;

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

    function setDescription($description){
        $this->description = $description;
    }

    function setComplaintStatus($complaint_status){
        $this->complaint_status = $complaint_status;
    }

    function setEmpID($emp_id){
        $this->emp_id = $emp_id;
    }

    function setCon($con){
        $this->con = $con;
    }

    function getComplaintID(){
        return $this->complaint_id;
    }

    function convertCategory($category){
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

    public function addComplaint($location_id){
        if($location_id == ""){
            $query = "INSERT INTO complaint(date, complaint_type, complaint_title, audio_src, complaint_text, complaint_status, empID) VALUES(?, ?, ?, ?, ?, ?, ?)";
            try{
                $pstmt = $this->con->prepare($query);
                
                $pstmt->bindValue(1, $this->date);
                $pstmt->bindValue(2, $this->category);
                $pstmt->bindValue(3, $this->title);
                $pstmt->bindValue(4, $this->recording);
                $pstmt->bindValue(5, $this->description);
                $pstmt->bindValue(6, $this->complaint_status);
                $pstmt->bindValue(7, $this->emp_id);

                $a = $pstmt->execute();
                $this->complaint_id = $this->con->lastInsertId();
                
                if($a > 0){
                    return true;
                }
                else{
                    return false;
                    die("An Error occured<br>");
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        else{
            $query = "INSERT INTO complaint(date, complaint_type, complaint_title, complaint_text, complaint_status, empID, location_id) VALUES(?, ?, ?, ?, ?, ?, ?)";
            try{
                $pstmt = $this->con->prepare($query);
                
                $pstmt->bindValue(1, $this->date);
                $pstmt->bindValue(2, $this->category);
                $pstmt->bindValue(3, $this->title);
                $pstmt->bindValue(4, $this->description);
                $pstmt->bindValue(5, $this->complaint_status);
                $pstmt->bindValue(6, $this->emp_id);
                $pstmt->bindValue(7, $location_id);

                $a = $pstmt->execute();
                $this->complaint_id = $this->con->lastInsertId();
                
                if($a > 0){
                    return true;
                }
                else{
                    return false;
                    die("An Error occured<br>");
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }

    function addRecording(){
        $path = "../uploads/complaint-recordings/";
        $old_filename = $path."filename.mp3";
        
        if(file_exists($old_filename)){
            $new_filename = $path."Rec-".$this->complaint_id.".mp3";
            rename($old_filename, $new_filename);

            $query = "UPDATE complaint SET audio_src=? WHERE complaint_id=?";
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $new_filename);
            $pstmt->bindValue(2, $this->complaint_id);

            $a = $pstmt->execute();
            if($a > 0){
                return true;
            }
            else{
                return false;
                die("An Error occured<br>");
            }
        }
        else{
            return;
        }
    }

    public function addRoleInCase($people_nic, $type){
        $query = "INSERT INTO role_in_case(nic, role_in_case, complaint_id) VALUES(?, ?, ?)";

        try{
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $people_nic);
            $pstmt->bindValue(2, $type);
            $pstmt->bindValue(3, $this->complaint_id);

            $a = $pstmt->execute();
            if($a > 0){
                return true;
            }
            else{
                return false;
                die("An Error occured");
            }
        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    function updateComplaint(){
        
    }
}