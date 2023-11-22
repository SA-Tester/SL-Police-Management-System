<?php
session_start();
require "./classes/class-db-connector.php";
require "./classes/class-leave.php";

use classes\DBConnector;
use classes\Leave;

$dbcon = new DBConnector();

$con = $dbcon->getConnection();

if (isset($_SESSION["user_id"], $_SESSION["role"], $_SESSION["username"]) && $_SESSION["role"] == "admin") {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="../css/calculate-salary.css">
        <link rel="stylesheet" href="../css/submit-leave-medical.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
            integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <title>Leave Management</title>
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
            <div class="row mt-5">
                <div class="col-50">
                    <h4 class="h4 mt-5">Leave Requests</h4>
                    <div class="row-50">
                        <div class="col-md" style="overflow-x: auto;">
                            <table class="table-con">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>EmpID</th>
                                        <th>Name</th>
                                        <th>Start Date</th>
                                        <th>Duration</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query1 = "SELECT leaves.*, employee.first_name, employee.last_name FROM leaves, employee where leaves.empID = employee.empID";
                                    $pstmt1 = $con->prepare($query1);
                                    $pstmt1->execute();
                                    $rs = $pstmt1->fetchAll(PDO::FETCH_OBJ);
                                    $i = 1;
                                    foreach ($rs as $employee) {
                                        if ($employee->status == 2) {
                                            $empID = $employee->empID;
                                            $leaveObject = new Leave(NULL, $employee->leave_start, $employee->leave_end, NULL, NULL, NULL);
                                            $leaveObject->setCon($con);
                                            $duration = $leaveObject->durationCal();
                                            if($duration == 1){
                                                $str = " day";
                                            } else{
                                                $str = " days";
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i ?>
                                                </td>
                                                <td>
                                                    <?php echo $empID ?>
                                                </td>
                                                </td>
                                                <td>
                                                    <?php echo $employee->first_name . " " . $employee->last_name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $employee->leave_start; ?>
                                                </td>
                                                <td>
                                                    <?php echo $duration . $str?>
                                                </td>
                                                <td><a href="leaveManagement.php?empID=<?php echo $empID ?>">View</a></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h4 class="h4">Accepted Leaves This Month</h4>
                    <div class="row-50">
                        <div class="col-md" style="overflow-x: auto;">
                            <table class="table-con">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>EmpID</th>
                                        <th>Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query4 = "SELECT leaves.*, employee.first_name, employee.last_name FROM leaves, employee where leaves.empID = employee.empID";
                                    $pstmt4 = $con->prepare($query4);
                                    $pstmt4->execute();
                                    $rs = $pstmt4->fetchAll(PDO::FETCH_OBJ);
                                    $i = 1;
                                    foreach ($rs as $employee) {
                                        $leaveObject = new Leave(NULL, $employee->leave_start, $employee->leave_end, NULL, NULL, NULL);
                                        $leaveObject->setCon($con);
                                        if ($leaveObject->checkLeaveThisMonth() && $employee->status == 1) {
                                            $duration = $leaveObject->durationCal();
                                            if($duration == 1){
                                                $str = " day";
                                            } else{
                                                $str = " days";
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $employee->empID; ?>
                                                </td>
                                                <td>
                                                    <?php echo $employee->first_name . " " . $employee->last_name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $employee->leave_start ?>
                                                </td>
                                                <td>
                                                    <?php echo $employee->leave_end ?>
                                                </td>
                                                <td>
                                                    <?php echo $duration . $str?>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-50 mt-5">
                    <h4 class="h4">Leave Application</h4>

                    <?php
                    if (isset($_GET["message"])) {
                        if ($_GET["message"] == 1) {
                            echo "<div class='alert'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Updated Successfully!</strong></div>";
                        } elseif ($_GET["message"] == 2) {
                            echo "<div class='error'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Error Occurred!</strong></div>";
                        }
                    }
                    ?>

                    <div class="containerx">
                        <?php
                        if (isset($_GET["empID"])) {
                            $empID = $_GET["empID"];
                            $query2 = "SELECT leaves.*, employee.first_name, employee.last_name FROM leaves, employee where leaves.empID = employee.empID";
                            $pstmt2 = $con->prepare($query2);
                            $pstmt2->execute();
                            $rs = $pstmt2->fetchAll(PDO::FETCH_OBJ);
                            foreach ($rs as $employee) {
                                if ($employee->empID == $empID && $employee->status == 2) {
                                    ?>

                                    <form action="leaveManagement-process.php" method="POST">
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="emp_id">Emp ID</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" id="emp_id" name="emp_id" value="<?php echo $empID ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="fullname">Name</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" id="fullname" name="fullname" value="<?php echo $employee->first_name . " " . $employee->last_name;?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="from_date">From</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" id="from_date" name="from_date"
                                                    value="<?php echo $employee->leave_start ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="to_date">To</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" id="to_date" name="to_date"
                                                    value="<?php echo $employee->leave_end ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="reason_type">Reason Type</label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" id="reason_type" name="reason_type"
                                                    value="<?php echo $employee->reason_type ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-25">
                                                <label for="reason_desc">Reason Description </label>
                                            </div>
                                            <div class="col-75">
                                                <input type="text" id="reason_desc" name="reason_desc" style="height:auto;"
                                                    value="<?php echo $employee->reason ?>" readonly></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <img src="../uploads/medicals/<?php echo $employee->medical ?>" alt="Medical Not Found"
                                                width="100%" style="margin:20px 0;">
                                        </div>
                                        <div class="row">
                                            <input type="submit" name="status" class="btn1 buttons" value="ACCEPT">
                                            <input type="submit" name="status" class="btn1 buttons" value="REJECT">
                                        </div>
                                    </form>
                                    <?php
                                }
                            }
                        } else {
                            echo "<h6>Select Leave Application Form</h6>";
                        }
                        ?>
                    </div>

                    <h4 class="h4">Leave History</h4>
                    <div class="row-50">
                        <div class="col-md" style="overflow-x: auto;">
                            <table class="table-con">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Duration</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET["empID"])) {
                                        $empID = $_GET["empID"];
                                        $query3 = "SELECT * FROM leaves";
                                        $pstmt3 = $con->prepare($query3);
                                        $pstmt3->execute();
                                        $rs = $pstmt3->fetchAll(PDO::FETCH_OBJ);
                                        $i = 1;
                                        foreach ($rs as $employee) {
                                            if ($employee->empID == $empID && $employee->status == 1) {
                                                $leaveObject = new Leave(NULL, $employee->leave_start, $employee->leave_end, NULL, NULL, NULL);
                                                $leaveObject->setCon($con);
                                                $duration = $leaveObject->durationCal();
                                                if($duration == 1){
                                                    $str = " day";
                                                } else{
                                                    $str = " days";
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $employee->leave_start ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $employee->leave_end ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $duration . $str?>
                                                    </td>
                                                    <td>
                                                        <?php echo $employee->reason_type ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

    <?php
} else {
    header("Location: loginForm.php");
}
?>