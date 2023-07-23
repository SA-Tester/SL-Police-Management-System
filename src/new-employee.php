<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Employee</title>
    <link rel="icon" type="image/png" href="../assets/logo.png" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="../CSS/New_Employee.css">
</head>

<body>
    <!------------------navbar---------------------------->
    <?php
        include 'navbar.php';
        renderNavBar();
    ?>
    <!---------------------------------------------------->

    <div class="container py-md-5">
        <h2 style="color: darkblue; text-align: center;">Employee Details</h2>
        <div class="card shadow mb-3">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NIC</th>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Joined Date</th>
                            <th>Marital Status</th>
                            <th>Rank</th>
                            <th>Retired Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>123456789V</td>
                            <td>EMP001</td>
                            <td>John</td>
                            <td>Doe</td>
                            <td>1985-10-15</td>
                            <td>9876543210</td>
                            <td>johndoe@gmail.com</td>
                            <td>123 Main St, City</td>
                            <td>Male</td>
                            <td>2020-01-01</td>
                            <td>Married</td>
                            <td>Inspector</td>
                            <td>No</td>
                        </tr>
                        <tr>
                            <td>987654321V</td>
                            <td>EMP002</td>
                            <td>Jane</td>
                            <td>Smith</td>
                            <td>1990-05-20</td>
                            <td>1234567890</td>
                            <td>janesmith@gmail.com</td>
                            <td>456 Elm St, Town</td>
                            <td>Female</td>
                            <td>2019-07-10</td>
                            <td>Single</td>
                            <td>Sergeant</td>
                            <td>No</td>
                        </tr>
                        <tr>
                            <td>987123654V</td>
                            <td>EMP005</td>
                            <td>David</td>
                            <td>Wilson</td>
                            <td>1982-12-10</td>
                            <td>1111111111</td>
                            <td>davidwilson@gmail.com</td>
                            <td>321 Cedar St, District</td>
                            <td>Male</td>
                            <td>2017-06-05</td>
                            <td>Divorced</td>
                            <td>Inspector</td>
                            <td>No</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add Employee
            </button>

            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">New Employee</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="Emp_Id"><strong>Employee
                                                        ID</strong></label></div><input class="form-control"
                                                type="text">
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"
                                                    for="NIC"><strong>NIC</strong></label></div><input
                                                class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="first_name"><strong>First
                                                        Name</strong></label><input class="form-control" type="text"
                                                    id="first_name-4" name="first_name"></div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="last_name"><strong>Last
                                                        Name</strong></label><input class="form-control" type="text"
                                                    id="last_name-4" name="last_name"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"
                                                    for="DOB"><strong>DOB</strong></label></div><input
                                                class="form-control" type="date">
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"
                                                    for="Gender"><strong>Gender</strong></label></div><select
                                                class="form-select">
                                                <optgroup>
                                                    <option value="12" selected="">Female</option>
                                                    <option value="13">Male</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"
                                                    for="tel"><strong>Contact</strong></label></div><input
                                                class="form-control" type="tel">
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Email
                                                        Address</strong></label></div><input class="form-control"
                                                type="email" id="email-1" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"
                                                    for="Address"><strong>Address</strong></label></div><input
                                                class="form-control" type="text">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="M_Status"><strong>Marital
                                                        Status</strong></label></div><input class="form-control"
                                                type="text">
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"
                                                    for="Rank"><strong>Rank</strong></label></div><input
                                                class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="Joined_Date"><strong>Joined
                                                        Date</strong></label></div><input class="form-control"
                                                type="date">
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"
                                                    for="Retired_Status"><strong>Retired Status</strong></label></div>
                                            <select class="form-select">
                                                <optgroup>
                                                    <option value="12" selected="">Yes</option>
                                                    <option value="13">No</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function submitForm() {
            $('#myModal').modal('hide');
        }
    </script>
</body>

</html>