<?PHP
	session_start();
	// include("PushNotification.php");
  include("connect.php");
  // require_once 'google-api-php-client/vendor/autoload.php';

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

    $connect_1 = mysqli_connect($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['databasename']) or die("Couldn't connect to database!");

    $query = "";
     
    if($GLOBALS['type']=="International"){
      $query = "SELECT * from `info_user`";
    } else if ( $GLOBALS['type'] == 'Area'){
      $query = "SELECT * from `info_user` WHERE reservation_area = '" . $GLOBALS['area'] . "'";
    } else if ( $GLOBALS['type'] == 'Sector'){
      $query = "SELECT * from `info_user` WHERE reservation_sector = '" . $GLOBALS['sector'] . "'";
    } else if ( $GLOBALS['type'] == 'Chapter'){
      $query = "SELECT * from `info_user` WHERE reservation_chapter = '" . $GLOBALS['chapter'] . "'";
    }

    echo $query;
    $sql= mysqli_query($connect_1, $query);
          
    while($row = mysqli_fetch_assoc($sql))
    {
      $url = "https://fcm.googleapis.com/fcm/send";
      $token = $row['FCM_ID'];
      $serverKey = 'AAAArqESQxA:APA91bEPD-zROiksdWZhFII9pxK_snPJeL4vpwqA72CYdnPdRR8yUuEnE_1vKLE-BsgyJ5DL12jhA0MK85Se5KdG8989TInZlxgCS-cpZ8BDucpw6k6A6fWxuMim_F2weFJ4Jg5SfjPr';
      $title = "A New Event is Available!";
      $body = $GLOBALS['reservation_event'];
      $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
      $data = array('date_start' => $GLOBALS['reservation_date'], 'date_end' => $GLOBALS['reservation_end_date']);
      $arrayToSend = array('to' => $token, 'notification' => $notification, 'data' => $data, 'priority'=>'high');
      $json = json_encode($arrayToSend);
      $headers = array();
      $headers[] = 'Content-Type: application/json';
      $headers[] = 'Authorization: key='. $serverKey;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
      curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
      //Send the request
      $response = curl_exec($ch);
      //Close request
      if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
      }
      curl_close($ch);

      $apicode="TR-MARTI515599_XJEXP";
      $message="New event available: ".$body." Date: ".$GLOBALS['reservation_date'];

      $url = 'https://www.itexmo.com/php_api/api.php';
      $itexmo = array('1' => $row['Contact_Number'], '2' => $message, '3' => $apicode);
      $param = array(
          'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($itexmo),
          ),
      );
      $context  = stream_context_create($param);
      return file_get_contents($url, false, $context);

      // $client = new Google_Client();
      // //The json file you got after creating the service account
      // putenv('GOOGLE_APPLICATION_CREDENTIALS=google-api/test-calendar-serivce-1ta558q3xvg0.json');
      // $client->useApplicationDefaultCredentials();
      // $client->setApplicationName("test_calendar");
      // $client->setScopes(Google_Service_Calendar::CALENDAR);
      // $client->setAccessType('offline');

      // $service = new Google_Service_Calendar($client);

      // $event = new Google_Service_Calendar_Event(array(
      //   'summary' => $GLOBALS['reservation_event'],
      //   'description' => $GLOBALS['reservation_place'],
      //   'start' => array(
      //     'dateTime' => $GLOBALS['reservation_date'].'T09:00:00-07:00'
      //   ),
      //   'end' => array(
      //     'dateTime' => $GLOBALS['reservation_end_date'].'T09:00:00-07:00'
      //   )
      // ));
      
      // $calendarId = 'eldr28nhloed0fb8crgp6snqvo@group.calendar.google.com';
      // $event = $service->events->insert($calendarId, $event);
      // printf('Event created: %s\n', $event->htmlLink);

      // $calendarList = $service->calendarList->listCalendarList();
      // print_r($calendarList);
    }
    mysqli_close($connect_1);
	}
