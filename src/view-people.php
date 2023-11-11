<?php
session_start();


require_once "./classes/class-db-connector.php";
use classes\DBConnector;

if(isset($_SESSION["user_id"], $_SESSION["role"], $_SESSION["username"])){
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();




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
$dataComplaint = $dataFetcherComplaint->getComplaintData();


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
                   
                    <th>Fine<br>(Paid/NotPaid/N/A)</th>
                    <th>Fine Deadline<br>Date/N/A</th>
                    <th>Next Coming Date</th>
                </tr>
            </thead>
            <tbody>
            
            <?php foreach ($dataPeople as $index => $row) : ?>
                    <?php
                    $nic = isset($row['nic']) ? $row['nic'] : 'N/A';
                    $roleInCaseData = $dataFetcherRoleInCase->getRoleInCaseData($nic);
                    $courtOrderData = $dataFetcherCourtOrder->getCourtOrderData($nic);
                    $dataFineData = $dataFetcherFine->getFineData($nic);
                    ?>
                    <tr>
                        <td><?php echo $nic; ?></td>
                        <td><?php echo isset($row['name']) ? $row['name'] : 'N/A'; ?></td>
                        <td><?php echo isset($roleInCaseData[0]['complaint_id']) ? $roleInCaseData[0]['complaint_id'] : 'N/A'; ?></td>
                        <td><?php echo isset($roleInCaseData[0]['role_in_case']) ? $roleInCaseData[0]['role_in_case'] : 'N/A'; ?></td>
                        <td><?php echo isset($dataComplaint[$index]['complaint_type']) ? $dataComplaint[$index]['complaint_type'] : 'N/A'; ?></td>
                        <td><?php echo isset($dataFineData[0]['fine_amount']) ? $dataFineData[0]['fine_amount'] : 'N/A'; ?></td>
                        <td><?php echo isset($dataFineData[0]['temp_license_end_date']) ? $dataFineData[0]['temp_license_end_date'] : 'N/A'; ?></td>
                        <td><?php echo isset($courtOrderData[0]['next_court_date']) ? $courtOrderData[0]['next_court_date'] : 'N/A'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tr>
                <td colspan="9">
                    <div class="btn-group">
                    <form method="post" action="send-email.php">
                    <button type="submit" class="btn btn-primary" name="submit">Send emails</button>
                </form>
                        <form action="update-button-data-people.php" method="post">
                        <button type="submit" class="btn btn-secondary" name="updateButton" id="updateButton">Update Data</button>
                        </form>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>



    <button class="btn btn-success" id="generateReportButton">Generate Report</button>  

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


        $("#updateButton").on("click", function(e) {
            e.preventDefault(); 
            // Make an AJAX request to the backend to update data
            $.ajax({
                type: "POST",
                url: "update-button-data-people.php", 
                data: {
                    // Provide any data needed for the update (if necessary)
                },
                success: function(response) {
                    // Handle the response here, update the table, and display the messages
                    if (response.message) {
                        alert(response.message);
                    }
                    if (response.insertedRows) {
                        // Update the table with the inserted rows (if needed)
                    }
                    if (response.updateMessages) {
                        alert(response.updateMessages.join("\n"));
                    }
                },
                error: function(xhr, status, error) {
                    
                    console.error(error);
                }
            });
        });
       


    //Generate report
    $(document).ready(function() {
     // Handle the "Generate Report" button click
      $("#generateReportButton").on("click", function() {
    // Make an AJAX request to the PHP script for report generation
      $.ajax({
      type: "GET", 
      url: "reportPeople.php", 
      success: function(response) {
        // Create a new browser window or tab to display the report
        var reportWindow = window.open();
        reportWindow.document.write(response);
      },
      error: function(xhr, status, error) {
        // Handle the error 
        console.error(error);
      }
    });
  });
});






    </script>
</body>

</html>
<?php
}
else{
    header("Location: loginForm.php");
}
?>