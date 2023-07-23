<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../CSS/calculate-salary.css">
    <link rel="stylesheet" href="../CSS/submit-leave-medical.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Leave Request</title>
    <link rel="icon" type="image/png" href="../assets/logo.png">
</head>

<body>
    <!------------------navbar---------------------------->
    <?php
        include 'navbar.php';
        renderNavBar();
    ?>
    <!---------------------------------------------------->

    <div>
        <div class="row mt-5">
            <div class="col-50">
                <h4 class="h4 mt-5">Leave Application</h4>

                <!-- <?php
                if (isset($_GET["message"])) {
                    if ($_GET["message"] == 1) {
                        echo "<div class='alert'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Successfully Saved!</strong></div>";
                     } elseif ($_GET["message"] == 2) {
                        echo "<div class='error'><span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span><strong>Error Occurred!</strong></div>";
                     }
                }
                ?> -->

                <div class="containerx">
                    <form action="apply-leave.php" method="POST">
                        <div class="row">
                            <div class="col-25">
                                <label for="emp_id">Emp ID</label>
                            </div>
                            <div class="col-75">
                                <select id="emp_id" name="emp_id" required>
                                    <option value="EMP0001">EMP0001</option>
                                    <option value="EMP0002">EMP0002</option>
                                    <option value="EMP0003">EMP0003</option>
                                    <option value="EMP0004">EMP0004</option>
                                    <option value="EMP0005">EMP0005</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="from_date">From</label>
                            </div>
                            <div class="col-75">
                                <input type="date" id="from_date" name="from_date" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="to_date">To</label>
                            </div>
                            <div class="col-75">
                                <input type="date" id="to_date" name="to_date" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="reason_type">Reason Type</label>
                            </div>
                            <div class="col-75">
                                <select id="reason_type" name="reason_type" required>
                                    <option value="Personal">Personal</option>
                                    <option value="Health">Health</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="reason_desc">Reason Description </label>
                            </div>
                            <div class="col-75">
                                <textarea id="reason_desc" name="reason_desc" placeholder="Write something.."
                                    style="height:200px" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="upload_medical">Upload Medical</label>
                            </div>
                            <div class="col-75">
                                <input type="file" id="upload_medical" name="upload_medical"/>
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" class="btn1 buttons" value="SUBMIT">
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-50 mt-5">
                <h4 class="h4">Leave History</h4>
                <div class="row">
                    <div class="col-md" style="overflow-x: auto;">
                        <table class="table-con">
                            <thead>
                                <tr>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Duration (Days)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2023/05/05</td>
                                    <td>2023/05/10</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>2023/06/05</td>
                                    <td>2023/06/08</td>
                                    <td>3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>