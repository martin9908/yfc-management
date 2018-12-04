<?PHP
	session_start();
	//Database Connection
	include ("database/connect.php");

	//Get ID
	$action = isset($_GET["ppid"]) ? $_GET["ppid"] : null;

	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

	//SQL Scripts
	$query = "UPDATE `reservation_venue`
						SET
						`reservation_status` = 'Reserved'
						WHERE `id` = $action;";
	$sql= mysqli_query($connect,$query);
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}

	mysqli_close($connect);
	echo "<script>
			alert('Update Successful!');
			window.location.assign('reserve_venue.php'); </script>";
?>
