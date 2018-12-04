<?php

	include("connect.php");

	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

	$notify = "";
	$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
	if($_SESSION['Account_Type'] == 0){
		$query = "CALL `Proc_Stud_Info`($id);";
		Get_Student($query, $connect);
	}

	else if($_SESSION['Account_Type'] == 2){
		$query = "CALL `Proc_Faculty_Info`($id);";
		Get_Faculty($query, $connect);
	}

	else if($_SESSION['Account_Type'] == 1){
		$query = "CALL `Proc_Admin_Info`($id);";
		Get_Admin($query, $connect);
	}

	function Get_Student($sql, $connect){
		$query = mysqli_query($connect,$sql);
		if(!$query)
		{
			//die ('Unable to run query:');
			/*echo "<script>alert('Invalid username or password!!!!');</script>";*/
		}
		$numrows = mysqli_num_rows($query);
		if($numrows!=0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$_SESSION['id'] = $row['id'];
				$_SESSION['User_Number'] = $row['User_Number'];
				$_SESSION['First_Name'] = $row['First_Name'];
				$_SESSION['Middle_Name'] = $row['Middle_Name'];
				$_SESSION['Last_Name'] = $row['Last_Name'];
				$_SESSION['Address'] = $row['Address'];
				$_SESSION['Contact_Number'] = $row['Contact_Number'];
				$_SESSION['Account_Type'] = $row['Account_Type'];
				$_SESSION['Account_Status'] = $row['Account_Status'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['Account_Name'] = $row['Account_Name'];
				$_SESSION['Area'] = $row['Area'];
				$_SESSION['Sector'] = $row['Sector'];
				$_SESSION['Hire_Date'] = $row['Member_Since'];
			}
		}
		mysqli_close($connect);
	}

	function Get_Faculty($sql, $connect){
		$query = mysqli_query($connect,$sql);
		if(!$query)
		{
			//die ('Unable to run query:');
			/*echo "<script>alert('Invalid username or password!!!!');</script>";*/
		}
		$numrows = mysqli_num_rows($query);
		if($numrows!=0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$_SESSION['id'] = $row['id'];
				$_SESSION['User_Number'] = $row['User_Number'];
				$_SESSION['First_Name'] = $row['First_Name'];
				$_SESSION['Middle_Name'] = $row['Middle_Name'];
				$_SESSION['Last_Name'] = $row['Last_Name'];
				$_SESSION['Address'] = $row['Address'];
				$_SESSION['Contact_Number'] = $row['Contact_Number'];
				$_SESSION['Account_Type'] = $row['Account_Type'];
				$_SESSION['Account_Status'] = $row['Account_Status'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['Account_Name'] = $row['Account_Name'];
				$_SESSION['Area'] = $row['Area'];
				$_SESSION['Sector'] = $row['Sector'];
				$_SESSION['Hire_Date'] = $row['Hire_Date'];
			}
		}
		mysqli_close($connect);
	}

	function Get_Admin($sql, $connect){
		$query = mysqli_query($connect,$sql);
		if(!$query)
		{
			//die ('Unable to run query:');
			/*echo "<script>alert('Invalid username or password!!!!');</script>";*/
		}
		$numrows = mysqli_num_rows($query);
		if($numrows!=0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$_SESSION['id'] = $row['id'];
				$_SESSION['User_Number'] = $row['User_Number'];
				$_SESSION['First_Name'] = $row['First_Name'];
				$_SESSION['Middle_Name'] = $row['Middle_Name'];
				$_SESSION['Last_Name'] = $row['Last_Name'];
				$_SESSION['Address'] = $row['Address'];
				$_SESSION['Contact_Number'] = $row['Contact_Number'];
				$_SESSION['Account_Type'] = $row['Account_Type'];
				$_SESSION['Account_Status'] = $row['Account_Status'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['Account_Name'] = $row['Account_Name'];
				$_SESSION['Area'] = $row['Area'];
				$_SESSION['Sector'] = $row['Sector'];
				$_SESSION['Hire_Date'] = $row['Hire_Date'];
			}
		}
		mysqli_close($connect);
	}

?>
</body>
</html>
