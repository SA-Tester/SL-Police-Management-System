<?php
session_start();

require './classes/class-db-connector.php';

use classes\DBConnector;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accept'])) {
        updateDutyStatus($_POST['duty_id'], 1);
        showAlert('Duty accepted successfully!');
    } elseif (isset($_POST['reject'])) {
        updateDutyStatus($_POST['duty_id'], 0);
        showAlert('Duty rejected successfully!');
    }
}
//feedback
if (isset($_POST['feedback'])) {
    $feedback = $_POST['feedback'];
    $duty_id = $_POST['duty_id'];

    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();

    if (isDutyStatusUpdated($duty_id)) {
        try {
            $fquery = "UPDATE duty_feedback SET feedback=? WHERE duty_id=?";
            $fpstmt = $con->prepare($fquery);
            $fpstmt->bindValue(1, $feedback);
            $fpstmt->bindValue(2, $duty_id);
            $fpstmt->execute();
        } catch (PDOException $ex) {
            die("Error updating duty feedback: " . $ex->getMessage());
        }
    } else {
        showAlert('Please accept or reject the duty before submitting feedback.');
    }
}

function isDutyStatusUpdated($duty_id)
{
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();
    try {
        $cquery = "SELECT COUNT(*) FROM duty_feedback WHERE duty_id = ? AND status IS NOT NULL";
        $cpstmt = $con->prepare($cquery);
        $cpstmt->bindValue(1, $duty_id);
        $cpstmt->execute();
        $count = $cpstmt->fetchColumn();
        return ($count > 0);
    } catch (PDOException $ex) {
        return false;
    }
}

