<?php
	session_start();
	$page = $_SERVER['PHP_SELF'];
	$sec = "10";
	header("Refresh: $sec; url = $page");
	new_variables($_SESSION['User_Number'], $_SESSION['password']);
	//Database Connection String
	require("database/connect.php");

	//Connect Strings
	$con = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

	//Personal Information
	$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
	$User_Number = isset($_SESSION['User_Number']) ? $_SESSION['User_Number'] : null;
	$FName = isset($_SESSION['First_Name']) ? $_SESSION['First_Name'] : null;
	$MName = isset($_SESSION['Middle_Name']) ? $_SESSION['Middle_Name'] : null;
	$LName = isset($_SESSION['Last_Name']) ? $_SESSION['Last_Name'] : null;
	$Address = isset($_SESSION['Address']) ? $_SESSION['Address'] : null;
	$Contact_Number = isset($_SESSION['Contact_Number']) ? $_SESSION['Contact_Number'] : null;
	$Account_Type = isset($_SESSION['Account_Type']) ? $_SESSION['Account_Type'] : null;
	$Account_Status = isset($_SESSION['Account_Status']) ? $_SESSION['Account_Status'] : null;
	$pic = isset($_SESSION['Pic']) ? $_SESSION['Pic'] : "assets/img/photo.png";

	if (trim($pic) == ""){
		$pic = "assets/img/photo.png";
	}

	//Account Info
	if ($Account_Type == 1)
	{
		$Account_Name = "Administrator";
	}
	else if ($Account_Type == 2)
	{
		$Account_Name = "Area Encoder";
	}
	else if ($Account_Type == 3)
	{
		$Account_Name = "Sector Encoder";
	}
	else if ($Account_Type == 4)
	{
		$Account_Name = "Chapter Encoder";
	}
	else
  {
		$Account_Name = "User";
	}
	$table = isset($_SESSION['table']) ? $_SESSION['table'] : null;

	//Employee Info
	$Member_Since = isset($_SESSION['Member_Since']) ? $_SESSION['Member_Since'] : null;
	$Area			 		= isset($_SESSION['Area']) ? $_SESSION['Area'] : null;
	$Area_Name 		= isset($_SESSION['Area_Name']) ? $_SESSION['Area_Name'] : null;
	$Sector 			= isset($_SESSION['Sector']) ? $_SESSION['Sector'] : null;
	$Sector_Name	= isset($_SESSION['Sector_Name']) ? $_SESSION['Sector_Name'] : null;
	$Chapter			= isset($_SESSION['Chapter']) ? $_SESSION['Chapter'] : null;
	$Chapter_Name	= isset($_SESSION['Chapter_Name']) ? $_SESSION['Chapter_Name'] : null;

	//SQL Scripts
	if ($Account_Type == 1) {
		$sql1 = "select * from info_user where Account_Status = 'Pending'";
	}
	else {
		$sql1 = "SELECT * FROM info_user
		WHERE
			Account_Status = 'Pending'
		AND
			Area = $Area
		AND
			Sector = $Sector
		AND
			Chapter = $Chapter";
	}
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
			<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color:green;" aria-labelledby="hide-on-mobile">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="color:white;">Youth For Christ</a>
            </div>
            <!-- /.navbar-header -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <img src="../assets/yfc_logo.gif" width="190px"/>
                                </div>
                            <!-- /input-group -->
                            </li>
                            <li>
                                <a href="index.php" class="active"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                            </li>
                                <?PHP if($Account_Type != 0){ ?>
                                    <li>
                                        <a href="reserve_venue.php"><i class="fa fa-calendar fa-fw"></i> Manage Events</a>
                                    </li>
                                    <li>
                                        <a href="user_management.php"><i class="fa fa-users fa-fw"></i> Manage Users</a>
                                    </li>
									<li>
										<a href="payment_management.php"><i class="fa fa-dollar fa-fw"></i> Manage Payments</a>
									</li>
								<?PHP if($Account_Type == 1){?>
									<li>
										<a href="#"><i class="fa fa-map-marker fa-fw"></i> Manage Locations<span class="fa arrow"></span></a>
										<ul class="nav nav-second-level">
											<li>
												<a href="manage_area.php">Manage Area</a>
											</li>
											<li>
												<a href="manage_sector.php">Manage Sector</a>
											</li>
											<li>
												<a href="manage_chapter.php">Manage Chapter</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="reports.php"><i class="fa fa-bar-chart fa-fw"></i> Reports</a>
									</li>
								<?PHP }?>
                                <?PHP } else { ?>
                                    <li>
                                        <a href="reserve_venue.php"><i class="fa fa-calendar fa-fw"></i> View Events</a>
                                    </li>
                                <?PHP }?>
                            <!--<li> <a href= "reports.php"><i class="fa fa-bar-chart-o fa-fw"></i> Reports</a>
                            </li> -->
                            <li>
                                <a href="update_info.php"><i class="fa fa-gears fa-fw"></i> My Account</a>
                            </li>
                            <li>
                                <a href="database/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper" style="margin-bottom: 70px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Welcome <?PHP echo $FName." ".$LName;?>!</h1>
                    </div>
                    <!--/.col-lg-12-->
										<?PHP if($Account_Type != 0) { ?>
                    <div class="col-lg-6 col-md-6 col-xs12">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <!--/ .col-xs-3-->
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?PHP if ($result=mysqli_query($con,$sql1)){
													$numrows = mysqli_num_rows($result);
													echo $numrows;
												}
												mysqli_close($con);?></div>
                                                <!--/ .huge-->
                                        <div>New Pending Users!</div>
                                         <!--/ .div-->
                                    </div>
                                     <!--/ .col-xs-9-->
                                </div>
                                <!--/ .row-->
                            </div>
                            <!--/ .panel-heading-->
                            <a href="user_management.php">
                                <div class="panel-footer">
                                    <span class="pull-left">User Requests</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                    <!--/ .clearfix-->
                                </div>
                                <!--/ .panel-footer-->
                            </a>
                        </div>
                        <!--/ .panel-green-->
                	</div>
                    <!--/ .col-lg-3 col-md-6-->
									<?PHP }?>
                </div>
                <!--/ .row-->
                    <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                User Information
                            </div>
                            <!--/.panel-heading -->
                            <div class="panel-body">
                            	<div class="col-md-8 col-xs-6">
                                    <p><b>ID Number:      </b><?PHP echo $User_Number;?></p>
                                    <p><b>Address:        </b><?PHP echo $Address;?></p>
                                    <p><b>Contact Number: </b><?PHP echo '+63' . $Contact_Number;?></p>
                                    <p><b>Account Type:   </b><?PHP echo $Account_Name;?></p>
																		<p><b>Member Since:     </b><?PHP echo $Member_Since;?></p>
																		<p><b>Area:				    </b><?PHP echo $Area_Name;?></p>
																		<p><b>Sector:     		</b><?PHP echo $Sector_Name;?></p>
																		<p><b>Chapter:     		</b><?PHP echo $Chapter_Name;?></p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                	<div style="border: 1px solid; width:120px; height:120px;">
                                    	<img src="<?PHP echo $pic;?>" style="width:120px; height:120px">
                                    </div>
                                </div>
                            </div>
                            <!--/.panel-body -->
                        </div>
                        <!--/.panel-success -->
                	</div>
                	<!--/.col-md-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</div>
