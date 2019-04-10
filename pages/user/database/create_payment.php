<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$user_id = isset($_SESSION['payment_user']) ? $_SESSION['payment_user'] : null;
$event_id = isset($_SESSION['event_id']) ? $_SESSION['event_id'] : null;
$payment_type = isset($_SESSION['payment_type']) ? $_SESSION['payment_type'] : null;
$payment_date = date("Y-m-d");
$payment_time = date("h:i:s");
$payment_made = isset($_SESSION['reservation_fee']) ? $_SESSION['reservation_fee'] : null;
$payment_reference = isset($_POST['payment_reference']) ? $_POST['payment_reference'] : null;
$Account_Type = isset($_SESSION['Account_Type']) ? $_SESSION['Account_Type'] : null;

//Add to Session
$_SESSION['payment_reference'] = isset($_POST['payment_reference']) ? $_POST['payment_reference'] : null;

if($Account_Type == 0){
  $remarks = 'Pending';
} else if ($Account_Type != 0 && $payment_type == 'bank'){
  $remarks = 'Pending';
} else {
  $remarks = 'Paid';
}

echo ("INSERT INTO info_payment
(
`user_id`,
`event_id`,
`pament_type`,
`payment_date`,
`pament_time`,
`payment_made`,
`payment_reference`,
`status`)
VALUES
(
$user_id,
'$event_id',
'$payment_type',
'$payment_date',
'$payment_time',
'$payment_made',
'$payment_reference',
'$remarks');
");

$sql= mysqli_query($connect,"INSERT INTO info_payment
(
`user_id`,
`event_id`,
`pament_type`,
`payment_date`,
`pament_time`,
`payment_made`,
`payment_reference`,
`status`)
VALUES
(
$user_id,
'$event_id',
'$payment_type',
'$payment_date',
'$payment_time',
'$payment_made',
'$payment_reference',
'$remarks');
");

if(!$sql){
  die('Error_1: ' . mysqli_error($connect));
}

$sql1= mysqli_query($connect, "INSERT INTO info_attendance
(
`user_id`,
`event_id`,
`payment_status`,
`remarks`)
VALUES
(
'$user_id',
'$event_id',
'$remarks',
'joined');");

if(!$sql){
  die('Error_2: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      window.location.assign('../payments/page_4.php'); </script>";
?>
