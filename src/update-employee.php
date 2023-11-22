<?php
session_start();
if (!isset($_SESSION['empID'])) {
    header("Location: login.php");
    exit();
}
//
require_once "./classes/class-db-connector.php";
use classes\DBConnector;

$dbcon = new DBConnector();
$con = $dbcon->getConnection();
$employeeId = $_SESSION['empID'] ;


if (isset(  $_POST['first_name'], $_POST['last_name'], $_POST['dob'], $_POST['tel_no'], $_POST['email'], $_POST['address'], $_POST['marital_status'])) {


    // Gather all the updated form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $dob = $_POST['dob'];
    $telNo = $_POST['tel_no'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $maritalStatus = $_POST['marital_status'];


    // Update the employee details in the database
    $sql = "UPDATE employee SET  first_name = :first_name, last_name = :last_name, dob = :dob,  tel_no = :tel_no, email = :email, address = :address, marital_status = :marital_status WHERE empID = :empID";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':tel_no', $telNo);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':marital_status', $maritalStatus);
 
    $stmt->bindParam(':empID', $employeeId);

    if ($stmt->execute()) {
        // Success! Redirect or show a success message.
        header("Location: update-personal-details.php"); // Redirect to a success page
        exit();
    } else {
        // Handle error
        echo "Error updating employee details.";
    }
}
?>
