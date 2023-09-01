<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>General Duties</title>
    <link rel="icon" type="image/png" href="../assets/logo.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../css/general-duty.css"/>

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


    <div class="container">
        <div class="col-12  mb-1">
            <h4 class="text-uppercase">General Duties of the Week</h4>
            <p>Statistics Showing</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="icon-pencil primary font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>278</h3>
                                <span>Investigation</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="icon-speech warning font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>156</h3>
                                <span>Office Duty</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="icon-graph success font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>64.89 %</h3>
                                <span>Night Duty</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="icon-pointer danger font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>423</h3>
                                <span>Traffics</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="danger">278</h3>
                                <span>Investigation</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-rocket danger font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">156</h3>
                                <span>Office Duty</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-user success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning">64.89 %</h3>
                                <span>Night Duty</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-pie-chart warning font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="primary">423</h3>
                                <span>Traffics</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-support primary font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="primary">278</h3>
                                <span>Investigation</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-book-open primary font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress mt-1 mb-0" style="height: 7px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"
                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning">156</h3>
                                <span>Office Duty</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-bubbles warning font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress mt-1 mb-0" style="height: 7px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 35%"
                                aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">64.89 %</h3>
                                <span>Night Duty</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-cup success font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress mt-1 mb-0" style="height: 7px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 60%"
                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="danger">423</h3>
                                <span>Traffics</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-direction danger font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress mt-1 mb-0" style="height: 7px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>


    <div class="row ">
        <!-- Profile Card -->
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <!-- Profile Card Content -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4>Mr.Ambewela</h4>
                                <p class="text-secondary mb-1">Duty in charge offiser</p>
                                <p class="text-muted font-size-sm">Colombo Road,7</p>
                                <button class="btn btn-primary">Contact</button>
                                <button class="btn btn-outline-primary">Message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Duty Card -->

        <div class="col-xl-5 col-sm-6 col-12">
            <h1>General Duties</h1>

            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                data-bs-target="#addAssignmentModal">
                Add Duty
            </button>

            <!-- Table to display Duty -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Officer Name</th>
                        <th>Assignment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>Patrol</td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>Traffic</td>
                    </tr>

                </tbody>
            </table>

            <!-- Add Duty Modal -->
            <div class="modal fade" id="addAssignmentModal" tabindex="-1" aria-labelledby="addAssignmentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAssignmentModalLabel">Add Duty</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="officerName" class="form-label">Officer Name</label>
                                    <input type="text" class="form-control" id="officerName"
                                        placeholder="Enter officer name">
                                </div>
                                <div class="mb-3">
                                    <label for="assignment" class="form-label">Duties</label>
                                    <select class="form-select" id="assignment">
                                        <option selected>Select Duty</option>
                                        <option value="traffic">Investigation</option>
                                        <option value="patrol">Office</option>
                                        <option value="patrol">Night</option>
                                        <option value="investigation">Traffic</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6 col-12">
            <form>
                <!-- Name -->
                <h1 class="title text-center mb-4">FOR CHANGE DUTIES</h1>
                <div class="form-group position-relative">
                    <label for="formName" class="d-block">
                        <i class="icon" data-feather="user"></i>
                    </label>
                    <input type="text" id="formName" class="form-control form-control-lg thick" placeholder="Name">
                </div>

                <!-- E-mail -->
                <div class="form-group position-relative">
                    <label for="formEmail" class="d-block">
                        <i class="icon" data-feather="mail"></i>
                    </label>
                    <input type="email" id="formEmail" class="form-control form-control-lg thick" placeholder="E-mail">
                </div>

                <!-- Message -->
                <div class="form-group message">
                    <textarea id="formMessage" class="form-control form-control-lg" rows="7"
                        placeholder="Mensagem"></textarea>
                </div>

                <!-- Submit btn -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" tabIndex="-1">Send message</button>
                </div>
            </form>
        </div>
    </div>
    </div>


    <!--Duty-->
    <footer class="py-5 mt-5" style="background-color: #101D6B;">
        <div class="container text-light text-center">
            <p class="display-5 mb-3">Sri Lanka Police</p>
            <small class="text-white-50">&copy; Copyright. All right reserved</small>
        </div>
    </footer>




    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>