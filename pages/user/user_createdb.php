<?PHP
	session_start();
	include("database/connect.php");

	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass, $databasename) or die("Couldn't connect to database!");

	//Variables
	$IDNum = isset($_POST['IDNum']) ? $_POST['IDNum'] : null;
	$FName = isset($_POST['FName']) ? $_POST['FName'] : null;
	$MName = isset($_POST['MName']) ? $_POST['MName'] : null;
	$LName = isset($_POST['LName']) ? $_POST['LName'] : null;
	$Address = isset($_POST['Address']) ? $_POST['Address'] : null;
	$Gender = isset($_POST['Gender']) ? $_POST['Gender'] : null;
	$ConNum = isset($_POST['ConNum']) ? $_POST['ConNum'] : null;
	$Area = isset($_POST['Area']) ? $_POST['Area'] : null;
	$Sector = isset($_POST['Sector']) ? $_POST['Sector'] : null;
	$Chapter = isset($_POST['Chapter']) ? $_POST['Chapter'] : null;
	$Gender = isset($_POST['Gender']) ? $_POST['Gender'] : null;
	$Member_Since = isset($_POST['Member_Since']) ? $_POST['Member_Since'] : null;
	$Date = date("Y-m-d", strtotime($Member_Since));
	$Account_Status = isset($_POST['Account_Status']) ? $_POST['Account_Status'] : null;
	$Account_Type = isset($_POST['Account_Type']) ? $_POST['Account_Type'] : null;
	$NoImage = null;

	function GetImageExtension($imagetype){
		if(empty($imagetype)) return false;
		switch($imagetype)
		{
		 case 'image/bmp': return '.bmp';
		 case 'image/gif': return '.gif';
		 case 'image/jpeg': return '.jpg';
		 case 'image/png': return '.png';
		 default: return false;
		}
	}

	if (!empty($_FILES["uploadedimage"]["name"])) {
		$file_name=$_FILES["uploadedimage"]["name"];
		$temp_name=$_FILES["uploadedimage"]["tmp_name"];
		$imgtype=$_FILES["uploadedimage"]["type"];
		$ext= GetImageExtension($imgtype);
		$imagename=date("d-m-Y")."-".time().$ext;
		$target_path = "images/".$imagename;

		move_uploaded_file($temp_name, $target_path);
		$sql= mysqli_query($connect,
					"INSERT INTO `info_user`
						(`User_Number`,
						`First_Name`,
						`Middle_Name`,
						`Last_Name`,
						`Address`,
						`Gender`,
						`Contact_Number`,
						`Account_Type`,
						`Area`,
						`Sector`,
						`Chapter`,
						`Member_Since`,
						`Account_Status`,
						`password`,
						`Account_Picture`)
						VALUES
						(
							'$IDNum',
							'$FName',
							'$MName',
							'$LName',
							'$Address',
							'$Gender',
							'$ConNum',
							'$Account_Type',
							'$Area',
							'$Sector',
							'$Chapter',
							'$Date',
							'Active',
							'$LName',
							'$target_path');");
		if(!$sql){
			die('Error: ' . mysqli_error($connect));
		}

		mysqli_close($connect);
		echo "<script>
					alert('Created Successfully!');
					window.location.assign('user_management.php'); </script>";
	}
	else
	{
		$sql= mysqli_query($connect,
					"INSERT INTO `info_user`
						(`User_Number`,
						`First_Name`,
						`Middle_Name`,
						`Last_Name`,
						`Address`,
						`Gender`,
						`Contact_Number`,
						`Account_Type`,
						`Area`,
						`Sector`,
						`Chapter`,
						`Member_Since`,
						`Account_Status`,
						`password`)
						VALUES
						(
							'$IDNum',
							'$FName',
							'$MName',
							'$LName',
							'$Address',
							'$Gender',
							'$ConNum',
							'$Account_Type',
							'$Area',
							'$Sector',
							'$Chapter',
							'$Date',
							'Active',
							'$LName');");
		if(!$sql){
			die('Error: ' . mysqli_error($connect));
		}

		mysqli_close($connect);
		echo "<script>
					alert('Created Successfully!');
					window.location.assign('user_management.php'); </script>";
	}
?>
