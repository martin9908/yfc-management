<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$areaName = isset($_POST['AreaName']) ? $_POST['AreaName'] : null;

$sql= mysqli_query($connect,
  "INSERT INTO `info_area`
  (
    `areaName`
  )
  VALUES
  (
    '$areaName'
  );");

if(!$sql){
  die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      alert('Create Successful!');
      window.location.assign('../manage_area.php'); </script>";
?>
