<?PHP
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$id = isset($_POST['id']) ? $_POST['id'] : null;
$reservation_place = isset($_POST['reservation_place']) ? $_POST['reservation_place'] : null;
$reservation_date = isset($_POST['reservation_date']) ? $_POST['reservation_date'] : null;
$reservation_time = isset($_POST['reservation_time']) ? $_POST['reservation_time'] : null;
$reservation_end_date = isset($_POST['reservation_end_date']) ? $_POST['reservation_end_date'] : null;
$reservation_end_time = isset($_POST['reservation_end_time']) ? $_POST['reservation_end_time'] : null;
$event_type = isset($_POST['event_type']) ? $_POST['event_type'] : null;
$reservation_event = isset($_POST['reservation_event']) ? $_POST['reservation_event'] : null;
$reservation_status = isset($_POST['reservation_status']) ? $_POST['reservation_status'] : null;
$reservation_area = isset($_POST['reservation_area']) ? $_POST['reservation_area'] : null;
$reservation_sector = isset($_POST['reservation_sector']) ? $_POST['reservation_sector'] : null;
$reservation_chapter = isset($_POST['reservation_chapter']) ? $_POST['reservation_chapter'] : null;
$reservation_fee = isset($_POST['reservation_fee']) ? $_POST['reservation_fee'] : null;

$query = "UPDATE `reservation_venue`
SET
`reservation_place` = '$reservation_place',
`reservation_date` = '$reservation_date',
`reservation_end_date` = '$reservation_end_date',
`reservation_time` = '$reservation_time',
`reservation_end_time` = '$reservation_end_time',
`event_type` = '$event_type',
`reservation_event` = '$reservation_event',
`reservation_status` = '$reservation_status',
`reservation_area` = $reservation_area,
`reservation_sector` = $reservation_sector,
`reservation_chapter` = $reservation_chapter,
`reservation_fee` = $reservation_fee

WHERE `id` = $id";

$sql= mysqli_query($connect, $query);
if(!$sql){
	die('Error: ' . mysqli_error($connect));
}

mysqli_close($connect);
echo "<script> var oldURL = document.referrer;
	alert('Update Successful!');
	window.location.assign(oldURL); </script>";
?>
