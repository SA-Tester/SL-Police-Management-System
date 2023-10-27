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
    <link rel="icon" type="image/png" href="../assets/logo.png">
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
            <input type="text" id="caseID" name="caseID" class="w-50 mt-5 form-group" placeholder="Enter Case ID"/>
            <button class="mt-5 form-group" onclick="fillComplaintData(document.getElementById('caseID').value)"><i class="fas fa-search"></i></button>
        </div>

        <div class="alert alert-danger mt-3 mb-3" role="alert" id="alertMsg" style="display: none;">
            Complaint Not Found
        </div>

        <div class="row d-flex mt-4">
            <fieldset class="form-group border p-4 w-100">
                <legend>Case Summary</legend>
                <div class="row">
                    <div class="col-4">
                        <p>Complaint ID</p>
                    </div>
                    <div class="col-8">
                        <input type="text" name="comp_id" id="comp_id" class="form-group w-100"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <p>Date Recorded</p>
                    </div>
                    <div class="col-8">
                        <input type="text" name="comp_date" id="comp_date" class="form-group w-100"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <p>Plantiff (NIC - Name)</p>
                    </div>
                    <div class="col-8">
                        <input type="text" name="plantiff_nic" id="plantiff_nic" class="form-group mr-3"/>
                        <input type="text" name="plantiff_name" id="plantiff_name" class="form-group w-50"/>
                    </div>
                </div>
                         
                <div class="row">
                    <div class="col-4">
                        <p>Complaint Type</p>
                    </div>
                    <div class="col-8">
                        <input type="text" name="comp_category" id="comp_category" class="form-group w-100"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <p>Complaint Title</p>
                    </div>
                    <div class="col-8">
                        <input type="text" name="comp_title" id="comp_title" class="form-group w-100"/>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-4">
                        <p>Complaint in Words</p>
                    </div>
                    <div class="col-8">
                        <textarea class="mb-3 w-100" rows="10" name="comp_desc" id="comp_desc">
                        </textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <p>Recorded By (EMP ID - Name)</p>
                    </div>
                    <div class="col-8">
                        <input type="text" name="emp_id" id="emp_id" class="form-group mr-3"/>
                        <input type="text" name="emp_name" id="emp_name" class="form-group w-50"/>
                    </div>
                </div>               
            </fieldset>
        </div>

        <div class="row d-flex mt-4">
            <fieldset class="form-group w-100">
                <legend>Manage Evidences</legend>

                <fieldset class="form-group border p-4">
                    <legend class="small font-weight-bold">Manage Suspects/ Culprits</legend>
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <button class="btn btn-info h-100 w-50" onclick="showHide('suspectCulpritCol')">Manage Suspects/ Culprits</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" name="suspectCulpritCol" id="suspectCulpritCol" style="display: none;">
                            <table class="table mt-4 w-100" name="suspectCulpritTable" id="suspectCulpritTable">
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
                                        <form method="POST" action="scripts/fill-complaint-study.php" name="newSuspectCulprit">
                                            <td>
                                                <select class="form-control" id="role" name="role">
                                                    <option value="Suspect">Suspect</option>
                                                    <option value="Culprit">Culprit</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="new_nic" id="new_nic" class="form-control"/>
                                            </td>
                                            <td>
                                                <input type="text" name="new_name" id="new_name" class="form-control"/>
                                            </td>
                                            <td>
                                                <input type="text" name="new_address" id="new_address" class="form-control"/>
                                            </td>
                                            <td>
                                                <input type="text" name="new_contact" id="new_contact" class="form-control"/>
                                            </td>
                                            <td>
                                                <input type="text" name="new_email" id="new_email" class="form-control"/>
                                            </td>
                                            <td colspan="2">
                                                <button type="submit" name="addNew" class="btn btn-success">Add</button>
                                            </td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-4">
                    <legend class="small font-weight-bold">Eyewitness Descriptions</legend>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success h-100">Add Eye Witnesses</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info">Update Eye Witnesses</button>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-4">
                    <legend class="small font-weight-bold">Fingerprints</legend>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success h-100">Add Fingerprints</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info h-100">Update Fingerprints</button>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-4">
                    <legend class="small font-weight-bold">Photos</legend>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success">Add Photos</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info">Update Photos</button>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-4">
                    <legend class="small font-weight-bold">Court Medical Reports</legend>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success">Add Court Medical Reports</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info">Update Court Medical Reports</button>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-4">
                    <legend class="small font-weight-bold">Accident Charts</legend>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success h-100">Add Accident Charts</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info h-100">Update Accident Charts</button>
                        </div>
                    </div>
                </fieldset>
            </fieldset>
        </div>
    </div>

    <script type = "text/javascript">
        function showHide(element_name){
            let element = document.getElementById(String(element_name));
            if(element.style.display == "none"){
                element.style.display = "block";
            }
            else{
                element.style.display = "none";
            }
        }
    </script>

    <script type="text/javascript">
        document.getElementById("caseID").addEventListener("keydown", function(e) {
            if (e.keyCode == 13) { fillComplaintData(this.value); }
        }, false);

        let suspectCulpritTable = document.getElementById("suspectCulpritTable");

        function fillComplaintData(case_id){
            let comp_id = document.getElementById("comp_id");
            let comp_date = document.getElementById("comp_date");
            let plantiff_nic = document.getElementById("plantiff_nic");
            let plantiff_name = document.getElementById("plantiff_name");
            let comp_category = document.getElementById("comp_category");
            let comp_title = document.getElementById("comp_title");
            let comp_desc = document.getElementById("comp_desc");
            let emp_id = document.getElementById("emp_id");
            let emp_name = document.getElementById("emp_name");

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                    var obj = JSON.parse(this.responseText);
                    comp_id.value = obj[0][0];
                    comp_date.value = obj[0][1];
                    plantiff_nic.value = obj[0][2];
                    plantiff_name.value = obj[0][3];
                    comp_category.value = obj[0][4];
                    comp_title.value = obj[0][5];
                    comp_desc.value = obj[0][6];
                    emp_id.value = obj[0][7];
                    emp_name.value = obj[0][8];

                    let suspectCulpritArray = obj[1][0];
                    for (let i=0; i<suspectCulpritArray.length; i++){

                        let form = document.createElement("form");
                        form.setAttribute("method", "POST");
                        form.setAttribute("action", "scripts/fill-complaint-study.php");
                        
                        let row = document.createElement("tr");

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
                        
                        let select = document.createElement("SELECT"); // Suspect/ Culprit
                        select.setAttribute("id", "suspectCulprit");
                        select.setAttribute("name", "suspectCulprit");

                        let option1 = document.createElement("option");
                        option1.setAttribute("value", "Suspect");
                        let option1Text = document.createTextNode("Suspect");
                        option1.appendChild(option1Text);

                        let option2 = document.createElement("option");
                        option2.setAttribute("value", "Culprit");
                        let option2Text = document.createTextNode("Culprit");
                        option2.appendChild(option2Text);

                        select.classList.add("form-control");
                        select.appendChild(option1);
                        select.appendChild(option2);

                        let text1 = document.createElement("INPUT"); //NIC
                        text1.setAttribute("name", "suspectCulpritNIC");
                        text1.setAttribute("type", "text");
                        text1.setAttribute("value", suspectCulpritArray[i]["nic"]);
                        text1.classList.add("form-control");
                        
                        let text2 = document.createElement("INPUT"); // Name
                        text2.setAttribute("name", "suspectCulpritName");
                        text2.setAttribute("type", "text");
                        text2.setAttribute("value", suspectCulpritArray[i]["name"]);
                        text2.classList.add("form-control");
                        
                        let text3 = document.createElement("INPUT"); //Address
                        text3.setAttribute("name", "suspectCulpritAddress");
                        text3.setAttribute("type", "text");
                        text3.setAttribute("value", suspectCulpritArray[i]["address"]);
                        text3.classList.add("form-control");
                        
                        let text4 = document.createElement("INPUT"); //Contact
                        text4.setAttribute("name", "suspectCulpritContact");
                        text4.setAttribute("type", "text");
                        text4.setAttribute("value", suspectCulpritArray[i]["contact"]);
                        text4.classList.add("form-control");
                        
                        let text5 = document.createElement("INPUT"); //Email 
                        text5.setAttribute("name", "suspectCulpritEmail");
                        text5.setAttribute("type", "text");
                        text5.setAttribute("value", suspectCulpritArray[i]["email"]);
                        text5.classList.add("form-control");
                        
                        let updateBtn = document.createElement("INPUT");
                        updateBtn.setAttribute("type", "submit");
                        updateBtn.setAttribute("name", "update");
                        updateBtn.setAttribute("value", "Update");
                        updateBtn.classList.add("btn");
                        updateBtn.classList.add("btn-info");

                        let deleteBtn = document.createElement("INPUT");
                        deleteBtn.setAttribute("type", "submit");
                        deleteBtn.setAttribute("name", "delete");
                        deleteBtn.setAttribute("value", "Delete");
                        deleteBtn.classList.add("btn");
                        deleteBtn.classList.add("btn-danger");

                        cell1.appendChild(select);
                        cell2.appendChild(text1); 
                        cell3.appendChild(text2);
                        cell4.appendChild(text3);
                        cell5.appendChild(text4);
                        cell6.appendChild(text5);
                        cell7.appendChild(updateBtn);
                        cell8.appendChild(deleteBtn);
                        
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
                        suspectCulpritTable.getElementsByTagName("tbody")[0].appendChild(row);
                    }

                    document.getElementById("alertMsg").style.display = "none";
                }
                else{
                    comp_id.value = "";
                    comp_date.value = "";
                    plantiff_nic.value = "";
                    plantiff_name.value = "";
                    comp_category.value = "";
                    comp_title.value = "";
                    comp_desc.value = "";
                    emp_id.value = "";
                    emp_name.value = "";

                    let rows = suspectCulpritTable.rows.length;
                    if(rows > 2){
                        for (let i=0; i < rows-2; i++){
                            suspectCulpritTable.deleteRow(2);
                        }
                    }

                    document.getElementById("alertMsg").style.display = "block";
                }
            };
            xmlhttp.open("GET", "./scripts/fill-complaint-study.php?comp_id=" + String(case_id), true);
            xmlhttp.send();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>