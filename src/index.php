<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/index.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!--boostrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- dark mode switch condition -->
    <?php
    session_start();
    if ($_SESSION['dark']) {
        echo '<link rel="stylesheet" href="../css/dark-mode.css">';
    }
    ?>

    <title>Sri Lanka Police Management System</title>
    <link rel="icon" type="image/png" href="../assets/logo.png" />
</head>

<body>
    <!------------------navbar---------------------------->
    <?php
        include 'navbar.php';
        renderNavBar();
    ?>
    <!---------------------------------------------------->
    <div class="container-fluid mt-1">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleCaptions" class="carousel slide custom-slider" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../assets/intro-bg2.jpg" class="d-block w-100 darken-image" alt="...">
                            <div class="carousel-caption d-md-block">
                                <p class="h5">WELCOME TO THE</p>
                                <h2 class="h2"><b>SRI LANKA POLICE STATIONS<br>MANAGEMENT SYSTEM</b></h2>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../assets/4.JPG" class="d-block w-100 darken-image" alt="img1">
                            <div class="carousel-caption d-md-block">
                                <p class="h5">WELCOME TO THE</p>
                                <h2 class="h2"><b>SRI LANKA POLICE STATIONS<br>MANAGEMENT SYSTEM</b></h2>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../assets/image4.jpg" class="d-block w-100 darken-image" alt="...">
                            <div class="carousel-caption d-md-block">
                                <p class="h5">WELCOME TO THE</p>
                                <h2 class="h2"><b>SRI LANKA POLICE STATIONS<br>MANAGEMENT SYSTEM</b></h2>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards start here -->
    <br>
    <div class="container ">
        <div class="heading text-center">
            <h1 style="color:darkblue">Complaints</h1>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0"><a href="record-complaints.php" class="disabled common-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/Add_view_complaint.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="record-complaints.php" style="color:darkblue" class="disabled common-link">Add/ View Complaints</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0"><a href="view-people.php" class="disabled common-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/view people.jpg" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="view-people.php" style="color:darkblue" class="disabled common-link">View People and Cases</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0"><a href="complaint-study.php" class="disabled common-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/complaint handeling.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="complaint-study.php" style="color:darkblue" class="disabled common-link">Complaint Study</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="container">
        <div class="heading text-center">
            <h1 style="color:darkblue">Duties</h1>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0"><a href="general-duty.php" class="disabled admin-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/General_duty.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="general-duty.php" style="color:darkblue" class="disabled admin-link">General Duty</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0"><a href="special-duty.php" class="disabled emp3-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/special_duty.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="special-duty.php" style="color:darkblue" class="disabled emp3-link">Special Duty</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0"><a href="emergency-duties.php" class="disabled admin-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/Emergensy.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="emergency-duties.php" style="color:darkblue" class="disabled admin-link">Emergency Duty</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="container" style="width: auto">
        <div class="heading text-center">
            <h1 style="color:darkblue">Leaves</h1>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0"><a href="submit-leave-medical.php" class="disabled common-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/Submit_leves.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="submit-leave-medical.php" style="color:darkblue" class="disabled common-link">Submit Leaves</a></h5>
                    </div>
                </div>
            </div>
            <!--div class="col-md-6 col-lg-4">
              <div class="card border-0"><a href="#"><img class="card-img-top zoomUp" style="width:25%"src="../assets/Medical.png" alt="Card Image"></a>
                 <br>
                  <div class="card-body text-center">
                      <h5><a href="#" style="color:darkblue">Submit Medicals</a></h5>
                  </div>
              </div>
          </div-->
        </div>
    </div>
    <br><br>
    <div class="container" style="width: auto">
        <div class="heading text-center">
            <h1 style="color:darkblue">Employee</h1>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0"><a href="new-employee.php" class="disabled admin-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/New employee.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="new-employee.php" style="color:darkblue" class="disabled admin-link">Add New Employee</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0"><a href="check-avalability.php" class="disabled emp3-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/complaint handeling.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="check-avalability.php" style="color:darkblue" class="disabled emp3-link">Check Employee Availability</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="container" style="width: auto">
        <div class="heading text-center">
            <h1 style="color:darkblue">Settings</h1>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class=" col-md-6 col-lg-4">
                <div class="card border-0"><a href="update-personal-details.php" class="disabled common-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/complaint handeling.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="#" style="color:darkblue" class="disabled common-link">Update Personal Details</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0"><a href="change-password.php" class="disabled common-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/complaint handeling.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="#" style="color:darkblue" class="disabled common-link">Change Password</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="container" style="width: auto">
        <div class="heading text-center">
            <h1 style="color:darkblue">Salary</h1>
        </div>
        <br>
        <div class="row ">
            <div class="col-md-6 col-lg-4 mx-auto">
                <div class="card border-0"><a href="payroll.php" class="disabled emp1-link"><img class="card-img-top zoomUp" style="width:25%" src="../assets/complaint handeling.png" alt="Card Image"></a>
                    <br>
                    <div class="card-body text-center">
                        <h5><a href="payroll.php" style="color:darkblue" class="disabled emp1-link">Payroll</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <footer class="py-5 mt-5" style="background-color: #101D6B;">
        <div class="container text-light text-center">
            <p class="display-5 mb-3">Sri Lanka Police</p>
            <small class="text-white-50">&copy; Copyright. All right reserved</small>
        </div>
    </footer>

    <script>
        document.addEventListener('click', (event) => {
            const targetLink = event.target.closest('a.disabled');
            if (targetLink) {
                console.log('Clicked on a disabled link');
                event.preventDefault();
            }
        });

        function enableAdminLinks() {
            document.querySelectorAll('.admin-link, .common-link, .emp3-link, .emp1-link').forEach(link => {
                link.classList.remove('disabled');
            });
        }

        function enableUserLinks() {
            document.querySelectorAll('.common-link').forEach(link => {
                link.classList.remove('disabled');
            });
        }
        function enableEmp3Links() {
            document.querySelectorAll('.emp3-link').forEach(link => {
                link.classList.remove('disabled');
            });
        }
        function enableEmp1Links() {
            document.querySelectorAll('.emp1-link').forEach(link => {
                link.classList.remove('disabled');
            });
        }

        const userRole = "<?php echo isset($_SESSION['role']) ? $_SESSION['role'] : 'guest'; ?>";
        const userId = "<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>";

        if (userRole === "admin") {
            enableAdminLinks();
            enableEmp3Links();
            enableEmp1Links();
        
        } else if (userRole === "user") {
            enableUserLinks();

            if(userId === "EMP0001"){
                enableEmp1Links();
            }
            else if(userId === "EMP0003"){
                enableEmp3Links();
            }
        }
    </script>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>