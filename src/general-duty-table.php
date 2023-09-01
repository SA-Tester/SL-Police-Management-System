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
        <div class="row">
            <div class="col-md-6">
                <form>
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
         $(document).ready(function() {
                function handleDropdown(dropdown) {
                    $(dropdown).siblings('.dropdown-menu').toggle();
                }

                function handleDropdownItem(dropdown, item) {
                    var text = $(item).text().trim();
                    $(dropdown).text(text);
                    $(dropdown).siblings('.dropdown-menu').toggle();
                }

                $('.dropdown-toggle').click(function() {
                    handleDropdown(this);
                });

                $('.dropdown-item').click(function(event) {
                    event.stopPropagation();
                    handleDropdownItem($(this).closest('.dropdown').find('.dropdown-toggle'), this);
                });

             $('#assign-btn').click(function() {
    // Get the form data
    var formData = {
      empID: $('#text1').val(),
      duty_type: $('#text2').val(),
      duty_cause: $('#dropdown1').text().trim(),
      start: $('#text3').val(),
      end: $('#text4').val(),
      location_id: $('#dropdown2').text().trim()
    };

    // Validate the empID field
    if (formData.empID === "") {
      alert('Employee ID is required.');
      return; // Stop the form submission if empID is empty
    }

    // Send the form data to the server using AJAX
    $.ajax({
      type: 'POST',
      url: 'submit_general_duty_table.php',
      data: JSON.stringify(formData),
      dataType: 'json',
      contentType: 'application/json',
      success: function(data) {
        // Handle the server response here
        if (data.status === 'success') {
          // The form was successfully submitted, update the table with the new data
          updateTable(data);
          alert('Form submitted successfully!');
        } else {
          // The form submission encountered an error
          alert('Error submitting the form.');
        }
      },
      error: function() {
        // An error occurred during the AJAX request
        alert('Error submitting the form.');
      }
    });
  });

                function fetchTableData() {
                    $.ajax({
                        url: 'fetch_data_general_duty_table.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            updateTable(data);
                        },
                        error: function() {
                            console.error('Error fetching data from the server.');
                        }
                    });
                }

                function updateTable(data) {
                    const tableBody = document.getElementById('employeeTableBody');
                    tableBody.innerHTML = '';

                    for (let i = 0; i < data.length; i++) {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${data[i].empID}</td>
                            <td>${data[i].duty_type}</td>
                            <td>${data[i].duty_cause}</td> 
                            <td>${data[i].start}</td>
                            <td>${data[i].end}</td>
                            <td>${data[i].location_id}</td>
                        `;
                        tableBody.appendChild(newRow);
                    }
                }

                fetchTableData();
            });
    </script>
</body>

</html>