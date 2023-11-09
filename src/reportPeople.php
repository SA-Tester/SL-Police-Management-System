<?php

require "./classes/class-db-connector.php";
use classes\DBConnector;
require_once 'fetch-people-data.php'; 

$dataFetcher = new DataFetcher();

// Fetch data from the tables 
$dataPeople = $dataFetcher->getPeopleData();

$dataComplaint = $dataFetcher->getComplaintData();

echo '<!DOCTYPE html>
<html>
<head>
    <title>People Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>People Report</h1>
    
    <table>
        <tr>
            <th>NIC</th>
            <th>Name</th>
            <th>Com_ID</th>
            <th>Role in Case</th>
            <th>Com Type</th>
            <th>Fine</th>
            <th>Fine Deadline</th>
            <th>Next Court Date</th>
        </tr>';

foreach ($dataPeople as $index => $row) {
    $nic = isset($row['nic']) ? $row['nic'] : 'N/A';
    $roleInCaseData = $dataFetcher->getRoleInCaseData($nic);
    $courtOrderData = $dataFetcher->getCourtOrderData($nic);
    $dataFineData = $dataFetcher->getFineData($nic);

    echo '<tr>';
    echo '<td>' . (isset($row['nic']) ? $row['nic'] : 'N/A') . '</td>';
    echo '<td>' . (isset($row['name']) ? $row['name'] : 'N/A') . '</td>';
    echo '<td>' . (isset($roleInCaseData[0]['complaint_id']) ? $roleInCaseData[0]['complaint_id'] : 'N/A') . '</td>';
    echo '<td>' . (isset($roleInCaseData[0]['role_in_case']) ? $roleInCaseData[0]['role_in_case'] : 'N/A') . '</td>';
    echo '<td>' . (isset($dataComplaint[$index]['complaint_type']) ? $dataComplaint[$index]['complaint_type'] : 'N/A') . '</td>';
    echo '<td>' . (isset($dataFineData[0]['fine_amount']) ? $dataFineData[0]['fine_amount'] : 'N/A') . '</td>';
    echo '<td>' . (isset($dataFineData[0]['temp_license_end_date']) ? $dataFineData[0]['temp_license_end_date'] : 'N/A') . '</td>';
    echo '<td>' . (isset($courtOrderData[0]['next_court_date']) ? $courtOrderData[0]['next_court_date'] : 'N/A') . '</td>';
    echo '</tr>';
}

echo '</table>
<br>
<br>
<form method="post" action="generate-pdf.php?generate-pdf=true">
    <input type="submit" name="download_pdf" value="Download PDF">
</form>
</body>
</html>';
