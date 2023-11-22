<?php
require_once "./classes/class-db-connector.php";
use classes\DBConnector;

require_once 'fetch-people-data.php';


$dbcon = new DbConnector();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nic = ($_POST['nic']);
    $comp_id = ($_POST['comp_id']);
    $name = ($_POST['name']);
    $nextCourtDate = ($_POST['next_court_date']);

    try {
        $conn = $dbcon->getConnection();
        $query1 = "SELECT next_court_date FROM court_order WHERE complaint_id=? AND nic=?";
        $pstmt1 = $conn->prepare($query1);
        $pstmt1->bindValue(1, $comp_id);
        $pstmt1->bindValue(2, $nic);
        $pstmt1->execute();

        if($pstmt1->rowCount() > 0){
            // The case is being already discussed in the court. Should update the next date.
            $previous = $pstmt1->fetch(PDO::FETCH_ASSOC);
            $prev_court_date = $previous["next_court_date"];

            $query2 = "UPDATE court_order SET previous_court_date=? WHERE nic=? AND complaint_id=?";
            $pstmt2 = $conn->prepare($query2);
            //$pstmt2->bindValue(1, strval($nextCourtDate));
            $pstmt2->bindValue(1, strval($prev_court_date));
            $pstmt2->bindValue(2, $nic);
            $pstmt2->bindValue(3, $comp_id);
            $pstmt2->execute();

            $query4 = "UPDATE court_order SET next_court_date=? WHERE nic=? AND complaint_id=?";
            $pstmt4 = $conn->prepare($query4);
            $pstmt4->bindValue(1, strval($nextCourtDate));
            $pstmt4->bindValue(2, $nic);
            $pstmt4->bindValue(3, $comp_id);
            $pstmt4->execute();

            if ($pstmt2->rowCount() > 0 && $pstmt4->rowCount() > 0) {
                header("Location: view-people.php");
                exit;
            } else {
                // If user didn't do any changes but clicked the update button.
                header("Location: view-people.php");
                exit;
            }
        }
        else{
            // New Court order. Should Insert the data.
            $query3= "INSERT INTO court_order (complaint_id, nic, next_court_date) VALUES(?, ?, ?)";
            $pstmt3 = $conn->prepare($query3);
            $pstmt3->bindValue(1, $comp_id);
            $pstmt3->bindValue(2, $nic);
            $pstmt3->bindValue(3, $nextCourtDate);

            $pstmt3->execute();
            if ($pstmt3->rowCount() > 0) {
                header("Location: view-people.php");
                exit;
            } else {
                // If user didn't do any changes but clicked the update button.
                header("Location: view-people.php");
                exit;
            }
        }

    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
} else {
    $nic = ($_GET["nic"]);
    $comp_id = ($_GET['comp_id']);

    try {
        $conn = $dbcon->getConnection();
        $query = "SELECT * FROM people WHERE `people`.`nic` = ?";
        $pstmt = $conn->prepare($query);
        $pstmt->bindValue(1, $nic);
        $pstmt->execute();
        $rs = $pstmt->fetch(PDO::FETCH_OBJ);
        
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Next Court Date</title>
        <link rel="icon" type="image/png" href="../assets/logo.png" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/new-employee.css">
    </head>

    <body>
        <div class="container py-md-5">
            <div class="card shadow mb-3">
                <div class="card-header py-3 text-center">
                    <p style="color: darkblue;" class="m-0 fw-bold ">Update next court Date</p>
                </div>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <input type="hidden" name="comp_id" value="<?php echo $comp_id ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label"><strong>NIC</strong></label>
                                    <input class="form-control" type="text" id="nic" name="nic" value="<?php echo $rs->nic; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Name</strong></label>
                                    <input class="form-control" type="text" id="name" name="name" value="<?php echo $rs->name; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Next Court Date</strong></label>
                                    <input class="form-control" type="date" id="next_court_date" name="next_court_date" value="<?php echo $rs->next_court_date; ?>">
                                </div>
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
    </body>

    </html>
<?php } ?>
