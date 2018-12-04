<?PHP 
	session_start();
	include("connect.php");
	
	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");	
	
	//Variables
	$id = isset($_GET['ppid']) ? $_GET['ppid'] : null;
	
	$sql= mysqli_query($connect,"DELETE FROM info_user
						
						WHERE `id` = $id;");
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}
	
	mysqli_close($connect);
	echo "<script> var oldURL = document.referrer;
				alert('User Deleted!');
				window.location.assign(oldURL); </script>";
?>