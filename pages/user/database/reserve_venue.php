<?PHP
	session_start();
	// include("PushNotification.php");
	include("connect.php");

	//Variables
	//User Account
	$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
	$user_number = isset($_SESSION['User_Number']) ? $_SESSION['User_Number'] : null;

	//Event Details
	$reservation_date = isset($_POST['sdate']) ? $_POST['sdate'] : null;
	$reservation_end_date = isset($_POST['edate']) ? $_POST['edate'] : null;
	//$ = date("Y/m/d",$vdate);
	$reservation_time = isset($_POST['stime']) ? $_POST['stime'] : null;
	$reservation_end_time = isset($_POST['etime']) ? $_POST['etime'] : null;
	$reservation_event = isset($_POST['vevent']) ? $_POST['vevent'] : null;
	$reservation_place = isset($_POST['vname']) ? $_POST['vname'] : null;
	$reservation_status = isset($_POST['status']) ? $_POST['status'] : null;;
	$area = isset($_POST['area']) ? $_POST['area'] : null;
	$sector = isset($_POST['sector']) ? $_POST['sector'] : null;
	$chapter = isset($_POST['chapter']) ? $_POST['chapter'] : null;
	$fee = isset($_POST['fee']) ? $_POST['fee'] : null;
	$type = isset($_POST['type']) ? $_POST['type'] : null;

	//date("Y/m/d");
	//date("h:i:sa",strtotime('+'.$eqtime.' hours'));
	reserve();

	function reserve(){
		$connect = mysqli_connect($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['databasename']) or die("Couldn't connect to database!");

		$sql= mysqli_query($connect,
					"INSERT INTO `reservation_venue`
						(
							`reservation_date`,
							`reservation_end_date`,
							`reservation_time`,
							`reservation_end_time`,
							`reservation_event`,
							`reservation_place`,
							`reservation_status`,
							`reservation_area`,
							`reservation_sector`,
							`reservation_chapter`,
							`reservation_fee`,
						  `event_type`
						)
						VALUES
						(".
							"'".$GLOBALS['reservation_date']."',".
							"'".$GLOBALS['reservation_end_date']."',".
							"'".$GLOBALS['reservation_time']."',".
							"'".$GLOBALS['reservation_end_time']."',".
							"'".$GLOBALS['reservation_event']."',".
							"'".$GLOBALS['reservation_place']."',".
							"'".$GLOBALS['reservation_status']."',".
							$GLOBALS['area'].",".
							$GLOBALS['sector'].",".
							$GLOBALS['chapter'].",".
							$GLOBALS['fee'].",".
							"'".$GLOBALS['type']."');");
		if(!$sql){
			die('Error: ' . mysqli_error($connect));
		} 
		// else {
		// 	require_once 'database/firebase/firebase.php';

		// 	// paste here getting fcm registration device token
		// 	$devicetoken [] = "dCgnXuMuC7s:APA91bEWvmUkAyYGyZ6VIS4KDhOHSTv8Eb8ZNEmWIRQQBWyrIcsN-J41gmKAN33QZIl6siiFcRoTs1vcxh_kZ8nPfk1u57XP28SoANe38ne4qgUPYZnYEL-R9cHjsdrEXQQ70FIrbyb7";

		// 	// create array that contains notification details
		// 	$res = array();

		// 	//push title, message, & image url for big notification  like as below
		// 	$res['data']['title'] = "YFC APP";
		// 	$res['data']['message'] = "A New Event is Available!";

		// 	/* //push title, message for small notification like as below
		// 	$res['data']['title'] = "FCM Demo";
		// 	$res['data']['message'] = "Testing message";*/


		// 	//creating firebase class object
		// 	$firebase = new Firebase();

		// 	//sending push notification and displaying result
		// 	echo $firebase->send($devicetoken, $res);
		// }

		mysqli_close($connect);
	}
?>
<!doctype html>
<html>
	<body>
	<script type='text/javascript'>
		var userData = [];

		const userAction = async () => {
			const response = await fetch('http://localhost/yfc-managment/api/v2/users/');
			const myJson = await response.json(); //extract JSON from the http response
			userData = myJson;// do something with myJson
		}

		var clientId = '209949321684-4lid4e7pvesh7t8ru67j2iknad3a88g0.apps.googleusercontent.com';
		var apiKey = 'AIzaSyA5adh0KnT66TacJX1DTxARONG1YWN1Tk4';
		var scopes =
			'https://www.googleapis.com/auth/gmail.readonly '+
			'https://www.googleapis.com/auth/gmail.send';
		function handleClientLoad() {
			userAction();
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
			alert('Event Created!');
			window.location.assign('../reserve_venue.php');
		}
			
		function sendMessage() 
		{
			userData.forEach((user)=> {
				if(<?php echo $_SESSION['Account_Type'] ?> == 1) {
					var email = '';
					var headers_obj = {
						'To' : user.Email,
						'Subject' : 'New Event Available!'
					}
				
					for(var header in headers_obj)
						email += header += ':'+headers_obj[header]+'\r\n';

					email += '\r\n' + "A new event has been made for your area! Please check your app for more details!";

					var sendRequest = gapi.client.gmail.users.messages.send({
						'userId': 'me',
						'resource': {
							'raw': window.btoa(email).replace(/\+/g, '-').replace(/\//g, '_')
						}
					});
					return sendRequest.execute();
				} else if (<?php echo $_SESSION['Account_Type'] ?> == 2) {
					if (<?php echo $_SESSION['Area'] ?> == user.Area) {
						var email = '';
						var headers_obj = {
							'To' : user.Email,
							'Subject' : 'New Event Available!'
						}

						for(var header in headers_obj)
							email += header += ':'+headers_obj[header]+'\r\n';

						email += '\r\n' + "A new event has been made for your area! Please check your app for more details!";

						var sendRequest = gapi.client.gmail.users.messages.send({
							'userId': 'me',
							'resource': {
								'raw': window.btoa(email).replace(/\+/g, '-').replace(/\//g, '_')
							}
						});
						return sendRequest.execute();
					}
				} else if (<?php echo $_SESSION['Account_Type'] ?> == 3) {
					if (<?php echo $_SESSION['Sector'] ?> == user.Sector) {
						var email = '';
						var headers_obj = {
							'To' : user.Email,
							'Subject' : 'New Event Available!'
						}


						for(var header in headers_obj)
							email += header += ':'+headers_obj[header]+'\r\n';

						email += '\r\n' + "A new event has been made for your area! Please check your app for more details!";

						var sendRequest = gapi.client.gmail.users.messages.send({
							'userId': 'me',
							'resource': {
								'raw': window.btoa(email).replace(/\+/g, '-').replace(/\//g, '_')
							}
						});
						return sendRequest.execute();
					}
				} else if (<?php echo $_SESSION['Account_Type'] ?> == 4) {
					if (<?php echo $_SESSION['Chapter'] ?> == user.Chapter) {
						var email = '';
						var headers_obj = {
							'To' : user.Email,
							'Subject' : 'New Event Available!'
						}


						for(var header in headers_obj)
							email += header += ':'+headers_obj[header]+'\r\n';

						email += '\r\n' + "A new event has been made for your area! Please check your app for more details!";

						var sendRequest = gapi.client.gmail.users.messages.send({
							'userId': 'me',
							'resource': {
								'raw': window.btoa(email).replace(/\+/g, '-').replace(/\//g, '_')
							}
						});
						return sendRequest.execute(loadPreviousScreen);
					}
				}
				
			})
		}
	</script>
	<script src='https://apis.google.com/js/client.js?onload=handleClientLoad'></script>
	</body>
</html>