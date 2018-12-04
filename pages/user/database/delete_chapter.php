<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$ChapterID = isset($_GET['ppid']) ? $_GET['ppid'] : null;

$sql= mysqli_query($connect,
  "DELETE FROM `info_chapter`
  WHERE `id` = $ChapterID;");

if(!$sql){
  die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      alert('Deleted Successfully!');
      window.location.assign('../manage_chapter.php'); </script>";
?>
