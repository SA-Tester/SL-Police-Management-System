<?php
namespace classes;

use PDOException;
use PDO;
require_once './classes/class-db-connector.php.php';

$dbConnector = new DBConnector();
$con = $dbConnector->getConnection();

try {
    $sql = "SELECT tel_no FROM employee ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $telNumbers = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    // Handle errors if needed
    $telNumbers = [];
}
?>


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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal" name="btn-primary">Contact Other Officers</button>
                                
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
</div>

           
<div class="col-xl-4 col-sm-6 col-12">
   <div id="response-message"></div>
    
    <form class="contact" method="POST" action="general-email.php">
    <!-- Name -->
    <h1 class="title text-center mb-4">FOR CHANGE DUTIES</h1>  
    <div class="form-group position-relative">
        <label for="formName" class="d-block">
            <i class="icon" data-feather="user"></i>
        </label>
        <input type="text" id="formName" class="form-control form-control-lg thick" placeholder="Name" name="name">
    </div>

    <!-- E-mail -->
    <div class="form-group position-relative">
        <label for="formEmail" class="d-block">
            <i class="icon" data-feather="mail"></i>
        </label>
        <input type="email" id="formEmail" class="form-control form-control-lg thick" placeholder="E-mail" name="email">
    </div>

    <!-- Message -->
    <div class="form-group message">
        <textarea id="formMessage" class="form-control form-control-lg" rows="7" placeholder="Message" name="message"></textarea>
    </div>

    <!-- Submit btn -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary" tabIndex="-1">Send message</button>
    </div>
</form>
</div>
    
</div>
</div>
  
  

<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactModalLabel">Contact Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body">
  <p><strong>Telephone Numbers:</strong></p>
  <ul>
    <?php foreach ($telNumbers as $telNumber): ?>
      <li><?php echo $telNumber; ?></li>
    <?php endforeach; ?>
  </ul>
</div>

<!-- Include Bootstrap JS library -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const contactButton = document.querySelector(".btn-primary");

    contactButton.addEventListener("click", () => {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "general-get-tel-number.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const data = JSON.parse(xhr.responseText);
                    if (data.success) {
                        const telNumbers = data.telNumbers;
                        const telNumberList = telNumbers.join(', ');
                        document.querySelector("#telNumber").textContent = telNumberList;
                        const contactModal = new bootstrap.Modal(document.getElementById('contactModal'));
                        contactModal.show();
                    } else {
                        console.error("Failed to fetch telephone numbers:", data.error);
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                }
            }
        };
        xhr.send();
    });
});

document.addEventListener("DOMContentLoaded", function() {
  const form = document.querySelector(".contact");
  const responseMessage = document.querySelector("#response-message");

  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const formData = new FormData(form);

    try {
      const response = await fetch("general-email.php", {
        method: "POST",
        body: formData,
      });
      const data = await response.text();

      // Update the response message container with the response
      responseMessage.innerHTML = data;

      // Clear the form fields
      form.reset();
    } catch (error) {
      console.error("Error sending form data:", error);
    }
  });
});

</script>

</body>
</html>
