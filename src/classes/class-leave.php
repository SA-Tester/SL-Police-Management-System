<?php

namespace classes;
use PDOException;

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
}

?>