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
          $('#title').removeClass("hidden");
        } else {
          $('#authorize-button').removeClass("hidden");
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

			console.log(email);
			var sendRequest = gapi.client.gmail.users.messages.send({
				'userId': 'me',
				'resource': {
					'raw': window.btoa(email).replace(/\+/g, '-').replace(/\//g, '_')
				}
			});

			return sendRequest.execute(loadPreviousScreen);
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
  </body>
</html>