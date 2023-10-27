<?php

include('./pdf-library/TCPDF-main/tcpdf.php');

require_once('./pdf-library/TCPDF-main/tcpdf.php');

 
if (isset($_GET['generate-pdf']) && $_GET['generate-pdf'] == 'true') {
    require "./classes/class-db-connector.php";
    
    require_once 'fetch-people-data.php';

    $dataFetcher = new DataFetcher();

    // Fetch data from the tables
    $dataPeople = $dataFetcher->getPeopleData();
    $dataRoleInCase = $dataFetcher->getRoleInCaseData();
    $dataComplaint = $dataFetcher->getComplaintData();
    $dataFine = $dataFetcher->getFineData();
    $dataCourtOrder = $dataFetcher->getCourtOrderData();

    // Create a new PDF document
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator('Slpolice');
    $pdf->SetAuthor('Slpolice');
    $pdf->SetTitle('People Report');

    // Add a page
    $pdf->AddPage();

$html = '<h1>People Report</h1>';

$html .= '<table style="width: 100%;">';
$html .= '<col width="30mm">';
$html .= '<col width="30mm">';
$html .= '<col width="20mm">';
$html .= '<col width="30mm">';
$html .= '<col width="30mm">';
$html .= '<col width="20mm">';
$html .= '<col width="20mm">';
$html .= '<col width="20mm">';

$html .= '<tr>';
$html .= '<th>NIC</th>';
$html .= '<th>Name</th>';
$html .= '<th>Com_ID</th>';
$html .= '<th>Role in Case</th>';
$html .= '<th>Com Type</th>';
$html .= '<th>Fine</th>';
$html .= '<th>Fine Deadline</th>';
$html .= '<th>Next Court Date</th>';
$html .= '</tr>';

// Fetch data from the tables and add it to the PDF
foreach ($dataPeople as $index => $row) {
    $html .= '<tr>';
    $html .= '<td>' . (isset($row['nic']) ? $row['nic'] : 'N/A') . '</td>';
    $html .= '<td>' . (isset($row['name']) ? $row['name'] : 'N/A') . '</td>';
    $html .= '<td>' . (isset($dataRoleInCase[$index]['complaint_id']) ? $dataRoleInCase[$index]['complaint_id'] : 'N/A') . '</td>';
    $html .= '<td>' . (isset($dataRoleInCase[$index]['role_in_case']) ? $dataRoleInCase[$index]['role_in_case'] : 'N/A') . '</td>';
    $html .= '<td>' . (isset($dataComplaint[$index]['complaint_type']) ? $dataComplaint[$index]['complaint_type'] : 'N/A') . '</td>';
    $html .= '<td>' . (isset($dataFine[$index]['fine_amount']) ? $dataFine[$index]['fine_amount'] : 'N/A') . '</td>';
    $html .= '<td>' . (isset($dataFine[$index]['fine_deadline']) ? $dataFine[$index]['fine_deadline'] : 'N/A') . '</td>';
    $html .= '<td>' . (isset($dataCourtOrder[$index]['next_court_date']) ? $dataCourtOrder[$index]['next_court_date'] : 'N/A') . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';

    // Write the HTML content to the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output the PDF as a download
    $pdf->Output('People Report.pdf', 'D');
} else {
    echo 'Invalid request.';
}