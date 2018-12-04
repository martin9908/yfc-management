<?PHP
	session_start();
	include("connect.php");

	//Variables
	$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
	$user_number = isset($_SESSION['User_Number']) ? $_SESSION['User_Number'] : null;
	$reservation_date = isset($_POST['sdate']) ? $_POST['sdate'] : null;
	$reservation_end_date = isset($_POST['edate']) ? $_POST['edate'] : null;
	//$ = date("Y/m/d",$vdate);
	$reservation_time = isset($_POST['stime']) ? $_POST['stime'] : null;
	$reservation_end_time = isset($_POST['etime']) ? $_POST['etime'] : null;
	$reservation_event = isset($_POST['vevent']) ? $_POST['vevent'] : null;
	$reservation_place = isset($_POST['vname']) ? $_POST['vname'] : null;
	$reservation_status = isset($_POST['status']) ? $_POST['status'] : null;;
	$area = isset($_POST['area']) ? $_POST['area'] : null;
	$sector = isset($_POST['sector']) ? $_POST['sector'] : null;
	$chapter = isset($_POST['chapter']) ? $_POST['chapter'] : null;
	$fee = isset($_POST['fee']) ? $_POST['fee'] : null;
	$type = isset($_POST['type']) ? $_POST['type'] : null;

	//date("Y/m/d");
	//date("h:i:sa",strtotime('+'.$eqtime.' hours'));
	reserve();

	function reserve(){
		$connect = mysqli_connect($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['databasename']) or die("Couldn't connect to database!");

		$sql= mysqli_query($connect,
					"INSERT INTO `reservation_venue`
						(
							`reservation_date`,
							`reservation_end_date`,
							`reservation_time`,
							`reservation_end_time`,
							`reservation_event`,
							`reservation_place`,
							`reservation_status`,
							`reservation_area`,
							`reservation_sector`,
							`reservation_chapter`,
							`reservation_fee`,
						  `event_type`
						)
						VALUES
						(".
							"'".$GLOBALS['reservation_date']."',".
							"'".$GLOBALS['reservation_end_date']."',".
							"'".$GLOBALS['reservation_time']."',".
							"'".$GLOBALS['reservation_end_time']."',".
							"'".$GLOBALS['reservation_event']."',".
							"'".$GLOBALS['reservation_place']."',".
							"'".$GLOBALS['reservation_status']."',".
							$GLOBALS['area'].",".
							$GLOBALS['sector'].",".
							$GLOBALS['chapter'].",".
							$GLOBALS['fee'].",".
							"'".$GLOBALS['type']."');");
		if(!$sql){
			die('Error: ' . mysqli_error($connect));
		}

		mysqli_close($connect);
		echo "<script>
					alert('Event Created!');
					window.location.assign('../reserve_venue.php'); </script>";
	}
?>
