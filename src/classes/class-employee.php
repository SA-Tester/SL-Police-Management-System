<?php

namespace classes;
use PDO;
use PDOException;

class Employee{
    
    private $emplD;
    private $nic;
    private $first_name;
    private $last_name;
    private $dob;
    private $gender;
    private $tel_no;
    private $email;
    private $address;
    private $marital_status;
    private $rank;
    private $appointment_date;
    private $retired_status;

    public function __construct($emplD, $nic, $first_name, $last_name, $dob, $gender, $tel_no, $email, $address, $marital_status, $rank, $appointment_date, $retired_status) {
        $this->emplD = $emplD;
        $this->nic = $nic;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->dob = $dob;
        $this->gender = $gender;
        $this->tel_no = $tel_no;
        $this->email = $email;
        $this->address = $address;
        $this->marital_status = $marital_status;
        $this->rank = $rank;
        $this->appointment_date = $appointment_date;
        $this->retired_status = $retired_status;
        
    }
    public function register() {
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query = "INSERT INTO employee(emplD, nic, first_name, last_name, dob, gender, tel_no, email, address, marital_status, rank, appointment_date, retired_status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->emplD);
            $pstmt->bindValue(2, $this->nic);
            $pstmt->bindValue(3, $this->first_name);
            $pstmt->bindValue(4, $this->last_name);
            $pstmt->bindValue(5, $this->dob);
            $pstmt->bindValue(6, $this->gender);
            $pstmt->bindValue(7, $this->tel_no);
            $pstmt->bindValue(8, $this->email);
            $pstmt->bindValue(9, $this->address);
            $pstmt->bindValue(10, $this->marital_status);
            $pstmt->bindValue(11, $this->rank);
            $pstmt->bindValue(12, $this->appointment_date);
            $pstmt->bindValue(13, $this->retired_status);
           

            $a = $pstmt->execute();

            if ($a > 0) {
                header("Location: new-employee.php?message=1");
                exit;
            } else {
                header("Location: new-employee.php?message=2");
                exit;
            }
        } catch (PDOException $e) {
            die("Connection failed: ") . $e->getMessage();
        }
    }

    function viewEmployeeAvalability(){
        date_default_timezone_set('Asia/Colombo');
        $currentDate = date("Y-m-d");
    
        $dbcon = new DBConnector();
        try{
            $con = $dbcon->getConnection();
            $employeeQuery = "SELECT empID, first_name, last_name, tel_no FROM employee";
            $epstmt = $con->prepare($employeeQuery);
            $epstmt->execute();
    
            if($epstmt->rowCount() > 0){
                echo '<tbody>';
                $count = 1;
                while($employeeRow = $epstmt->fetch(PDO::FETCH_ASSOC)){
                    $empID = $employeeRow[ 'empID'];
                    $empName = $employeeRow[ 'first_name'] .' '. $employeeRow[ 'last_name'];
                    $empContactNo = $employeeRow['tel_no'];
                    
                    echo '<tr>';
                    echo '<th scope="row">'. $count .'</th>';
                    echo '<td data-title="Employee ID">' . $empID .'</td>';
                    echo '<td data-title="Name">' . $empName .'</td>';
                    echo '<td data-title="Contact Number">' . $empContactNo .'</td>';

                    //duty
                    $dutyQuery = "SELECT duty_type FROM duty WHERE empID = ? AND start <= ? AND end >= ?" ;
                    $dpstmt = $con->prepare($dutyQuery);
                    $dpstmt->bindValue(1,$empID);
                    $dpstmt->bindValue(2,$currentDate);
                    $dpstmt->bindValue(3,$currentDate);
                    $dpstmt->execute();
    
                    //leave
                    $leaveQuery = "SELECT leaveID FROM leaves WHERE empID = ? AND leave_start <= ? AND leave_end >= ?";
                    $lpstmt = $con->prepare($leaveQuery);
                    $lpstmt->bindValue(1,$empID);
                    $lpstmt->bindValue(2,$currentDate);
                    $lpstmt->bindValue(3,$currentDate);
                    $lpstmt->execute();
    

    
                    $isOnDuty = $dpstmt->rowCount() > 0;
                    $isOnLeave = $lpstmt->rowCount() > 0;
    
                    echo '<td data-title="Duty">';
                    if ($isOnDuty) {
                        $dutyType = $dpstmt->fetch(PDO::FETCH_ASSOC)['duty_type'];
                        echo $dutyType;
                    } else {
                        echo 'No Duty';
                    }
                    echo '</td>';
    
                    echo '<td data-title="Avalability">';
                    if ($isOnLeave) {
                        echo 'Not Available(On Leave)';
                    } else {
                        echo 'Available';
                    }
                    echo '</td>';
    
                    echo '</tr>';
                    $count++;
                }
                echo '</tbody>';
            } else {
                echo '<tbody><tr><td colspan="6">No records found.</td></tr></tbody>';
            }
            
    
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
}