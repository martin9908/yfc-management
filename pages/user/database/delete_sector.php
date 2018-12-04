<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$SectorID = isset($_GET['ppid']) ? $_GET['ppid'] : null;

$sql= mysqli_query($connect,
  "DELETE FROM `info_sector`
  WHERE `id` = $SectorID;");

if(!$sql){
  die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      alert('Deleted Successfully!');
      window.location.assign('../manage_sector.php'); </script>";
?>
