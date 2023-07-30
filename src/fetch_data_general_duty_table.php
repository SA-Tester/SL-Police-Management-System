<?php
// Include the DbConnector class
require_once 'DbConnector.php';

try {
    // Create a new instance of the DbConnector class to establish the database connection
    $dbConnector = new DbConnector();

    // Get the PDO connection object from the DbConnector class
    $conn = $dbConnector->conn;

    // SQL query to fetch data from the table for duty_type = "General"
    $sql = "SELECT empID, duty_type, duty_cause, start, end, location_id FROM duty WHERE duty_type = 'General'";

    // Prepare the query and execute it
    $stmt = $conn->query($sql);

    // Fetch all rows as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the database connection (PDO automatically closes the connection when the object is destroyed)
    $conn = null;

    // Convert the array to JSON format and send it as the response
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    // If there is an error, die and display the error message
    die('Connection failed: ' . $e->getMessage());
}
?>
