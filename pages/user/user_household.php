<?php
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
	$Area			 		= isset($_SESSION['Area']) ? $_SESSION['Area'] : null;
	$Sector 			= isset($_SESSION['Sector']) ? $_SESSION['Sector'] : null;
	$Chapter			= isset($_SESSION['Chapter']) ? $_SESSION['Chapter'] : null;

	//SQL Scripts
	$household = mysqli_query($connect, "SELECT * FROM household, info_user WHERE household_leader = id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <meta name="description" content="AVR Reservation System">
    <meta name="author" content="Janine Sapinoso">

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
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- Add fancyBox -->
    <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
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
									<a href="index.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
								</li>
									<?PHP if($Account_Type != 3){ ?>
										<li>
											<a href="reserve_venue.php"><i class="fa fa-calendar fa-fw"></i> Manage Events</a>
										</li>
										<li>
											<a href="user_management.php" class="active"><i class="fa fa-users fa-fw"></i> Manage Users</a>
										</li>
										<li>
											<a href="payment_management.php"><i class="fa fa-dollar fa-fw"></i> Manage Payments</a>
										</li>
										<?PHP if($Account_Type == 1 || $Account_Type == 2 || $Account_Type == 3 || $Account_Type == 4){?>
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
											<a href="reserve_venue.php" class="active"><i class="fa fa-calendar fa-fw"></i> View Events</a>
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
                        <h1 class="page-header">Household Management</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-10 col-xs-offset-1">
                    	<div class="panel panel-success">
                            <div class="panel-heading">
                                Household Management
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="display responsive nowrap table table-striped table-bordered table-hover" width="100%" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Household Number</th>
                                            <th>Household Name</th>
                                            <th>Leader Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?PHP
                                         while($row = mysqli_fetch_assoc($household)){
                                            echo "<tr><td>".$row['idhousehold']."</td>";
                                            echo "<td>".$row['household_name']."</td>";
                                            echo "<td>".$row['First_Name']." ".$row['Last_Name']."</td>";
											echo "<td><a class='btn btn-outline btn-success fancybox fancybox.ajax' href='household_edit.php'>Edit</a>";
											echo "&nbsp<a class='btn btn-outline btn-danger fancybox fancybox.ajax' href='household_view.php'>View</a></td></tr>";
                                         }
                                    ?>
                                    </tbody>
                                </table>
								<a class="btn btn-success btn-mdo fancybox fancybox.ajax" href="household_create.php">Add Household</a>
                            </div>
                        </div>
                        <!-- /.panel-->
                    </div>
                    <!-- /.col-lg-8-->
				</div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
	$(document).ready(function() {
		$('#dataTables-example').DataTable({
				retrieve: true,
				responsive: true,
				"order": [[ 0, "desc" ]]
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
</html>
