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

	//Equipment Info
	$idnum = $_GET['ppid'];

	//SQL Scripts
	$query = mysqli_query($connect,"SELECT * FROM info_user WHERE id = $idnum");

	//Fetch Equipment Information
	while($row = mysqli_fetch_assoc($query)){
		$_SESSION['ppid'] = $row['id'];
		$UserID = $row['User_Number'];
		$FName = $row['First_Name'];
		$MName = $row['Middle_Name'];
		$LName = $row['Last_Name'];
		$Address = $row['Address'];
		$CNum = $row['Contact_Number'];
		$Area = $row['Area'];
		$Sector = $row['Sector'];
		$Chapter = $row['Chapter'];
		$Password = $row['password'];
		$AccountType = $row['Account_Type'];
		if($row['Account_Picture'] != null){
			$pic = $row['Account_Picture'];
		}
		else{
			$pic = 'assets/img/photo.png';
		}
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

	<!-- jQuery -->
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
			<div class="col-lg-12" >
				<div class="panel panel-success">
					<div class="panel-heading">
						User Information
					</div>
					<div class="panel-body">
						<form action="user_editdb.php" enctype="multipart/form-data" method="post">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-8">
										<input hidden name="IDNum" value="<?PHP echo $_SESSION['ppid']?>">
										<label>ID Number</label>
										<input class="form-control" name="UserID" value="<?PHP echo $UserID;?>" required>
										<label>First Name</label>
										<input class="form-control" name="FName" value="<?PHP echo $FName;?>" required>
										<label>Middle Name</label>
										<input class="form-control" name="MName" value="<?PHP echo $MName;?>">
									</div>
									<div class="col-lg-4" style=" padding-top:20px;">
										<div style="border: 1px solid; width:150px; height:150px;">
											<img id="updateimage" src="<?PHP echo $pic;?>" style="width:150px; height:150px">
										</div>
									</div>
								</div>
								<label>Last Name</label>
								<input class="form-control" name="LName" value="<?PHP echo $LName;?>" required>
								<label>Address</label>
								<input class="form-control" name="Address" value="<?PHP echo $Address;?>" required>
								<label>Contact Number</label>
								<div class="form-group input-group">
									<span class="input-group-addon">+63</span>
									<input class="form-control" name="ConNum" placeholder="9XXXXXXXXX" value="<?PHP echo $CNum;?>" required>
								</div>
								<label>Area</label>
								<select class="form-control" name="Area" id="Area">
									<option data-group="SHOW" value="">Please Select Area</option>
								<?PHP
									$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
									$area = mysqli_query($connect, "SELECT * FROM info_area");
									while($row = mysqli_fetch_assoc($area)){
										if($row['id'] == $Area) {
											echo "<option value = ". $row['id']." selected>".$row['areaName']."</option>";
										}
										else {
											echo "<option value = ". $row['id'].">".$row['areaName']."</option>";
										}
									}
									mysqli_close($connect);
								?>
								</select>
								<label>Sector</label>
								<select class="form-control" name="Sector" id="Sector">
									<option data-group="SHOW" value="">Please Select Sector</option>
									<?PHP
									$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
									$sector = mysqli_query($connect, "SELECT * FROM info_sector");
									while($row = mysqli_fetch_assoc($sector)){
										if ($row['id'] == $Sector) {
											echo "<option data-group=". $row['areaId'] ." value = ". $row['id']." selected>".$row['sectorName']."</option>";
										}
										else {
											echo "<option data-group=". $row['areaId'] ." value = ". $row['id'].">".$row['sectorName']."</option>";
										}
									}
									mysqli_close($connect);
									?>
								</select>
								<label>Chapter</label>
								<select class="form-control" name="Chapter" id="Chapter">
									<option data-group="SHOW" value="">Please Select Chapter</option>
								<?PHP
									$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
									$chapter = mysqli_query($connect, "SELECT * FROM info_chapter");
									while($row = mysqli_fetch_assoc($chapter)){
										if ($row['id'] == $Chapter) {
											echo "<option data-group=". $row['sectorId'] ." value = ". $row['id']." selected>".$row['chapterName']."</option>";
										}
										else {
											echo "<option data-group=". $row['sectorId'] ." value = ". $row['id'].">".$row['chapterName']."</option>";
										}
									}
									mysqli_close($connect);
								?>
								</select>
								<label>Account Type</label>
								<select class="form-control" name="Account_Type" required>
									<?PHP if ($Account_Type == 1){?>
										<?PHP if ($AccountType == 1){?>
											<option value = "">Select An Account Type</option>
											<option value = "1" selected>Administrator</option>
											<option value = "2">Area Encoder</option>
											<option value = "3">Sector Encoder</option>
											<option value = "4">Chapter Encoder</option>
											<option value = "0">User</option>
										<?PHP } else if ($AccountType == 2){?>
											<option value = "">Select An Account Type</option>
											<option value = "1">Administrator</option>
											<option value = "2" selected>Area Encoder</option>
											<option value = "3">Sector Encoder</option>
											<option value = "4">Chapter Encoder</option>
											<option value = "0">User</option>
										<?PHP } else if ($AccountType == 3){?>
											<option value = "">Select An Account Type</option>
											<option value = "1">Administrator</option>
											<option value = "2">Area Encoder</option>
											<option value = "3" selected>Sector Encoder</option>
											<option value = "4">Chapter Encoder</option>
											<option value = "0">User</option>
										<?PHP } else if ($AccountType == 4){?>
											<option value = "">Select An Account Type</option>
											<option value = "1">Administrator</option>
											<option value = "2">Area Encoder</option>
											<option value = "3">Sector Encoder</option>
											<option value = "4" selected>Chapter Encoder</option>
											<option value = "0">User</option>
										<?PHP } else {?>
											<option value = "">Select An Account Type</option>
											<option value = "1">Administrator</option>
											<option value = "2">Area Encoder</option>
											<option value = "3">Sector Encoder</option>
											<option value = "4">Chapter Encoder</option>
											<option value = "0" selected>User</option>
										<?PHP }?>
									<?PHP } else if ($Account_Type == 2) { ?>
										<?PHP if ($AccountType == 2){?>
											<option value = "">Select An Account Type</option>
											<option value = "2" selected>Area Encoder</option>
											<option value = "3">Sector Encoder</option>
											<option value = "4">Chapter Encoder</option>
											<option value = "0">User</option>
										<?PHP } else if ($AccountType == 3){?>
											<option value = "">Select An Account Type</option>
											<option value = "2">Area Encoder</option>
											<option value = "3" selected>Sector Encoder</option>
											<option value = "4">Chapter Encoder</option>
											<option value = "0">User</option>
										<?PHP } else if ($AccountType == 4){?>
											<option value = "">Select An Account Type</option>
											<option value = "2">Area Encoder</option>
											<option value = "3">Sector Encoder</option>
											<option value = "4" selected>Chapter Encoder</option>
											<option value = "0">User</option>
										<?PHP } else {?>
											<option value = "">Select An Account Type</option>
											<option value = "2">Area Encoder</option>
											<option value = "3">Sector Encoder</option>
											<option value = "4">Chapter Encoder</option>
											<option value = "0" selected>User</option>
										<?PHP }?>
									<?PHP } else if ($Account_Type == 3) {?>
										<?PHP if ($AccountType == 3){?>
											<option value = "">Select An Account Type</option>
											<option value = "3" selected>Sector Encoder</option>
											<option value = "4">Chapter Encoder</option>
											<option value = "0">User</option>
										<?PHP } else if ($AccountType == 4){?>
											<option value = "">Select An Account Type</option>
											<option value = "3">Sector Encoder</option>
											<option value = "4" selected>Chapter Encoder</option>
											<option value = "0">User</option>
										<?PHP } else {?>
											<option value = "">Select An Account Type</option>
											<option value = "3">Sector Encoder</option>
											<option value = "4">Chapter Encoder</option>
											<option value = "0" selected>User</option>
										<?PHP }?>
									<?PHP } else {?>
										<?PHP if ($AccountType == 4){?>
											<option value = "">Select An Account Type</option>
											<option value = "4" selected>Chapter Encoder</option>
											<option value = "0">User</option>
										<?PHP } else {?>
											<option value = "">Select An Account Type</option>
											<option value = "4">Chapter Encoder</option>
											<option value = "0" selected>User</option>
										<?PHP }?>
									<?PHP } ?>
								</select>
								<label>Password</label>
								<input class="form-control" name="Password" value="<?PHP echo $Password;?>" type="password" required>
								<label>Profile Picture</label>
								<input type='file' onChange="readURL(this);" name="uploadedimage"/>
								<center>
									<button type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-danger">Reset</button>
								</center>
							</div>
						</form>
					</div>
				</div>
				<!-- /.profile -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.body -->
	</div>
	<!-- /.success -->
</div>
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
	$(function(){
	    $('#Area').on('change', function(){
	        var val = $(this).val();
	        var sub = $('#Sector');
	        $('option', sub).filter(function(){
	            if (
	                 $(this).attr('data-group') === val
	              || $(this).attr('data-group') === 'SHOW'
	            ) {
	                $(this).show();
	            } else {
	                $(this).hide();
	            }
	        });
	    });
	    $('#Area').trigger('change');
	});

	$(function(){
	    $('#Sector').on('change', function(){
	        var val = $(this).val();
	        var sub = $('#Chapter');
	        $('option', sub).filter(function(){
	            if (
	                 $(this).attr('data-group') === val
	              || $(this).attr('data-group') === 'SHOW'
	            ) {
	                $(this).show();
	            } else {
	                $(this).hide();
	            }
	        });
	    });
	    $('#Sector').trigger('change');
	});
</script>
</div>
<!-- / .wrapper -->
</body>
</html>
