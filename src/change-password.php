<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginForm.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/index.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!--boostrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <title>Change Password</title>
    <link rel="icon" type="image/png" href="../assets/logo.png"/>
</head>

<body>
<!------------------navbar---------------------------->
<?php
include 'navbar.php';
renderNavBar();
?>
<!---------------------------------------------------->

<br><br><br><br>
<?php
if (isset($_GET['error'])){
    echo '<h6 style="text-align: center;color: red">'.$_GET['error'].'</h6>';
}elseif (isset($_GET['success'])){
    echo '<h6 style="text-align: center;color: springgreen">'.$_GET['success'].'</h6>';
}
?>
<div class="container mt-5 card" style="padding: 40px;margin-top: 15px !important; width: 40%;background-color: lavender">
    <h3 class="card-title" style="color: darkblue;text-align: center;padding-bottom: 15px">Change Password</h3>
    <form action="validate-password-change.php" method="post">
        <div class="form-group">
            <label for="current_password" style="font-weight: bold">Current Password:</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="form-group">
            <label for="new_password" style="font-weight: bold">New Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password" style="font-weight: bold">Confirm New Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <div style="display: flex;justify-content: center;margin-top: 40px">
            <button type="submit" class="btn btn-primary" style="background-color: darkblue;color: white; font-weight: bold;border: transparent">Submit</button>
        </div>
    </form>
</div>

</body>

