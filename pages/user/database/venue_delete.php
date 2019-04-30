<?PHP 
	session_start();
	include("connect.php");
	
	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");	
	
	//Variables
	$id = isset($_GET['ppid']) ? $_GET['ppid'] : null;
	
	$sql= mysqli_query($connect,"DELETE FROM reservation_venue
						
						WHERE `id` = $id;");
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}
	
	mysqli_close($connect);
	echo "<script> var oldURL = document.referrer;
				alert('Event Deleted!');
				window.location.assign(oldURL); </script>";
?>