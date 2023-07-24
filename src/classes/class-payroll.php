<?php 

namespace classes;
use PDOException;

class CalculateSalary{
    private $emp_id;
    private $base_salary;
    private $service_years;
    private $rank;
    private $email;
    private $con;


    public function __construct($emp_id, $base_salary, $service_years){
        $this->emp_id = $emp_id;
        $this->base_salary = $base_salary;
        $this->service_years = $service_years;
    }

    public function setCon($con){
        $this->con = $con;
    }

    public function setTotalSalary($base_salary, $service_years){
        $this->total_salary = ($base_salary + $service_years * 1000);
    }

    public function setBartar($base_salary, $service_years){
        $this->bartar_amount = ($base_salary + $service_years * 1000) * 20 / 100 ;
    }

    public function addEmployee(){
        $query = "INSERT INTO salary (empID, base_salary, service_years, bartar_amount, total_salary) VALUES (?, ?, ?, ?, ?)";
        try {
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $this->emp_id);
            $pstmt->bindValue(2, $this->base_salary);
            $pstmt->bindValue(3, $this->service_years);
            $pstmt->bindValue(4, $this->bartar_amount);
            $pstmt->bindValue(5, $this->total_salary);
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


?>