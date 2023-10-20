<?php

require_once './classes/class-db-connector.php';
use classes\DBConnector;
require_once 'fetch-people-data.php'; 

//  check if a NIC exists in the evidence table
function isNICExistsInEvidenceTable($nic, $con) {
    //  check for NIC existence 
    try {
   
        $query = "SELECT COUNT(*) FROM evidence WHERE nic = :nic";
        $stmt = $con->con->prepare($query);
        $stmt->bindParam(':nic', $nic);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        
        return $count > 0;
    } catch (PDOException $e) {
       
        return false;
    }
}

// Initialize response array
$response = array();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $con = new DBConnector();
    // Get all NIC values from the front_end table
    $allNics = array();
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'nic_') === 0) {
            $nic = trim($value);
            if (!empty($nic)) {
                $allNics[] = $nic;
            }
        }
    }

    // Filter out any duplicate NIC values
    $uniqueNics = array_unique($allNics);

    // Initialize an array to store the newly inserted rows
    $insertedRows = array();

    // Check each NIC for existence in the evidence table and insert into the front_end table if not present
    foreach ($uniqueNics as $nic) {
        if (!isNICExistsInEvidenceTable($nic, $conn)) {
            
            // Fetch data for the given NIC from each table
            $dataEvidence = $conn->conn->query("SELECT * FROM evidence WHERE nic = '$nic'")->fetch(PDO::FETCH_ASSOC);

            // Create a new row with data from each table
            $newRow = array(
                'nic' => isset($dataEvidence['nic']) ? $dataEvidence['nic'] : 'N/A',
                'complaint_id' => isset($dataEvidence['complaint_id']) ? $dataEvidence['complaint_id'] : 'N/A',
               
            );

            // Insert the new data into the "People" table and "Role in Case" table
            if (insertDataIntoPeopleTable($newRow, $conn) && insertDataIntoRoleInCaseTable($newRow, $conn)) {
                $insertedRows[] = $newRow;
            }
        }
    }

    // If no new NIC numbers were found, send a suitable message
    if (empty($insertedRows)) {
        $response['message'] = 'No new evidence found.';
    } else {
        // If new rows were inserted, return them in the response
        $response['insertedRows'] = $insertedRows;
        $response['message'] = 'Data updated successfully.';
    }

    // Send the JSON response back to the front_end
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    // If the request is not a valid POST request, handle the error (optional)
    header('HTTP/1.1 400 Bad Request');
    exit;
}


function insertDataIntoPeopleTable($data, $conn) {
    try {
        
        $nic = $data['nic'];
        $complaint_id = $data['complaint_id'];

      
        $query = "INSERT INTO people(nic, complaint_id) VALUES (:nic, :complaint_id)";

        $stmt = $conn->conn->prepare($query);

       
        $stmt->bindParam(':nic', $nic);
        $stmt->bindParam(':complaint_id', $complaint_id);

      
        $result = $stmt->execute();

        return $result;
    } catch (PDOException $e) {
        
        return false;
    }
}

// for the "role_in_case " table 
function insertDataIntoRoleInCaseTable($data, $conn) {
    try {
        
        $nic = $data['nic'];
        $complaint_id = $data['complaint_id'];

        
        $query = "INSERT INTO role_in_case (nic, complaint_id) VALUES (:nic, :complaint_id)";

        
        $stmt = $conn->conn->prepare($query);

        
        $stmt->bindParam(':nic', $nic);
        $stmt->bindParam(':complaint_id', $complaint_id);

        
        $result = $stmt->execute();

        return $result;
    } catch (PDOException $e) {
       
        return false;
    }
}
?>
