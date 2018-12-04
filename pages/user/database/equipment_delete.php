<?PHP 
	session_start();
	include("connect.php");
	
	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");	
	
	//Variables
	$idav_equipment = isset($_GET['ppid']) ? $_GET['ppid'] : null;
	
	//date("Y/m/d");
	//date("h:i:sa",strtotime('+'.$eqtime.' hours'));
	
	$sql= mysqli_query($connect,"DELETE FROM `info_av_equipment` WHERE `idav_equipment` = $idav_equipment");
	
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}
	
	mysqli_close($connect);
	echo "<script>
				alert('Deleted Successfully!');
				window.location.assign('../admin/equipment_management.php'); </script>";
?>