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
     th, td {
        font-size: 14px;
      }
    
    @media (max-width: 768px) {
      /* Adjust the margin for small screens */
      .input-group-append {
        margin-left: 0;
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
            <?php foreach ($dataPeople as $index => $row): ?>
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
            <tfoot>
                <tr>
                    <td colspan="9">
                        <button class="btn btn-primary">Send Email</button>
                        <div class="btn-group">
                            <button class="btn btn-secondary" id="dropdownMenuButton" data-toggle="dropdown">
                                Update
                            </button>

                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
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
            $('.dropdown-toggle').on('click', function () {
                $(this).siblings('.dropdown-menu').toggle();
            });
        });
    </script>
</body>

</html>