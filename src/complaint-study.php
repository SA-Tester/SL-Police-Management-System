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
            <input type="text" id="caseID" name="caseID" class="w-50 mt-5" placeholder="Enter Case ID"/>
            <button class="mt-5"><i class="fas fa-search"></i></button>
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
                    <legend class="small font-weight-bold">Eyewitness Descriptions</legend>
                    <div class="row w-100">
                        <div class="col">
                            <button class="btn btn-success h-100">Add Eye Witness</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-info">Update Eye Witnesses</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-danger">Delete Eye Witnesses</button>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-4">
                    <legend class="small font-weight-bold">Fingerprints</legend>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success h-100">Add Fingerprint</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-danger h-100">Delete Fingerprints</button>
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
                            <button class="btn btn-danger">Delete Photos</button>
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
                            <button class="btn btn-danger">Delete Court Medical Reports</button>
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
                            <button class="btn btn-danger h-100">Delete Accident Charts</button>
                        </div>
                    </div>
                </fieldset>
            </fieldset>
        </div>
    </div>

    <script type="text/javascript">
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
                
            }
        };
        xmlhttp.open("GET", "./scripts/complaint-study.php?comp_id=" + str, true);
        xmlhttp.send();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>