<?php

require "./classes/class-db-connector.php";

use classes\DBConnector;

$dbcon = new DBConnector();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/calculate-salary.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://kit.fontawesome.com/a943423ab3.js" crossorigin="anonymous"></script>
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <title>Calculate Salary</title>
    <link rel="icon" type="image/png" href="../assets/logo.png">

    <!--boostrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- dark mode switch condition -->
    <?php
    session_start();
    if ($_SESSION['dark']) {
        echo '<link rel="stylesheet" href="../css/dark-mode.css">';
    }
    ?>
</head>

<body>
    <!------------------navbar---------------------------->
    <?php
        include 'navbar.php';
        renderNavBar();
    ?>
    <!---------------------------------------------------->
    
    <div>
        <h4 class="mt-5">Calculate Salary</h4>
        
        <?php
            if (isset($_GET["message"])) {
                if ($_GET["message"] == 1) {
                    echo "<div class='alert'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Successfully Saved!</strong></div>";
                } elseif ($_GET["message"] == 2) {
                     echo "<div class='error'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Error Occurred!</strong></div>";
                } elseif ($_GET["message"] == 3) {
                    echo "<div class='alert'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Email Sent Successfully!</strong></div>";
                } elseif ($_GET["message"] == 4) {
                    echo "<div class='alert'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Salary Sheet Sent Successfully!</strong></div>";
                } elseif ($_GET["message"] == 5) {
                    echo "<div class='alert'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Pension Sheet Sent Successfully!</strong></div>";
                }
            }
        ?>

        <div style="overflow-x: auto;">
        
            <table class="table-con">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>EmpID</th>
                        <th>Rank</th>
                        <th>Email</th>
                        <th>Base Salary</th>
                        <th>Service Years</th>
                        <th>Barter</th>
                        <th>Total Salary</th>
                        <th>Pension Amount</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    try {
                        $con = $dbcon->getConnection();
                        $query = "SELECT salary.*, employee.email, employee.rank FROM salary, employee where salary.empID = employee.empID";
                        $pstmt = $con->prepare($query);
                        $pstmt->execute();
                        $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
                        $i = 1;
                        foreach ($rs as $employee){
                    ?>
                    
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $employee->empID; ?></td>
                        <td><?php echo $employee->rank; ?></td>
                        <td><?php echo $employee->email; ?></td>
                        <td><?php echo $employee->base_salary; ?></td>
                        <td><?php echo $employee->service_years; ?></td>
                        <td><?php echo $employee->bartar_amount; ?></td>
                        <td><?php echo $employee->total_salary; ?></td>
                        <td><?php echo $employee->pension_amount; ?></td>
                        <td class="buttons"><a class="btn2" href="retired-employee.php?empID=<?php echo $employee->empID;?>&base_salary=<?php echo $employee->base_salary; ?>">Retired</a> 
                        <a class="btn2" href="reset-payroll.php?empID=<?php echo $employee->empID;?>&base_salary=<?php echo $employee->base_salary; ?>">Reset</a> 
                        <a class="btn2" href="remove-payroll.php?empID=<?php echo $employee->empID; ?>">Remove</a> 
                        <a class="btn2" href="sendPaySheets.php?empID=<?php echo $employee->empID; ?>&email=<?php echo $employee->email; ?>&base_salary=<?php echo $employee->base_salary; ?>&bartar_amount=<?php echo $employee->bartar_amount; ?>&total_salary=<?php echo $employee->total_salary; ?>&pension_amount=<?php echo $employee->pension_amount; ?>">Send</a><td>
                    </tr>

                    <?php
                        $i++;
                        }
                    } catch (PDOException $exc) {
                        echo $exc->getMessage();
                    }
                    ?>

                    
                    </tbody>
            </table>
        </div>


        <div class="buttons">
            <button type="button" class="btn1" onclick="openForm()"><i class="fa-solid fa-user-plus"></i> Add</button>
            <form action="process-payroll.php" method="POST">
                <input type="submit" class="btn1" name="refresh" value="Refresh"/>
            </form>
            <button type="button" class="btn1" onclick="sendEmail()">Send Email</button>
        </div>
    </div>

    <div class="form-popup" id="myForm">
        <form method="POST" action="process-payroll.php" class="form-container">

          <h4>Add New Employee</h4>
      
          <label for="empID">EmpID</label>
          <input type="text" placeholder="Enter Employee ID" name="empID" required>
      
          <label for="base_salary">Base Salary</label>
          <input type="text" placeholder="Enter Base Salary" name="base_salary" required>
      
          <div class="buttons">
            <button type="submit" class="btn1" name="add">Add</button>
            <button type="button" class="btn2" onclick="closeForm()">Close</button>
          </div>
        </form>
      </div>


       <form action="process-payroll.php" method="POST" class="msg_container" id="msg_container">
            <h4>Compose Email</h4>
            <p id="multi-responce"></p>
            <!-- <div class="form-group">
                <textarea class="form-control" id="emails" name="emails" placeholder="Email list" style="height: 80px;"></textarea>
            </div> -->
            <div class="form-group">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
            </div>
            <div class="form-group">
                <textarea style="height: 220px;" name="message" class="form-control" placeholder="Your Message" rows="5" required></textarea>
            </div>
            <div class="buttons">
                <input type="submit" class="btn1" name="send" value="Send"/>
                <button type="button" class="btn2" onclick="closeEmail()">Close</button>
            </div>
        </form>

    <script>
    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }
    
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }

    function sendEmail() {
      document.getElementById("msg_container").style.display = "block";
    }

    function closeEmail() {
      document.getElementById("msg_container").style.display = "none";
    }
    </script>

    <footer class="py-5 mt-5" style="background-color: #101D6B;">
        <div class="container text-light text-center">
            <p class="display-5 mb-3">Sri Lanka Police</p>
            <small class="text-white-50">&copy; Copyright. All right reserved</small>
        </div>
    </footer>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>