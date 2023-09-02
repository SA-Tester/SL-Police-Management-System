<?php
namespace classes;

require_once './classes/class-db-connector.php';
class TelephoneNumberFetcher {
    private $dbConnector;

    public function __construct() {
        $this->dbConnector = new DbConnector();
    }

    public function getTelephoneNumbers() {
        $con= $this->dbConnector->getConnection();

        try {
            $sql = "SELECT tel_no FROM employee";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            
            $telNumbers = $stmt->fetchAll(PDO::FETCH_COLUMN);
            if ($telNumbers) {
                return array(
                    'success' => true,
                    'telNumbers' => $telNumbers
                );
            } else {
                return array(
                    'success' => false,
                    'error' => 'Telephone numbers not found'
                );
            }
        } catch (PDOException $e) {
            return array(
                'success' => false,
                'error' => 'Error fetching telephone numbers: ' . $e->getMessage()
            );
        }
    }
}

// Instantiate the TelephoneNumberFetcher class
$telephoneNumberFetcher = new TelephoneNumberFetcher();

// Fetch and output the telephone numbers
$response = $telephoneNumberFetcher->getTelephoneNumbers();

// Set the response headers
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);

?>
