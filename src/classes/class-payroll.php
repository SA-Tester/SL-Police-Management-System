<?php 

namespace classes;
use PDOException;
use PDO;

require "includes\PHPMailer.php";
require "includes\SMTP.php";
require "includes\Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class CalculateSalary{
    private $emp_id;
    private $base_salary;
    private $con;


    public function __construct($emp_id, $base_salary){
        $this->emp_id = $emp_id;
        $this->base_salary = $base_salary;
    }

    public function setCon($con){
        $this->con = $con;
    }

    public function setServiceYears(){
        $query = "SELECT empID, appointment_date FROM employee";
        $pstmt = $this->con->prepare($query);
        $pstmt->execute();
        $rows = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){
            if($row['empID']==$this->emp_id){
                $appointment_date = $row['appointment_date'];
            }
        }

        $current_date = date("Y-m-d");
        $startDate = date_create($appointment_date);
        $lastDate = date_create($current_date);
        $difference = date_diff($startDate, $lastDate);
        $this->service_years = $difference->y;
    }

    public function setTotalSalary(){
        $this->total_salary = ($this->base_salary + $this->service_years * 1000);
    }

    public function setBartar(){
        $query = "SELECT empID, rank FROM employee";
        $pstmt = $this->con->prepare($query);;
        $pstmt->execute();
        $rows = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){
            if($row['empID']==$this->emp_id){
                $rank = $row['rank'];
            }
        }

        if($rank == "PC" || $rank == "WPC"){
            $this->bartar_amount = 12000;
        } else if($rank == "PC" || $rank == "WPC" || $rank == "PS" || $rank == "WPS"){
            $this->bartar_amount = 15000;
        } else if ($rank == "SI" || $rank == "IP" || $rank == "ASP"){
            $this->bartar_amount = 20000;
        } else{
            $this->bartar_amount = 25000;
        }
    }

    public function setPension(){
        if($this->service_years >= 30){
            $this->pension = $this->base_salary * 80/100;
        } else if($this->service_years >= 25){
            $this->pension = $this->base_salary * 75/100;
        } else{
            $this->pension = $this->base_salary * 70/100;
        }
    }

    public function addEmployee(){
        $query = "SELECT empID, retired_status FROM employee";
        $pstmt = $this->con->prepare($query);
        $pstmt->execute();
        $rows = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row){
            if($row['empID']==$this->emp_id){
                $retired_status = $row['retired_status'];
            }
        }

        if($retired_status==0){
            $query = "INSERT INTO salary (empID, base_salary, service_years, bartar_amount, total_salary, pension_amount) VALUES (?, ?, ?, ?, ?. ?)";
            try {
                $pstmt = $this->con->prepare($query);
                $pstmt->bindValue(1, $this->emp_id);
                $pstmt->bindValue(2, $this->base_salary);
                $pstmt->bindValue(3, $this->service_years);
                $pstmt->bindValue(4, $this->bartar_amount);
                $pstmt->bindValue(5, $this->total_salary);
                $pstmt->bindValue(6, NULL);
                $pstmt->execute();
                if($pstmt->rowCount() > 0){
                    header("Location: payroll.php?message=1");
                    exit;
                } else{
                    header("Location: payroll.php?message=2");
                    exit;
                }

            } catch (PDOException $exc) {
                echo $exc->getMessage();
            }
        } else{
            $query = "INSERT INTO salary (empID, base_salary, service_years, bartar_amount, total_salary, pension_amount) VALUES (?, ?, ?, ?, ?, ?)";
            try {
                $pstmt = $this->con->prepare($query);
                $pstmt->bindValue(1, $this->emp_id);
                $pstmt->bindValue(2, $this->base_salary);
                $pstmt->bindValue(3, $this->service_years);
                $pstmt->bindValue(4, NULL);
                $pstmt->bindValue(5, NULL);
                $pstmt->bindValue(6, $this->pension);
                $pstmt->execute();
                if($pstmt->rowCount() > 0){
                    header("Location: payroll.php?message=1");
                    exit;
                } else{
                    header("Location: payroll.php?message=2");
                    exit;
                }

            } catch (PDOException $exc) {
                echo $exc->getMessage();
            }
        }


        
    }

    public function removeEmployee(){
        $query = "DELETE from salary WHERE empID=?";
        try {
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $this->emp_id);
            $pstmt->execute();
            if ($pstmt->rowCount() > 0){
                header("Location: payroll.php"); 
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function retiredEmployee(){
        $query = "UPDATE salary SET bartar_amount=?, total_salary=?, pension_amount=? WHERE empID=?";
        try {
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, NULL);
            $pstmt->bindValue(2, NULL);
            $pstmt->bindValue(3, $this->pension);
            $pstmt->bindValue(4, $this->emp_id);
            $pstmt->execute();
            header("Location: payroll.php");
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function reset(){
        $query = "UPDATE salary SET bartar_amount=?, total_salary=?, pension_amount=? WHERE empID=?";
        try {
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $this->bartar_amount);
            $pstmt->bindValue(2, $this->total_salary);
            $pstmt->bindValue(3, NULL);
            $pstmt->bindValue(4, $this->emp_id);
            $pstmt->execute();
            header("Location: payroll.php");
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function refersh(){
        $query = "UPDATE salary SET service_years=?, bartar_amount=?, total_salary=? WHERE empID=?";
        try {
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $this->service_years);
            $pstmt->bindValue(2, $this->bartar_amount);
            $pstmt->bindValue(3, $this->total_salary);
            $pstmt->bindValue(4, $this->emp_id);
            $pstmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function sendSalarySheet(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        //$mail->Username = "kasunikamaheshi2000@gmail.com";
        $mail->Password = "zafvlbvxlpakbvsv";
        //$mail->setFrom("kasunikamaheshi2000@gmail.com");
        $mail->isHTML(true);
        return $mail;
    }
}


?>