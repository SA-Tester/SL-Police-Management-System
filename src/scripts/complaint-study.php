<?php

require_once("../classes/db-connector.php");
require_once("../classes/class-complaints.php");
require_once("../classes/class-people.php");
require_once("../classes/class-employee.php");

use classes\DBConnector;
use classes\Complaints;
use classes\People;
use classes\Employee;

if(isset($_REQUEST["comp_id"])){
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();

    $complaint_id = $_REQUEST["comp_id"];

    $complaint = new Complaints();
    $person = new People("", "", "", "", "");
    $employee = new Employee("", "", "", "", "", "", "", "", "", "", "", "", "", "");

    $complaint->setCon($con);
    $complaint->setComplaintID($complaint_id);
    $complaint->initComplaint();

    $date = $complaint->getDate();
    $plantiff_nic = "";
    $plantiff_name = "";
    $category = $complaint->getCategory();
    $title = $complaint->getTitle();
    $description = $complaint->getDescription();
    
    $employee_id = $complaint->getEmpID();
    $employee_name = "";

    /*
    let comp_id = document.getElementById("comp_id");
        let comp_date = document.getElementById("comp_date");
        let plantiff_nic = document.getElementById("plantiff_nic");
        let plantiff_name = document.getElementById("plantiff_name");
        let comp_category = document.getElementById("comp_category");
        let comp_title = document.getElementById("comp_title");
        let comp_desc = document.getElementById("comp_desc");
        let emp_id = document.getElementById("emp_id");
        let emp_name = document.getElementById("emp_name");
    */
}