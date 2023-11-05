<?php
// Include the DbConnector class
require_once './classes/class-db-connector.php';
require_once './classes/class-duties.php';
use classes\DBConnector;

try {
    // Create a new instance of the DbConnector class to establish the database connection
    $dbConnector = new DBConnector();

    
    $con = $dbConnector->getConnection();

    //  fetch data from the table for duty_type = "General"
    $sql = "SELECT d.empID, d.duty_type, d.duty_cause, d.start, d.end, l.district , l.city 
    FROM duty d
    JOIN location l ON d.location_id = l.location_id
    WHERE d.duty_type = 'General'";

    
    $stmt = $con->query($sql);

    
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    $con= null;

    
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    
    die('Connection failed: ' . $e->getMessage());
}
?>
