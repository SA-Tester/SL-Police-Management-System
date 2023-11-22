<?php

require_once($_SERVER['DOCUMENT_ROOT']."/sl-police/src/classes/class-db-connector.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/sl-police/src/pdf-library/TCPDF-main/tcpdf.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/sl-police/src/scripts/fill-complaint-study.php");

use classes\DBConnector;

// Extend the TCPDF class to create custom Header and Footer
class CaseReportPDF extends TCPDF {
    public $complaint_id;

    //Page header
    public function Header() {
        // Logo
        $image_file = "../../assets/logo.png";
        $this->Image($image_file, 10, 5, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        // Set font and Title
        $this->SetFont('helvetica', 'B', 20);
        $this->Cell(0, 20, 'Sri Lanka Police Department', 0, 2, 'C', 0, '', 0, false, 'M', 'B');

        // Set font and Subtitle
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 15, "Report of Complaint $this->complaint_id", 0, false, 'C', 0, '', 0, false, 'M', 'B');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


if (isset($_POST["generateReport"], $_POST["comp_id"]) && !empty($_POST["comp_id"])) {
    $complaint_id = strip_tags($_POST["comp_id"]);

    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();

    $complaintSummary = fillComplaintSummary($con, $complaint_id);
    $peopleAssociated = fillPeople($con, $complaint_id);
    $witnessDescriptions = fillWitnesses($con, $complaint_id);
    $photos = fillPhotos($con, $complaint_id);
    $fingerprints = fillFingerprints($con, $complaint_id);
    $courtMedicals = fillCourtMedicalReports($con, $complaint_id);
    $accidentCharts = fillAccidentCharts($con, $complaint_id);

    // To avoid headers already sent error
    ob_start();

    // Create New PDF Document. Initialize TCPDF
    $pdf = new CaseReportPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->complaint_id = $complaint_id;

    // Main Document Settings ============================================================================================================================
    // Set Document Information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Sri Lanka Police Department');
    $pdf->SetTitle('Case Study Report');
    $pdf->SetSubject("Report of Complaint $complaint_id");

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

    // set header and footer fonts
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // =================================================================================================================================================

    // Set font
    $pdf->SetFont('helvetica', '', 10);

    // Add a page
    $pdf->AddPage();

    $summaryTbl = <<<EOD
        <h1>Case Summary</h1>
        <table border="1" cellpadding="5">
            <thead>
                <tr style="text-align: center; font-weight: bold;">
                    <th>Criteria</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Complaint ID</td>
                    <td>$complaintSummary[0]</td>
                </tr>
                <tr>
                    <td>Date Recorded</td>
                    <td>$complaintSummary[1]</td>
                </tr>
                <tr>
                    <td>Plantiff NIC</td>
                    <td>$complaintSummary[3]</td>
                </tr>
                <tr>
                    <td>Plantiff Name</td>
                    <td>$complaintSummary[4]</td>
                </tr>
                <tr>
                    <td>Complaint Type</td>
                    <td>$complaintSummary[2]</td>
                </tr>
                <tr>
                    <td>Complaint Title</td>
                    <td>$complaintSummary[5]</td>
                </tr>
                <tr>
                    <td>Complaint In Words</td>
                    <td>$complaintSummary[6]</td>
                </tr>
                <tr>
                    <td>Recorded By (Employee ID)</td>
                    <td>$complaintSummary[7]</td>
                </tr>
                <tr>
                    <td>Recorded By (Employee Name)</td>
                    <td>$complaintSummary[8]</td>
                </tr>
            </tbody>
        </table>

        <h1>People Associated</h1>
        EOD;

    $pdf->writeHTML($summaryTbl, true, false, false, false, '');
    
    if($peopleAssociated != null){
        $peopleTbl = <<<EOD
        <br>
        <table border="1" cellpadding="5">
            <tr style="text-align: center; font-weight: bold;">
                <th>Role In Case</th>
                <th>NIC</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
            </tr>
        EOD;
        
        for ($i=0; $i < sizeof($peopleAssociated); $i++){
            $ric = $peopleAssociated[$i]["role_in_case"];
            $nic = $peopleAssociated[$i]["nic"];
            $name = $peopleAssociated[$i]["name"];
            $address = $peopleAssociated[$i]["address"];
            $contact = $peopleAssociated[$i]["contact"];
            $email = $peopleAssociated[$i]["email"];

            $peopleTbl .= <<<EOD
                <tr>
                    <td>$ric</td>
                    <td>$nic</td>
                    <td>$name</td>
                    <td>$address</td>
                    <td>$contact</td>
                    <td>$email</td>
                </tr>
            EOD;
        }

        $peopleTbl .= <<<EOD
                    </tbody>
                </table>

                <h1>Witness Descriptions</h1>
                EOD;
        
        $pdf->writeHTML($peopleTbl, true, false, false, false, '');
    }
    else{
        $html = <<<EOD
                <p>None</p>
                <h1>Witness Descriptions</h1>
                EOD;

        $pdf->writeHTML($html, true, false, false, false, ''); 
    }

    if($witnessDescriptions != null){
        $witnessTable = <<<EOD
                <table border="1" cellpadding="5">
                    <tr style="text-align: center; font-weight: bold;">
                        <th>NIC</th>
                        <th>Description</th>
                    </tr>
                EOD;

        for ($i=0; $i < sizeof($witnessDescriptions); $i++){
            $nic = $witnessDescriptions[$i]["nic"];
            $desc = $witnessDescriptions[$i]["witness_description"];

            $witnessTable .= <<<EOD
                <tr>
                    <td>$nic</td>
                    <td>$desc</td>
                </tr>
                EOD;
        }

        $witnessTable .= <<<EOD
                </table>
                <h1>Photos</h1>
                EOD;

        $pdf->writeHTML($witnessTable, true, false, false, false, ''); 
    }
    else{
        $html = <<<EOD
                <p>None</p>
                <h1>Photos</h1>
                EOD;

        $pdf->writeHTML($html, true, false, false, false, ''); 
    }

    $y = 175;
    if($photos != null){
        for($i=0; $i < sizeof($photos); $i++){

            $path = $_SERVER['DOCUMENT_ROOT']. "sl-police/" . $photos[$i][0];

            $data = explode(".", $path);
            $extension = end($data);

            $pdf->Image($path, 30, $y, 100, 100, strtoupper($extension), '', 'T', false, 300, '', false, false, 0, false, false, false);
            $y += 103;
        }
        $pdf->setY($y + 3);
        $pdf->writeHTML("<h1>Fingerprints</h1>", true, false, false, false, '');
    }
    else{
        $html = <<<EOD
        <p>None</p>
        <h1>Fingerprints</h1>
        EOD;
        
        $pdf->writeHTML($html, true, false, false, false, '');
    }

    if($fingerprints != null){
        for($i=0; $i < sizeof($fingerprints); $i++){

            $path = $_SERVER['DOCUMENT_ROOT']. "sl-police/" . $fingerprints[$i][0];

            $data = explode(".", $path);
            $extension = end($data);

            $pdf->Image($path, 30, $y, 150, 250, strtoupper($extension), '', 'T', false, 300, '', false, false, 0, false, false, false);
            $y += 253;
        }
        $pdf->setY($y + 3);
        $pdf->writeHTML("<h1>Court Medical Reports</h1>", true, false, false, false, '');
    }
    else{
        $html = <<<EOD
        <p>None</p>
        <h1>Court Medical Reports</h1>
        EOD;

        $pdf->writeHTML($html, true, false, false, false, '');
    }

    if($courtMedicals != null){
        for($i=0; $i < sizeof($courtMedicals); $i++){

            $path = $_SERVER['DOCUMENT_ROOT']. "sl-police/" . $courtMedicals[$i][0];

            $data = explode(".", $path);
            $extension = end($data);

            $pdf->Image($path, 30, $y, 150, 250, strtoupper($extension), '', 'T', false, 300, '', false, false, 0, false, false, false);
            $y += 253;
        }
        $pdf->setY($y + 3);
        $pdf->writeHTML("<h1>Accident Charts</h1>", true, false, false, false, '');
    }
    else{
        $html = <<<EOD
        <p>None</p>
        <h1>Accident Charts</h1>
        EOD;

        $pdf->writeHTML($html, true, false, false, false, '');
    }

    if($accidentCharts != null){
        for($i=0; $i < sizeof($accidentCharts); $i++){

            $path = $_SERVER['DOCUMENT_ROOT']. "sl-police/" . $accidentCharts[$i][0];

            $data = explode(".", $path);
            $extension = end($data);

            $pdf->Image($path, 30, $y, 150, 150, strtoupper($extension), '', 'T', false, 300, '', false, false, 0, false, false, false);
            $y += 153;
        }
        $pdf->setY($y);
        $pdf->writeHTML("<hr width='100'>", true, false, false, false, '');
    }
    else{
        $html = <<<EOD
        <p>None</p>
        <hr width='100'>
        EOD;

        $pdf->writeHTML($html, true, false, false, false, '');
    }

    // To avoid "Content is already written error"
    ob_end_clean(); 

    // Close and output PDF document 
    $pdf->Output("Report of Complaint $complaint_id.pdf", 'I');

} else {
    header("Location: ../complaint-study.php?status=false&msg=Report Generation Failed");
}