<footer class="footer" aria-labelledby="hide-on-desktop">
	<nav class="navbar navbar-light bg-faded container-fluid" aria-labelledby="hide-on-desktop">
		
	<?php if ($Account_Type != 0){?>
	  <a href="reserve_venue.php" class="navbar-brand "><i class="fa fa-calendar fa-fw"></i></a>
		<a href="user_management.php" class="navbar-brand"><i class="fa fa-users fa-fw"></i></a>
			<a href="reports.php"><i class="fa fa-bar-chart fa-fw"></i></a>
		<a href="payment_management.php" class="navbar-brand"><i class="fa fa-dollar fa-fw"></i></a>
		<a href="manage_area.php" class="navbar-brand"><i class="fa fa-map-marker fa-fw"></i></a>
	<?php } else {?>
		<a href="reserve_venue.php" class="navbar-brand"><i class="fa fa-calendar fa-fw"></i></a>
	<?php } ?>
		<a href="update_info.php" class="navbar-brand"><i class="fa fa-gears fa-fw"></i></a>
	</nav>
</footer>
</body>
<?PHP
function new_variables($username, $password){
	include("database/connect.php");

	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
	$query = mysqli_query($connect,
	"SELECT *
		FROM
			`info_sector`,
			`info_area`,
			`info_chapter`,
			`info_user`
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
</html>