?>
<!doctype html>
<html>
  <head>
    <title>Gmail API demo</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <style>
      iframe {
        width: 100%;
        border: 0;
        min-height: 80%;
        height: 600px;
        display: flex;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1 id="title" class="hidden">Authorize User Email</h1>

      <a href="#compose-modal" data-toggle="modal" id="compose-button" class="btn btn-primary pull-right hidden">Compose</a>

      <button id="authorize-button" class="btn btn-primary hidden">Authorize</button>

    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Compose</h4>
          </div>
          <form onsubmit="return sendEmail();">
            <div class="modal-body">
              <div class="form-group">
                <input type="email" class="form-control" id="compose-to" placeholder="To" required />
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="compose-subject" placeholder="Subject" required />
              </div>

              <div class="form-group">
                <textarea class="form-control" id="compose-message" placeholder="Message" rows="10" required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="send-button" class="btn btn-primary">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="reply-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Reply</h4>
          </div>
          <form onsubmit="return sendReply();">
            <input type="hidden" id="reply-message-id" />

            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" id="reply-to" disabled />
              </div>

              <div class="form-group">
                <input type="text" class="form-control disabled" id="reply-subject" disabled />
              </div>

              <div class="form-group">
                <textarea class="form-control" id="reply-message" placeholder="Message" rows="10" required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="reply-button" class="btn btn-primary">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    //   var clientId = '209949321684-4lid4e7pvesh7t8ru67j2iknad3a88g0.apps.googleusercontent.com';
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

      function handleAuthClick() {
        gapi.auth.authorize({
          client_id: clientId,
          scope: scopes,
          immediate: false
        }, handleAuthResult);
        return false;
      }

      function handleAuthResult(authResult) {
        if(authResult && !authResult.error) {
          loadGmailApi();
          $('#authorize-button').remove();
          $('.table-inbox').removeClass("hidden");
        } else {
          $('#authorize-button').removeClass("hidden");
          $('#title').removeClass("hidden");
          $('#authorize-button').on('click', function(){
            handleAuthClick();
          });
        }
      }

      function loadGmailApi() {
        gapi.client.load('gmail', 'v1', sendMessage);
      }

      function displayInbox() {
        var request = gapi.client.gmail.users.messages.list({
          'userId': 'me',
          'labelIds': 'INBOX',
          'maxResults': 10
        });
        request.execute(function(response) {
          $.each(response.messages, function() {
            var messageRequest = gapi.client.gmail.users.messages.get({
              'userId': 'me',
              'id': this.id
            });
            messageRequest.execute(appendMessageRow);
          });
        });
      }

      function appendMessageRow(message) {
        $('.table-inbox tbody').append(
          '<tr>\
            <td>'+getHeader(message.payload.headers, 'From')+'</td>\
            <td>\
              <a href="#message-modal-' + message.id +
                '" data-toggle="modal" id="message-link-' + message.id+'">' +
                getHeader(message.payload.headers, 'Subject') +
              '</a>\
            </td>\
            <td>'+getHeader(message.payload.headers, 'Date')+'</td>\
          </tr>'
        );
        var reply_to = (getHeader(message.payload.headers, 'Reply-to') !== '' ?
          getHeader(message.payload.headers, 'Reply-to') :
          getHeader(message.payload.headers, 'From')).replace(/\"/g, '&quot;');

        var reply_subject = 'Re: '+getHeader(message.payload.headers, 'Subject').replace(/\"/g, '&quot;');
        $('body').append(
          '<div class="modal fade" id="message-modal-' + message.id +
              '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">\
            <div class="modal-dialog modal-lg">\
              <div class="modal-content">\
                <div class="modal-header">\
                  <button type="button"\
                          class="close"\
                          data-dismiss="modal"\
                          aria-label="Close">\
                    <span aria-hidden="true">&times;</span></button>\
                  <h4 class="modal-title" id="myModalLabel">' +
                    getHeader(message.payload.headers, 'Subject') +
                  '</h4>\
                </div>\
                <div class="modal-body">\
                  <iframe id="message-iframe-'+message.id+'" srcdoc="<p>Loading...</p>">\
                  </iframe>\
                </div>\
                <div class="modal-footer">\
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>\
                  <button type="button" class="btn btn-primary reply-button" data-dismiss="modal" data-toggle="modal" data-target="#reply-modal"\
                  onclick="fillInReply(\
                    \''+reply_to+'\', \
                    \''+reply_subject+'\', \
                    \''+getHeader(message.payload.headers, 'Message-ID')+'\'\
                    );"\
                  >Reply</button>\
                </div>\
              </div>\
            </div>\
          </div>'
        );
        $('#message-link-'+message.id).on('click', function(){
          var ifrm = $('#message-iframe-'+message.id)[0].contentWindow.document;
          $('body', ifrm).html(getBody(message.payload));
        });
      }

      function sendEmail()
      {
        $('#send-button').addClass('disabled');

        sendMessage(
          {
            'To': $('#compose-to').val(),
            'Subject': $('#compose-subject').val()
          },
          $('#compose-message').val(),
          composeTidy
        );

        return false;
      }

      function composeTidy()
      {
        $('#compose-modal').modal('hide');

        $('#compose-to').val('');
        $('#compose-subject').val('');
        $('#compose-message').val('');

        $('#send-button').removeClass('disabled');
      }

      function sendReply()
      {
        $('#reply-button').addClass('disabled');

        sendMessage(
          {
            'To': $('#reply-to').val(),
            'Subject': $('#reply-subject').val(),
            'In-Reply-To': $('#reply-message-id').val()
          },
          $('#reply-message').val(),
          replyTidy
        );

        return false;
      }

      function replyTidy()
      {
        $('#reply-modal').modal('hide');

        $('#reply-message').val('');

        $('#reply-button').removeClass('disabled');
      }

      function fillInReply(to, subject, message_id)
      {
        $('#reply-to').val(to);
        $('#reply-subject').val(subject);
        $('#reply-message-id').val(message_id);
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

      function getHeader(headers, index) {
        var header = '';
        $.each(headers, function(){
          if(this.name.toLowerCase() === index.toLowerCase()){
            header = this.value;
          }
        });
        return header;
      }

      function getBody(message) {
        var encodedBody = '';
        if(typeof message.parts === 'undefined')
        {
          encodedBody = message.body.data;
        }
        else
        {
          encodedBody = getHTMLPart(message.parts);
        }
        encodedBody = encodedBody.replace(/-/g, '+').replace(/_/g, '/').replace(/\s/g, '');
        return decodeURIComponent(escape(window.atob(encodedBody)));
      }

      function getHTMLPart(arr) {
        for(var x = 0; x <= arr.length; x++)
        {
          if(typeof arr[x].parts === 'undefined')
          {
            if(arr[x].mimeType === 'text/html')
            {
              return arr[x].body.data;
            }
          }
          else
          {
            return getHTMLPart(arr[x].parts);
          }
        }
        return '';
      }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>
    <script>window.location.assign('../reserve_venue.php'); </script>
  </body>
</html>