<?php
	session_start();
  $payment_reference = uniqid();
	$_SESSION['payment_type'] = isset($_GET['payment_type']) ? $_GET['payment_type'] : null;
	$payment_type = isset($_GET['payment_type']) ? $_GET['payment_type'] : null;
	$reservation_fee = isset($_SESSION['reservation_fee']) ? $_SESSION['reservation_fee'] : null;
	$Account_Type = isset($_SESSION['Account_Type']) ? $_SESSION['Account_Type'] : null;
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <meta name="description" content="AVR Reservation System">
    <meta name="author" content="Janine Sapinoso">

    <title>User - YFC Events Management System</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
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
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Add jQuery library -->
	<script type="text/javascript" src="../../../bower_components/jquery/dist/jquery.min.js"></script>


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
					<a class="navbar-brand" href="../index.php" style="color:white;">Youth For Christ</a>
				</div>
				<!-- /.navbar-header -->

					<div class="navbar-default sidebar" role="navigation">
						<div class="sidebar-nav navbar-collapse">
							<ul class="nav" id="side-menu">
								<li class="sidebar-search">
									<div class="input-group custom-search-form">
										<img src="../../assets/yfc_logo.gif" width="190px"/>
									</div>
								<!-- /input-group -->
								</li>
								<li>
									<a href="../index.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
								</li>
									<?PHP if($Account_Type != 0){ ?>
										<li>
											<a href="../reserve_venue.php"><i class="fa fa-calendar fa-fw"></i> Manage Events</a>
										</li>
										<li>
											<a href="../user_management.php"><i class="fa fa-users fa-fw"></i> Manage Users</a>
										</li>
										<li>
											<a href="../payment_management.php" class="active"><i class="fa fa-dollar fa-fw"></i> Manage Payments</a>
										</li>
										<?PHP if($Account_Type == 1){?>
											<li>
												<a href="#"><i class="fa fa-map-marker fa-fw"></i> Manage Locations<span class="fa arrow"></span></a>
													<ul class="nav nav-second-level">
															<li>
																	<a href="../manage_area.php">Manage Area</a>
															</li>
															<li>
																	<a href="../manage_sector.php">Manage Sector</a>
															</li>
															<li>
																	<a href="../manage_chapter.php">Manage Chapter</a>
															</li>
													</ul>
											</li>
											<li>
												<a href="#"><i class="fa fa-bar-chart fa-fw"></i> Reports</a>
											</li>
										<?PHP }?>
									<?PHP } else { ?>
										<li>
											<a href="../reserve_venue.php"><i class="fa fa-calendar fa-fw"></i> View Events</a>
										</li>
									<?PHP }?>
								<!--<li> <a href= "reports.php"><i class="fa fa-bar-chart-o fa-fw"></i> Reports</a>
								</li> -->
								<li>
									<a href="../update_info.php"><i class="fa fa-gears fa-fw"></i> My Account</a>
								</li>
								<li>
									<a href="../database/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                        <h1 class="page-header">Payments</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-10 col-xs-offset-1">
                    	<div class="panel panel-success">
                            <div class="panel-heading">
                                Process Payment
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body center-div">
								<form action="../database/create_payment.php" method="post">
									<input type="hidden" name="payment_reference" value="<?PHP echo $payment_reference?>"/>
									<h3>Your Events Registration Order is now ready for payment.</h3>
									<br>
									<h2>TOTAL AMOUNT DUE: PHP. <?PHP echo $reservation_fee ?></h2>
									<br>
									<h3>PAYMENT OPTION: <?PHP echo strtoupper($payment_type)?></h3>
									<div class="overflow-text">
										<?PHP if ($payment_type == 'bank') { ?>
											<ol>
												<li>
													Deposit your payment to any of the following bank accounts: BDO Octagon Peso Savings Account: 6810020704 BPI Aurora Peso Current Account: 0123-4662-76 Chinabank Aurora Peso Current Account: 1040981311 Note: Deposit the full amount as reflected in the transaction (one transaction: one deposit/payment) within five (5) calendar days upon registration. Transactions with no payment details will automatically expire after 5 calendar days from the day they were created.
												</li>
												<li>
													After making the deposit, log in back to www.cfchomeoffice.com. The system will remind you of your pending transaction that needs payment. Click the link to add payment details. Alternative: You may also click on the module (TITHES/EVENTS REGISTRATION/DONATIONS), click History, and click on the TRANSACTION ID that newts payment.
												</li>
												<li>
													Fill out the fields in this format:
													<ol type="a">
														<li>
															DATE OF DEPOSIT- mm/dd/yyyy (12/19/2013)
														</li>
														<li>
															TIME OF DEPOSIT- hh:mm AM/PM (1:55 PM)
														</li>
														<li>
															BANK ACCOUNT - choose from the drop-down fist
															Note: There are different bank accounts designated for each event/module. Make sure that you deposit your payment to the correct bank account.
														</li>
														<li>
															PANIC/BRANCH - bank name and branch where payment was deposited
														</li>
														<li>
															REFERENCE NO.
														</li>
														<li>
															REMARKS - additional instructions you would like to tell Finance
														</li>
														<li>
															CONTACT NO. - where Hnance can contact you should they need to clarify your payment details Once done, click Save. Then, a dialog box will appear to confirm your payment submission. Click OK to continue.
														</li>
													</ol>
												</li>
												<li>
													Finance will review your payment and confirm your bansaction. Keep your deposit slip until your transaction is confirmed. Confirmation takes up to 14 working days from the day you entered your deposit details. This may extend to 19 working days during peak season (deadline and end of the month).
												</li>
												<li>
													Once transaction is confirmed, a CONFIRMATION notice will be automatically sent to the email address used to create the transaction and to the designated contact person/delegation head. The confirmation email also serves as your PROVISIONAL RECEIPT. You may get the OFFICIAL RECEIPT from Finance. For inquiries and follow-up on the status of your payment, contact Jean Magbujos at 7094868 loc 39 or email cfcfinance©cfcglobaldata.com.
												</li>
											</ol>
										<?PHP } else if ($payment_type == 'cash') { ?>
										<ol>
											<li>
												Take note of the TRANSACTION ID and the AMOUNT.
											</li>
											<li>
												Go to the CFC Global Mission Center (4156 20th Avenue, Cubao, Quezon City), accomplish the PAYMENT SLIP and give to the CASHIER along with your payment. Note: The CFC Global Mission Center is open from yam-5pm, Monday to Friday, except holidays. Make sure to pay the transaction within five (5) calendar days. Transactions not paid after 5 calendar days will automatically expire.
											</li>
											<li>
												The Cashier will issue an OFFICIAL RECEIPT and will confirm your transaction.
											</li>
											<li>
												Once transaction is confirmed, a CONFIRMATION notice will be automatically sent to the email address used to create the transaction and to the designated contact person/delegation head.
											</li>
										</ol>
										<?PHP }?>
									</div>
									<br>
									<input type="checkbox" name="q" id="a-1" required>
									<label>
										By checking this box you agree to the above Guidelines and the Terms and Conditions.
									</label>
									<br>
									<a class='btn btn-danger' href='page_2.php?event_id=<?PHP echo $event_id?>&payment_type=<?PHP echo $payment_type?>'>Back</a>
									<button class="btn btn-success" type="submit">Confirm</button>
								</form>
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
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../../dist/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
	$(document).ready(function() {
		$('#dataTables-example').DataTable({
				retrieve: true,
				responsive: true,
		});
	});
    </script>
</div>
<footer class="footer" aria-labelledby="hide-on-desktop">
	<nav class="navbar navbar-light bg-faded container-fluid" aria-labelledby="hide-on-desktop">
		<a href="../index.php" class="navbar-brand"><i class="fa fa-home fa-fw"></i></a>
	<?php if ($Account_Type != 0){?>
	  <a href="../reserve_venue.php" class="navbar-brand "><i class="fa fa-calendar fa-fw"></i></a>
		<a href="../user_management.php" class="navbar-brand"><i class="fa fa-users fa-fw"></i></a>
		<a href="../payment_management.php" class="navbar-brand"><i class="fa fa-dollar fa-fw"></i></a>
		<a href="../manage_area.php" class="navbar-brand"><i class="fa fa-map-marker fa-fw"></i></a>
	<?php } else {?>
		<a href="../reserve_venue.php" class="navbar-brand"><i class="fa fa-calendar fa-fw"></i></a>
	<?php } ?>
		<a href="../update_info.php" class="navbar-brand"><i class="fa fa-gears fa-fw"></i></a>
	</nav>
</footer>
</body>
</html>
