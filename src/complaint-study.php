<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">

    <title>Complaint Study</title>
    <link rel="icon" type="image/png" href="../assets/logo.png">

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

    <div class="container-lg" style="height: 10pt;"></div>
    <div class="container-lg mt-5">
        <div class="row d-flex justify-content-center mt-5">
            <label for="caseID" class="mr-3 mt-5">Enter Case ID: </label>
            <input type="text" id="caseID" name="caseID" class="w-50 mt-5" placeholder="Enter Case ID"/>
            <button class="mt-5"><i class="fas fa-search"></i></button>
        </div>

        <div class="row mt-5">
            <div class="col-md">
                <div class="text-center d-flex align-content-middle w-100 h-100" style="background-color: darkblue; color: #fff">
                    <p class="w-100 p-3">Road Rule Violations</p>
                    <button class="btn-success w-50 h-100" onclick="showHide()">Manage Road Rule Violations</button>
                </div>
            </div>
        </div>

        <!----------------------------------------------- Modal 1: Road Rule Violations -------------------------------------------------------------------------------------->
        <div class="row-mt-5">
            <div class="roadRules mt-5" style="display: none;">
                <div class="head">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Road Rule Violations</h5>
                </div>
                <div class="body">
                    <form method="POST" action="roadRules.php">
                        <label for="compID">Complaint ID</label>
                        <input type="text" id="compID" name="compID" disabled>

                        <table class="table">
                            <thead>
                                <th>NIC</th>
                                <th>Vehicle Number</th>
                                <th>Temp License (Start)</th>
                                <th>Temp License (End)</th>
                                <th>Fine Amount</th>
                                <th>Fine Status</th>
                                <th>License Issed Status</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" id="nic" name="nic" disabled/></td>
                                    <td><input type="text" id="vehicle_number" name="vehicle_number" disabled/></td>
                                    <td><input type="date" id="temp_start" name="temp_start" disabled/></td>
                                    <td><input type="date" id="temp_end" name="temp_end" disabled/></td>
                                    <td><input type="text" id="fine_amount" name="fine_amount" disabled/></td>
                                    <td>
                                        <select id="fine_status">
                                            <option value="1">Paid</option>
                                            <option value="2">Unpaid</option>
                                        </select>
                                    </td>
                                    <td><input type="checkbox" id="license_issue_status" name="license_issue_status"/></td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <input type="submit" name="road_rules" value="Update" class="btn-success"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->

        <div class="row mt-5">
            <div class="col-md">
                <div class="text-center d-flex align-content-middle w-100 h-100" style="background-color: darkblue; color: #fff">
                    <p class="w-100 p-3">Eye Witness Count: #NUMBER</p>
                    <button class="btn-success w-50 h-100" data-toggle="modal" data-target="#eyeWitnessModal">Manage Eye Witnesses</button>
                </div>
            </div>
            <div class="col-md">
                <div class="text-center d-flex align-content-middle w-100 h-100" style="background-color: darkblue; color: #fff">
                    <p class="w-100 p-3">Finger Print Data: #NUMBER</p>
                    <button class="btn-success w-50 h-100" data-toggle="modal" data-target="#fingerprintsModal">Manage Fingerprints</button>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="../uploads/case-imagery/1-3.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>CASE ID</h3>
                            <p>Image 1</p>
                          </div>
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="../uploads/case-imagery/1-1.jpg" alt="Second slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>CASE ID</h3>
                            <p>Image 2</p>
                          </div>
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="../uploads/case-imagery/1-2.jpg" alt="Third slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Case ID</h3>
                            <p>Image 3</p>
                          </div>
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-5 text-center mb-5">
            <div class="col-md">
                <button class="btn-primary w-50 h-100" data-toggle="modal" data-target="#photoModal">Manage Photos</button>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md">
                <div class="text-center d-flex align-content-middle w-100 h-100" style="background-color: darkblue; color: #fff">
                    <p class="w-100 p-3">Court Medical Reports: #NUMBER</p>
                    <button class="btn-success w-50 h-100" data-toggle="modal" data-target="#mediacalReportsModal">Show Court Medical Reports</button>
                </div>
            </div>
            <div class="col-md">
                <div class="text-center d-flex align-content-middle w-100 h-100" style="background-color: darkblue; color: #fff">
                    <p class="w-100 p-3">Accident Charts: #NUMBER</p>
                    <button class="btn-success w-50 h-100" data-toggle="modal" data-target="#accidentChartModal">Show Accident Charts</button>
                </div>
            </div>
        </div>
  
        <!------------------------------------------------ Modal 2: Eye Witnesses -------------------------------------------------------------------------------------------->
        <div class="modal fade bd-example-modal-lg" id="eyeWitnessModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Eye Witnesses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="updateEyeWitness.php">
                        <label for="compID">Complaint ID</label>
                        <input type="text" id="compID" name="compID" disabled>

                        <table class="table">
                            <thead>
                                <th>NIC</th>
                                <th>Description</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" id="nic" name="nic"/></td>
                                    <td>
                                        <textarea id="desc" name="desc" rows="5" cols="30"></textarea>
                                    </td>
                                    <td>
                                        <button class="btn-primary">Update</button>
                                    </td>
                                    <td>
                                        <button class="btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>

                    <form method="POST" action="newEyeWitness.php">
                        <table class="table">
                            <thead>
                                <th>NIC</th>
                                <th>Description</th>
                                <th>Add New</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" id="nic" name="nic"/></td>
                                    <td>
                                        <textarea id="desc" name="desc" rows="5" cols="30"></textarea>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn-success" id="addNew" data-toggle="modal">Add New</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
 
        <!------------------------------------------------------- START OF FINGERPRINTS ------------------------------------------------------------------------------------->
        <div class="modal fade bd-example-modal-lg" id="fingerprintsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Fingerprints</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="updateFingerprints.php">
                            <label for="compID">Complaint ID</label>
                            <input type="text" id="compID" name="compID" disabled>

                            <table class="table">
                                <thead>
                                    <th>NIC</th>
                                    <th>Fingerprint</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>198056723034</td>
                                        <td>
                                            <img src="" alt="Fingerprint 1">
                                        </td>
                                        <td>
                                            <button class="btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <form method="POST" action="addFingerPrints.php">
                            <table class="table">
                                <thead>
                                    <th>NIC</th>
                                    <th>Fingerprint</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label for="nic">Enter NIC </label>
                                        </td>
                                        <td>
                                            <input type="text" id="nic" placeholder="Enter NIC">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="fingerprint">Fingerprint File</label>
                                        </td>
                                        <td>
                                            <input type="file" id="fingerprint" type="image/png" enctype="multipart/form-data">
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td colspan="3">
                                            <button class="btn-success" data-toggle="modal">Add New</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!------------------------------------------------------- START OF MEDICAL RECORDS ---------------------------------------------------------------------------------->
        <div class="modal fade" id="mediacalReportsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Court Medical Reports</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="updateMedicalReports.php">
                            <label for="compID">Complaint ID</label>
                            <input type="text" id="compID" name="compID" disabled>

                            <table class="table">
                                <thead>
                                    <th>Court Medical Reports</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="1.pdf" alt="Court Medical Report 1">1.pdf</a></td>
                                        <td><button class="btn-danger">Delete</button></td>
                                    </tr>
                                    <tr>
                                        <td><a href="2.pdf" alt="Court Medical Report 2">2.pdf</a></td>
                                        <td><button class="btn-danger">Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <form method="POST" action="addMedicalReport.php">
                            <table class="table">
                                <thead>
                                    <th>Court Medical Reports</th>
                                    <th>Add New</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Medical Record<input type="file" enctype="multipart/form-data">
                                        </td>
                                        <td>
                                            <button class="btn-success" data-toggle="modal">Add New</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!------------------------------------------------------- START OF ACCIDENT CHARTS ----------------------------------------------------------------------------------->
        <div class="modal fade" id="accidentChartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Accident Charts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="updateAccidentCharts.php">
                            <label for="compID">Complaint ID</label>
                            <input type="text" id="compID" name="compID" disabled>

                            <table class="table">
                                <thead>
                                    <th>Accident Chart</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="" alt="Accident 1">
                                        </td>
                                        <td><button class="btn-danger">Delete</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="" alt="Accident 2">
                                        </td>
                                        <td><button class="btn-danger">Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <form method="POST" action="newAccidentChart.php">
                            <table class="table">
                                <thead>
                                    <th>Accident Chart</th>
                                    <th>New</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Accident Chart <input type="file" enctype="multipart/form-data">
                                        </td>
                                        <td>
                                            <button class="btn-success" data-toggle="modal">Add New</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!------------------------------------------------------------- START OF PHOTOS ------------------------------------------------------------------------------------->
        <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Photos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <label for="compID">Complaint ID</label>
                            <input type="text" id="compID" name="compID" disabled>

                            <table class="table">
                                <thead>
                                    <th>Photo</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="" alt="Accident 1">
                                        </td>
                                        <td><button class="btn-danger">Delete</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="" alt="Accident 2">
                                        </td>
                                        <td><button class="btn-danger">Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table>
                                <thead>
                                    <th>Photo</th>
                                    <th>Add New</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            New Photo <input type="file" enctype="multipart/form-data">
                                        </td>
                                        <td>
                                            <button class="btn-success" data-toggle="modal">Add New</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------------------------------------------------ END OF PHOTOS  ---------------------------------------------------------------------------->

    </div>

    <script>
        function showHide(){
            let roadRulesDiv = document.querySelector(".roadRules");
            if(roadRulesDiv.style.display == "none"){
                roadRulesDiv.style.display = "block";
            }
            else{
                roadRulesDiv.style.display = "none";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>