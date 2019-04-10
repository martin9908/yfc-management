<!DOCTYPE html>
<html lang="en">
<?PHP
	session_start();
	//Database Connection String
	require("../database/connect.php");

	//Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");


	//User Information
	$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
	$User_Number = isset($_SESSION['User_Number']) ? $_SESSION['User_Number'] : null;
	$FName = isset($_SESSION['First_Name']) ? $_SESSION['First_Name'] : null;
	$MName = isset($_SESSION['Middle_Name']) ? $_SESSION['Middle_Name'] : null;
	$LName = isset($_SESSION['Last_Name']) ? $_SESSION['Last_Name'] : null;
	$Address = isset($_SESSION['Address']) ? $_SESSION['Address'] : null;
	$Contact_Number = isset($_SESSION['Contact_Number']) ? $_SESSION['Contact_Number'] : null;
	$Account_Type = isset($_SESSION['Account_Type']) ? $_SESSION['Account_Type'] : null;
	$Account_Status = isset($_SESSION['Account_Status']) ? $_SESSION['Account_Status'] : null;

	//Equipment Info
	$avid = $_GET['ppid'];
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User - YFC Events Management System</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
		<style type="text/css">
			@media only screen and (min-width: 600px){
				.hide-on-desktop, *[aria-labelledby='hide-on-desktop']{
					display: none;
					max-height: 0;
					overflow: hidden;
				}
			}
			@media only screen and (max-width: 640px) { 
				.hide-on-mobile, *[aria-labelledby='hide-on-mobile']{
					display: none;
					max-height: 0;
					overflow: hidden;
				}
			}
			.footer {
			  position: fixed;
			  bottom: 0;
			  width: 100%;
			  /* Set the fixed height of the footer here */
			  height: 60px;
			  background-color: #f5f5f5;
			}
		</style>

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Add jQuery library -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="wrapper">
<!-- Page Content -->
    <div class="container-fluid" style="margin-bottom: 70px;">
        <div class="row">
            <div class="col-lg-12" style="width:500px">
                <form action="database/confirm_payment.php" method="GET">
                    <div class="form-group">
                    	<input type="hidden" name="ppid" value="<?php echo $avid; ?>">
                        <label>Remarks</label>
                        <input class="form-control" name="remarks">
                        <input type="hidden" class="form-control" name="processed_by" value="<?php echo $id?>">
                    </div>
                    <center>
                        <button type="submit" class="btn btn-success">Confirm</button>
                    <!-- /.form-group -->
                </form>
                <!-- /.form -->
            </div>
        </div>
    </div>
</div>
<!-- / .wrapper -->
<footer class="footer" aria-labelledby="hide-on-desktop">
	<nav class="navbar navbar-light bg-faded container-fluid" aria-labelledby="hide-on-desktop">
		<a href="index.php" class="navbar-brand"><i class="fa fa-home fa-fw"></i></a>
	<?php if ($Account_Type != 0){?>
	  <a href="reserve_venue.php" class="navbar-brand "><i class="fa fa-calendar fa-fw"></i></a>
		<a href="user_management.php" class="navbar-brand"><i class="fa fa-users fa-fw"></i></a>
		<a href="payment_management.php" class="navbar-brand"><i class="fa fa-dollar fa-fw"></i></a>
		<a href="manage_area.php" class="navbar-brand"><i class="fa fa-map-marker fa-fw"></i></a>
	<?php } else {?>
		<a href="reserve_venue.php" class="navbar-brand"><i class="fa fa-calendar fa-fw"></i></a>
	<?php } ?>
		<a href="update_info.php" class="navbar-brand"><i class="fa fa-gears fa-fw"></i></a>
	</nav>
</footer>
</body>
</html>
