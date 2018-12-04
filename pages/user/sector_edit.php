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
	$query = mysqli_query($connect,"SELECT * FROM info_sector WHERE id = $idnum");

	//Fetch Equipment Information
	while($row = mysqli_fetch_assoc($query)){
		$id = $row['id'];
		$Sector_Name = $row['sectorName'];
    $areaID = $row['areaId'];
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12" >
        <div class="panel panel-success">
          <div class="panel-heading">
            Sector Information
          </div>
          <div class="panel-body">
            <form action="database/edit_sector.php" enctype="multipart/form-data" method="post">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-12">
                    <label>Sector ID</label>
                    <input class="form-control" name="SectorID" value="<?PHP echo $id;?>" readonly>
                    <label>Area Name</label>
    								<select class="form-control" name="Area">
    									<option value="">Please Select Area</option>
    								<?PHP
    									$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
    									$area = mysqli_query($connect, "SELECT * FROM info_area");
    									while($row = mysqli_fetch_assoc($area)){
    										if($row['id'] == $areaID) {
    											echo "<option value = ". $row['id']." selected>".$row['areaName']."</option>";
    										}
    										else {
    											echo "<option value = ". $row['id'].">".$row['areaName']."</option>";
    										}
    									}
    									mysqli_close($connect);
    								?>
    								</select>
                    <label>Sector Name</label>
                    <input class="form-control" name="SectorName" value="<?PHP echo $Sector_Name;?>" required>
                    <br>
                    <center>
                      <button type="submit" class="btn btn-success">Save</button>
                      <button type="reset" class="btn btn-danger">Reset</button>
                    </center>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- jQuery -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- / .wrapper -->
</body>
</html>
