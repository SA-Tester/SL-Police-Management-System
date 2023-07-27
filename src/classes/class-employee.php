<?php

namespace classes;
use PDO;
use PDOException;

class Employee{
    function viewEmployeeAvalability(){
        date_default_timezone_set('Asia/Colombo');
        $currentDate = date("Y-m-d");
    
        $dbcon = new DBConnector();
        try{
            $con = $dbcon->getConnection();
            $employeeQuery = "SELECT emplD, first_name, last_name, tel_no FROM employee";
            $epstmt = $con->prepare($employeeQuery);
            $epstmt->execute();
    
            if($epstmt->rowCount() > 0){
                echo '<tbody>';
                $count = 1;
                while($employeeRow = $epstmt->fetch(PDO::FETCH_ASSOC)){
                    $empID = $employeeRow[ 'emplD'];
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