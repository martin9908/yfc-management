<?PHP
session_start();
include("connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

$id = isset($_GET['ppid']) ? $_GET['ppid']: null;
$email = isset($_GET['email']) ? $_GET['email'] : null;

$sql= mysqli_query($connect,"UPDATE `info_user`
					SET
            `Account_Status` = 'Active'
					WHERE
            `id` = $id;");
	if(!$sql){
		die('Error: ' . mysqli_error($connect));
	}
	mysqli_close($connect);
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
				var oldURL = document.referrer;
				alert('Activation Successful!');
				window.location.assign(oldURL); 
			}
				
			function sendMessage() 
			{
				var parts = window.location.search.substr(1).split("&");
				var $_GET = {};
				for (var i = 0; i < parts.length; i++) {
						var temp = parts[i].split("=");
						$_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
				}
				var email = '';
				var headers_obj = {
					'To' : $_GET['email'],
					'Subject' : 'Account Has Been Activated'
				}

				for(var header in headers_obj)
					email += header += ':'+headers_obj[header]+'\r\n';

				email += '\r\n' + "Your account is now activated! You can now use the YFC App just login using your YFC ID number:" + $_GET['userID'] + " and your "+ $_GET['password'] +" as your password!";

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
