<?php

namespace classes;
use PDO;
use PDOException;

class Evidence{
    private $witness_nic;
    private $witness_description;
    private $fingerprint_description;
    private $photo_description;
    private $court_medical_report;
    private $accident_chart;
    
    // SETTERS ===========================================================================
    public function setWitnessNIC($witness_nic){
        $this->witness_nic = $witness_nic;
    }

    public function setWitnessDescription($witness_description){
        $this->witness_description = $witness_description;
    }

    public function setFingerprintDescription($fingerprint_description){
        $this->fingerprint_description = $fingerprint_description;
    }

    public function setPhotoDescription($photo_description){
        $this->photo_description = $photo_description;
    }

    public function setCourtMedicalReport($court_medical_report){
        $this->court_medical_report = $court_medical_report;
    }

    public function setAccidentChart($accident_chart){
        $this->accident_chart = $accident_chart;
    }
    // ===================================================================================

    public function getWinesses($con, $complaint_id){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();

        try{
            $query = "SELECT nic, witness_description FROM evidence WHERE complaint_id=?";

            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $complaint_id);
            if($pstmt->execute()){
                $rows = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                return $rows;
            }
            else{
                return "";
            }
        }
        catch(PDOException $e){
            die("Error Occured: ".$e->getMessage());
        }
    }

    public function recordEvidence($con, $command, $evidenceType, $complaint_id){
        $query = "";
        $code = "";

        if($command != ""){
            if($command = "add"){
                switch($evidenceType){
                    case "witness":
                        $query = "INSERT INTO evidence (complaint_id, nic, witness_description) VALUES(?, ?, ?)";
                        $code = "NW";
                        break;
                    
                    case "fingerprint":
                        $query = "INSERT INTO evidence (complaint_id, nic, fingerprint_description) VALUES(?, ?, ?)";
                        $code = "NF";
                        break;
        
                    case "photo":
                        $query = "INSERT INTO evidence (complaint_id, photo_description) VALUES(?, ?)";
                        $code = "P";
                        break;
        
                    case "court_medical":
                        $query = "INSERT INTO evidence (complaint_id, court_medical_reports) VALUES(?, ?)";
                        $code = "C";
                        break;
        
                    case "accident_chart":
                        $query = "INSERT INTO evidence (complaint_id, accident_chart) VALUES(?, ?)";
                        $code = "A";
                        break;
                }
            }

            elseif($command == "update"){
                // Only Witness descriptions can be updated. Others are file paths.
                $query = "UPDATE evidence SET witness_description = ? WHERE complaint_id=? AND nic=?";
            }
    
            elseif($command == "delete"){}
    
            try{
                $pstmt = $con->prepare($query);

                if($command == "add"){
                    $pstmt->bindValue(1, $complaint_id);
    
                    switch($code){
                        case "NW":
                            $pstmt->bindValue(2, $this->witness_nic);
                            $pstmt->bindValue(3, $this->witness_description);
                            break;
        
                        case "NF";
                            $pstmt->bindValue(2, $this->witness_nic);
                            $pstmt->bindValue(3, $this->fingerprint_description);
                            break;
        
                        case "P":
                            $pstmt->bindValue(2, $this->photo_description);
                            break;
        
                        case "C":
                            $pstmt->bindValue(2, $this->court_medical_report);
                            break;
                        
                        case "A":
                            $pstmt->bindValue(2, $this->accident_chart);
                            break;
                    }
                }

                elseif($command == "update"){
                    $pstmt->bindValue(1, $this->witness_description);
                    $pstmt->bindValue(2, $complaint_id);
                    $pstmt->bindValue(3, $this->witness_nic);
                }
    
                $a = $pstmt->execute();
                if($a){
                    return true;
                }
                else{
                    return false;
                }
            }
            catch(PDOException $e){
                die("An Error Occured".$e->getMessage());
            }
        }
    }
}