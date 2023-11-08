<?php

namespace classes;

use PDO;
use PDOException;

class Duties{
    private $duty_type;
    private $duty_cause;
    private $start; 
    private $end;

    private $empID;
    private $location_id;
    private $con;

    public function __construct($duty_type, $duty_cause, $start, $end)
    {
        $this->duty_type = $duty_type;
        $this->duty_cause = $duty_cause;
        $this->start = $start;
        $this->end = $end;
    }

    public function setCon($con){
        $this->con = $con;
    }

    public function setEmpID($empID){
        $this->empID = $empID;
    }

    public function setStartDate($date){
        $this->start = $date;
    }

    public function setLocationID($location_id){
        $this->location_id = $location_id;
    }

    public function checkAvailability(){
        $query = "SELECT * FROM duty WHERE empID=? AND end>=?";
        try{
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $this->empID);
            $pstmt->bindValue(2, $this->start);
            $pstmt->execute();

            if($pstmt->rowCount() > 0){
                $rows = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row){
                    $current_end = strtotime($row["end"]);
                    $current_duty_type = $row["duty_type"];

                    // Employee is in a duty but should be assinged to another duty which is important that the current
                    if(($current_duty_type == "General" && $this->duty_type == "Emergency") || 
                        ($current_duty_type == "Emergency" && $this->duty_type == "Special") || 
                        ($current_duty_type == "General" && $this->duty_type == "Special")){

                        if($current_end >= strtotime($this->start)){
                            $query2 = "UPDATE duty SET end=? WHERE id=?";
                            $pstmt2 = $this->con->prepare($query2);
                            $pstmt2->bindValue(1, $this->start);
                            $pstmt2->bindValue(2, $row["id"]);
                            $pstmt2->execute();
                            return true;
                        }
                    }
                    else{
                        // Employee is already enrolled in a duty. Hence cannot be assigned to another.
                        return false;
                    }
                }
            }
            else{
                // Employee is not enrolled in a duty during the requested time.
                return true;
            }
        }
        catch(PDOException $e){
            die("Error Occured: ".$e->getMessage());
        }
    }

    public function addDuty(){
        $query = "INSERT INTO duty(empID, duty_type, duty_cause, start, end, location_id) VALUES(?, ?, ?, ?, ?, ?)";

        try{
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $this->empID);
            $pstmt->bindValue(2, $this->duty_type);
            $pstmt->bindValue(3, $this->duty_cause);
            $pstmt->bindValue(4, $this->start);
            $pstmt->bindValue(5, $this->end);
            $pstmt->bindValue(6, $this->location_id);

            if($this->checkAvailability()){
                if($pstmt->execute() > 0){
                    echo "Duty added <br>";
                    return true;
                }
                else{
                    return false;
                    die("An error occured");
                }
            }
            else{
                return false;
                die("An error occured");
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}