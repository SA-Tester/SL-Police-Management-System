<?php
require_once("./scripts/fill-complaint-study.php");
?>

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
    <link rel="icon" type="image/png" href="../assets/logo.png" />

    <style>
        .btn {
            background-color: #101D6B;
            color: #fff;
        }

        .btn:hover {
            background-color: #101D6B;
            color: #ffffff;
        }

        .nav-pills a {
            color: #000;
            background-color: #101D6B;
        }

        .nav-pills a:hover {
            color: #ffffff;
            background-color: #808080;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #ffffff;
            background-color: #101D6B;
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

    <div class="container-lg" style="height: 40pt;"></div>

    <div class="containter-md ml-5 mr-5">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <label for="caseID" class="mr-3 mt-5">Enter Case ID: </label>
                <input type="text" id="caseID" name="caseID" class="mt-5 w-50 form-group" placeholder="Enter Case ID" />
                <button class="mt-5 form-group" onclick="fillComplaintData(document.getElementById('caseID').value)"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <div class="alert mt-3 mb-3" role="alert" id="alertMsg" style="display: none;"></div>
        <div class="alert mt-3 mb-3" role="alert" id="recordsMsg" style="display: none;"></div>

        <div class="row mt-4">
            <div class="col-3">
                <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" data-toggle="tab" id="v-pills-link1-tab" data-mdb-toggle="pill" href="#link1" role="tab" aria-controls="v-pills-link1" aria-selected="true">Case Summary</a>
                    <a class="nav-link" data-toggle="tab" id="v-pills-link2-tab" data-mdb-toggle="pill" href="#link2" role="tab" aria-controls="v-pills-link2" aria-selected="false">Manage Associated People</a>
                    <a class="nav-link" data-toggle="tab" id="v-pills-link3-tab" data-mdb-toggle="pill" href="#link3" role="tab" aria-controls="v-pills-link3" aria-selected="false">Witnesses Descriptions</a>
                    <a class="nav-link" data-toggle="tab" id="v-pills-link3-tab" data-mdb-toggle="pill" href="#link4" role="tab" aria-controls="v-pills-link4" aria-selected="false">Fingerprints</a>
                    <a class="nav-link" data-toggle="tab" id="v-pills-link3-tab" data-mdb-toggle="pill" href="#link5" role="tab" aria-controls="v-pills-link5" aria-selected="false">Photos</a>
                    <a class="nav-link" data-toggle="tab" id="v-pills-link3-tab" data-mdb-toggle="pill" href="#link6" role="tab" aria-controls="v-pills-link6" aria-selected="false">Court Medical Reports</a>
                    <a class="nav-link" data-toggle="tab" id="v-pills-link3-tab" data-mdb-toggle="pill" href="#link7" role="tab" aria-controls="v-pills-link7" aria-selected="false">Accident Charts</a>
                </div>
            </div>

            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="link1" role="tabpanel" aria-labelledby="v-pills-link1-tab">
                        <fieldset class="form-group border p-4 w-100">
                            <legend>Case Summary</legend>
                            <div class="row">
                                <div class="col-4">
                                    <p>Complaint ID</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="comp_id" id="comp_id" class="form-group w-100" readonly />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <p>Date Recorded</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="comp_date" id="comp_date" class="form-group w-100" readonly />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <p>Plantiff (NIC - Name)</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="plantiff_nic" id="plantiff_nic" class="form-group mr-3" readonly />
                                    <input type="text" name="plantiff_name" id="plantiff_name" class="form-group w-50" readonly />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <p>Complaint Type</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="comp_category" id="comp_category" class="form-group w-100" readonly />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <p>Complaint Title</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="comp_title" id="comp_title" class="form-group w-100" readonly />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <p>Complaint in Words</p>
                                </div>
                                <div class="col-8">
                                    <textarea class="mb-3 w-100" rows="5" name="comp_desc" id="comp_desc" readonly>
                            </textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <p>Recorded By (EMP ID - Name)</p>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="emp_id" id="emp_id" class="form-group mr-3" readonly />
                                    <input type="text" name="emp_name" id="emp_name" class="form-group w-50" readonly />
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="v-pills-link2-tab">
                        <div class="row">
                            <div class="col" name="peopleCol" id="peopleCol">
                                <table class="table mt-4 w-100" name="peopleTable" id="peopleTable">
                                    <thead>
                                        <th>Role in Case</th>
                                        <th>NIC</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <form method="POST" action="scripts/fill-complaint-study.php" name="newPerson" onsubmit="return confirm('Are you sure you want to proceed ?')">
                                                <input type="hidden" id="comp_id" name="comp_id" class="comp_id" value="" />
                                                <td>
                                                    <select class="form-control" id="role" name="new_role">
                                                        <option value="Suspect">Suspect</option>
                                                        <option value="Culprit">Culprit</option>
                                                        <option value="Witness">Witness</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="new_nic" id="new_nic" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="text" name="new_name" id="new_name" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="text" name="new_address" id="new_address" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="text" name="new_contact" id="new_contact" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="email" name="new_email" id="new_email" class="form-control" />
                                                </td>
                                                <td colspan="2">
                                                    <input type="submit" name="addPerson" class="btn w-100" value="Add">
                                                </td>
                                            </form>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="link3" role="tabpanel" aria-labelledby="v-pills-link3-tab">
                        <div class="row">
                            <div class="col" name="witnessCol" id="witnessCol">
                                <table class="table mt-4" name="witnessTable" id="witnessTable">
                                    <thead>
                                        <th>NIC</th>
                                        <th>Description</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <form method="POST" action="scripts/fill-complaint-study.php" name="newWitness" onsubmit="return confirm('Are you sure you want to proceed ?')">
                                                <input type="hidden" id="comp_id" name="comp_id" class="comp_id" value="" />
                                                <td>
                                                    <select class="form-control" id="witness_nics" name="witness_nics" style="width: 15vw;"></select>
                                                </td>
                                                <td>
                                                    <textarea name="description" id="description" class="form-control" rows="4" style="width: 35vw;"></textarea>
                                                </td>
                                                <td colspan="2">
                                                    <input type="submit" name="addWitness" class="btn w-75" value="Add">
                                                </td>
                                            </form>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="link4" role="tabpanel" aria-labelledby="v-pills-link4-tab">
                        <div class="row">
                                <div class="col" name="fingerprintCol" id="fingerprintCol">
                                    <form method="POST" action="scripts/fill-complaint-study.php" enctype="multipart/form-data">
                                        <input type="hidden" id="comp_id" name="comp_id" class="comp_id" value="" />
                                        
                                        <label for="fingerprintFile">Choose a File (png, jpeg, pdf): </label>
                                        <input type="file" id="fingerprintFile" name="fingerprintFile" accept="image/png, image/jpeg, image/jpg, .pdf">
                                        
                                        <input type="submit" name="addFingerprint" class="btn" value="Add"/>
                                    </form>

                                    <table class="table mt-4" name="fingerprintTable" id="fingerprintTable">
                                        <thead>
                                            <th>Analysis</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    <div class="tab-pane fade" id="link5" role="tabpanel" aria-labelledby="v-pills-link5-tab">
                        <div class="row">
                            <div class="col" name="photoCol" id="photoCol">
                                <form method="POST" action="scripts/fill-complaint-study.php" enctype="multipart/form-data">
                                    <input type="hidden" id="comp_id" name="comp_id" class="comp_id" value="" />

                                    <label for="photoFile">Choose a File (png, jpeg, pdf): </label>         
                                    <input type="file" id="photoFile" name="photoFile" accept="image/png, image/jpg, image/jpeg">

                                    <input type="submit" name="addPhoto" class="btn" value="Add"/>
                                </form>

                                <table class="table mt-4" name="photoTable" id="photoTable">
                                    <thead>
                                        <th>Image</th>
                                        <th>Delete</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="link6" role="tabpanel" aria-labelledby="v-pills-link6-tab">
                        <div class="row">
                            <div class="col" name="courtMedicalCol" id="courtMedicalCol">
                                <form method="POST" action="scripts/fill-complaint-study.php" enctype="multipart/form-data">
                                    <input type="file">
                                    <input type="submit" name="addMedical" class="btn" value="Add"/>
                                </form>

                                <table class="table mt-4" name="courtMedicalTable" id="courtMedicalTable">
                                    <thead>
                                        <th>Report</th>
                                        <th>Delete</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="link7" role="tabpanel" aria-labelledby="v-pills-link7-tab">
                        <div class="row">
                            <div class="col" name="accidentCol" id="accidentCol">
                                <form method="POST" action="scripts/fill-complaint-study.php" enctype="multipart/form-data">
                                    <input type="file">
                                    <input type="submit" name="addAccidentChart" class="btn" value="Add"/>
                                </form>

                                <table class="table mt-4" name="accidentTable" id="accidentTable">
                                    <thead>
                                        <th>Chart</th>
                                        <th>Delete</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById("caseID").addEventListener("keydown", function(e) {
            if (e.keyCode == 13) {
                fillComplaintData(this.value);
            }
        }, false);

        let peopleTable = document.getElementById("peopleTable");
        let witnessTable = document.getElementById("witnessTable");
        let fingerprintTable = document.getElementById("fingerprintTable");
        let photoTable = document.getElementById("photoTable");

        function fillComplaintData(case_id) {
            // Data for Case Summary
            let comp_id = document.getElementById("comp_id");
            let comp_date = document.getElementById("comp_date");
            let plantiff_nic = document.getElementById("plantiff_nic");
            let plantiff_name = document.getElementById("plantiff_name");
            let comp_category = document.getElementById("comp_category");
            let comp_title = document.getElementById("comp_title");
            let comp_desc = document.getElementById("comp_desc");
            let emp_id = document.getElementById("emp_id");
            let emp_name = document.getElementById("emp_name");

            // From Manage Witnesses
            let witness_nics = [];

            for (let n = 0; n < document.querySelectorAll(".comp_id").length; n++) {
                document.querySelectorAll(".comp_id")[n].value = case_id;
            }

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.responseText != "") {
                        // FILL OUT CASE SUMMARY =======================================================================
                        var obj = JSON.parse(this.responseText);

                        comp_id.value = obj[0][0];
                        comp_date.value = obj[0][1];
                        plantiff_nic.value = obj[0][3];
                        plantiff_name.value = obj[0][4];
                        comp_category.value = obj[0][2];
                        comp_title.value = obj[0][5];
                        comp_desc.value = obj[0][6];
                        emp_id.value = obj[0][7];
                        emp_name.value = obj[0][8];
                        // ==============================================================================================

                        // MANAGE PEOPLE ASSOCIATED WITH THE CASE =======================================================
                        if (obj[1][0] != null) {
                            let peopleArray = obj[1][0];

                            for (let i = 0; i < peopleArray.length; i++) {
                                let form = document.createElement("form");
                                form.setAttribute("method", "POST");
                                form.setAttribute("action", "scripts/fill-complaint-study.php");
                                form.setAttribute("onsubmit", "return confirm('Are you sure you want to proceed ?')");

                                let row = document.createElement("tr");

                                let complaint_id = document.createElement("INPUT");
                                complaint_id.setAttribute("type", "hidden");
                                complaint_id.setAttribute("id", "comp_id");
                                complaint_id.setAttribute("name", "comp_id");
                                complaint_id.setAttribute("value", case_id);

                                let cell1 = document.createElement("td");
                                let cell2 = document.createElement("td");
                                let cell3 = document.createElement("td");
                                let cell4 = document.createElement("td");
                                let cell5 = document.createElement("td");
                                let cell6 = document.createElement("td");
                                let cell7 = document.createElement("td");
                                let cell8 = document.createElement("td");

                                let cell9 = document.createElement("td");
                                cell9.setAttribute("colspan", "8");
                                cell9.style.padding = "0";

                                let select = document.createElement("SELECT"); // Suspect/ Culprit/ Witness
                                select.setAttribute("id", "role");
                                select.setAttribute("name", "role");

                                let option1 = document.createElement("option");
                                option1.setAttribute("value", "Suspect");
                                let option1Text = document.createTextNode("Suspect");
                                option1.appendChild(option1Text);

                                let option2 = document.createElement("option");
                                option2.setAttribute("value", "Culprit");
                                let option2Text = document.createTextNode("Culprit");
                                option2.appendChild(option2Text);

                                let option3 = document.createElement("option");
                                option3.setAttribute("value", "Witness");
                                let option3Text = document.createTextNode("Witness");
                                option3.appendChild(option3Text);

                                select.classList.add("form-control");
                                select.appendChild(option1);
                                select.appendChild(option2);
                                select.appendChild(option3);
                                select.value = peopleArray[i]['role_in_case'];
                                
                                let text1 = document.createElement("INPUT"); //NIC
                                text1.setAttribute("name", "personNIC");
                                text1.setAttribute("type", "text");
                                text1.setAttribute("value", peopleArray[i]["nic"]);
                                text1.setAttribute("required", "")
                                text1.setAttribute("readonly", "")
                                text1.classList.add("form-control");
                                text1.style.width = "10vw";
                                if (peopleArray[i]['role_in_case'] == "Witness") {
                                    witness_nics.push(peopleArray[i]["nic"]);
                                }

                                let text2 = document.createElement("INPUT"); // Name
                                text2.setAttribute("name", "personName");
                                text2.setAttribute("type", "text");
                                text2.setAttribute("value", peopleArray[i]["name"]);
                                text2.setAttribute("required", "")
                                text2.classList.add("form-control");

                                let text3 = document.createElement("INPUT"); //Address
                                text3.setAttribute("name", "personAddress");
                                text3.setAttribute("type", "text");
                                text3.setAttribute("value", peopleArray[i]["address"]);
                                text3.setAttribute("required", "")
                                text3.classList.add("form-control");

                                let text4 = document.createElement("INPUT"); //Contact
                                text4.setAttribute("name", "personContact");
                                text4.setAttribute("type", "text");
                                text4.setAttribute("value", peopleArray[i]["contact"]);
                                text4.setAttribute("required", "")
                                text4.classList.add("form-control");

                                let text5 = document.createElement("INPUT"); //Email 
                                text5.setAttribute("name", "personEmail");
                                text5.setAttribute("type", "email");
                                text5.setAttribute("value", peopleArray[i]["email"]);
                                text5.classList.add("form-control");

                                let updateBtn = document.createElement("INPUT");
                                updateBtn.setAttribute("type", "submit");
                                updateBtn.setAttribute("name", "updatePerson");
                                updateBtn.setAttribute("value", "Update");
                                updateBtn.classList.add("btn");

                                let deleteBtn = document.createElement("INPUT");
                                deleteBtn.setAttribute("type", "submit");
                                deleteBtn.setAttribute("name", "deletePerson");
                                deleteBtn.setAttribute("value", "Delete");
                                deleteBtn.classList.add("btn");

                                cell1.appendChild(select);
                                cell2.appendChild(text1);
                                cell3.appendChild(text2);
                                cell4.appendChild(text3);
                                cell5.appendChild(text4);
                                cell6.appendChild(text5);
                                cell7.appendChild(updateBtn);
                                cell8.appendChild(deleteBtn);

                                form.appendChild(complaint_id);
                                form.appendChild(cell1);
                                form.appendChild(cell2);
                                form.appendChild(cell3);
                                form.appendChild(cell4);
                                form.appendChild(cell5);
                                form.appendChild(cell6);
                                form.appendChild(cell7);
                                form.appendChild(cell8);

                                cell9.appendChild(form)
                                row.appendChild(cell9);
                                peopleTable.getElementsByTagName("tbody")[0].appendChild(row);
                            }
                        }
                        // ==============================================================================================   

                        // MANAGE WITNESSES ==========================================================================
                        nic_list = document.getElementById("witness_nics");

                        for (let i = 0; i < witness_nics.length; i++) {
                            let option = document.createElement("OPTION");
                            option.setAttribute("value", witness_nics[i]);
                            let optionText = document.createTextNode(witness_nics[i]);
                            option.appendChild(optionText);
                            nic_list.appendChild(option);
                        }

                        if (obj.length > 2) {
                            if (obj[2][0] != null) {
                                let witnessArray = obj[2][0];

                                for (let i = 0; i < witnessArray.length; i++) {

                                    let form = document.createElement("form");
                                    form.setAttribute("method", "POST");
                                    form.setAttribute("action", "scripts/fill-complaint-study.php");
                                    form.setAttribute("onsubmit", "return confirm('Are you sure you want to proceed ?')");

                                    let row = document.createElement("tr");

                                    let complaint_id = document.createElement("INPUT");
                                    complaint_id.setAttribute("type", "hidden");
                                    complaint_id.setAttribute("id", "comp_id");
                                    complaint_id.setAttribute("name", "comp_id");
                                    complaint_id.setAttribute("value", case_id);

                                    let cell1 = document.createElement("td");
                                    let cell2 = document.createElement("td");
                                    let cell3 = document.createElement("td");
                                    let cell4 = document.createElement("td");

                                    let cellRow = document.createElement("td");
                                    cellRow.setAttribute("colspan", "4");
                                    cellRow.style.padding = "0";

                                    let text1 = document.createElement("INPUT"); // NIC
                                    text1.setAttribute("name", "nic");
                                    text1.setAttribute("type", "text");
                                    text1.setAttribute("value", witnessArray[i]["nic"]);
                                    text1.setAttribute("required", "");
                                    text1.setAttribute("readonly", "");
                                    text1.classList.add("form-control");
                                    text1.style.width = "15vw";
                                    text1.style.marginRight = "1vw";

                                    let text2 = document.createElement("textarea"); // Description
                                    text2.setAttribute("name", "description");
                                    text2.setAttribute("rows", "4");
                                    textDesc = document.createTextNode(witnessArray[i]["witness_description"]);
                                    text2.appendChild(textDesc);
                                    text2.classList.add("form-control");
                                    text2.style.width = "35vw";
                                    text2.style.marginRight = "2vw";

                                    let updateBtn = document.createElement("INPUT");
                                    updateBtn.setAttribute("type", "submit");
                                    updateBtn.setAttribute("name", "updateWitness");
                                    updateBtn.setAttribute("value", "Update");
                                    updateBtn.classList.add("btn");
                                    
                                    let deleteBtn = document.createElement("INPUT");
                                    deleteBtn.setAttribute("type", "submit");
                                    deleteBtn.setAttribute("name", "deleteWitness");
                                    deleteBtn.setAttribute("value", "Delete");
                                    deleteBtn.classList.add("btn");

                                    cell1.appendChild(text1);
                                    cell2.appendChild(text2);
                                    cell3.appendChild(updateBtn);
                                    cell4.appendChild(deleteBtn);

                                    form.appendChild(cell1);
                                    form.appendChild(cell2);
                                    form.appendChild(cell3);
                                    form.appendChild(cell4);
                                    form.appendChild(complaint_id);

                                    cellRow.appendChild(form);
                                    row.appendChild(cellRow);
                                    witnessTable.getElementsByTagName("tbody")[0].appendChild(row);
                                }
                            }
                        }
                        // ==============================================================================================

                        // MANAGE FINGERPRINTS ==========================================================================
                        if (obj.length > 3) {
                            
                            if (obj[3][0] != null) {
                                let fingerprintArray = obj[3][0];

                                for(let i=0; i<fingerprintArray.length; i++){
                                    let form = document.createElement("form");
                                    form.setAttribute("method", "POST");
                                    form.setAttribute("action", "scripts/fill-complaint-study.php");
                                    form.setAttribute("onsubmit", "return confirm('Are you sure you want to proceed ?')");

                                    let row = document.createElement("tr");

                                    let complaint_id = document.createElement("INPUT");
                                    complaint_id.setAttribute("type", "hidden");
                                    complaint_id.setAttribute("id", "comp_id");
                                    complaint_id.setAttribute("name", "comp_id");
                                    complaint_id.setAttribute("value", case_id);

                                    let fingerprint = document.createElement("INPUT");
                                    fingerprint.setAttribute("type", "hidden");
                                    fingerprint.setAttribute("id", "fingerprint");
                                    fingerprint.setAttribute("name", "fingerprint");
                                    fingerprint.setAttribute("value", fingerprintArray[i][0]);

                                    let cell1 = document.createElement("td");
                                    let cell2 = document.createElement("td");

                                    let cellRow = document.createElement("td");
                                    cellRow.setAttribute("colspan", "2");
                                    cellRow.style.padding = "0";

                                    let link = document.createElement("a");
                                    link.setAttribute("href", "../" + fingerprintArray[i][0]);
                                    link.setAttribute("target", "blank");
                                    link.style.paddingRight = "30vw";
                                    linkText = document.createTextNode("Fingerprint " + (i+1));
                                    link.appendChild(linkText);

                                    let deleteBtn = document.createElement("INPUT");
                                    deleteBtn.setAttribute("type", "submit");
                                    deleteBtn.setAttribute("name", "deleteFingerprint");
                                    deleteBtn.setAttribute("value", "Delete");
                                    deleteBtn.classList.add("btn");

                                    cell1.appendChild(link);
                                    cell2.appendChild(deleteBtn);

                                    form.appendChild(complaint_id);
                                    form.appendChild(fingerprint);
                                    form.appendChild(cell1);
                                    form.appendChild(cell2);

                                    cellRow.appendChild(form);
                                    row.appendChild(cellRow);
                                    fingerprintTable.getElementsByTagName("tbody")[0].appendChild(row);
                                }
                            }
                        }
                        // ==============================================================================================

                        // MANAGE PHOTOS ================================================================================
                        if (obj.length > 4) {
                            
                            if (obj[4][0] != null) {
                                let photoArray = obj[4][0];

                                for(let i=0; i < photoArray.length; i++){
                                    let form = document.createElement("form");
                                    form.setAttribute("method", "POST");
                                    form.setAttribute("action", "scripts/fill-complaint-study.php");
                                    form.setAttribute("onsubmit", "return confirm('Are you sure you want to proceed ?')");

                                    let row = document.createElement("tr");

                                    let complaint_id = document.createElement("INPUT");
                                    complaint_id.setAttribute("type", "hidden");
                                    complaint_id.setAttribute("id", "comp_id");
                                    complaint_id.setAttribute("name", "comp_id");
                                    complaint_id.setAttribute("value", case_id);

                                    let photo = document.createElement("INPUT");
                                    photo.setAttribute("type", "hidden");
                                    photo.setAttribute("id", "photo");
                                    photo.setAttribute("name", "photo");
                                    photo.setAttribute("value", photoArray[i][0]);

                                    let cell1 = document.createElement("td");
                                    let cell2 = document.createElement("td");

                                    let cellRow = document.createElement("td");
                                    cellRow.setAttribute("colspan", "2");
                                    cellRow.style.padding = "0";

                                    let link = document.createElement("a");
                                    link.setAttribute("href", "../" + photoArray[i][0]);
                                    link.setAttribute("target", "blank");
                                    link.style.paddingRight = "30vw";
                                    linkText = document.createTextNode("Image  " + (i+1));
                                    link.appendChild(linkText);

                                    let deleteBtn = document.createElement("INPUT");
                                    deleteBtn.setAttribute("type", "submit");
                                    deleteBtn.setAttribute("name", "deletePhoto");
                                    deleteBtn.setAttribute("value", "Delete");
                                    deleteBtn.classList.add("btn");

                                    cell1.appendChild(link);
                                    cell2.appendChild(deleteBtn);

                                    form.appendChild(complaint_id);
                                    form.appendChild(photo);
                                    form.appendChild(cell1);
                                    form.appendChild(cell2);

                                    cellRow.appendChild(form);
                                    row.appendChild(cellRow);
                                    photoTable.getElementsByTagName("tbody")[0].appendChild(row);
                                }
                            }
                        }
                        // ==============================================================================================

                        document.getElementById("alertMsg").style.display = "none"; // Hide the "Complaint Not Found Messgae if response if not null"      
                    }
                } else {
                    comp_id.value = "";
                    comp_date.value = "";
                    plantiff_nic.value = "";
                    plantiff_name.value = "";
                    comp_category.value = "";
                    comp_title.value = "";
                    comp_desc.value = "";
                    emp_id.value = "";
                    emp_name.value = "";

                    // Remove rows of people table upon each new complaint search
                    let rows1 = peopleTable.rows.length;
                    if (rows1 > 2) {
                        for (let i = 0; i < rows1 - 2; i++) {
                            peopleTable.deleteRow(2);
                        }
                    }

                    // Remove the Elements of the NICs select upon each new complaint search
                    for (let i = 0; i < document.getElementById("witness_nics").length; i++) {
                        document.getElementById("witness_nics").remove(document.getElementById("witness_nics")[i]);
                    }

                    // Remove rows of witness table upon each new complaint search
                    let rows2 = witnessTable.rows.length;
                    if (rows2 >= 2) {
                        for (let i = 0; i < rows2 - 2; i++) {
                            witnessTable.deleteRow(2);
                        }
                    }

                    // Remove rows of fingerprint table upon each new complaint search
                    let rows3 = fingerprintTable.rows.length;
                    if(rows3 >= 2){
                        for (let i = 0; i < rows3 - 1; i++) {
                            fingerprintTable.deleteRow(1);
                        }
                    }

                    // Remove rows of photo table upon each new complaint search
                    let rows4 = photoTable.rows.length;
                    if(rows4 >= 2){
                        for (let i = 0; i < rows4 - 1; i++) {
                            photoTable.deleteRow(1);
                        }
                    }

                    document.getElementById("alertMsg").classList.add("alert-danger");
                    document.getElementById("alertMsg").textContent = "Complaint Not Found";
                    document.getElementById("alertMsg").style.display = "block";
                }
            };
            xmlhttp.open("GET", "./scripts/fill-complaint-study.php?complaint_id=" + String(case_id), true);
            xmlhttp.send();
        }
    </script>

    <?php
    if (isset($_GET["status"])) {

        $msg = "";
        if(isset($_GET["msg"])){
            $msg = $_GET["msg"];
        }

        if ($_GET["status"] == "true") {
            $complaint_id = $_GET["comp_id"];
    ?>
            <script type="text/javascript">
                document.getElementById("caseID").value = "<?php echo $complaint_id; ?>";
                fillComplaintData(<?php echo $complaint_id; ?>);

                document.getElementById("recordsMsg").classList.add("alert-success");
                document.getElementById("recordsMsg").textContent = "Records updated successfully";
                document.getElementById("recordsMsg").style.display = "block";
            </script>
        <?php
        } elseif ($_GET["status"] == "false") {
        ?>
            <script type="text/javascript">
                document.getElementById("recordsMsg").classList.add("alert-danger");
                document.getElementById("recordsMsg").textContent = "Record update failed. <?php echo $msg; ?>";
                document.getElementById("recordsMsg").style.display = "block";
            </script>
    <?php
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>