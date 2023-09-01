<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginForm.php");
    exit();
}

require_once "./classes/class-db-connector.php";
use classes\DBConnector;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $formCurrentPassword = $_POST["current_password"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];
    $username = $_SESSION['username'];

    //get current password from db
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();

    $result = $con->query("SELECT password FROM login WHERE username='$username'");
    $currentPassword = $result->fetch(PDO::FETCH_ASSOC)['password'];

    // Check if new password and confirm password match
    if ($currentPassword != $formCurrentPassword) {
        header('Location:change-password.php?error=Entered current password is invalid!');
    }
    elseif ($newPassword != $confirmPassword){
        header('Location:change-password.php?error=Confirm passwords do not match!');
    }
    else {
        //update new password in db
        $result = $con->query("UPDATE login SET password='$newPassword' WHERE username='$username'");
        if($result->rowCount()==0){
            header('Location:change-password.php?error=Something went wrong! Please try again');
        }
        else{
            header('Location:change-password.php?success=Password changed successfully!');
        }

    }
}

?>


