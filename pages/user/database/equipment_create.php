<?PHP 
	session_start();
	include("connect.php");
	
	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");	
	
	//Variables
	$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
	$idav_equipment = isset($_SESSION['ppid']) ? $_SESSION['ppid'] : null;
	$accession_number = isset($_POST['accnum']) ? $_POST['accnum'] : null;
	$equipment_name = isset($_POST['eqname']) ? $_POST['eqname'] : null;
	$equipment_type = isset($_POST['eqtype']) ? $_POST['eqtype'] : null;
	$equipment_description = isset($_POST['eqdesc']) ? $_POST['eqdesc'] : null;
	$equipment_value = isset($_POST['eqval']) ? $_POST['eqval'] : null;
	$equipment_avail = isset($_POST['eqavail']) ? $_POST['eqavail'] : null;
	$allowable_hours = isset($_POST['eqtime']) ? $_POST['eqtime'] : null;
	
	//date("Y/m/d");
	//date("h:i:sa",strtotime('+'.$eqtime.' hours'));
	
	$sql= mysqli_query($connect,"CALL `Proc_EquipmentCreate`(
									'$accession_number', 
									'$equipment_name', 
									'$equipment_type', 
									'$equipment_description', 
									$equipment_value, 
									$equipment_avail, 
									$allowable_hours);");
	
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}
	
	mysqli_close($connect);
	echo "<script>
				alert('Created Successfully!');
				window.location.assign('../equipment_management.php'); </script>";
?>