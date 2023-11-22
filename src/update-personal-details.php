<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginForm.php");
    exit();
}
require_once "./classes/class-db-connector.php";

use classes\DBConnector;

$dbcon = new DBConnector();
$con = $dbcon->getConnection();
// 

$username = $_SESSION['username'];

// Fetch old employee details from the database based on the provided ID
$sql = "SELECT * FROM employee as e,login as l WHERE l.username=? AND l.empID=e.empID"; // Corrected column name
$stmt = $con->prepare($sql);
$stmt->bindValue(1, $username);
$stmt->execute();
$oldDetails = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['empID'] = $oldDetails['empID'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Update Details</title>
    <link rel="icon" type="image/png" href="../assets/logo.png">

    <style>
        .traffic {
            display: none;
        }

        #comp-table tr:hover {
            background-color: rgb(0, 0, 255, 0.2);
        }
    </style>

    <!--boostrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- dark mode switch condition -->
    <?php
    session_start();
    ?>
</head>

<body>
    <!------------------navbar---------------------------->
    <?php
    include 'navbar.php';
    renderNavBar();
    ?>
    <!---------------------------------------------------->
    <div class="modal-dialog">
        <div class="modal-content" style="    margin-top: 50px;
">

            <div class="modal-header">
                <h4 class="modal-title">Update details</h4>

            </div>

            <!-- Modal Body -->


            <div class="modal-body">
                <form action="update-employee.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Employee
                                            ID</strong></label></div><input class="form-control" type="text" id="emplD" name="emplD" required value="<?php echo $oldDetails['empID']; ?>" disabled>
                            </div>

                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Rank</strong></label></div><input class="form-control" type="text" id="rank" name="rank" required value="<?php echo $oldDetails['rank']; ?>" disabled>
                            </div>


                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>First
                                            Name</strong></label><input class="form-control" type="text" id="first_name" name="first_name" required value="<?php echo $oldDetails['first_name']; ?>"></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Last
                                            Name</strong></label><input class="form-control" type="text" id="last_name" name="last_name" required value="<?php echo $oldDetails['last_name']; ?>"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Date of Birth</strong></label></div><input class="form-control" type="date" id="dob" name="dob" required value="<?php echo $oldDetails['dob']; ?>">
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Gender</strong></label></div><select class="form-select" id="gender" name="gender" required disabled>
                                    <optgroup>
                                        <option value="Male" <?php if ($oldDetails['gender'] === "Male") echo "selected" ?>>Male</option>
                                        <option value="Female" <?php if ($oldDetails['gender'] === "Female") echo "selected" ?>>Female</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Contact</strong></label></div><input class="form-control" type="tel" id="tel_no" name="tel_no" required value="<?php echo $oldDetails['tel_no']; ?>">
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Email
                                            Address</strong></label></div><input class="form-control" type="email" id="email" name="email" required value="<?php echo $oldDetails['email']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Address</strong></label></div><input class="form-control" type="text" id="address" name="address" required value="<?php echo $oldDetails['address']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Marital
                                            Status</strong></label></div>
                                <!--select class="form-control" id="marital_status" name="marital_status" selected="<?php echo $oldDetails['marital_status']; ?>">
                                    <option value="Married">Married</option>
                                    <option value="Unmarried">Unmarried</option>
                                </select-->
                                <input class="form-control" type="text" id="marital_status" name="marital_status" required value="<?php echo $oldDetails['marital_status']; ?>">
                            </div>

                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>NIC</strong></label></div><input class="form-control" type="text" id="nic" name="nic" required value="<?php echo $oldDetails['nic']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Joined
                                            Date</strong></label></div><input class="form-control" type="date" id="appointment_date" name="appointment_date" required value="<?php echo $oldDetails['appointment_date']; ?>" disabled>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Retired Status</strong></label></div>
                                <select class="form-select" id="retired_status" name="retired_status" required disabled>
                                    <optgroup>
                                        <option value=1 <?php if ($oldDetails['retired_status'] === 1) echo 'selected'; ?>>Yes</option>
                                        <option value=0 <?php if ($oldDetails['retired_status'] === 0) echo 'selected'; ?>>No</option>

                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">

                        <input type="submit" name="submit" class="btn btn-primary" onclick="validateForm()" value="Submit" title="Click to Update details">
                        <input type="Reset" name="Reset" class="btn btn-success" onclick="" value="Reset" title="Reset Form before submit">
                        <a href="index.php"><button type="button" name="close" class="btn btn-secondary" data-dismiss="modal">Close</button></a>
                        <span id="error-message" style="color: red; display: none;">Please fill all fields.</span>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <footer class="py-5 mt-5" style="background-color: #101D6B;">
        <div class="container text-light text-center">
            <p class="display-5 mb-3">Sri Lanka Police</p>
            <small class="text-white-50">&copy; Copyright. All right reserved</small>
        </div>
    </footer>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script>
        function validateForm() {
            // Check if all required fields are filled in
            const inputs = document.querySelectorAll('#myModal input[required], #myModal select[required]');
            let isValid = true;

            for (const input of inputs) {
                if (!input.value.trim()) {
                    isValid = false;
                    break;
                }
            }

            if (isValid) {
                // If all required fields are filled, hide the error message and close the modal
                document.getElementById('error-message').style.display = 'none';
                $('#myModal').modal('hide');
            } else {
                // If any required field is empty, show the error message and keep the modal open
                document.getElementById('error-message').style.display = 'block';
            }
        }
    </script>
</body>

</html>