<?php
session_start();

require_once "./classes/class-db-connector.php";
use classes\DBConnector;

if(isset($_SESSION["user_id"], $_SESSION["role"], $_SESSION["username"])){
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Record Complaints</title>
    <link rel="icon" type="image/png" href="../assets/logo.png">

    <style>
        .traffic{
            display: none;
        }

        #comp-table tr:hover {
            background-color: rgb(0,0,255,0.2);
        }
    </style>
</head>

<body onload="fillTable('id')">
     <!------------------navbar---------------------------->
     <?php
        include 'navbar.php';
        renderNavBar();
    ?>
    <!---------------------------------------------------->

    <!-- SUCCESS/FAIL MESSAGE UPON DB INTERACTIONS -->
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
                            <div class="alert alert-success w-100 mt-5" role="alert">
                                Records updated succesfully!
                            </div>
                            <?php
                        }
                        elseif ($_GET["status"] == "3"){
                            ?>
                            <div class="alert alert-danger w-100 mt-5" role="alert">
                                Records update failed!
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="containter-md"><!--d-flex justify-content-center ml-4 mr-4 mt-3-->
        <div class="row">
            <div class="col-md ml-3 mr-3">
                <h3 class="h3 mt-5 mb-4 ml-5">New Complaint</h3>
                <form method="POST" action="process-complaints.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed ?')">
                    <div class="row">
                        <div class="col-sm">
                            <label for="date">Date</label>
                        </div>
                        <div class="col-sm">
                            <input type="date" id="date" name="date" class="mb-4 w-100 form-control" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="category" class="mr-4">Complaint Category</label>
                        </div>
                        <div class="col-sm">
                            <select id="category" name="category" class="mb-4 w-100 form-control">
                                <option value="1">Abuse of Women or Children</option>
                                <option value="2">Appreciation</option>
                                <option value="3">Archeological Issue</option>
                                <option value="4">Assault</option>
                                <option value="5">Bribery and Corruption</option>
                                <option value="6">Complaint against Police</option>
                                <option value="7">Criminal Offence</option>
                                <option value="8">Cybercrime</option>
                                <option value="9">Demonstration / Protest / Strike</option>
                                <option value="10">Environmental Issue</option>
                                <option value="11">Exchange Fault</option>
                                <option value="12">Foreign Employment Issue</option>
                                <option value="13">Frauds / Cheating</option>
                                <option value="14">House Breaking</option>
                                <option value="15">Illegal Mining</option>
                                <option value="16">Industrial / Labour Dispute</option>
                                <option value="17">Information</option>
                                <option value="18">Intellectual Property Dispute</option>
                                <option value="19">Miscellaneous</option>
                                <option value="20">Mischief / Sabotage</option>
                                <option value="21">Murder</option>
                                <option value="22">Narcotics / Dangerous Drugs </option>
                                <option value="23">National Security</option>
                                <option value="24">Natural Disaster</option>
                                <option value="25">Offence / Act against Public Health</option>
                                <option value="26">Offence against Public Property</option>
                                <option value="27">Organized Crime</option>
                                <option value="28">Personal Complaint</option>
                                <option value="29">Police Clearance</option>
                                <option value="30">Property Disputes</option>
                                <option value="31">Robbery</option>
                                <option value="32">Sexual Offences</option>
                                <option value="33">Suggestion</option>
                                <option value="34">Terrorism Related</option>
                                <option value="35">Theft</option>
                                <option value="36">Threat &amp; Intimidation</option>
                                <option value="37">Tourist Harassment</option>
                                <option value="38">Traffic &amp; Road Safety</option>
                                <option value="39">Treasure Hunting</option>
                                <option value="40">Vice Related</option>
                                <option value="41">Violation of Immigration Laws</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="title">Complaint Title</label>
                        </div>
                        <div class="col-sm">
                            <input type="text" id="title" name="title" class="mb-4 w-100 form-control" placeholder="Enter Complaint Title"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="start-recording">Record Complaint</label>
                        </div>
                        <div class="col-sm">
                            <button name="start-recording" id="start-recording" class="btn-danger mb-4">Start
                                Recording</button>
                            <button name="stop-recording" id="stop-recording" class="btn-dark mb-4">Stop
                                Recording</button>
                            <p id="isRecording">Click start to button to record</p>
                            <audio src="" name="recording" id="audioElement" class="mb-4" controls></audio>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="comp_desc">Complaint In Text</label>
                        </div>
                        <div class="col-sm">
                            <!--button name="start-speech" id="start-speech" class="btn-danger mb-2" disabled>Start</button>
                            <button name="stop-speech" id="stop-speech" class="btn-dark mb-2" disabled>Stop</button-->
                            <textarea id="comp_desc" name="comp_desc" rows="10" cols="40" class="mb-4 form-control" placeholder="Type the complaint in text"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="people_type">Type</label>
                        </div>
                        <div class="col-sm">
                            <select name="people_type" id="people_type" class="mb-4 w-100 form-control">
                                <option value="Plantiff">Plantiff</option>
                                <option value="Suspect">Suspect</option>
                                <option value="Culprit">Culprit</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="people_nic">NIC</label>
                        </div>
                        <div class="col-sm">
                            <input list="people_nics" name="people_nic" id="people_nic" class="mb-4 w-100 form-control" placeholder="Person's NIC" onchange="fillDetails(this.value)" value="">
                            <datalist id="people_nics" name="people_nics" class="mb-4 w-100">     
                                <?php 
                                    try{
                                        $query = "SELECT nic FROM people";
                                        $pstmt = $con->prepare($query);
                                        $pstmt->execute();
                                        $rows = $pstmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach($rows as $row){
                                            ?>
                                            <option value="<?php echo $row["nic"]; ?>"></option>
                                            <?php
                                        }
                                    }catch(PDOException $e){}
                                ?>
                            </datalist>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="people_name">Name</label>
                        </div>
                        <div class="col-sm">
                            <input type="text" id="people_name" name="people_name" class="mb-4 w-100 form-control" placeholder="Person's Name" value=""/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="people_address">Address</label>
                        </div>
                        <div class="col-sm">
                        <input type="text" id="people_address" name="people_address" class="mb-4 w-100 form-control" placeholder="Person's Address" value=""/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="people_contact">Contact</label>
                        </div>
                        <div class="col-sm">
                            <input type="text" id="people_contact" name="people_contact" class="mb-4 w-100 form-control" placeholder="Person's Contact" value=""/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="people_email">Email</label>
                        </div>
                        <div class="col-sm">
                            <input type="email" id="people_email" name="people_email" class="mb-4 w-100 form-control" placeholder="Person's Email" value=""/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="location">Location</label>
                        </div>
                        <div class="col-sm">
                            <input type="hidden" name="selectedCity" id="selectedCity" value=""/>
                            <input type="hidden" name="selectedLat" id="selectedLat" value=""/>
                            <input type="hidden" name="selectedLon" id="selectedLon" value=""/>
                            <select id="city" name="city" class="mb-4 w-100 form-control"></select>       
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="comp_status">Complaint Status</label>
                        </div>
                        <div class="col-sm">
                            <select name="comp_status" id="comp_status" class="mb-4 w-100 form-control">
                                <option value="Ongoing">Ongoing</option>
                                <option value="Resolved">Resolved</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <label for="emp_id">Recorded By</label>
                        </div>
                        <div class="col-sm">
                            <select id="emp_id" name="emp_id" class="mb-4 w-100 form-control">     
                                <?php
                                    $query2 = "SELECT empID FROM employee WHERE retired_status=?";
                                    $pstmt2 = $con->prepare($query2);
                                    $pstmt2->bindValue(1,0);
                                    $pstmt2->execute();
                                    $rows2 = $pstmt2->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($rows2 as $row){
                                        ?>
                                        <option value="<?php echo $row["empID"]; ?>"><?php echo $row["empID"]; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="traffic">
                        <div class="row">
                            <div class="col-sm">
                                <label for="vehicle_number">Vehicle Number</label>
                            </div>
                            <div class="col-sm">
                                <input type="text" id="vehicle_number" name="vehicle_number" class="mb-4 w-100 form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <label for="temp_start" class="mr-4">Temporary License Start Date</label>
                            </div>
                            <div class="col-sm">
                                <input type="date" id="temp_start" name="temp_start" class="mb-4 w-100 form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <label for="temp_end">Temporary License End Date</label>
                            </div>
                            <div class="col-sm">
                                <input type="date" id="temp_end" name="temp_end" class="mb-4 w-100 form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <label for="fine_amount">Fine Amount</label>
                            </div>
                            <div class="col-sm">
                                <input type="text" id="fine_amount" name="fine_amount" class="mb-4 w-100 form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <label for="fine_status">Fine Status</label>
                            </div>
                            <div class="col-sm">
                                <select name="fine_status" id="fine_status" class="mb-4 w-100 form-control">
                                    <option value="0">Unpaid</option>    
                                    <option value="1">Paid</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <label for="license_issued">License Issued</label>
                            </div>
                            <div class="col-sm">
                                <select name="license_issued" id="license_issued" class="mb-4 w-100 form-control">
                                    <option value="0">Not Issued</option>    
                                    <option value="1">Issued</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <input type="submit" name="add" value="Add New" class="btn-primary mb-4 w-25">
                            <input type="submit" name="update" value="Update" class="btn-warning mb-4 w-25">
                            <input type="reset" name="reset" value="Reset" class="btn-dark mb-4 w-25">
                        </div>
                    </div>
                    
                    <!-- SAVE THE SELECTED COMPLAINT ID AND NIC ONCLICK (Included here to be sumbitted when update is clicked) -->
                    <input type="hidden" name="selected_row_id" id="selected_row_id" value=""/>
                    <input type="hidden" name="selected_row_nic" id="selected_row_nic" value=""/>
                    <input type="hidden" name="selected_row_loc_id" id="selected_row_loc_id" value=""/>
                </form>
            </div>

            <div class="col-md ml-3 mr-3 mt-5">
                <h3 class="h3 mb-4">Complaint History</h3>
                <div class="row mb-4">
                    <div class="col-sm">
                        <label for="sort_type" class="mr-3">Sort By</label>
                        <select name="sort_type" id="sort_type" onchange="fillTable(this.value)" selected="id" class="form-control">
                            <option value="id">Complaint ID</option>
                            <option value="type">Complaint Type</option>
                            <option value="date">Date</option>
                            <option value="emp">Employee</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <label for="search" class="mr-3">Search</label>
                        <input type="text" id="search" name="search" placeholder="Enter Text to Search" onchange="fillTable(this.value)" class="form-control">
                    </div>
                </div> 

                <div class="row">
                    <div class="col-sm mr-3 table-responsive">
                        <table class="table table-primary table-striped-columns" id="comp-table">
                            <thead>
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Date</th>
                                    <th>Complaint Category</th>
                                    <th>Name</th>
                                    <th>R.I.C</th>
                                    <th>Status</th>
                                    <th>Recorded By</th>
                                </tr>
                            </thead>
                            <tbody>
                                

                            <!-- FILL TABLE BASED ON SELECTION -->
                            <script>
                                let table = document.getElementById("comp-table");
                                let rows;
                                
                                function fillTable(element){   
                                    rows = table.rows.length;
                                    if(rows > 1){
                                        for(let j=0; j < rows-1; j++){
                                            table.deleteRow(1); //delete the first row 13 times
                                        }
                                    }

                                    var xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function(e){   

                                        if(this.readyState == 4 && this.status == 200){

                                            var obj = JSON.parse(this.responseText);
                                            let tableBody = document.createElement("tbody");
                                            
                                            for(let i=0; i<obj.length; i++){
                                                const row = document.createElement("tr");
                                                row.addEventListener("click", function(e){
                                                    document.getElementById("selected_row_id").value = obj[i][0];
                                                    document.getElementById("selected_row_nic").value = obj[i][3];
                                                    document.getElementById("people_nic").readOnly = true; //to avoid updating the nic
                                                    fillForm();
                                                })

                                                const cell1 = document.createElement("td");
                                                const cell2 = document.createElement("td");
                                                const cell3 = document.createElement("td");
                                                const cell4 = document.createElement("td");
                                                const cell5 = document.createElement("td");
                                                const cell6 = document.createElement("td");
                                                const cell7 = document.createElement("td");

                                                const cell1Text = document.createTextNode(obj[i][0]);
                                                const cell2Text = document.createTextNode(obj[i][1]);
                                                const cell3Text = document.createTextNode(obj[i][2]);
                                                const cell4Text = document.createTextNode(obj[i][4]);
                                                const cell5Text = document.createTextNode(obj[i][5]);
                                                const cell6Text = document.createTextNode(obj[i][6]);
                                                const cell7Text = document.createTextNode(obj[i][7]);

                                                cell1.appendChild(cell1Text);
                                                cell2.appendChild(cell2Text);
                                                cell3.appendChild(cell3Text);
                                                cell4.appendChild(cell4Text);
                                                cell5.appendChild(cell5Text);
                                                cell6.appendChild(cell6Text);
                                                cell7.appendChild(cell7Text);

                                                row.appendChild(cell1);
                                                row.appendChild(cell2);
                                                row.appendChild(cell3);
                                                row.appendChild(cell4);
                                                row.appendChild(cell5);
                                                row.appendChild(cell6);
                                                row.appendChild(cell7);

                                                tableBody.append(row);
                                            }
                                            table.append(tableBody);
                                        }
                                    };
                                    xhr.open("GET", "./scripts/fill-complaint-table.php?element=" + element, true);
                                    xhr.send();                                  
                                }         
                            </script>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--button name="start-speech" id="start-speech" class="btn-danger mb-4">Start Speech</button>
        <button name="stop-speech" id="stop-speech" class="btn-dark mb-4">Stop Speech</button-->
        <!--div class="p-3" style="border: 1px solid #000; height: 300px;">
            <span id="final" class="text-dark"></span>
            <span id="interim" class="text-secondary"></span>
        </div-->
        
    </div>

    <!-- FILL PEOPLE DETAILS BASED ON NIC -->
    <script type="text/javascript">
        function fillDetails(str){
            let name = document.getElementById("people_name");
            let address = document.getElementById("people_address");
            let contact = document.getElementById("people_contact");
            let email = document.getElementById("people_email");

            if(str.length == 0){
                name.value = "";
                address.value = "";
                contact.value - "";
                email.value = "";
            }
            else{
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var obj = JSON.parse(this.responseText);
                        name.value = obj[0];
                        address.value = obj[1];
                        contact.value = obj[2];
                        email.value = obj[3];
                    }
                };
                xmlhttp.open("GET", "./scripts/people-auto-fill.php?nic=" + str, true);
                xmlhttp.send();
            }
        }
    </script>

    <!-- SHOW/ HIDE TRAFFIC COMPLAINTS -->
    <script type="text/javascript">
        let tableID = document.querySelector(".traffic");
        var category = document.getElementById("category");
        
        function showHideTraffic(){
            if(category.value == "38"){
                tableID.style.display = "block";
            }
            else{
                tableID.style.display = "none";
            }
        }

        category.addEventListener("change", function(){
            showHideTraffic();
        });
    </script>

     <!-- FILL CITIES BASED ON DISTRICT -->
    <script type="module">
        import {Badulla} from "../assets/sl-cities/badulla.js";

        city = document.getElementById("city");
        for(let i=0; i<Badulla.length; i++){
            city.options[i+1] = new Option(Badulla[i]["city"], i);
        }
        city.options[0] = new Option("--None--", "");
    </script>
    
    <!-- SAVE SELECTED CITY DATA FOR SERVER SIDE PROCESSING -->
    <script type="module">
        import {Badulla} from "../assets/sl-cities/badulla.js";

        let selectedCity = document.getElementById("selectedCity");
        let lat = document.getElementById("selectedLat");
        let lon = document.getElementById("selectedLon");
        var city = document.getElementById("city");

        city.addEventListener("change", function(){
            selectedCity.value = Badulla[city.value]["city"];
            lat.value = Badulla[city.value]["latitude"];
            lon.value = Badulla[city.value]["longitude"];
        });
    </script>

    <!-- SELECT COMPLAINTS ON CLICK !-->
    <script type="text/javascript">

        function getCityValue(reqCity){
            for(let i=0; i < city.length; i++){
                if(city.options[i].textContent == reqCity){
                    return city.options[i].value;
                }
            }
        }
        function fillForm(){
            let selected_row_id = document.getElementById("selected_row_id").value;
            let selected_row_nic = document.getElementById("selected_row_nic").value;
            let selected_row_loc_id = document.getElementById("selected_row_loc_id");

            let date = document.getElementById("date");
            var category = document.getElementById("category");
            let title = document.getElementById("title");
            let rec = document.getElementById("audioElement");
            let desc = document.getElementById("comp_desc");
            let people_type = document.getElementById("people_type");
            let nic = document.getElementById("people_nic");
            let name = document.getElementById("people_name");
            let address = document.getElementById("people_address");
            let contact = document.getElementById("people_contact");
            let email = document.getElementById("people_email");
            var city = document.getElementById("city");
            let status = document.getElementById("comp_status");
            let emp_id = document.getElementById("emp_id");
            let vehicle_no = document.getElementById("vehicle_number");
            let temp_start = document.getElementById("temp_start");
            let temp_end = document.getElementById("temp_end");
            let fine_amount = document.getElementById("fine_amount");
            let fine_status = document.getElementById("fine_status");
            let license_issued = document.getElementById("license_issued");

            if(selected_row_id.length != 0){
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        var obj = JSON.parse(this.responseText);

                        date.value = obj[0];
                        category.value = obj[1];
                        title.value = obj[2];
                        rec.src = ""
                        if(obj[3] != null) rec.src = obj[3];
                        desc.value = obj[4];
                        people_type.value = obj[5];
                        nic.value = obj[6];
                        name.value = obj[7];
                        address.value = obj[8];
                        contact.value = obj[9];
                        email.value = obj[10];
                        status.value = obj[11];
                        emp_id.value = obj[12];

                        if(getCityValue(obj[13]) >= "0"){
                            city.value = getCityValue(obj[13]);
                            selected_row_loc_id.value = obj[14];
                            vehicle_no.value = obj[15];
                            temp_start.value = obj[16];
                            temp_end.value = obj[17];
                            fine_amount.value = obj[18];
                            fine_status.value = obj[19];
                            license_issued.value = obj[20];   
                        }
                        else{
                            city.value = "";
                            selected_row_loc_id.value = "";
                            vehicle_no.value = obj[13];
                            temp_start.value = obj[14];
                            temp_end.value = obj[15];
                            fine_amount.value = obj[16];
                            fine_status.value = obj[17];
                            license_issued.value = obj[18];
                        }

                        if(obj[1] == "38"){
                            document.querySelector(".traffic").style.display = "block";
                        }
                        else{
                            document.querySelector(".traffic").style.display = "none";
                        }
                    }         
                };
                xhr.open("GET", "./scripts/complaint-on-select.php?comp_id=" + selected_row_id + "&nic=" + selected_row_nic, true);
                xhr.send();
            }
        }
    </script>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- COMPLAINT RECORDER CODE -->
    <script src="../js/complaint-recorder.js"></script>
</body>
</html>
<?php
}
else{
    header("Location: loginForm.php");
}
?>