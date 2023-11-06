<?php
session_start();

require "./classes/class-db-connector.php";
use classes\DBConnector;

if(isset($_SESSION["user_id"], $_SESSION["role"], $_SESSION["username"]) && $_SESSION["role"] == "admin"){
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Emergency Duties</title>
    <link rel="icon" type="image/png" href="../assets/logo.png" />
</head>
<body>
    <!------------------navbar---------------------------->
    <?php
        include 'navbar.php';
        renderNavBar();
    ?>
    <!---------------------------------------------------->

    <div class="container-md w-100 mt-5">
        <div class="row">
            <div class="col">
                <?php
                    if(isset($_GET["status"])){
                        if($_GET["status"] == "0"){
                            ?>
                            <div class="alert alert-success w-100 mt-5" role="alert">
                                Record inserted succesfully!
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="alert alert-info w-75 mt-3" role="alert">
                                    <?php
                                        $empID = $_GET["emp"];
                                        try{
                                            $query = "SELECT first_name, last_name, tel_no FROM employee WHERE empID=?";
                                            $pstmt = $con->prepare($query);
                                            $pstmt->bindValue(1, $empID);
                                            $pstmt->execute();
                                            $row = $pstmt->fetch(PDO::FETCH_NUM);
                                            ?>
                                            <p class="text-center font-weight-bold">Inform Employee</p>
                                            <p class="text-center font-weight-bold">Name: <?php echo $row[0]. " " . $row[1]?></p> 
                                            <p class="text-center font-weight-bold">Contact: <?php echo $row[2] ?></p>
                                            <?php
                                        }catch(PDOException $e){
                                            echo $e->getMessage();
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        elseif ($_GET["status"] == "1"){
                            ?>
                            <div class="alert alert-danger w-100 mt-5" role="alert">
                                Record insertion failed!
                            </div>
                            <?php
                        }
                        elseif ($_GET["status"] == "2"){
                            ?>
                            <div class="alert alert-danger w-100 mt-5" role="alert">
                                No entries can be empty! Please fill ou all the fields.
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="containter-lg mt-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="h3 mb-4 ml-5 mt-5">Assign an Emergency Duty</h3>
                <form method="POST" action="process-emergency-duties.php" id="emergency-duty-form" onsubmit="return confirm('Are you sure you want to proceed ?')">     
                    <table class="w-100 ml-5">
                        <thead></thead>
                        <tbody>
                            <tr>
                                <td class="w-25">
                                    <label for="emp_id">Employee</label>
                                </td>
                                <td>
                                    <select id="emp_id" name="emp_id" class="mb-4 w-75 form-control">
                                        <?php
                                            try{
                                                $query = "SELECT empID, first_name, last_name FROM employee WHERE retired_status=?";
                                                $pstmt = $con->prepare($query);
                                                $pstmt->bindValue(1, "0");
                                                $pstmt->execute();
                                                $rows = $pstmt->fetchAll(PDO::FETCH_ASSOC);

                                                foreach($rows as $row){
                                                    ?>
                                                    <option value="<?php echo $row["empID"]; ?>"><?php echo $row["first_name"]. " ". $row["last_name"]; ?></option>
                                                    <?php
                                                }
                                            }catch(PDOException $e){
                                                echo $e->getMessage();
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="duty_cause">Duty Cause</label>
                                </td>
                                <td>
                                    <select id="duty_cause" name="duty_cause" class="mb-4 w-75 form-control">
                                        <option value="Crime">Crime</option>
                                        <option value="Accident">Road Accident</option>
                                        <option value="Robbery">Robbery</option>
                                        <option value="Drugs/ Explosives">Drugs/ Explosives Raid</option>
                                        <option value="119">119 Request</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="start">Start Time</label>
                                </td>
                                <td>
                                    <input type="datetime-local" id="start" name="start" class="mb-4 w-75 form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="end">End Time</label>
                                </td>
                                <td>
                                    <input type="datetime-local" id="end" name="end" class="mb-4 w-75 form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="district">District</label>
                                </td>
                                <td>
                                    <select name="district" id="district" class="mb-4 w-75 form-control">
                                        <option value="">--None--</option>

                                        <option value="colombo">Colombo</option>
                                        <option value="gampaha">Gampaha</option>
                                        <option value="kalutara">Kalutara</option>

                                        <option value="kegalle">Kegalle</option>
                                        <option value="ratnapura">Ratnapura</option>

                                        <option value="galle">Galle</option>
                                        <option value="hambantota">Hambantota</option>
                                        <option value="matara">Matara</option>

                                        <option value="kandy">Kandy</option>
                                        <option value="matale">Matale</option>
                                        <option value="nuwara-eliya">Nuwara Eliya</option>

                                        <option value="kurunegala">Kurunegala</option>
                                        <option value="puttalam">Puttalam</option>

                                        <option value="aunuradhapura">Anuradhapura</option>
                                        <option value="polonnaruwa">Polonnaruwa</option>

                                        <option value="trincomalee">Trincomalee</option>
                                        <option value="batticaloa">Batticaloa</option>
                                        <option value="ampara">Ampara</option>

                                        <option value="jaffna">Jaffna</option>
                                        <option value="mannar">Mannar</option>
                                        <option value="killinochchi">Killinochchi</option>
                                        <option value="mullaitivu">Mullaitivu</option>
                                        <option value="vavuniya">Vavuniya</option>

                                        <option value="badulla">Badulla</option>
                                        <option value="monaragala">Monaragala</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="city">City</label>
                                </td>
                                <td>
                                    <select name="city" id="city" class="mb-4 w-75 form-control"><!-- AUTO FILLED WHEN A DISTRICT IS SELECTED --></select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="lat">Scence Latitude </label>
                                </td>
                                <td>
                                    <input type="text" name="lat" id="lat" class="mb-4 w-75 form-control" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="lon">Scence Longitude </label>
                                </td>
                                <td>
                                    <input type="text" name="lon" id="lon" class="mb-4 w-75 form-control" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="assign" value="Assign" class="btn btn-danger mb-4 w-75 ml-3"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>

            <div class="col-md d-flex justify-content-center bg-dark mr-3">
                <canvas id="worldwindCanvas" width="1200" height="1080">
                    Your browser does not support HTML5 Canvas
                </canvas>
            </div>
        </div>
    </div>

    <script src="../js/fill-city.js" type="module"></script>

    <script src="https://files.worldwind.arc.nasa.gov/artifactory/web/0.9.0/worldwind.min.js" type="text/javascript"></script>
    <script src="../js/location.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>    
</body>
</html>
<?php
}
else{
    header("Location: loginForm.php");
}
?>