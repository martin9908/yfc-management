<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$id = isset($_POST['AreaID']) ? $_POST['AreaID'] : null;
$areaName = isset($_POST['AreaName']) ? $_POST['AreaName'] : null;

$sql= mysqli_query($connect,
  "UPDATE `info_area`
SET
`areaName` = '$areaName'
WHERE `id` = $id;
");

if(!$sql){
  die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      alert('Update Successful!');
      window.location.assign('../manage_area.php'); </script>";
?>
