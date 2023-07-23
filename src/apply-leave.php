<?php
require './classes/class-db-connector.php';
use classes\DBConnector;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $emp_id = $_POST["emp_id"];
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];
    $reason_type = $_POST["reason_type"];
    $reason_desc = $_POST["reason_desc"];
    $upload_medical = $_POST["upload_medical"];

    $dbcon = new DBConnector();

    try {
        $con = $dbcon->getConnection();
        $query = "INSERT INTO leaves (empID, leave_start, leave_end, reason_type, reason, medical) VALUES (?, ?, ?, ?, ?, ?)";
        $pstmt = $con->prepare($query);

        $pstmt->bindValue(1, $emp_id);
        $pstmt->bindValue(2, $from_date);
        $pstmt->bindValue(3, $to_date);
        $pstmt->bindValue(4, $reason_type);
        $pstmt->bindValue(5, $reason_desc);
        $pstmt->bindValue(6, $upload_medical);

        $pstmt->execute();
        if($pstmt->rowCount() > 0){
            header("Location: submit-leave-medical.php?message=1");
            exit;
        } else{
            header("Location: submit-leave-medical.php?message=2");
            exit;
        }       
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
    ?>
</body>
</html>