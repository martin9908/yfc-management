<?PHP
	session_start();
	//Database Connection
	include ("connect.php");

	//Get ID
	$action = isset($_GET["ppid"]) ? $_GET["ppid"] : null;
	$remarks = isset($_GET["remarks"]) ? $_GET["remarks"] : null;

	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

	//SQL Scripts
	$query = "UPDATE `info_payment`
						SET
						`status` = 'Cancelled',
						`remarks` = '$remarks'
						WHERE `id` = $action;";
	$sql= mysqli_query($connect,$query);
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}

	//SQL Scripts
	$query1 = "UPDATE `info_attendance`
						SET
						`payment_status` = 'Cancelled',
						`remarks` = '$remarks'
						WHERE `id` = $action;";
	$sql= mysqli_query($connect,$query1);
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}

	mysqli_close($connect);

	// echo $query1;
	echo "<script>
				alert('Cancellation Complete');
				window.location.assign('reserve_venue.php'); </script>";
?>
