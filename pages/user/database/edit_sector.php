<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$id = isset($_POST['SectorID']) ? $_POST['SectorID'] : null;
$sectorName = isset($_POST['SectorName']) ? $_POST['SectorName'] : null;
$areaID = isset($_POST['Area']) ? $_POST['Area'] : null;

$sql= mysqli_query($connect,
  "UPDATE `info_sector`
  SET
    `sectorName` = '$sectorName',
    `areaId` = $areaID
  WHERE `id` = $id;");

if(!$sql){
  die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      alert('Update Successful!');
      window.location.assign('../manage_sector.php'); </script>";
?>
