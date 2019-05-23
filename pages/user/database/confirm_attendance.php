<?PHP
	session_start();
	//Database Connection
	include ("connect.php");

	//Get ID
	$user_id = isset($_GET["ppid"]) ? $_GET["ppid"] : null;
	$status = isset($_GET["status"]) ? $_GET["status"] : null;
	$event_id = isset($_GET["event_id"]) ? $_GET["event_id"] : null;
	
	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

	//SQL Scripts
	$query = "UPDATE `info_attendance`
						SET
						`payment_status` = '$status'
						WHERE `user_id` = $user_id
						AND `event_id` = $event_id;";
						
	$sql= mysqli_query($connect,$query);
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}

	mysqli_close($connect);
	// echo $query1;
	echo "<script>
				alert('Update Complete');
				window.location.assign('../reports.php'); </script>";
?>
