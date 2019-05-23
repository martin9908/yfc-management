<?php
//include connection file 
include_once("connection.php");
include_once('library/fpdf.php');
 
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('yfc_logo.gif',10,-1,20);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Attendance List',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$ppid = isset($_GET['ppid']) ? $_GET['ppid'] : null;

$db = new dbObj();
$connString =  $db->getConnstring();
$display_heading = array('id'=>'ID', 'user_id'=> 'First Name', 'event_id'=> 'Last Name','attendance_remarks'=> 'Remarks', 'payment_status'=> 'Status');
 
$result = mysqli_query($connString, "SELECT User_Number, First_Name, Last_Name, attendance_remarks, payment_status FROM info_attendance INNER JOIN info_user ON info_attendance.user_id = info_user.id WHERE event_id = $ppid") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM info_attendance");
 
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);
foreach($header as $heading) {
$pdf->Cell(38,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(38,12,$column,1);
}
$pdf->Output();
?>