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
	$Email = isset($_POST['Email']) ? $_POST['Email'] : null;
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
						`Email`,
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
							'$Email',
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
						`Email`,
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
							'$Email',
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
	}
?>
<!doctype html>
<html>
	<body>
	<script type='text/javascript'>
			// var clientId = '209949321684-4lid4e7pvesh7t8ru67j2iknad3a88g0.apps.googleusercontent.com';
			var clientId = '209949321684-cjvpni96ps2pflf6mcr6on68i5ijj99i.apps.googleusercontent.com';
			var apiKey = 'AIzaSyA5adh0KnT66TacJX1DTxARONG1YWN1Tk4';
			var scopes =
				'https://www.googleapis.com/auth/gmail.readonly '+
				'https://www.googleapis.com/auth/gmail.send';
			function handleClientLoad() {
				gapi.client.setApiKey(apiKey);
				window.setTimeout(checkAuth, 1);
			}

			function checkAuth() {
				gapi.auth.authorize({
					client_id: clientId,
					scope: scopes,
					immediate: true
				}, handleAuthResult);
			}

			function handleAuthResult(authResult) {
        if(authResult && !authResult.error) {
          loadGmailApi();
        } 
			}
			
			function loadGmailApi() {
				gapi.client.load('gmail', 'v1', sendMessage);
			}
			
			function loadPreviousScreen(){
				alert('Created Successfully!');
				window.location.assign('user_management.php');
			}
				
			function sendMessage() 
			{
				var email = '';
				var headers_obj = {
					'To' : '<?php echo $_POST['Email'] ?>',
					'Subject' : 'Account Has Been Created'
				}


				for(var header in headers_obj)
					email += header += ':'+headers_obj[header]+'\r\n';

				email += '\r\n' + "Your account is now created! You can now use the YFC App just login using your YFC ID number: <?php echo $_POST['IDNum'] ?> and <?php echo $_POST['LName'] ?> as your password!";

				var sendRequest = gapi.client.gmail.users.messages.send({
					'userId': 'me',
					'resource': {
						'raw': window.btoa(email).replace(/\+/g, '-').replace(/\//g, '_')
					}
				});

				return sendRequest.execute(loadPreviousScreen);
			}
		</script>
		<script src='https://apis.google.com/js/client.js?onload=handleClientLoad'></script>
	</body>
</html>