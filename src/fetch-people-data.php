<?php
require_once './classes/class-db-connector.php';
use classes\DBConnector;

class DataFetcher
{
    private $db;

    public function __construct()
    {
        $this->db = new DBConnector();
    }

   public function getPeopleData()
    {
       try {
            $query = "SELECT nic, name FROM people";
            $pstmt = $this->db->getConnection()->prepare($query);
            $pstmt->execute();
            return $pstmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching data from 'people' table: " . $e->getMessage();
            return array();
        }
    }

    public function getRoleInCaseData($nic)
    {
        try {
            $query = "SELECT role_in_case, complaint_id FROM role_in_case WHERE nic = :nic";
            $pstmt = $this->db->getConnection()->prepare($query);
            $pstmt->bindParam(':nic', $nic);
            $pstmt->execute();
            return $pstmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching data from 'role_in_case' table: " . $e->getMessage();
            return array();
        }
    }

    public function getComplaintData()
    {
        try {
            $query = "SELECT complaint_type FROM complaint";
            $pstmt = $this->db->getConnection()->prepare($query);
            $pstmt->execute();
            return $pstmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching data from 'complaint' table: " . $e->getMessage();
            return array();
        }
    }

   public function getFineData($nic)
{
    try {
        $query = "SELECT fine_amount, temp_license_end_date FROM fine WHERE nic = :nic"; 
        $pstmt = $this->db->getConnection()->prepare($query);
        $pstmt->bindParam(':nic', $nic);
        $pstmt->execute();
        $data = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    } catch (PDOException $e) {
        echo "Error fetching data from 'fine' table: " . $e->getMessage();
        return array();
    }
}


public function getCourtOrderData($nic)
{
    try {
        $query = "SELECT next_court_date FROM court_order WHERE nic = :nic";
        $pstmt = $this->db->getConnection()->prepare($query);
        $pstmt->bindParam(':nic', $nic);
        $pstmt->execute();
        $data = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    } catch (PDOException $e) {
        echo "Error fetching data from 'court_order' table: " . $e->getMessage();
        return array();
    }
}
    
  public function getEvidenceDataForNIC($nic)
    {
        try {
            $stmt = $this->db->getConnection()->prepare('SELECT * FROM evidence  WHERE nic = :nic');
            $stmt->bindParam(':nic', $nic);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle any database errors
            return null;
        }   
    }   
}

?>
