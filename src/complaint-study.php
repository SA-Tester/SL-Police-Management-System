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
                    <legend class="small font-weight-bold">Add Suspects/ Culprits</legend>
                    <div class="row w-100">
                        <div class="col">
                            <button class="btn btn-success h-100">Add Suspects/ Culprits</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info">Update Suspects/ Culprits</button>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-4">
                    <legend class="small font-weight-bold">Eyewitness Descriptions</legend>
                    <div class="row w-100">
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

    <script type="text/javascript">
        document.getElementById("caseID").addEventListener("keydown", function(e) {
            if (e.keyCode == 13) { fillComplaintData(this.value); }
        }, false);

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

                    comp_id.value = obj[0];
                    comp_date.value = obj[1];
                    plantiff_nic.value = obj[2];
                    plantiff_name.value = obj[3];
                    comp_category.value = obj[4];
                    comp_title.value = obj[5];
                    comp_desc.value = obj[6];
                    emp_id.value = obj[7];
                    emp_name.value = obj[8];

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