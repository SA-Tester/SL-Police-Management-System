<?php

namespace classes;

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

    public function setLocationID($location_id){
        $this->location_id = $location_id;
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
            $a = $pstmt->execute();

            if($a > 0){
                echo "Duty added <br>";
                return true;
            }
            else{
                return false;
                die("An error occured: Duty Table");
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}