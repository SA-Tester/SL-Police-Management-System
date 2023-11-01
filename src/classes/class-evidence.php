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
        try{
            $query = "SELECT nic, witness_description FROM evidence WHERE complaint_id=? AND witness_description IS NOT NULL";

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

    public function getFingerprints($con, $complaint_id){
        try{
            $query = "SELECT fingerprint_description FROM evidence WHERE complaint_id=? AND fingerprint_description IS NOT NULL";

            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $complaint_id);
            if($pstmt->execute()){
                $rows = $pstmt->fetchAll(PDO::FETCH_NUM);
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

    public function getPhotos($con, $complaint_id){
        try{
            $query = "SELECT photo_description FROM evidence WHERE complaint_id=? AND photo_description IS NOT NULL";

            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $complaint_id);
            if($pstmt->execute()){
                $rows = $pstmt->fetchAll(PDO::FETCH_NUM);
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

    public function getCourtMedicalReports($con, $complaint_id){
        try{
            $query = "SELECT court_medical_reports FROM evidence WHERE complaint_id=? AND court_medical_reports IS NOT NULL";

            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $complaint_id);
            if($pstmt->execute()){
                $rows = $pstmt->fetchAll(PDO::FETCH_NUM);
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

    public function getAccidentCharts($con, $complaint_id){
        try{
            $query = "SELECT accident_chart FROM evidence WHERE complaint_id=? AND accident_chart IS NOT NULL";

            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $complaint_id);
            if($pstmt->execute()){
                $rows = $pstmt->fetchAll(PDO::FETCH_NUM);
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

    public function getFingerPrintCount($con, $complaint_id){
        try{
            $query = "SELECT COUNT(fingerprint_description) FROM evidence WHERE complaint_id=?";

            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $complaint_id);
            if($pstmt->execute()){
                $row = $pstmt->fetch(PDO::FETCH_NUM);
                return $row[0];
            }
        }
        catch(PDOException $e){
            die("Error Occured: ".$e->getMessage());
        }
    }

    public function getPhotoCount($con, $complaint_id){
        try{
            $query = "SELECT COUNT(photo_description) FROM evidence WHERE complaint_id=?";

            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $complaint_id);
            if($pstmt->execute()){
                $row = $pstmt->fetch(PDO::FETCH_NUM);
                return $row[0];
            }
        }
        catch(PDOException $e){
            die("Error Occured: ".$e->getMessage());
        }
    }

    public function getMedicalCount($con, $complaint_id){
        try{
            $query = "SELECT COUNT(court_medical_reports) FROM evidence WHERE complaint_id=?";

            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $complaint_id);
            if($pstmt->execute()){
                $row = $pstmt->fetch(PDO::FETCH_NUM);
                return $row[0];
            }
        }
        catch(PDOException $e){
            die("Error Occured: ".$e->getMessage());
        }
    }

    public function getAccidentChartCount($con, $complaint_id){
        try{
            $query = "SELECT COUNT(accident_chart) FROM evidence WHERE complaint_id=?";

            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $complaint_id);
            if($pstmt->execute()){
                $row = $pstmt->fetch(PDO::FETCH_NUM);
                return $row[0];
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
            if($command == "add"){
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

                    default:
                        break;
                }
            }

            elseif($command == "update"){
                // Only Witness descriptions can be updated. Others are file paths.
                $query = "UPDATE evidence SET witness_description=? WHERE complaint_id=? AND nic=?";
            }
    
            elseif($command == "delete"){
                switch($evidenceType){
                    case "witness":
                        $query = "DELETE FROM evidence WHERE witness_description=?";
                        $code = "DW";
                        break;
                    
                    case "fingerprint":
                        $query = "DELETE FROM evidence WHERE fingerprint_description=?";
                        $code = "DF";
                        break;
        
                    case "photo":
                        $query = "DELETE FROM evidence WHERE photo_description=?";
                        $code = "DP";
                        break;
        
                    case "court_medical":
                        $query = "DELETE FROM evidence WHERE court_medical_reports=?";
                        $code = "DM";
                        break;
        
                    case "accident_chart":
                        $query = "DELETE FROM evidence WHERE accident_chart=?";
                        $code = "DA";
                        break;

                    default:
                        break;
                }
            }
    
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

                elseif($command == "delete"){
                    switch($code){
                        case "DW":
                            $pstmt->bindValue(1, $this->witness_description);
                            break;

                        case "DF":
                            $pstmt->bindValue(1, $this->fingerprint_description);
                            break;

                        case "DP":
                            $pstmt->bindValue(1, $this->photo_description);
                            break;

                        case "DM":
                            $pstmt->bindValue(1, $this->court_medical_report);
                            break;
                        
                        case "DA":
                            $pstmt->bindValue(1, $this->accident_chart);
                            break;

                        default:
                            break;
                    }
                }

                if($pstmt->execute()){
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