<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/check-availability.css">

    <title>Check Avalability</title>
    <link rel="icon" type="image/png" href="../assets/logo.png">
</head>

<body>
    <!------------------navbar---------------------------->
    <?php
        include 'navbar.php';
        renderNavBar();
    ?>
    <!---------------------------------------------------->

    <div class="container-fluid mt-4 mb-2">
        <div class="row">
            <div class="col-md-12">
                <h3 style="color:#101D6B"><b>Check Employee Avalability</b></h3>
                <div class="table-responsive" id="avalability-table">
                    <table class="table mt-5">
                        <thead class="thead-edit">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Employee ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Duty</th>
                                <th scope="col">Avalability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td data-title="ID">ss</td>
                                <td data-title="Name">ss</td>
                                <td data-title="Contact">ss</td>
                                <td data-title="Duty">ss</td>
                                <td data-title="Avalability">ss</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td data-title="ID">ss</td>
                                <td data-title="Name">ss</td>
                                <td data-title="Contact">ss</td>
                                <td data-title="Duty">ss</td>
                                <td data-title="Avalability">ss</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td data-title="ID">ss</td>
                                <td data-title="Name">ss</td>
                                <td data-title="Contact">ss</td>
                                <td data-title="Duty">ss</td>
                                <td data-title="Avalability">ss</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td data-title="ID">ss</td>
                                <td data-title="Name">ss</td>
                                <td data-title="Contact">ss</td>
                                <td data-title="Duty">ss</td>
                                <td data-title="Avalability">ss</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <footer class="py-5 mt-5" style="background-color: #101D6B;">
        <div class="container text-light text-center">
            <p class="display-5 mb-3">Sri Lanka Police</p>
            <small class="text-white-50">&copy; Copyright. All right reserved</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

</body>

</html>