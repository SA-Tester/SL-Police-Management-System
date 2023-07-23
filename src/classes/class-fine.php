<?php

namespace classes;
use PDOException;

class Fine{
    private $complaint_id;
    private $nic;
    private $vehicle_number;
    private $temp_license_start_date;
    private $temp_license_end_date;
    private $fine_amount;
    private $fine_status;
    private $license_issued;
    private $con;

    public function __construct($vehicle_number, $temp_license_start_date, $temp_license_end_date, $fine_amount, $fine_status, $license_issued){
        $this->vehicle_number = $vehicle_number;
        $this->temp_license_start_date = $temp_license_start_date;
        $this->temp_license_end_date = $temp_license_end_date;
        $this->fine_amount = $fine_amount;
        $this->fine_status = $fine_status;
        $this->license_issued = $license_issued;
    }

    public function setCon($con){
        $this->con = $con;
    }

    public function setComplaintID($complaint_id){
        $this->complaint_id = $complaint_id;
    }

    public function setNIC($nic){
        $this->nic = $nic;
    }

    public function addFine(){
        $query = "INSERT INTO fine(complaint_id, nic, vehicle_number, temp_license_start_date, temp_license_end_date, fine_amount, fine_status, license_issued) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        try{
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $this->complaint_id);
            $pstmt->bindValue(2, $this->nic);
            $pstmt->bindValue(3, $this->vehicle_number);
            $pstmt->bindValue(4, $this->temp_license_start_date);
            $pstmt->bindValue(5, $this->temp_license_end_date);
            $pstmt->bindValue(6, $this->fine_amount);
            $pstmt->bindValue(7, $this->fine_status);
            $pstmt->bindValue(8, $this->license_issued);
            $a = $pstmt->execute();

            if($a>0){
                echo "Fine: Success <br>";
            }
            else{
                die("An error occured");
            }

        }catch(PDOException $e){
            $e->getMessage();
        }
    }
}