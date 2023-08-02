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
                <tr>
                    <td>Data 1</td>
                    <td>Data 2</td>
                    <td>Data 3</td>
                    <td>Data 4</td>
                    <td>Data 5</td>
                    <td>Data 6</td>
                    <td>Data 7</td>
                    <td>Column 8</td>
                    <td>Column 9</td>
                </tr>
                <tr>
                    <td>Data 8</td>
                    <td>Data 9</td>
                    <td>Data 10</td>
                    <td>Data 11</td>
                    <td>Data 12</td>
                    <td>Data 13</td>
                    <td>Data 14</td>
                    <td>Column 15</td>
                    <td>Column 16</td>
                </tr>
                <!-- Add more rows as needed -->
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