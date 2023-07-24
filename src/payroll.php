<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesgeet" href="../CSS/submit-leave-medical.css">
    <link rel="stylesheet" href="../CSS/calculate-salary.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a943423ab3.js" crossorigin="anonymous"></script>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <title>Calculate Salary</title>
    <link rel="icon" type="image/png" href="../assets/logo.png">
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

        <div style="overflow-x: auto;" class="mt-5">
        
        <?php
            if (isset($_GET["message"])) {
                if ($_GET["message"] == 1) {
                    echo "<div class='alert'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Successfully Saved!</strong></div>";
                } elseif ($_GET["message"] == 2) {
                     echo "<div class='error'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Error Occurred!</strong></div>";
                }
            }
        ?>
            <table class="table-con">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>EmpID</th>
                        <th>Rank</th>
                        <th>Base Salary</th>
                        <th>Service</th>
                        <th>Barter</th>
                        <th>Total Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</th>
                        <td>EMP0001</td>
                        <td>IP</td>
                        <td>40000</td>
                        <td>30</td>
                        <td>15000</td>
                        <td>60000</td>
                    </tr>
                    <tr>
                        <td>2</th>
                        <td>EMP0002</td>
                        <td>WPC</td>
                        <td>30000</td>
                        <td>20</td>
                        <td>10000</td>
                        <td>42000</td>
                    </tr>
                    <tr>
                        <td>3</th>
                        <td>EMP0003</td>
                        <td>SI</td>
                        <td>35000</td>
                        <td>40</td>
                        <td>12250</td>
                        <td>75000</td>
                    </tr>
                    </tbody>
            </table>
        </div>


        <div class="buttons">
            <button type="button" class="btn1" onclick="openForm()"><i class="fa-solid fa-user-plus"></i> Add</button>
            <button type="button" class="btn2"><i class="fa-solid fa-calculator"></i> Calculate</button>
        </div>
    </div>

    <div class="form-popup" id="myForm">
        <form method="POST" action="process-payroll.php" class="form-container">

          <h4>Add New Employee</h4>
      
          <label for="empID">EmpID</label>
          <input type="text" placeholder="Enter Employee ID" name="empID" required>
      
          <label for="base_salary">Base Salary</label>
          <input type="text" placeholder="Enter Base Salary" name="base_salary" required>
          
          <label for="service_years">Service Years</label>
          <input type="text" placeholder="Enter Service Years" name="service_years" required>
      
          <div class="buttons">
            <button type="submit" class="btn1" name="add">Add</button>
            <button type="button" class="btn2" onclick="closeForm()">Close</button>
          </div>
        </form>
      </div>
      
      <script>
      function openForm() {
        document.getElementById("myForm").style.display = "block";
      }
      
      function closeForm() {
        document.getElementById("myForm").style.display = "none";
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