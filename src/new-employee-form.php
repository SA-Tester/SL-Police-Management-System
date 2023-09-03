<?php

use classes\Employee;

require_once './classes/class-employee.php';

if (isset($_POST['emplD'], $_POST['nic'], $_POST['first_name'], $_POST['last_name'], $_POST['dob'], $_POST['gender'], $_POST['tel_no'], $_POST['email'], $_POST['address'], $_POST['marital_status'], $_POST['rank'], $_POST['appointment_date'], $_POST['retired_status'],$_POST['username'])) {

    $emplD = strip_tags($_POST['emplD']);
    $nic = strip_tags($_POST['nic']);
    $first_name = strip_tags($_POST['first_name']);
    $last_name = strip_tags($_POST['last_name']);
    $dob = strip_tags($_POST['dob']);
    $gender = strip_tags($_POST['gender']);
    $tel_no = strip_tags($_POST['tel_no']);
    $email = strip_tags($_POST['email']);
    $address = strip_tags($_POST['address']);
    $marital_status = strip_tags($_POST['marital_status']);
    $rank = strip_tags($_POST['rank']);
    $appointment_date = strip_tags($_POST['appointment_date']);
    $retired_status = strip_tags($_POST['retired_status']);
    $username = strip_tags($_POST['username']);

    $register = new Employee($emplD, $nic, $first_name, $last_name, $dob, $gender, $tel_no, $email, $address, $marital_status, $rank, $appointment_date, $retired_status, $username);
    $register->register();
}