<?PHP
	session_start();
	//Database Connection String
	require("database/connect.php");
	$number = mt_rand(100000, 999999);
	$year = date("Y");
	$Account_Type = isset($_SESSION['Account_Type']) ? $_SESSION['Account_Type'] : null;

    if ($Account_Type != 1){
        $areaSearch = "SELECT * FROM info_area WHERE areaName = '". $_SESSION['Area_Name']. "'";
    }
    else {
        $areaSearch = "SELECT * FROM info_area";
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
    <div class="container-fluid" style="margin-bottom: 60px;">
        <div class="row">
            <div class="col-lg-12" style="width:640px">
            	<div class="col-lg-12">
                    <form action="user_createdb.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>ID Number</label>
                            <input class="form-control" name="IDNum" value="YMM-<?PHP echo $year."-".$number?>" readonly>
                            <label>First Name</label>
                            <input class="form-control" name="FName" required>
                            <label>Middle Name</label>
                            <input class="form-control" name="MName">
                            <label>Last Name</label>
                            <input class="form-control" name="LName" required>
                            <label>Address</label>
                            <input class="form-control" name="Address" required>
                            <label>Gender</label>
														<select class="form-control" name="Gender" required>
	                            <option value="">Select A Gender</option>
															<option value="M">Male</option>
															<option value="F">Female</option>
														</select>
														<label>Contact Number</label>
														<div class="form-group input-group">
															<span class="input-group-addon">+63</span>
	                            <input class="form-control" name="ConNum" placeholder="9XXXXXXXXX" required>
														</div>
														<label>Area</label>
														<select class="form-control" id="Area" name="Area" required>
															<option value="">Please Select Area</option>
														<?PHP
															$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
															$area = mysqli_query($connect, $areaSearch);
															while($row = mysqli_fetch_assoc($area)){
																echo "<option value = ". $row['id'].">".$row['areaName']."</option>";
															}
															mysqli_close($connect);
														?>
														</select>
														<label>Sector</label>
		                        <select class="form-control" id="Sector" name="Sector" required>
															<option data-group="SHOW" value="">Please Select Sector</option>
															<?PHP
															$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
															$sector = mysqli_query($connect, "SELECT * FROM info_sector");
															while($row = mysqli_fetch_assoc($sector)){
																echo "<option data-group=". $row['areaId'] ." value = ". $row['id'].">".$row['sectorName']."</td>";
															}
															mysqli_close($connect);
															?>
														</select>
														<label>Chapter</label>
														<select class="form-control" id="Chapter" name="Chapter" required>
															<option data-group="SHOW" value="">Please Select Chapter</option>
														<?PHP
															$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
															$chapter = mysqli_query($connect, "SELECT * FROM info_chapter");
															while($row = mysqli_fetch_assoc($chapter)){
																echo "<option data-group=". $row['sectorId'] ." value = ". $row['id'].">".$row['chapterName']."</option>";
															}
															mysqli_close($connect);
														?>
														</select>
														<label>Member Since</label>
														<input class="form-control" name="Member_Since" type="date" required>
                            <label>Account Type</label>
                            <select class="form-control" name="Account_Type">
															<?PHP if ($Account_Type == 1){?>
																<option value = "">Select An Account Type</option>
																<option value = "1">Administrator</option>
																<option value = "2">Area Encoder</option>
																<option value = "3">Sector Encoder</option>
																<option value = "4">Chapter Encoder</option>
																<option value = "0">User</option>
															<?PHP } else if ($Account_Type == 2) { ?>
																<option value = "">Select An Account Type</option>
																<option value = "2">Area Encoder</option>
																<option value = "3">Sector Encoder</option>
																<option value = "4">Chapter Encoder</option>
																<option value = "0">User</option>
															<?PHP } else if ($Account_Type == 3) {?>
																<option value = "3">Sector Encoder</option>
																<option value = "4">Chapter Encoder</option>
																<option value = "0">User</option>
															<?PHP } else {?>
																<option value = "4">Chapter Encoder</option>
																<option value = "0">User</option>
															<?PHP } ?>
                            </select>
														<?PHP if ($Account_Type == 1) { ?>
															<input type="hidden" name="Account_Status" value="Active">
														<?PHP } else { ?>
															<input type="hidden" name="Account_Status" value="Pending">
														<?PHP } ?>
														<label>Profile Picture</label>
														<input type='file' onChange="readURL(this);" name="uploadedimage"/>
                        </div>
                       <button type="submit" class="btn btn-success col-xs-offset-5">Create</button>
                       <button type="reset" class="btn btn-danger">Reset</button>
                        <!-- /.form-group -->
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.col-lg-12-->
        </div>
        <!-- /.row-->
    </div>
	<!-- / .container-fluid -->
</div>
<!-- / .wrapper -->
<script>
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
</body>
</html>
