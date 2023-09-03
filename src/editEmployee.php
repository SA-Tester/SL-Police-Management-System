<?php
require './classes/class-db-connector.php';

use classes\DBConnector;

$dbcon = new DBConnector();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>

    <title>Edit Employee</title>
    <link rel="icon" type="image/png" href="../assets/logo.png" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="../CSS/new-employee.css">
</head>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $emplD = ($_POST['emplD']);
        $nic = ($_POST['nic']);
        $first_name = ($_POST['first_name']);
        $last_name = ($_POST['last_name']);
        $dob = ($_POST['dob']);
        $gender = ($_POST['gender']);
        $tel_no = ($_POST['tel_no']);
        $email = ($_POST['email']);
        $address = ($_POST['address']);
        $marital_status = ($_POST['marital_status']);
        $rank = ($_POST['rank']);
        $appointment_date = ($_POST['appointment_date']);
        $retired_status = ($_POST['retired_status']);
        try {
            $con = $dbcon->getConnection();
            $query = "UPDATE employee SET nic=?, first_name=?, last_name=?, dob=?, gender=?, tel_no=?, email=?, address=?, marital_status=?, rank=?, appointment_date=?, retired_status=? WHERE `employee`.`emplD` = ?";

            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $nic);
            $pstmt->bindValue(2, $first_name);
            $pstmt->bindValue(3, $last_name);
            $pstmt->bindValue(4, $dob);
            $pstmt->bindValue(5, $gender);
            $pstmt->bindValue(6, $tel_no);
            $pstmt->bindValue(7, $email);
            $pstmt->bindValue(8, $address);
            $pstmt->bindValue(9, $marital_status);
            $pstmt->bindValue(10, $rank);
            $pstmt->bindValue(11, $appointment_date);
            $pstmt->bindValue(12, $retired_status);
            $pstmt->bindValue(13, $emplD);
            $pstmt->execute();
            if ($pstmt->rowCount() > 0) {
                header("Location: new-employee.php");
                exit;
            }
            //If user didn't do any changes but clicked update button.
            else {
                header("Location: new-employee.php");
                exit;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    } else {
        $emplD = ($_GET["emplD"]);
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT * FROM employee WHERE `employee`.`emplD` = ?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $emplD);
            $pstmt->execute();
            $rs = $pstmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    ?>
        <div class="container py-md-5">
            <div class="card shadow mb-3">
                <div class="card-header py-3 text-center">
                    <p style="color: darkblue;" class="m-0 fw-bold ">Edit Employee Details</p>
                </div>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <input type="hidden" name="emplD" value="<?php echo $rs->emplD; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>NIC</strong></label></div><input class="form-control" type="text" id="nic" name="nic" value="<?php echo $rs->nic; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>First
                                            Name</strong></label><input class="form-control" type="text" id="first_name" name="first_name" value="<?php echo $rs->first_name; ?>"></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Last
                                            Name</strong></label><input class="form-control" type="text" id="last_name" name="last_name" value="<?php echo $rs->last_name; ?>"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>DOB</strong></label></div><input class="form-control" type="date" id="dob" name="dob" value="<?php echo $rs->dob; ?>">
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Gender</strong></label></div><input class="form-control" name="gender" type="text" value="<?php echo $rs->gender; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Contact</strong></label></div><input class="form-control" type="tel" id="tel_no" name="tel_no" value="<?php echo $rs->tel_no; ?>">
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Email
                                            Address</strong></label></div><input class="form-control" type="email" id="email" name="email" value="<?php echo $rs->email; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Address</strong></label></div><input class="form-control" type="text" id="address" name="address" value="<?php echo $rs->address; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Marital
                                            Status</strong></label></div><input class="form-control" type="text" id="marital_status" name="marital_status" value="<?php echo $rs->marital_status; ?>">
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Rank</strong></label></div><input class="form-control" type="text" id="rank" name="rank" value="<?php echo $rs->rank; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Joined
                                            Date</strong></label></div><input class="form-control" type="date" id="appointment_date" name="appointment_date" value="<?php echo $rs->appointment_date; ?>">
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Retired Status</strong></label></div><input class="form-control" type="text" name="retired_status" value="<?php echo $rs->retired_status; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <input class="Submit-Btn" type="submit" value="Update" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
</body>

</html>