<?PHP
	session_start();
	require("database/connect.php");
	//Equipment Info
	$idnum = $_GET['ppid'];

	//Date Today
	$currentDate = date("Y-m-d");
	$Area_Value	 		= isset($_SESSION['Area']) ? $_SESSION['Area'] : null;
	$Sector_Value		= isset($_SESSION['Sector']) ? $_SESSION['Sector'] : null;
	$Chapter_Value  = isset($_SESSION['Chapter']) ? $_SESSION['Chapter'] : null;
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
    <div class="container-fluid" style="margin-bottom: 70px;">
        <div class="row">
            <div class="col-lg-12" style="width:300px">
                <form action="database/reserve_venue.php" method="post">
                    <div class="form-group">
											<input class="form-control" name="status" type="hidden" value="Reserved">
											<label>ID Number</label>
                        <input class="form-control" name="id" placeholder="ID Number" value="<?PHP echo $_SESSION['User_Number']?>" readonly>
                        <label>Venue Name</label>
                        <input class="form-control" name="vname" required>
                       	<label>Event Name</label>
                        <input class="form-control" name="vevent" required>
 												<label>Event Start Date</label>
                        <input type="date" class="form-control" name="sdate" min="<?PHP echo $currentDate ?>" required>
												<label>Event End Date</label>
                        <input type="date" class="form-control" name="edate" min="<?PHP echo $currentDate ?>" required>
                        <label>Start Time</label>
                        <input type="time" name="stime" class="form-control" required>
												<label>End Time</label>
                        <input type="time" name="etime" class="form-control" required>
                        </select>
												<label>Area</label>
												<select class="form-control" id="Area" name="area" required>
													<option value="">Please Select Area</option>
												<?PHP
												if($_SESSION['Account_Type'] == 2 || $_SESSION['Account_Type'] == 3 || $_SESSION['Account_Type'] == 4)
												{
													$area_query = "SELECT * FROM info_area WHERE id = $Area_Value";
												}
												else
												{
													$area_query = "SELECT * FROM info_chapter";
												}
												$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
												$area = mysqli_query($connect, $area_query);
												while($row = mysqli_fetch_assoc($area)){
													echo "<option value = ". $row['id'].">".$row['areaName']."</td>";
												}
												mysqli_close($connect);
												?>
												</select>
												<label>Sector</label>
												<select class="form-control" id="Sector" name="sector" required>
													<option data-group="SHOW" value="">Please Select Sector</option>
													<?PHP
														if($_SESSION['Account_Type'] == 3 || $_SESSION['Account_Type'] == 4)
														{
															 $sector_query = "SELECT * FROM info_sector WHERE id = $Sector_Value";
														}
														else
														{
															$sector_query = "SELECT * FROM info_chapter";
														}
														$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
														$sector = mysqli_query($connect, $sector_query);
														while($row = mysqli_fetch_assoc($sector)){
															echo "<option data-group=". $row['areaId'] ." value = ". $row['id'].">".$row['sectorName']."</td>";
														}
														mysqli_close($connect);
													?>
												</select>
												<label>Chapter</label>
												<select class="form-control" id="Chapter" name="chapter" required>
													<option data-group="SHOW" value="">Please Select Chapter</option>
												<?PHP
													if($_SESSION['Account_Type'] == 4)
													{
														 $chapter_query = "SELECT * FROM info_chapter WHERE id = $Chapter_Value";
													}
													else
													{
														$chapter_query = "SELECT * FROM info_chapter";
													}
													$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
													$chapter = mysqli_query($connect, $chapter_query);
													while($row = mysqli_fetch_assoc($chapter)){
														echo "<option data-group=". $row['sectorId'] ." value = ". $row['id'].">".$row['chapterName']."</option>";
													}
													mysqli_close($connect);
												?>
												</select>
												<label>Event Fee</label>
                        <input class="form-control" name="fee" required>
												<label>Event Type</label>
												<select class="form-control" name="type" required>
													<option value="">Please Select Event Type</option>
													<option value="local">Local</option>
													<option value="International">International</option>
												</select>
                    </div>
                   <button type="submit" class="btn btn-success center-block">Reserve</button>
                    <!-- /.form-group -->
                </form>
                <!-- /.form -->
            </div>
        </div>
    </div>
</div>
<!-- / .wrapper -->
</body>
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
</html>
