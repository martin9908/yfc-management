<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$household_name = isset($_POST['household_name']) ? $_POST['household_name'] : null;
$household_leader = isset($_POST['household_leader']) ? $_POST['household_leader'] : null;
$household_members = isset($_POST['household_members']) ? $_POST['household_members'] : null;
$json_members = json_encode($household_members);
$sql= mysqli_query($connect,
  "INSERT INTO `household`
  (
    `household_name`,
    `household_leader`,
    `household_members`
  )
  VALUES
  (
    '$household_name',
    $household_leader,
    '$json_members'
  );");

if(!$sql){
  die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      alert('Create Successful!');
      window.location.assign('../user_household.php'); </script>";
?>
