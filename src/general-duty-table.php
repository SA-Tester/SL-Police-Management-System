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
            <form action="#" method="post" id="assignment-form">
                    <div class="form-group">
                        <label for="text1">Select Employee</label>
                        <input type="text" class="form-control" id="text1" name="empID" placeholder="Enter text">
                    </div>
                    <div class="form-group">
                                <label for="text1">Enter Duty type</label>
                                <input type="text" class="form-control" id="text2" name="duty_type" placeholder="Enter text">
                            </div>
                    <div class="form-group">
                                <label for="dropdown1">Duty Cause</label>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown1" name="duty_cause" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <input type="text" class="form-control" id="text2" name="start"  placeholder="Enter text">
                    </div>
                    <div class="form-group">
                        <label for="text3">Duty End Time</label>
                        <input type="text" class="form-control" id="text3" name="end" placeholder="Enter text">
                    </div>
                    
                    <div class="form-group">
                        <label for="dropdown2">Duty Place</label>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown2" name="location_id"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select location_id
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdown2">
                                <a class="dropdown-item" href="#">1</a>
                                <a class="dropdown-item" href="#">2</a>
                                <a class="dropdown-item" href="#">3</a>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="assign-btn" >Assign</button>
                    <button type="reset" class="btn btn-secondary">Remove</button>
                </form>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead class="thead">
                        <tr>
                            <th>Emp ID</th>
                            <th>Duty Type</th>
                            <th>Duty Cause</th>
                            <th>Duty Start Time</th>
                            <th>Duty End Time</th>
                            <th>Duty Place</th>
                           

                        </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                                    <!-- Add more rows dinamically -->
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
       $(document).ready(function () {
    function handleDropdown(dropdown) {
        $(dropdown).siblings('.dropdown-menu').toggle();
    }

    function handleDropdownItem(dropdown, item) {
        var text = $(item).text().trim();
        $(dropdown).text(text);
        $(dropdown).siblings('.dropdown-menu').toggle();
    }

    $('.dropdown-toggle').click(function () {
        handleDropdown(this);
    });

    $('.dropdown-item').click(function (event) {
        event.stopPropagation();
        var dropdownToggle = $(this).closest('.dropdown').find('.dropdown-toggle');
        handleDropdownItem(dropdownToggle, this);

        // Update the corresponding hidden input field with the selected value
        var inputField = $(dropdownToggle).siblings('input[type="hidden"]');
        inputField.val($(this).text().trim());
    });

    $('#assign-btn').click(function () {
        // Get the form data
        var formData = {
            empID: $('#text1').val(),
            duty_type: $('#text2').val(),
            duty_cause: $('#dropdown1-hidden').val(),
            start: $('#text3').val(),
            end: $('#text4').val(),
            location_id: $('#dropdown2-hidden').val()
        };

        // Validate the empID field
        if (formData.empID === "") {
            alert('Employee ID is required.');
            return; // Stop the form submission if empID is empty
        }

        // Send the form data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: 'submit-general-duty-table.php',
            data: formData,
            dataType: 'json',
            success: function (data) {
                // Handle the server response here
                if (data.status === 'success') {
                    // The form was successfully submitted, update the table with the new data
                    updateTable(data);
                    alert('Form submitted successfully!');
                } else {
                    
                    console.error('Server returned an error: ' + data.message);
                    alert('Error submitting the form. Please check the console for details.');
                }
            },
            error: function (xhr, status, error) {
                
                console.error('AJAX Error: ' + status, error);
                alert('Done and Assigned data');
            }
        });
    });

    function fetchTableData() {
        $.ajax({
            url: 'fetch-data-general-duty-table.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                updateTable(data);
            },
            error: function () {
                console.error('Error fetching data from the server.');
            }
        });
    }

    function updateTable(data) {
        const tableBody = $('#employeeTableBody'); // Use jQuery to select the table body
        tableBody.empty(); // Clear previous rows

        for (let i = 0; i < data.length; i++) {
            const newRow = $('<tr>');
            newRow.html(`
                <td>${data[i].empID}</td>
                <td>${data[i].duty_type}</td>
                <td>${data[i].duty_cause}</td>
                <td>${data[i].start}</td>
                <td>${data[i].end}</td>
                <td>${data[i].location_id}</td>
            `);
            tableBody.append(newRow); // Use jQuery to append the new row
        }
    }

    fetchTableData();
});

    </script>
    </body>

</html>
