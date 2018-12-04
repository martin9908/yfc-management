<?PHP
	session_start();
	include("database/connect.php");

	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

	//Variables
	$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
	$usernumber = isset($_SESSION['User_Number']) ? $_SESSION['User_Number'] : null;
	$fname = isset($_POST['FName']) ? $_POST['FName'] : null;
	$mname = isset($_POST['MName']) ? $_POST['MName'] : null;
	$lname = isset($_POST['LName']) ? $_POST['LName'] : null;
	$address = isset($_POST['Address']) ? $_POST['Address'] : null;
	$cnum = isset($_POST['Contact_Number']) ? $_POST['Contact_Number'] : null;
	$pword = isset($_POST['Password']) ? $_POST['Password'] : null;

  function GetImageExtension($imagetype)
	 {
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
		$sql= mysqli_query($connect,"UPDATE `info_user`
						SET

						`First_Name` = '$fname',
						`Middle_Name` = '$mname',
						`Last_Name` = '$lname',
						`Address` = '$address',
						`Contact_Number` = '$cnum',
						`password` = '$pword',
						`account_picture` = '$target_path'

						WHERE `id` = $id;");
		if(!$sql){
			die('Error: ' . mysqli_error($connect));
		}

		mysqli_close($connect);
		new_variables($usernumber,$pword);
	}
	else
	{
		$sql= mysqli_query($connect,"UPDATE `info_user`
						SET

						`First_Name` = '$fname',
						`Middle_Name` = '$mname',
						`Last_Name` = '$lname',
						`Address` = '$address',
						`Contact_Number` = '$cnum',
						`password` = '$pword'

						WHERE `id` = $id;");
		if(!$sql){
			die('Error: ' . mysqli_error($connect));
		}

		mysqli_close($connect);
		new_variables($usernumber,$pword);
	}

function new_variables($username, $password){
	include("database/connect.php");

	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
	$query = mysqli_query($connect,
	"SELECT *
		FROM
			`info_user`,
			`info_sector`,
			`info_area`,
			`info_chapter`
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
			$_SESSION['id'] = $row['id'];
			$_SESSION['User_Number'] = $row['User_Number'];
			$_SESSION['First_Name'] = $row['First_Name'];
			$_SESSION['Middle_Name'] = $row['Middle_Name'];
			$_SESSION['Last_Name'] = $row['Last_Name'];
			$_SESSION['Address'] = $row['Address'];
			$_SESSION['Contact_Number'] = $row['Contact_Number'];
			$_SESSION['Account_Type'] = $row['Account_Type'];
			$_SESSION['Account_Status'] = $row['Account_Status'];
			$_SESSION['Area'] = $row['Area'];
			$_SESSION['Area_Name'] = $row['areaName'];
			$_SESSION['Sector'] = $row['Sector'];
			$_SESSION['Sector_Name'] = $row['sectorName'];
			$_SESSION['Chapter'] = $row['Chapter'];
			$_SESSION['Chapter_Name'] = $row['chapterName'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['Pic'] = $row['Account_Picture'];
		}

	mysqli_close($connect);

	}
}
?>
