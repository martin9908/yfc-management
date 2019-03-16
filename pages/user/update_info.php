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
	$Password = isset($_SESSION['password']) ? $_SESSION['password'] : null;
	$pic = isset($_SESSION['Pic']) ? $_SESSION['Pic'] : "assets/img/photo.png";

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
		<style type="text/css">
			@media only screen and (min-width: 600px){
				.hide-on-desktop, *[aria-labelledby='hide-on-desktop']{
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
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color:green;">
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
										<?PHP }?>
									<?PHP } else { ?>
										<li>
											<a href="reserve_venue.php"><i class="fa fa-calendar fa-fw"></i> View Events</a>
										</li>
									<?PHP }?>
								<!--<li> <a href= "reports.php"><i class="fa fa-bar-chart-o fa-fw"></i> Reports</a>
								</li> -->
								<li>
									<a href="update_info.php" class="active"><i class="fa fa-gears fa-fw"></i> My Account</a>
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
                        <h1 class="page-header">Update User Information</h1>
                    </div>
                    <div class="col-md-8">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            User Information
                        </div>
                        <div class="panel-body">
                        	<form action="update_infodb.php" enctype="multipart/form-data" method="post" runat="server">
                                <div class="form-group">
                                    <div class="row">
																			<div class="col-lg-4">
	                                      <div style="border: 1px solid; width:150px; height:150px;">
	                                          <img id="updateimage" src="<?PHP echo $pic;?>" style="width:150px; height:150px">
	                                      </div>
	                                    </div>
	                                    <div class="col-lg-8">
		                                    <label>First Name</label>
		                                    <input class="form-control" name="FName" value="<?PHP echo $FName;?>" required>
		                                    <label>Middle Name</label>
		                                    <input class="form-control" name="MName" value="<?PHP echo $MName;?>">
		                                    <label>Last Name</label>
		                                    <input class="form-control" name="LName" value="<?PHP echo $LName;?>" required>
	                                    </div>
                                    </div>
									<div class="row">
										<div class="col-lg-12">
										<label>Address</label>
										<input class="form-control" name="Address" value="<?PHP echo $Address;?>" required>
										<label>Contact Number</label>
										<div class="form-group input-group">
											<span class="input-group-addon">+63</span>
											<input class="form-control" name="Contact_Number" placeholder="9XXXXXXXXX" value="<?PHP echo $Contact_Number;?>" required>
										</div>
										<label>Email</label>
										<input class="form-control" name="Email" required>
										<label>Password</label>
										<input class="form-control" name="Password" value="<?PHP echo $Password;?>" type="password" required>
										<label>Profile Picture</label>
										<input type='file' onChange="readURL(this);" name="uploadedimage"/>
									</div>
								</div>
                                </div>
                                <center>
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </center>
                            </form>
                        </div>
                    </div>
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

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!--Upload Image-->
    <script type="text/javascript">
	   function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
			$('#updateimage').attr('src', e.target.result);
		   }
			reader.readAsDataURL(input.files[0]);
		   }
		}
	</script>
</div>
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
