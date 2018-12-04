<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$chapterName = isset($_POST['ChapterName']) ? $_POST['ChapterName'] : null;
$sectorID = isset($_POST['Sector']) ? $_POST['Sector'] : null;

$sql= mysqli_query($connect,
  "INSERT INTO `info_chapter`
  (
    `chapterName`,
    `sectorId`
  )
  VALUES
  (
    '$chapterName',
    $sectorID
  );");

if(!$sql){
  die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      alert('Create Successful!');
      window.location.assign('../manage_chapter.php'); </script>";
?>
