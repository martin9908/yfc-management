<?PHP
	session_start();
	//Database Connection String
	require("database/connect.php");

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

?>
<!DOCTYPE html>
<html lang="en">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" style="width:300px">
                <form action="database/reserve_venue.php" method="post">
                    <div class="form-group">
                        <label>Venue Name</label>
                        <input class="form-control" name="vname" required>
                        <label>Venue Room</label>
                        <input class="form-control" name="vroom" required>
                        <label>Venue Capacity</label>
                        <input class="form-control" name="vcapacity" required>
                        <label>Venue Description</label>
                        <input class="form-control" name="vdescription" required>
 												<label>Venue Time Limit</label>
                        <input class="form-control" name="vlimit" required>
                    </div>
                    <center>
                   <button type="submit" class="btn btn-success">Update</button>
                   <button type="reserve" class="btn btn-success">Reserve</button>
                   </center>
                    <!-- /.form-group -->
                </form>
                <!-- /.form -->
            </div>
        </div>
    </div>
</div>
<!-- / .wrapper -->
</body>
</html>
