<?php

require "../classes/class-db-connector.php";
use classes\DBConnector;

if(isset($_REQUEST["nic"])){
    $nic = $_REQUEST["nic"];

    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();

    if($nic !== ""){
        $query = "SELECT name, address, contact, email FROM people WHERE nic=?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $nic);
        $pstmt->execute();
        $result = $pstmt->fetch(PDO::FETCH_ASSOC);

        $name = $result["name"];
        $address = $result["address"];
        $contact = $result["contact"];
        $email = $result["email"];
    }

    $response = array("$name", "$address", "$contact", "$email");
    $json = json_encode($response);
    echo $json;
}