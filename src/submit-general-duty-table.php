<?php

require_once './classes/class-db-connector.php';
require_once './classes/class-duties.php';
require_once './classes/class-employee.php';
require_once './ultramsg-api/config.php';

use classes\DBConnector;
use classes\Duties;
use classes\Employee;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure that the data is received correctly
    $empID = isset($_POST["empID"]) ? $_POST["empID"] : null;
    $duty_type = isset($_POST["duty_type"]) ? $_POST["duty_type"] : null;
    $duty_cause = $_POST["duty_cause"];//isset($_POST["duty_cause"]) ? $_POST["duty_cause"] : null;
    $start = isset($_POST["start"]) ? $_POST["start"] : null;
    $end = isset($_POST["end"]) ? $_POST["end"] : null;
    $location_id = $_POST["location_id"];//isset($_POST["location_id"]) ? $_POST["location_id"] : null;

    // Check if empID is empty
    if (empty($empID)) {
        $response = array("status" => "error", "message" => "Employee ID is required");
        echo json_encode($response);
        exit; // Terminate the script
    }

    // Create a new DbConnector instance
    $dbConnector = new DBConnector();

    try {
        
        // Check if the empID already exists in the database
        $checkSql = "SELECT COUNT(*) as count FROM duty WHERE empID = :empID";
        $checkStmt = $dbConnector->getConnection()->prepare($checkSql);
        $checkStmt->bindParam(':empID', $empID);
        $checkStmt->execute();
        $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // empID already exists, handle the situation accordingly
            $response = array("status" => "error", "message" => "Employee ID already exists");
            echo json_encode($response);
        } 
        else {
            // empID is unique, proceed with the insertion
            $sql = "INSERT INTO duty (empID, duty_type, duty_cause, start, end, location_id) 
                    VALUES (:empID, :duty_type, :duty_cause, :start, :end, :location_id)";
            
            // Use prepared statements to prevent SQL injection
            $stmt = $dbConnector->getConnection()->prepare($sql);
            $stmt->bindParam(':empID', $empID);
            $stmt->bindParam(':duty_type', $duty_type);
            $stmt->bindParam(':duty_cause', $duty_cause);
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':location_id', $location_id);

            // Execute the prepared statement
            $stmt->execute();

            $empObj = new Employee("", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
            $empObj->setEmpID($empID);
            $empObj->initEmployee();
            $empName = $empObj->getName();
            $emp_tel = "94". ltrim($empObj->getTelephone(), "0");
            $startInfo = explode("T", $start);
            $endInfo = explode("T", $end);
            $empRank = $empObj->getRank();

            $msg = "Dear $empRank $empName,
                    \nYou are assigned for a general duty for a $duty_cause
                    \non $startInfo[0] from $startInfo[1] 
                    \nto $endInfo[0], $endInfo[1].
                    \nPlease attend to the above mentioned duty.
                    \nThank you.
                    \n-Sri Lanka Police Department-";

            //Send Message to Employee
            sendMessage($emp_tel, $msg);

            // Return a success response
            $response = array("status" => "success");

            echo json_encode($response);
        }
    } catch (PDOException $e) {
        // If there's an error with the database query, return an error response with the error message
        $response = array("status" => "error", "message" => "Database error: " . $e->getMessage());
        echo json_encode($response);
    }
} else {
    // If the request method is not POST, return a response indicating an error
    $response = array("status" => "error", "message" => "Invalid request method");
    echo json_encode($response);
}
try {
    // Create a new instance of the Duties class
    $duty = new Duties($duty_type, $duty_cause, $start, $end);

    // Set the database connection (assuming you have a $dbConnector object)
    $duty->setCon($dbConnector->getConnection());

    // Set other properties 
    $duty->setEmpID($empID);
    $duty->setLocationID($location_id);

    // Add the duty using the Duties class method
    $result = $duty->addDuty();

    if ($result) {
        // Return a success response
        $response = array("status" => "success");
    } else {
        // Return an error response
        $response = array("status" => "error", "message" => "An error occurred while adding duty.");
    }
    echo json_encode($response);

} catch (PDOException $e) {
    // If there is an error, return an error response
    $response = array("status" => "error", "message" => "Database error: " . $e->getMessage());
    echo json_encode($response);
}
?>