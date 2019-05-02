<?php
	session_start();
	include("connect.php");

	$notify = "";
	$username =isset($_GET['username']) ? $_GET['username'] : null;
	$password = isset($_GET['password']) ? $_GET['password'] : null;

	$connect = mysqli_connect($host, $user, $dbpass,$database) or die("Couldn't connect to database!");
	$query = mysqli_query($connect,
	"SELECT *
		FROM
			`info_sector`,
			`info_area`,
			`info_chapter`,
			`info_user`
		WHERE
			`User_Number`= '$username'
		AND
			`password`= '$password'
		AND
			info_sector.id = info_user.sector
		AND
			info_area.id = info_user.area
		AND
			info_chapter.id = info_user.chapter;");


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
			$dbpassword = $row['password'];
			$dbaccounttype = $row['Account_Type'];
			if($password == $dbpassword)
			{
				$_SESSION['id'] = $row['id'];
				$_SESSION['User_Number'] = $row['User_Number'];
				$_SESSION['First_Name'] = $row['First_Name'];
				$_SESSION['Middle_Name'] = $row['Middle_Name'];
				$_SESSION['Last_Name'] = $row['Last_Name'];
				$_SESSION['Address'] = $row['Address'];
				$_SESSION['Gender'] = $row['Gender'];
				$_SESSION['Contact_Number'] = $row['Contact_Number'];
				$_SESSION['Account_Type'] = $row['Account_Type'];
				$_SESSION['Account_Status'] = $row['Account_Status'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['Area'] = $row['Area'];
				$_SESSION['Area_Name'] = $row['areaName'];
				$_SESSION['Sector'] = $row['Sector'];
				$_SESSION['Sector_Name'] = $row['sectorName'];
				$_SESSION['Chapter'] = $row['Chapter'];
				$_SESSION['Chapter_Name'] = $row['chapterName'];
				$_SESSION['Member_Since'] = $row['Member_Since'];
				$_SESSION['Pic'] = $row['Account_Picture'];
			}
			if($row['Account_Status'] == 'Active')
			{
				echo "<script> alert('Welcome ".$row['First_Name'].' '.$row['Last_Name']."');
				window.location.assign('../user/index.php'); </script>";
			}
			else if ($row['Account_Status'] == 'Pending')
			{
				echo "<script> alert('Account still being verified by Administrator');
								window.location.assign('../login.php'); </script>";
			}
		}
	}

	else
	{
		echo "<script> alert('Invalid Username and/or Password');
						window.location.assign('../login.php'); </script>";

		//header("Location: ../login.html");
	}

?>
</body>
</html>
