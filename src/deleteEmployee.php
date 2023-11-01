<?php
require './classes/class-db-connector.php';

use classes\DBConnector;
$dbcon = new DBConnector();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $empID=$_GET["empID"];
        try {
                $con = $dbcon->getConnection();
                $query = "DELETE FROM employee WHERE `employee`.`empID` = ?";
                $pstmt = $con->prepare($query);
                $pstmt->bindValue(1, $empID);
                $pstmt->execute();
                if($pstmt->rowCount() > 0){
                    header("Location: new-employee.php");
                    
                }
            } catch (PDOException $exc) {
                echo $exc->getMessage();
            }

        ?>
    </body>
</html>
