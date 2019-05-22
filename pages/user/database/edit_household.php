<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$household_id = isset($_POST['household_id']) ? $_POST['household_id'] : null;
$household_name = isset($_POST['household_name']) ? $_POST['household_name'] : null;
$household_leader = isset($_POST['household_leader']) ? $_POST['household_leader'] : null;

$sql= mysqli_query($connect,
  "UPDATE `household`
  SET
  `household_name` = '$household_name',
  `household_leader` = $household_leader
  WHERE `idhousehold` = $household_id;");

if(!$sql){
  die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      alert('Update Successful!');
      window.location.assign('../user_household.php'); </script>";
?>
