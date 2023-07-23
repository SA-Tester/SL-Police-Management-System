<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Emergency Duties</title>
    <link rel="icon" type="image/png" href="../assets/logo.png">
</head>
<body>
    <!------------------navbar---------------------------->
    <?php
        include 'navbar.php';
        renderNavBar();
    ?>
    <!---------------------------------------------------->
    <div class="containter-lg mt-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="h3 mb-4 ml-5 mt-5">Assign an Emergency Duty</h3>
                <form method="POST" action="" id="emergency-duty-form">     
                    <table class="w-100 ml-5">
                        <thead></thead>
                        <tbody>
                            <tr>
                                <td class="w-25">
                                    <label for="emp_id">Employee ID</label>
                                </td>
                                <td>
                                    <input type="text" name="emp_id" id="emp_id" placeholder="Enter Employee ID" class="mb-4 w-75">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="duty_type">Duty Cause</label>
                                </td>
                                <td>
                                    <select id="duty_type" name="duty_type" class="mb-4 w-75">
                                        <option value="Crime">Crime</option>
                                        <option value="accident">Road Accident</option>
                                        <option value="robbery">Robbery</option>
                                        <option value="drugs_explosives">Drugs/ Explosives Raid</option>
                                        <option value="119">119 Request</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="district">District</label>
                                </td>
                                <td>
                                    <select name="district" id="district" class="mb-4 w-75">
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
                                    <select name="city" id="city" class="mb-4 w-75"><!-- AUTO FILLED WHEN A DISTRICT IS SELECTED --></select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="lat">Scence Latitude </label>
                                </td>
                                <td>
                                    <!--FILL ON SELECET OF OPTION-->
                                    <input type="text" name="lat" id="lat" class="mb-4 w-75" disabled/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="lon">Scence Longitude </label>
                                </td>
                                <td>
                                    <!--FILL ON SELECT OF OPTION-->
                                    <input type="text" name="lon" id="lon" class="mb-4 w-75" disabled/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="assign" value="Assign" class="btn-danger mb-4 w-75 ml-3"/>
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