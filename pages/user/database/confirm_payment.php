<?PHP
	session_start();
	//Database Connection
	include ("connect.php");

	//Get ID
	$action = isset($_GET["ppid"]) ? $_GET["ppid"] : null;
	$remarks = isset($_GET["remarks"]) ? $_GET["remarks"] : null;
  $processed_by = isset($_GET["processed_by"]) ? $_GET["processed_by"] : null;

	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

	//SQL Scripts
	$query = "UPDATE `info_payment`
						SET
						`status` = 'Paid',
						`remarks` = '$remarks',
            `processed_by` = '$processed_by'
						WHERE `event_id` = $action;";
	$sql= mysqli_query($connect,$query);
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}

	//SQL Scripts
	$query1 = "UPDATE `info_attendance`
						SET
						`payment_status` = 'Paid',
						`remarks` = '$remarks'
						WHERE `event_id` = $action;";
	$sql= mysqli_query($connect,$query1);
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}

	mysqli_close($connect);
	echo "<script>
				alert('Payment Complete');
				window.location.assign('../payment_management.php'); </script>";
?>
