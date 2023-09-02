<?php

require_once './classes/class-db-connector.php'; // insert 'DbConnector.php' 
require_once 'fetch-people-data.php'; 

// Function to check if a NIC exists in the evidence table
function isNICExistsInEvidenceTable($nic, $dataFetcher) {
    $evidenceData = $dataFetcher->getEvidenceDataForNIC($nic);
    return !empty($evidenceData);
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create an instance of DataFetcher
    $dataFetcher = new DataFetcher();

    // Get all NIC values from the front-end table
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

    // Check each NIC for existence in the evidence table and insert into the front-end table if not present
    foreach ($uniqueNics as $nic) {
        if (!isNICExistsInEvidenceTable($nic, $dataFetcher)) {
            // Fetch data for the given NIC from each table
            $dataEvidence = $dataFetcher->getEvidenceDataForNIC($nic);
           

            // Create a new row with data from each table
            $newRow = array(
                'nic' => isset($dataEvidence['nic']) ?$dataEvidence['nic'] : 'N/A',
              
                'complaint_id' => isset($dataEvidence['complaint_id']) ? $dataEvidence['complaint_id'] : 'N/A',
                
            );

            $insertedRows[] = $newRow;
        }
    }

    // If no new NIC numbers were found, send a suitable message
    if (empty($insertedRows)) {
        $response = array('message' => 'No new evidence found.');
    } else {
        // If new rows were inserted, return them in the response
        $response = array('insertedRows' => $insertedRows);
    }

    // Send the JSON response back to the frontend
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    // If the request is not a valid POST request, handle the error (optional)
    header('HTTP/1.1 400 Bad Request');
    exit;
}
?>
