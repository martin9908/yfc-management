<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$sectorName = isset($_POST['SectorName']) ? $_POST['SectorName'] : null;
$areaID = isset($_POST['Area']) ? $_POST['Area'] : null;

$sql= mysqli_query($connect,
  "INSERT INTO `info_sector`
  (
    `sectorName`,
    `areaId`
  )
  VALUES
  (
    '$sectorName',
    $areaID
  );");

if(!$sql){
  die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      alert('Create Successful!');
      window.location.assign('../manage_sector.php'); </script>";
?>
