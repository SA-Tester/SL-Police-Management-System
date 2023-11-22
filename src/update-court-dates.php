<?php
require_once './classes/class-db-connector.php';
use classes\DBConnector;
require_once 'fetch-people-data.php'; 


$dbConnector = new DBConnector();
$con = $dbConnector->getConnection(); 

function isNICExistsInEvidenceTable($nic, $con) {
    try {
        $query = "SELECT COUNT(*) FROM evidence WHERE nic = :nic";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':nic', $nic);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    } catch (PDOException $e) {
        return false;
    }
}

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allNics = array();

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'nic_') === 0) {
            $nic = trim($value);
            if (!empty($nic)) {
                $allNics[] = $nic;
            }
        }
    }

    $uniqueNics = array_unique($allNics);
    $insertedRows = array();
    $updateMessages = array();

    foreach ($uniqueNics as $nic) {
        if (!isNICExistsInEvidenceTable($nic, $con)) {
            $dataEvidence = $con->query("SELECT * FROM evidence WHERE nic = '$nic'")->fetch(PDO::FETCH_ASSOC);

            $newRow = array(
                'nic' => isset($dataEvidence['nic']) ? $dataEvidence['nic'] : 'N/A',
                'complaint_id' => isset($dataEvidence['complaint_id']) ? $dataEvidence['complaint_id'] : 'N/A',
            );

            if (insertDataIntoPeopleTable($newRow, $con) && insertDataIntoRoleInCaseTable($newRow, $con)) {
                $insertedRows[] = $newRow;
            }
        }
    }

    if (empty($insertedRows)) {
        $response['message'] = 'No new evidence found.';
    } else {
        $response['insertedRows'] = $insertedRows;
        $response['message'] = 'Data updated successfully.';
    }

    $updateMessages = updatePreviousCourtDate($con);
    $response['updateMessages'] = $updateMessages;

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    header('HTTP/1.1 400 Bad Request');
    exit;
}

function insertDataIntoPeopleTable($data, $con) {
    try {
        $nic = $data['nic'];
        $complaint_id = $data['complaint_id'];

        $query = "INSERT INTO people(nic, complaint_id) VALUES (:nic, :complaint_id)";
        $stmt = $con->prepare($query);

        $stmt->bindParam(':nic', $nic);
        $stmt->bindParam(':complaint_id', $complaint_id);

        $result = $stmt->execute();
        return $result;
    } catch (PDOException $e) {
        return false;
    }
}

function insertDataIntoRoleInCaseTable($data, $con) {
    try {
        $nic = $data['nic'];
        $complaint_id = $data['complaint_id'];

        $query = "INSERT INTO role_in_case (nic, complaint_id) VALUES (:nic, :complaint_id)";
        $stmt = $con->prepare($query);

        $stmt->bindParam(':nic', $nic);
        $stmt->bindParam(':complaint_id', $complaint_id);

        $result = $stmt->execute();
        return $result;
    } catch (PDOException $e) {
        return false;
    }
}

function updatePreviousCourtDate($con) {
    try {
        $currentDate = date('Y-m-d');
        $query = "SELECT nic, next_court_date, previous_court_dates FROM court_order WHERE next_court_date < :currentDate";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':currentDate', $currentDate);
        $stmt->execute();

        $updateMessages = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nic = $row['nic'];
            $nextCourtDate = $row['next_court_date'];
            $previousCourtDates = $row['previous_court_dates'];

            // Convert the previous_court_dates to an array
            $previousCourtDatesArray = explode(',', $previousCourtDates);
            $previousCourtDatesArray = array_map('trim', $previousCourtDatesArray);

            if ($nextCourtDate !== "0000-00-00" && !in_array($nextCourtDate, $previousCourtDatesArray)) {
                if ($previousCourtDatesArray[0] === '') {
                    // Remove the first element (empty string) if it exists
                    array_shift($previousCourtDatesArray);
                }
            
                // Add the date to previous_court_dates
                $previousCourtDatesArray[] = $nextCourtDate;
            
                // Remove the date from next_court_date
                $nextCourtDatesArray = explode(',', $row['next_court_date']);
                $nextCourtDatesArray = array_diff($nextCourtDatesArray, array($nextCourtDate));
                $newNextCourtDates = implode(',', $nextCourtDatesArray);
            
                // Join the array back into comma-separated strings
                $newPreviousCourtDates = implode(',', $previousCourtDatesArray);
            
                // Update both previous_court_dates and next_court_date
                $updateQuery = "UPDATE court_order SET previous_court_dates = :newPreviousCourtDates, next_court_date = :newNextCourtDates WHERE nic = :nic";
                $updateStmt = $con->prepare($updateQuery);
                $updateStmt->bindParam(':newPreviousCourtDates', $newPreviousCourtDates);
                $updateStmt->bindParam(':newNextCourtDates', $newNextCourtDates);
                $updateStmt->bindParam(':nic', $nic);
            
                if ($updateStmt->execute()) {
                    $updateMessages[] = "Successfully updated court date for NIC: $nic";
                } else {
                    $updateMessages[] = "Failed to update court date for NIC: $nic";
                }
            } else {
                // Date is already in previous_court_dates
                $updateMessages[] = "Date already exists in previous court dates for NIC: $nic";
            }
        }

        return $updateMessages;
    } catch (PDOException $e) {
        return array("Exception: " . $e->getMessage());
    }
}

?>