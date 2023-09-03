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

    <link rel="stylesheet" href="../CSS/special-duty.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <title>Special Duty</title>
    <link rel="icon" type="image/png" href="../assets/logo.png">
</head>

<body>
    <!------------------navbar---------------------------->
    <?php
    include 'navbar.php';
    renderNavBar();
    ?>
    <!---------------------------------------------------->

    <br><br><br><br>
    <div class="container">
        <?php
        if (isset($_GET["message"])) {
            if ($_GET["message"] == 1) {
                echo "Successfully Saved!";
            } elseif ($_GET["message"] == 2) {
                echo "Error Occurred!";
            }
        }
        ?>
        <div class="row">
            <div class="col-md-6">

                <div class="card shadow mb-3">
                    <div class="card-header py-3 text-center">
                        <p style="color: darkblue;">Special Duty</p>
                    </div>
                    <form action="Assign_special_duty.php" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="empID"><strong>Employee
                                                ID</strong></label></div> <select id="empID" name="empID" required>
                                        <option value="EMP0001">EMP0001</option>
                                        <option value="EMP0002">EMP0002</option>
                                        <option value="EMP0003">EMP0003</option>                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3"><label class="form-label"><strong>Duty type</strong></label></div><input class="form-control" type="text" id="duty_type" name="duty_type" value="Special" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3"><label class="form-label"><strong>Duty cause</strong></label></div><select id="duty_cause" name="duty_cause" required>
                                        <option>Independence Day Parade</option>
                                        <option>Religious Function</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3"><label class="form-label"><strong>Start time</strong></label></div><input class="form-control" type="datetime-local" id="start" name="start" required>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label"><strong>End time</strong></label></div><input class="form-control" type="datetime-local" id="end" name="end" required>
                                </div>
                                <div class="col">
                                    <div class="mb-3"></div><input class="form-control" type="hidden" id="location_id" name="location_id" value="3">
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col">
                                    <input type="submit" name="submit" class="Submit-Btn" value="Add Duty">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <button class="Submit-Btn" type="submit">Send email</button>
                            </div>
                            <div class="col">
                                <button class="Submit-Btn" type="submit">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
            <div class="col-md-6">
                <h2 style="color: darkblue; text-align: center;">Special Duty</h2>
                <div class="card shadow mb-3">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Select All</th>
                                    <th>Employee ID</th>
                                    <th>Duty type</th>
                                    <th>Duty cause</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    $con = $dbcon->getConnection();
                                    $query = "SELECT * FROM duty WHERE `duty`.`duty_type` = 'Special'";
                                    $pstmt = $con->prepare($query);
                                    $pstmt->execute();
                                    $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($rs as $user) {
                                ?>
                                        <tr>
                                            <td style="text-align: center;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                </div>
                                            </td>
                                            <td><?php echo $user->empID; ?></td>
                                            <td><?php echo $user->duty_type; ?></td>
                                            <td><?php echo $user->duty_cause; ?></td>
                                        </tr>
                                <?php
                                    }
                                } catch (PDOException $exc) {
                                    echo $exc->getMessage();
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
        -->
</body>

</html>