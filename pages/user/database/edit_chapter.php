<?php
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$id = isset($_POST['ChapterID']) ? $_POST['ChapterID'] : null;
$chapterName = isset($_POST['ChapterName']) ? $_POST['ChapterName'] : null;
$sectorID = isset($_POST['Sector']) ? $_POST['Sector'] : null;

$sql= mysqli_query($connect,
  "UPDATE `info_chapter`
  SET
    `chapterName` = '$chapterName',
    `sectorId` = $sectorID
  WHERE `id` = $id;");

if(!$sql){
  die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script>
      alert('Update Successful!');
      window.location.assign('../manage_chapter.php'); </script>";
?>
