<?php

require_once "../classes/class-db-connector.php";

use classes\DBConnector;

$dbcon = new DBConnector();
$con = $dbcon->getConnection();

$response = array();

try{
    $query = "SELECT duty.empID, duty.duty_cause, location.city, location.latitude, location.longitude FROM duty,location 
        WHERE duty.location_id = location.location_id
        AND duty.duty_type=? AND duty.end >= CURRENT_DATE";
    
    $pstmt = $con->prepare($query);
    $pstmt->bindValue(1, "Emergency");
    $pstmt->execute();
    $result = $pstmt->fetchAll(PDO::FETCH_NUM);

    foreach($result as $r){
        $temp = array($r[0], $r[1], $r[2], $r[3], $r[4]);
        array_push($response, $temp);
    }

    $json = json_encode($response);
    echo $json;
}
catch(PDOException $e){
    echo $e->getMessage();
}