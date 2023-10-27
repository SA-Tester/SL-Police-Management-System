<?php

require "./classes/class-db-connector.php";
use classes\DBConnector;
require_once 'fetch-people-data.php'; 


$dataFetcher = new DataFetcher();

// Fetch data from the tables 
$dataPeople = $dataFetcher->getPeopleData();
$dataRoleInCase = $dataFetcher->getRoleInCaseData();
$dataComplaint = $dataFetcher->getComplaintData();
$dataFine = $dataFetcher->getFineData();
$dataCourtOrder = $dataFetcher->getCourtOrderData();


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
              <th>Fine </th>
              <th>Fine Deadline</th>
              <th>Next Court Date</th>
            
        </tr>';
    

foreach ($dataPeople as $index => $row) {
    echo '<tr>';
    echo '<td>' . (isset($row['nic']) ? $row['nic'] : 'N/A') . '</td>';
    echo '<td>' . (isset($row['name']) ? $row['name'] : 'N/A') . '</td>';
    echo '<td>' . (isset($dataRoleInCase[$index]['complaint_id']) ? $dataRoleInCase[$index]['complaint_id'] : 'N/A') . '</td>';
    echo '<td>' . (isset($dataRoleInCase[$index]['role_in_case']) ? $dataRoleInCase[$index]['role_in_case'] : 'N/A') . '</td>';
    echo '<td>' . (isset($dataComplaint[$index]['complaint_type']) ? $dataComplaint[$index]['complaint_type'] : 'N/A') . '</td>';
    echo '<td>' . (isset($dataFine[$index]['fine_amount']) ? $dataFine[$index]['fine_amount'] : 'N/A') . '</td>';
    echo '<td>' . (isset($dataFine[$index]['fine_deadline']) ? $dataFine[$index]['fine_deadline'] : 'N/A') . '</td>';
    echo '<td>' . (isset($dataCourtOrder[$index]['next_court_date']) ? $dataCourtOrder[$index]['next_court_date'] : 'N/A') . '</td>';
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
?>
