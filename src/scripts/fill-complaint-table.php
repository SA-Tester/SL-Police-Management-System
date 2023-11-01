<?php 

require "../classes/class-db-connector.php";
use classes\DBConnector;

if(isset($_REQUEST["element"])){
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();

    $selection = $_REQUEST["element"];

    if($selection == "id" || $selection == "type" || $selection == "date" || $selection == "emp"){
        switch($selection){
            case "id":
                $query1 = "SELECT complaint.complaint_id, complaint.date, complaint.complaint_type, people.nic, people.name, role_in_case.role_in_case, 
                    complaint.complaint_status, complaint.empID 
                FROM ((people INNER JOIN role_in_case ON people.nic = role_in_case.nic) 
                INNER JOIN complaint ON role_in_case.complaint_id = complaint.complaint_id) 
                WHERE role_in_case.role_in_case != 'Witness' AND role_in_case.role_in_case != 'Suspect'
                ORDER BY complaint.complaint_id;";
    
                break;
    
            case "type":
                $query1 = "SELECT complaint.complaint_id, complaint.date, complaint.complaint_type, people.nic, people.name, role_in_case.role_in_case, 
                    complaint.complaint_status, complaint.empID 
                FROM ((people INNER JOIN role_in_case ON people.nic = role_in_case.nic) 
                INNER JOIN complaint ON role_in_case.complaint_id = complaint.complaint_id) 
                WHERE role_in_case.role_in_case != 'Witness' AND role_in_case.role_in_case != 'Suspect'
                ORDER BY complaint.complaint_type;";
                break;
    
            case "date":
                $query1 = "SELECT complaint.complaint_id, complaint.date, complaint.complaint_type, people.nic, people.name, role_in_case.role_in_case, 
                    complaint.complaint_status, complaint.empID 
                FROM ((people INNER JOIN role_in_case ON people.nic = role_in_case.nic) 
                INNER JOIN complaint ON role_in_case.complaint_id = complaint.complaint_id) 
                WHERE role_in_case.role_in_case != 'Witness' AND role_in_case.role_in_case != 'Suspect'
                ORDER BY complaint.date;";
                break;
            
            case "emp":
                $query1 = "SELECT complaint.complaint_id, complaint.date, complaint.complaint_type, people.nic, people.name, role_in_case.role_in_case, 
                    complaint.complaint_status, complaint.empID 
                FROM ((people INNER JOIN role_in_case ON people.nic = role_in_case.nic) 
                INNER JOIN complaint ON role_in_case.complaint_id = complaint.complaint_id) 
                WHERE role_in_case.role_in_case != 'Witness' AND role_in_case.role_in_case != 'Suspect'
                ORDER BY complaint.empID;";
                break;
        }
    }
    else{
        $query1 = "SELECT complaint.complaint_id, complaint.date, complaint.complaint_type, people.nic, people.name, 
            role_in_case.role_in_case, complaint.complaint_status, complaint.empID 
        FROM ((people INNER JOIN role_in_case ON people.nic = role_in_case.nic) 
        INNER JOIN complaint ON role_in_case.complaint_id = complaint.complaint_id) WHERE 
        role_in_case.role_in_case != 'Witness' AND role_in_case.role_in_case != 'Suspect' AND
        complaint.complaint_id LIKE '%$selection%' OR
        year(complaint.date) LIKE '%$selection%' OR MONTHNAME(complaint.date) LIKE '$selection' OR day(complaint.date) LIKE '$selection' OR
        complaint.complaint_type LIKE '%$selection%' OR
        people.nic LIKE '$selection%' OR
        people.name LIKE '%$selection%' OR
        role_in_case.role_in_case LIKE '$selection%' OR
        complaint.complaint_status LIKE '$selection%' OR
        complaint.empID LIKE 'EMP$selection'";
    }

    try{
        $pstmt1 = $con->prepare($query1);
        $pstmt1->execute();
        $rows = $pstmt1->fetchAll(PDO::FETCH_NUM);

        $array = array();
        foreach($rows as $row){
            $id = $row[0];
            $date = $row[1];
            $type = $row[2];
            $nic = $row[3];
            $name = $row[4];
            $ric = $row[5];
            $status = $row[6];
            $emp = $row[7];

            array_push($array, array($id, $date, $type, $nic, $name, $ric, $status, $emp));
        }

        $response = $array;
        $json = json_encode($response);
        echo $json;

    }catch(PDOException $e){
        echo "<script>console.log($e)</script>";
    }
}