<?php 

require "../classes/class-db-connector.php";
use classes\DBConnector;

if(isset($_REQUEST["sortby"])){
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();

    $selection = $_REQUEST["sortby"];

    switch($selection){
        case "id":
            $query1 = "SELECT complaint.complaint_id, complaint.date, complaint.complaint_type, people.name, complaint.complaint_status, complaint.empID 
                FROM ((people INNER JOIN role_in_case ON people.nic = role_in_case.nic)
                INNER JOIN complaint ON role_in_case.complaint_id = complaint.complaint_id) 
                ORDER BY complaint.complaint_id";

            break;

        case "type":
            $query1 = "SELECT complaint.complaint_id, complaint.date, complaint.complaint_type, people.name, complaint.complaint_status, complaint.empID 
                FROM ((people INNER JOIN role_in_case ON people.nic = role_in_case.nic)
                INNER JOIN complaint ON role_in_case.complaint_id = complaint.complaint_id) 
                ORDER BY complaint.complaint_type";
            break;

        case "date":
            $query1 = "SELECT complaint.complaint_id, complaint.date, complaint.complaint_type, people.name, complaint.complaint_status, complaint.empID 
                FROM ((people INNER JOIN role_in_case ON people.nic = role_in_case.nic)
                INNER JOIN complaint ON role_in_case.complaint_id = complaint.complaint_id) 
                ORDER BY complaint.date";
            break;
        
        case "emp":
            $query1 = "SELECT complaint.complaint_id, complaint.date, complaint.complaint_type, people.name, complaint.complaint_status, complaint.empID 
                FROM ((people INNER JOIN role_in_case ON people.nic = role_in_case.nic)
                INNER JOIN complaint ON role_in_case.complaint_id = complaint.complaint_id) 
                ORDER BY complaint.empID";
            break;
    }

    try{
        $pstmt1 = $con->prepare($query1);
        $pstmt1->execute();
        $rows = $pstmt1->fetchAll(PDO::FETCH_BOTH);

        $array = array();
        foreach($rows as $row){
            $id = $row[0];
            $date = $row[1];
            $type = $row[2];
            $name = $row[3];
            $status = $row[4];
            $emp = $row[5];

            array_push($array, array($id, $date, $type, $name, $status, $emp));
        }

        $response = $array;
        $json = json_encode($response);
        echo $json;

    }catch(PDOException $e){
        echo "<script>console.log($e)</script>";
    }
}
/*switch($selection){
    case "id":
       // try{
            $query1 = "SELECT complaint.complaint_id, complaint.date, complaint.complaint_type, people.name, complaint.complaint_status, complaint.empID 
            FROM complaint INNER JOIN role_in_case INNER JOIN people 
            WHERE role_in_case.complaint_id = complaint.complaint_id AND people.nic = role_in_case.nic;";

            $pstmt1 = $con->prepare($query1);
            $pstmt1->execute();
            $rows = $pstmt->fetchAll(PDO::FETCH_NUM);

            $array = array();
            foreach($rows as $row){
                $id = $row[0];
                $date = $row[1];
                $type = $row[2];
                $name = $row[3];
                $status = $row[4];
                $emp = $row[5];

                array_push($array, array($id, $date, $type, $status, $emp));
            }

            //echo "<script>console.log('hello')</script>";
            $response = array("a", "b", "d");
            $json = json_encode($response);
            echo $json;

       // }catch(PDOException $e){
         //   echo "<script>console.log($e)</script>";
        //}
    
        break;

    case "title":
        break;

    case "date":
        break;

    case "emp":
        break;
}*/