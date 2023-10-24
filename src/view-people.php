<?php
require_once 'fetch-people-data.php';

// Create an instance of DataFetcher
$dataFetcher = new DataFetcher();

$dataFetcherPeople = new DataFetcher();
$dataFetcherRoleInCase = new DataFetcher();
$dataFetcherComplaint = new DataFetcher();
$dataFetcherFine = new DataFetcher();
$dataFetcherCourtOrder = new DataFetcher();

// Fetch data from each table
$dataPeople = $dataFetcherPeople->getPeopleData();
$dataRoleInCase = $dataFetcherRoleInCase->getRoleInCaseData();
$dataComplaint = $dataFetcherComplaint->getComplaintData();
$dataFine = $dataFetcherFine->getFineData();
$dataCourtOrder = $dataFetcherCourtOrder->getCourtOrderData();

?>
<!DOCTYPE html>
<html>

<head>
    <title>View People</title>
    <link rel="icon" type="image/png" href="../assets/logo.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 40px;
        }

        .input-group-append {
            margin-left: 400px;
        }

        th {
            background-color: rgb(120, 168, 235);
        }

        .form-control {
            background-color: lightblue;
        }

        .highlight {
            background-color: yellow;
        }

        .search-button {
            display: flex;
            justify-content: center;
        }

        /* Added margin to separate the "Select Place" dropdown and search button */
        .search-area {
            margin-bottom: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        th,
        td {
            font-size: 14px;
        }

        @media (max-width: 768px) {

            /* Adjust the margin for small screens */
            .input-group-append {
                margin-left: 0;
            }
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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="9">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown2" name="sortby" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sort By
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown2">
                                        <a class="dropdown-item" href="#">All</a>
                                        <a class="dropdown-item" href="#">Plantiff</a>
                                        <a class="dropdown-item" href="#">Culprit</a>
                                        <a class="dropdown-item" href="#">Suspect</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 text-right">
                                <!-- Search input moved to the right -->
                                <div class="search-button">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search">
                                    <button class="btn btn-secondary" type="button" id="searchButton">Search</button>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>NIC</th>
                    <th>Name</th>
                    <th>Com_ID</th>
                    <th>Role-In-Case<br>(Plantit/Victim/Suspect)</th>
                    <th>Com_Type</th>
                    <th>If Traffic On Click</th>
                    <th>Fine<br>(Paid/NotPaid/N/A)</th>
                    <th>Fine Deadline<br>Date/N/A</th>
                    <th>Next Coming Date</th>
                </tr>
            </thead>
            <tbody>
                <!-- dataPeople if not defined --> 
                <?php foreach ($dataPeople as $index => $row) : ?>
                    <tr>
                        <td><?php echo isset($row['nic']) ? $row['nic'] : 'N/A'; ?></td>
                        <td><?php echo isset($row['name']) ? $row['name'] : 'N/A'; ?></td>
                        <td><?php echo isset($dataRoleInCase[$index]['complaint_id']) ? $dataRoleInCase[$index]['complaint_id'] : 'N/A'; ?></td>
                        <td><?php echo isset($dataRoleInCase[$index]['role_in_case']) ? $dataRoleInCase[$index]['role_in_case'] : 'N/A'; ?></td>
                        <td><?php echo isset($dataComplaint[$index]['complaint_type']) ? $dataComplaint[$index]['complaint_type'] : 'N/A'; ?></td>
                        <td>N/A</td><!-- have to update -->
                        <td><?php echo isset($dataFine[$index]['fine_amount']) ? $dataFine[$index]['fine_amount'] : 'N/A'; ?></td>
                        <td><?php echo isset($dataFine[$index]['fine_deadline']) ? $dataFine[$index]['fine_deadline'] : 'N/A'; ?></td>
                        <td><?php echo isset($dataCourtOrder[$index]['next_court_date']) ? $dataCourtOrder[$index]['next_court_date'] : 'N/A'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tr>
                <td colspan="9">
                    <div class="btn-group">
                        <button class="btn btn-primary mr-4" data-toggle="modal" data-target="#emailModal">Send Email</button>
                        <form action="update-button-data-people.php" method="post">
                        <button type="submit" class="btn btn-secondary" name="updateButton" id="updateButton">Update Data</button>
                        </form>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>


    <!-- Adding modal for email sending -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailModalLabel">Send Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="emailForm">
                        <div class="form-group">
                            <label for="recipientEmail">Recipient Email:</label>
                            <input type="email" class="form-control" id="recipientEmail" name="recipientEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="recipientName">Recipient Name:</label>
                            <input type="text" class="form-control" id="recipientName" name="recipientName" required>
                        </div>
                        <div class="form-group">
                            <label for="emailSubject">Subject:</label>
                            <input type="text" class="form-control" id="emailSubject" name="emailSubject" required>
                        </div>
                        <div class="form-group">
                            <label for="emailBody">Message:</label>
                            <textarea class="form-control" id="emailBody" name="emailBody" rows="4" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sendEmailButton">Send Email</button>
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
        // $(document).ready(function() {
        $('.dropdown-toggle').on('click', function() {
            $(this).siblings('.dropdown-menu').toggle();
        });

        $('.dropdown-menu a').on('click', function() {
            var text = $(this).text();
            $(this).closest('.dropdown').find('.dropdown-toggle').text(text);
        });

        $(document).ready(function() {
            // Function to handle the search and highlighting
            function searchTable() {
                var input, filter, table, tr, td, i, txtValue;
                input = $("#searchInput");
                filter = input.val().toUpperCase();
                table = $("table")[0];
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, starting from index 1 to skip the header row
                for (i = 1; i < tr.length; i++) {
                    td = $(tr[i]).find("td:eq(4)"); // Column index 4 (Com_Type)
                    if (td) {
                        txtValue = td.text();
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            $(tr[i]).addClass("highlight");
                        } else {
                            $(tr[i]).removeClass("highlight");
                        }
                    }
                }
            }

            // Bind the searchTable function to the click event of the search button
            $("#searchButton").on("click", function() {
                searchTable();
            });
        });
        $(document).ready(function() {
            // Function to handle filtering based on "role_in_case" value
            function filterTableByRole(role) {
                var table = $("table")[0];
                var tr = table.getElementsByTagName("tr");

                // Loop through all table rows, starting from index 1 to skip the header row
                for (var i = 1; i < tr.length; i++) {
                    var roleInCaseCell = $(tr[i]).find("td:eq(3)"); // Column index 3 (Role-In-Case)

                    if (role === "All" || roleInCaseCell.text() === role) {
                        $(tr[i]).show(); // Show rows that match the selected role or show all rows for "All"
                    } else {
                        $(tr[i]).hide(); // Hide rows that do not match the selected role
                    }
                }
            }

            // Bind the filterTableByRole function to the click event of the "Sort By" dropdown menu options
            $(".dropdown-menu a").on("click", function() {
                var selectedRole = $(this).text();
                filterTableByRole(selectedRole);
            });
        });

        $(document).ready(function() {
    // handle the "Update Data" button click
    $("#updateButton").on("click", function(e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Make an AJAX request to the backend to update data
        $.ajax({
            type: "POST",
            url: "update-button-data-people.php", 
            data: {
                // Provide any data needed for the update
            },
            success: function(response) {
                // Handle the response here, update the table, and display the message
                if (response.message) {
                    alert(response.message);
                }
                if (response.insertedRows) {
                    // Update the table with the inserted rows
                    
                }
            },
            error: function(xhr, status, error) {
                // Handle the error here
                console.error(error);
            }
        });
    });
});


        $(document).ready(function() {
            // Handle click event of the "Send Email" button
            $("#sendEmailButton").on("click", function() {
                var recipientEmail = $("#recipientEmail").val();
                var emailSubject = $("#emailSubject").val();
                var emailBody = $("#emailBody").val();

                // Perform AJAX request to check if the email exists in the database
                $.ajax({
                    type: "POST",
                    url: "send_email.php", // PHP script to check if email exists in the database
                    data: {
                        recipientEmail: recipientEmail
                    },
                    success: function(response) {
                        if (response === "email_exists") {
                            // The email exists in the database, so proceed to send the email
                            sendEmail(recipientEmail, emailSubject, emailBody);
                        } else {
                            // The email does not exist in the database, show an error message
                            $(".modal-body").html('<div class="alert alert-danger" role="alert">The email address you provided does not exist in our records.</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Show error message in the modal body
                        $(".modal-body").html('<div class="alert alert-danger" role="alert">Failed to check email. Please try again later.</div>');
                    }
                });
            });

            // Function to send the email after checking recipient email in the database
            function sendEmail(recipientEmail, emailSubject, emailBody) {
                // Perform AJAX request to send the email
                $.ajax({
                    type: "POST",
                    url: "send_email.php", // PHP script to send the email
                    data: {
                        recipientEmail: recipientEmail,
                        emailSubject: emailSubject,
                        emailBody: emailBody
                    },
                    success: function(response) {
                        // Show success message in the modal body
                        $(".modal-body").html('<div class="alert alert-success" role="alert">Email sent successfully!</div>');
                        // Clear the email form after sending the email
                        $("#recipientEmail").val('');
                        $("#recipientName").val('');
                        $("#emailSubject").val('');
                        $("#emailBody").val('');
                        // Hide the "Send Email" button
                        $("#sendEmailButton").hide();
                    },
                    error: function(xhr, status, error) {
                        // Show error message in the modal body
                        $(".modal-body").html('<div class="alert alert-danger" role="alert">Failed to send email. Please try again later.</div>');
                    }
                });
            }

            // Clear the modal content when the modal is closed
            $("#emailModal").on("hidden.bs.modal", function() {
                $(".modal-body").html(""); // Clear the modal body content
                $("#sendEmailButton").show(); // Show the "Send Email" button again if it was hidden
            });
        });
    </script>
</body>

</html>