<?php
session_start();

require './classes/class-db-connector.php';
require './pdf-library/TCPDF-main/tcpdf.php';

use classes\DBConnector;

$message = null;
$duty = null;
date_default_timezone_set('Asia/Colombo');
$currentDate = date("Y-m-d");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (isset($_POST["empID"])) {
        $empID = $_POST["empID"];

        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();

        try {
            $query = "SELECT first_name,last_name,nic,rank,tel_no FROM employee WHERE empID=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $empID);
            $pstmt->execute();
            $result = $pstmt->fetch(PDO::FETCH_OBJ);

            if (!empty($result)) {
                $empName = $result->first_name . ' ' . $result->last_name;
                $empNIC = $result->nic;
                $empRank = $result->rank;
                $empTel = $result->tel_no;

                try {
                    $cquery = "SELECT complaint_id FROM complaint WHERE empID=?";
                    $cpstmt = $con->prepare($cquery);
                    $cpstmt->bindValue(1, $empID);
                    $cpstmt->execute();
                    $rs = $cpstmt->fetchAll(PDO::FETCH_OBJ);

                    $count = 0;
                    foreach ($rs as $row) {
                        $count = $count + 1;
                    }
                } catch (PDOException $ex) {
                    die("Error in executing complaint select query" . $ex->getMessage());
                }

                try {
                    $leaveQuery = "SELECT leaveID FROM leaves WHERE empID = ? AND leave_start <= ? AND leave_end >= ?";
                    $lpstmt = $con->prepare($leaveQuery);
                    $lpstmt->bindValue(1, $empID);
                    $lpstmt->bindValue(2, $currentDate);
                    $lpstmt->bindValue(3, $currentDate);
                    $lpstmt->execute();

                    if ($lpstmt->rowCount() > 0) {
                        $duty = "On leave";
                    } else {
                        try {
                            $dutyQuery = "SELECT duty_type FROM duty WHERE empID = ? AND start <= ? AND end >= ?";
                            $dpstmt = $con->prepare($dutyQuery);
                            $dpstmt->bindValue(1, $empID);
                            $dpstmt->bindValue(2, $currentDate);
                            $dpstmt->bindValue(3, $currentDate);
                            $dpstmt->execute();

                            if ($dpstmt->rowCount() > 0) {
                                $dutyResult = $dpstmt->fetch(PDO::FETCH_OBJ);
                                $duty = $dutyResult->duty_type;
                            } else {
                                $duty = "No Duty Assigned";
                            }
                        } catch (PDOException $ex) {
                            die("Error in executing complaint select query" . $ex->getMessage());
                        }
                    }
                } catch (PDOException $ex) {
                    die("Error in executing complaint select query" . $ex->getMessage());
                }

                $pdf = new TCPDF();
                $pdf->SetPrintHeader(false);
                $pdf->SetPrintFooter(false);
                $pdf->AddPage('A4');

                $pdf->SetLineWidth(0.3);
                $pdf->Rect(5, 5, 200, 287);

                $pdf->SetFont('helvetica', 'B', 18);
                $pdf->Cell(0, 10, 'Sri Lanka Police', 0, 1, 'C');
                $pdf->SetFont('helvetica', '', 14);
                $pdf->Cell(0, 10, 'Employee Report', 0, 1, 'C');
                $pdf->SetFont('helvetica', '', 12);
                $pdf->Cell(0, 10, $currentDate, 0, 6, 'C');

                $pdf->SetFont('helvetica', '', 12);

                $pdf->Cell(0, 10, 'Employee ID: ' . $empID, 0, 1);
                $pdf->Cell(0, 10, 'Name: ' . $empName, 0, 1);
                $pdf->Cell(0, 10, 'NIC Number: ' . $empNIC, 0, 1);
                $pdf->Cell(0, 10, 'Rank: ' . $empRank, 0, 1);
                $pdf->Cell(0, 10, 'Telephone Number: ' . $empTel, 0, 1);
                $pdf->Cell(0, 10, 'Number of cases assigned: ' . $count, 0, 1);
                $pdf->Cell(0, 10, 'Duty: ' . $duty, 0, 1);

                $pdf->Output('employee_report.pdf', 'D');
            } else {
                $message = "<h6 class='text-danger'>Please enter a correct Employee ID.</h6>";
            }
        } catch (PDOException $ex) {
            die("Error executing employee select query " . $ex->getMessage());
        }
    } else {
        $message = "<h6 class='text-danger'>Required value is not submitted.</h6>";
    }
}
if(isset($_SESSION['user_id'])){
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Employee Report</title>



    <style>
        .form-container {
            height: 550px;
            background-color: #101D6B;
            margin: 0 auto;
            padding: 20px;
        }

        .form-container form {
            width: 40%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin: 0 auto;
            margin-top: 150px;
            margin-bottom: 40px;
        }

        .btn-primary {
            width: 100%;
            border: none;
            border-radius: 50px;
            background: #101D6B;
            margin-bottom: 20px;
        }

        .btn-primary:hover {
            color: #101D6B;
            background: white;
            border: 1px solid #101D6B;
        }

        h4{
            font-size: 1.5rem !important;
            font-weight: 700;
        }
    </style>



</head>

<body>
    <!------------------navbar---------------------------->
    <?php
    include 'navbar.php';
    renderNavBar();
    ?>
    <!---------------------------------------------------->

    <div class="container-fluid form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h4 class="text-center">Generate Employee Report</h4>

            <?= $message ?>
            <div class="form-group mb-3 mt-5">
                <label for="empID">Select Employee ID</label>
                <select class="form-control" id="empID" name="empID">
                    <option value=''>Select an employee ID</option>
                    <?php
                    $dbcon = new DBConnector();
                    $con = $dbcon->getConnection();
                    $equery = "SELECT empID FROM employee";
                    $epstmt = $con->prepare($equery);
                    $epstmt->execute();
                    $ids = $epstmt->fetchAll(PDO::FETCH_OBJ);

                    foreach ($ids as $row) {
                        echo '<option value="' . $row->empID . '">' . $row->empID . '</option>';
                    }

                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Download Report</button>
        </form>
    </div>


    <!--------------------footer------------->
    <footer class="py-5" style="background-color: #101D6B;">
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
<?php
}
else{
    header("Location: loginForm.php");
}
?>