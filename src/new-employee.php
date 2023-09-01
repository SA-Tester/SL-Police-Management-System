<?php
require './classes/class-db-connector.php';

use classes\DbConnector;

$dbcon = new DbConnector();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Employee</title>
    <link rel="icon" type="image/png" href="../assets/logo.png" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/new-employee.css">

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
    <br><br>
    <div class="container py-md-5">
        <?php
        if (isset($_GET["message"])) {
            if ($_GET["message"] == 1) {
                echo "Successfully Saved!";
            } elseif ($_GET["message"] == 2) {
                echo "Error Occurred!";
            }
        }
        ?>
        <h2 style="color: darkblue; text-align: center;">Employee Details</h2>
        <div class="card shadow mb-3">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>NIC</th>
                            <th>Gender</th>
                            <th>Joined Date</th>
                            <th>Marital Status</th>
                            <th>Rank</th>
                            <th>Retired Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $con = $dbcon->getConnection();
                            $query = "SELECT * FROM employee";
                            $pstmt = $con->prepare($query);
                            $pstmt->execute();
                            $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
                            foreach ($rs as $user) {
                        ?>
                                <tr>
                                    <td><a href="editEmployee.php?empID=<?php echo $user->s; ?>">Edit</a></td>
                                    <td><a href="deleteEmployee.php?empID=<?php echo $user->empID; ?>">Delete</a></td>
                                    <td><?php echo $user->empID; ?></td>
                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name; ?></td>
                                    <td><?php echo $user->dob; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $user->tel_no; ?></td>
                                    <td><?php echo $user->address; ?></td>
                                    <td><?php echo $user->nic; ?></td>
                                    <td><?php echo $user->gender; ?></td>
                                    <td><?php echo $user->appointment_date; ?></td>
                                    <td><?php echo $user->marital_status; ?></td>
                                    <td><?php echo $user->rank; ?></td>
                                    <td><?php echo $user->retired_status; ?></td>

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
            <br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add Employee
            </button>

            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">New Employee</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form action="New_EmployeeForm.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>Employee
                                                        ID</strong></label></div><input class="form-control" type="text" id="empID" name="empID" required>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>NIC</strong></label></div><input class="form-control" type="text" id="nic" name="nic" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>First
                                                        Name</strong></label><input class="form-control" type="text" id="first_name" name="first_name" required></div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>Last
                                                        Name</strong></label><input class="form-control" type="text" id="last_name" name="last_name" required></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>DOB</strong></label></div><input class="form-control" type="date" id="dob" name="dob" required>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>Gender</strong></label></div><select class="form-select" id="gender" name="gender" required>
                                                <optgroup>
                                                    <option value="12" selected="">Female</option>
                                                    <option value="13">Male</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>Contact</strong></label></div><input class="form-control" type="tel" id="tel_no" name="tel_no" required>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>Email
                                                        Address</strong></label></div><input class="form-control" type="email" id="email" name="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>Address</strong></label></div><input class="form-control" type="text" id="address" name="address" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>Marital
                                                        Status</strong></label></div><input class="form-control" type="text" id="marital_status" name="marital_status" required>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>Rank</strong></label></div><input class="form-control" type="text" id="rank" name="rank" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>Joined
                                                        Date</strong></label></div><input class="form-control" type="date" id="appointment_date" name="appointment_date" required>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"><strong>Retired Status</strong></label></div>
                                            <select class="form-select" id="retired_status" name="retired_status" required>
                                                <optgroup>
                                                    <option value="12" selected="">Yes</option>
                                                    <option value="13">No</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <input type="submit" name="submit" class="btn btn-primary" onclick="validateForm()" value="Submit">
                                    <button type="button" name="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <span id="error-message" style="color: red; display: none;">Please fill all fields.</span>
                                </div>

                            </form>
                        </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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