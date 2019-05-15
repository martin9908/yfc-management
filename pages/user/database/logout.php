<?PHP
	session_start();
	session_destroy();
	echo "<script> alert('Successfully Logged Out!');
				window.location.assign('../../login.php'); </script>";
?>