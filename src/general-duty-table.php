<!DOCTYPE html>
<html>

<head>
    <title>General Duties</title>
    <link rel="icon" type="image/png" href="../assets/logo.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .container {
            margin-top: 40px;
        }

        .thead {
            background-color: rgb(141, 141, 237);

        }

        .navbar {
            position: relative;
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

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label for="text1">Select Employee</label>
                        <input type="text" class="form-control" id="text1" placeholder="Enter text">
                    </div>
                    <div class="form-group">
                        <label for="dropdown1">Study Type</label>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select Duty
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdown1">
                                <a class="dropdown-item" href="#">Investigation</a>
                                <a class="dropdown-item" href="#">Traffic</a>
                                <a class="dropdown-item" href="#">Office Duty</a>
                                <a class="dropdown-item" href="#">Night Duty</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text2">Duty Start Time</label>
                        <input type="text" class="form-control" id="text2" placeholder="Enter text">
                    </div>
                    <div class="form-group">
                        <label for="text3">Duty End Time</label>
                        <input type="text" class="form-control" id="text3" placeholder="Enter text">
                    </div>
                    <div class="form-group">
                        <label for="text4">Text 4:</label>
                        <input type="text" class="form-control" id="text4" placeholder="Enter text">
                    </div>

                    <div class="form-group">
                        <label for="dropdown2">Duty Place</label>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select Place
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdown2">
                                <a class="dropdown-item" href="#">Option A</a>
                                <a class="dropdown-item" href="#">Option B</a>
                                <a class="dropdown-item" href="#">Option C</a>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Assign</button>
                    <button type="reset" class="btn btn-secondary">Remove</button>
                </form>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead class="thead">
                        <tr>
                            <th>Emp ID</th>
                            <th>Emp Name</th>
                            <th>Contact</th>
                            <th>Duty Place</th>
                            <th>Duty End Time</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Data 1</td>
                            <td>Data 2</td>
                            <td>Data 3</td>
                            <td>Data 4</td>
                            <td>Data 5</td>

                        </tr>
                        <tr>
                            <td>Data 8</td>
                            <td>Data 9</td>
                            <td>Data 10</td>
                            <td>Data 11</td>
                            <td>Data 12</td>

                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                    <tfoot>

                </table>
            </div>
        </div>
    </div>

    <footer class="py-5 mt-5" style="background-color: #101D6B;">
        <div class="container text-light text-center">
            <p class="display-5 mb-3">Sri Lanka Police</p>
            <small class="text-white-50">&copy; Copyright. All right reserved</small>
        </div>
    </footer>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').on('click', function() {
                $(this).siblings('.dropdown-menu').toggle();
            });
        });
    </script>
</body>

</html>