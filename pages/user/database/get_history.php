<?php

	include("connect.php");

	$notify = "";
	$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
	
	$connect = mysqli_connect($host, $user, $dbpass) or die("Couldn't connect to database!");	
	mysqli_select_db($database) or die("Couldn't find ".$database."!");
	$query = mysqli_query($connect,"CALL `Proc_BasicHistory`($id);");
	Get_Venue($query);
	
	function Get_Venue(){
		$query = mysqli_query($connect,"CALL `Proc_BasicHistory`($id);");
		while($row = mysqli_fetch_assoc($query))
		{	
		
		}
	}
?> 
</body>
</html>