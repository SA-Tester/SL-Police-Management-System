<?php

namespace classes;
use PDOException;
use PDO;

class Leave{
    private $emp_id;
    private $from_date;
    private $to_date;
    private $reason_type;
    private $reason_desc;
    private $upload_medical;
    private $con;

    public function __construct($emp_id, $from_date, $to_date, $reason_type, $reason_desc, $upload_medical){
        $this->emp_id = $emp_id;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->reason_type = $reason_type;
        $this->reason_desc = $reason_desc;
        $this->upload_medical = $upload_medical;
    }

    public function setCon($con){
        $this->con = $con;
    }

    public function applyLeave(){
        $query = "INSERT INTO leaves (empID, leave_start, leave_end, reason_type, reason, medical) VALUES (?, ?, ?, ?, ?, ?)";
        try {
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $this->emp_id);
            $pstmt->bindValue(2, $this->from_date);
            $pstmt->bindValue(3, $this->to_date);
            $pstmt->bindValue(4, $this->reason_type);
            $pstmt->bindValue(5, $this->reason_desc);
            $pstmt->bindValue(6, $this->upload_medical);
            $pstmt->execute();
            if($pstmt->rowCount() > 0){
                return true;
            } else{
                return false;
            }       
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function updateStatus($status){
        $query = "UPDATE leaves SET status=? WHERE empID=? AND status=2";
        try {
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $status);
            $pstmt->bindValue(2, $this->emp_id);
            $pstmt->execute();
            if($pstmt->rowCount() > 0){
                return true;
            } else{
                return false;
            } 
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function durationCal(){
        $start_date = date_create($this->from_date);
        $end_date = date_create($this->to_date);
        $difference = date_diff($start_date, $end_date);
        return($difference->d);
    }

    public function checkPendingApplication(){
        $query = "SELECT * FROM leaves";
        $pstmt = $this->con->prepare($query);
        $pstmt->execute();
        $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($rs as $employee){
            if($employee->empID==$this->emp_id && $employee->status==2){
                return true;
            }
        }
        return false;
    }

    public function checkLeaveThisMonth(){
        $thisMonth = date("M");
        $start_date = date("M", strtotime($this->from_date));
        $end_date = date("M", strtotime($this->to_date));
        if($start_date == $thisMonth || $end_date == $thisMonth){
            return true;
        } else{
            return false;
        }
    }
}

?>