//accepted/rejected
function updateDutyStatus($duty_id, $status)
{
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();
    try {
        $squery = "INSERT INTO duty_feedback(duty_id,status) VALUES(?,?) ON DUPLICATE KEY UPDATE status = ?";
        $spstmt = $con->prepare($squery);
        $spstmt->bindValue(1, $duty_id);
        $spstmt->bindValue(2, $status);
        $spstmt->bindValue(3, $status);
        $spstmt->execute();
    } catch (PDOException $ex) {
        die("Error inserting duty status: " . $ex->getMessage());
    }
}
function showAlert($message)
{
    echo '<script>alert("' . $message . '");</script>';
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/checkDuty.css">

    <title>Check Duty</title>
    <link rel="icon" type="image/png" href="../assets/logo.png" />
</head>

<body>
    <!------------------navbar---------------------------->
    <?php
    include 'navbar.php';
    renderNavBar();
    ?>
    <!---------------------------------------------------->
    <br><b>
        <div class="container-fluid heading">
            <div class="row mt-3">
                <div class="col-md-12">
                    <?php
                    $dbcon = new DBConnector();
                    $con = $dbcon->getConnection();
                    $id = $_SESSION['user_id'];
                    try {
                        $dquery = "SELECT * FROM employee WHERE empID = ?";
                        $dpstmt = $con->prepare($dquery);
                        $dpstmt->bindValue(1, $id);
                        $dpstmt->execute();
                        $row = $dpstmt->fetch(PDO::FETCH_ASSOC);
                        $name = $row['first_name'] . " " . $row['last_name'];
                    } catch (PDOException $ex) {
                        die("Error inserting duty status: " . $ex->getMessage());
                    }
                    ?>
                    <h3 style="color:#101D6B" class="h3"><b>Hello <?= $name ?>,</b></h3>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-12">
                    <h4 style="color:#101D6B" class="h5">Duty Assignment:
                        <span class="date">
                            <?php
                            date_default_timezone_set('Asia/Colombo');
                            echo date("Y-m-d")
                            ?>
                        </span>
                    </h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="table-responsive" id="avalability-table">
                        <table class="table mt-3">
                            <thead class="thead-edit">
                                <tr>
                                    <th scope="col">Duty Type</th>
                                    <th scope="col">Duty Cause</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Feedback</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <?php
                                    date_default_timezone_set('Asia/Colombo');
                                    $currentDate = date("Y-m-d H:i:s");

                                    $userID = $_SESSION['user_id'];

                                    $dbcon = new DBConnector();
                                    $con = $dbcon->getConnection();

                                    try {
                                        $query = "SELECT id,duty_type,duty_cause,start,end,location.district,location.city FROM duty, location WHERE empID = ? AND start <= ? AND end >= ? AND location.location_id = duty.location_id";
                                        $pstmt = $con->prepare($query);
                                        $pstmt->bindValue(1, $userID);
                                        $pstmt->bindValue(2, $currentDate);
                                        $pstmt->bindValue(3, $currentDate);
                                        $pstmt->execute();

                                        if ($pstmt->rowCount() > 0) {
                                            while ($row = $pstmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<tr>';
                                                echo '<td data-title="Duty Type">' . $row["duty_type"] . '</td>';
                                                echo '<td data-title="Duty Cause">' . $row["duty_cause"] . '</td>';
                                                echo '<td data-title="Start Time">' . $row["start"] . '</td>';
                                                echo '<td data-title="End Time">' . $row["end"] . '</td>';
                                                echo '<td data-title="Location">' . $row['district'] . "," . $row['city'] . '</td>';
                                                echo '<td data-title="Action">';
                                                echo '<form action="" method="POST">';
                                                echo '<input type="hidden" name="duty_id" value="' . $row["id"] . '">';
                                                echo '<button type="submit" name="accept" class="btn custom-btn">Accept</button>';
                                                echo '<button type="submit" name="reject" class="btn custom-btn ml-2">Reject</button>';
                                                echo '</form>';
                                                echo '</td>';
                                                echo '<td data-title="Feedback">';
                                                echo '<form action="" method="POST" class="d-flex" >';
                                                echo '<input type="hidden" name="duty_id" value="' . $row["id"] . '">';
                                                echo '<textarea name="feedback" id="exampleFormControlTextarea1" rows="3"></textarea>';
                                                echo '<button type="submit" name="submit_feedback" class="btn custom-btn-submit ml-1 mt-2">Submit</button>';
                                                echo '</form>';
                                                echo '</td>';
                                                echo '<tr>';
                                            }
                                        } else {
                                            echo '<td colspan="7">No duty information available</td>';
                                        }
                                    } catch (PDOException $ex) {
                                        die("Error in executing duty select query" . $ex->getMessage());
                                    }

                                    ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-12">
                    <h4 style="color:#101D6B" class="h5">Duty History:
                    </h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="table-responsive" id="avalability-table">
                        <table class="table mt-">
                            <thead class="thead-edit">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Duty ID</th>
                                    <th scope="col">Duty Type</th>
                                    <th scope="col">Duty Cause</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Duty Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <?php

                                    $dbcon = new DBConnector();
                                    $con = $dbcon->getConnection();

                                    $employee_id = $_SESSION['user_id'];

                                    try {
                                        $hquery = "SELECT
                                        d.id,d.duty_type,d.duty_cause,d.start,d.end,l.district,l.city,dc.status FROM duty d
                                    LEFT JOIN location l ON l.location_id = d.location_id LEFT JOIN duty_feedback dc ON dc.duty_id = d.id WHERE d.empID = ?
                                    ORDER BY d.start DESC;";
                                        $hpstmt = $con->prepare($hquery);
                                        $hpstmt->bindValue(1, $employee_id);
                                        $hpstmt->execute();

                                        if ($hpstmt->rowCount() > 0) {
                                            $count = 1;
                                            while ($employee_row = $hpstmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<tr>';
                                                echo '<th scope="row">' . $count . '</th>';
                                                echo '<td data-title="Duty ID">' . $employee_row["id"] . '</td>';
                                                echo '<td data-title="Duty Type">' . $employee_row["duty_type"] . '</td>';
                                                echo '<td data-title="Duty Cause">';
                                                if ($employee_row["duty_cause"] !== null) {
                                                    echo $employee_row["duty_cause"];
                                                } else {
                                                    echo 'No specific cause provided';
                                                }
                                                echo '</td>';
                                                echo '<td data-title="Start Time">' . $employee_row["start"] . '</td>';
                                                echo '<td data-title="End Time">' . $employee_row["end"] . '</td>';
                                                echo '<td data-title="Location">';
                                                if ($employee_row['district'] !== null && $employee_row['city'] !== null) {
                                                    echo $employee_row['district'] . "," . $employee_row['city'];
                                                } else {
                                                    echo 'No location';
                                                }
                                                echo '</td>';
                                                echo '<td data-title="Duty Status">';
                                                $status = $employee_row["status"];
                                                if ($status == '1') {
                                                    echo "Accepted";
                                                } elseif ($status == '0') {
                                                    echo "Rejected";
                                                }
                                                echo '</td>';
                                                echo '<tr>';
                                                $count++;
                                            }
                                        } else {
                                            echo '<td colspan="8">No duty information available</td>';
                                        }
                                    } catch (PDOException $ex) {
                                        die("Error in executing duty select query" . $ex->getMessage());
                                    }

                                    ?>

                            </tbody>
                        </table>
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

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>

</html>