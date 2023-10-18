<?php

require "./classes/class-db-connector.php";
use classes\DBConnector;
$dbcon = new DBConnector();
$con = $dbcon->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['empID'])) {
        
        $empID = $_POST['empID'];

        try {
          
            $query = "DELETE FROM employee WHERE empID = ?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $empID);
            $pstmt->execute();

            // Return a success message as a JSON response
            $response = ['status' => 'success', 'message' => 'Row removed successfully'];
        } catch (PDOException $e) {
            // Return an error message as a JSON response
            $response = ['status' => 'error', 'message' => $e->getMessage()];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // If empID is not provided in the POST data
        $response = ['status' => 'error', 'message' => 'empID is missing in POST data'];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // If the request method is not POST
    $response = ['status' => 'error', 'message' => 'Invalid request method'];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
