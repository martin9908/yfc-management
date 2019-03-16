<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>YFC - Events Management System</title>
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/login.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- jQuery -->
		<script src="../bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Add fancyBox -->
    <link rel="stylesheet" href="user/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="user/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <script type="text/javascript">
			$(document).ready(function() {
				$(".fancybox").fancybox();
			});
		</script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="text-center col-lg-12">
					<img src="assets/yfc_logo.gif" width="15%" style="padding-top:25px">
					<h1>YFC Events Management System<p><small>Login Page</small></p></h1>
				</div>
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-green">
						<div class="panel-heading">
							<h3 class="panel-title">Please Sign In</h3>
						</div>
						<div class="panel-body">
							<form action="database/login.php" method="post">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="ID Number" name="username" autofocus required>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password" name="password" type="password" required>
										<p>Not Registered? <a class="fancybox fancybox.ajax" href="Register.php">Register</a> Here</p>
									</div>
									<div class="form-group text-center">
										<button type="submit" class="btn btn-success btn-lg">Login</button>
										<button type="reset" class="btn btn-danger btn-lg">Reset</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			document.addEventListener("message", function(data) {
				alert(data.data);
			});
		</script>
		<!-- Bootstrap Core JavaScript -->
		<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- Metis Menu Plugin JavaScript -->
		<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="../dist/js/sb-admin-2.js"></script>
	</body>
</html>
