<?PHP
session_start();
include("database/connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//Variables
$id = isset($_POST['IDNum']) ? $_POST['IDNum'] : null;
$usernumber = isset($_POST['UserID']) ? $_POST['UserID'] : null;
$fname = isset($_POST['FName']) ? $_POST['FName'] : null;
$mname = isset($_POST['MName']) ? $_POST['MName'] : null;
$lname = isset($_POST['LName']) ? $_POST['LName'] : null;
$address = isset($_POST['Address']) ? $_POST['Address'] : null;
$cnum = isset($_POST['ConNum']) ? $_POST['ConNum'] : null;
$Area = isset($_POST['Area']) ? $_POST['Area'] : null;
$Sector = isset($_POST['Sector']) ? $_POST['Sector'] : null;
$Chapter = isset($_POST['Chapter']) ? $_POST['Chapter'] : null;
$accttype = isset($_POST['Account_Type']) ? $_POST['Account_Type'] : null;
$area = isset($_POST['Area']) ? $_POST['Area'] : null;
$sector = isset($_POST['Sector']) ? $_POST['Sector'] : null;
$chapter = isset($_POST['Chapter']) ? $_POST['Chapter'] : null;
$pword = isset($_POST['Password']) ? $_POST['Password'] : null;

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
	$sql= mysqli_query($connect,"UPDATE `info_user`
					SET

					`First_Name` = '$fname',
					`Middle_Name` = '$mname',
					`Last_Name` = '$lname',
					`Address` = '$address',
					`Contact_Number` = '$cnum',
					`Account_Type` = $accttype,
					`Area` = $Area,
					`Sector` = $Sector,
					`Chapter` = $Chapter,
					`password` = '$pword',
					`account_picture` = '$target_path'
					WHERE `id` = $id;");
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}
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
					`Account_Type` = $accttype,
					`Area` = $Area,
					`Sector` = $Sector,
					`Chapter` = $Chapter,
					`password` = '$pword'

					WHERE `id` = $id;");
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}
}

$query = mysqli_query($connect,
"SELECT *
	FROM
		`info_user`,
		`info_sector`,
		`info_area`,
		`info_chapter`
	WHERE
		`User_Number`= '$id'
	AND
		`password`= '$pword'
	AND
		 info_sector.id = info_user.sector
	AND
		info_area.id = info_user.area
	AND
		info_chapter.id = info_user.chapter;");

mysqli_close($connect);
echo "<script> var oldURL = document.referrer;
	alert('Update Successful!');
	window.location.assign(oldURL); </script>";
?>
