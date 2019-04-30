<?PHP
	session_start();
    //Database Connection String
    require("database/connect.php");

    //Connect Strings
	$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
    
    //Equipment Info
	$ppid = $_GET['ppid'];

    //Date Today
	$currentDate   = date("Y-m-d");
	$Area_Value	   = isset($_SESSION['Area']) ? $_SESSION['Area'] : null;
	$Sector_Value  = isset($_SESSION['Sector']) ? $_SESSION['Sector'] : null;
    $Chapter_Value = isset($_SESSION['Chapter']) ? $_SESSION['Chapter'] : null;
    
    //SQL Scripts
    $query = mysqli_query($connect, 
    "SELECT * FROM
	    reservation_venue
    WHERE
        id = $ppid");

    //Fetch Equipment Information
	while($row = mysqli_fetch_assoc($query)){
		$id = $row['id'];
		$reservation_place = $row['reservation_place'];
		$reservation_date = $row['reservation_date'];
		$reservation_end_date = $row['reservation_end_date'];
		$reservation_time = $row['reservation_time'];
		$reservation_end_time = $row['reservation_end_time'];
		$event_type = $row['event_type'];
		$reservation_event = $row['reservation_event'];
		$reservation_status = $row['reservation_status'];
		$reservation_area = $row['reservation_area'];
		$reservation_sector = $row['reservation_sector'];
		$reservation_chapter = $row['reservation_chapter'];
		$reservation_fee = $row['reservation_fee'];
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
    <div class="container-fluid" style="margin-bottom: 70px;">
        <div class="row">
            <div class="col-lg-12" style="width:300px">
                <form action="database/venue_edit.php" method="post">
                    <div class="form-group">
                        <input class="form-control" name="reservation_status" type="hidden" value="Reserved">
                        <input class="form-control" name="id" type="hidden" value="<?PHP echo $id?>">
                        <label>ID Number</label>
                        <input class="form-control" name="user_id" placeholder="ID Number" value="<?PHP echo $_SESSION['User_Number']?>" readonly>
                        <label>Venue Name</label>
                        <input class="form-control" name="reservation_place" value="<?PHP echo $reservation_place;?>" required>
                       	<label>Event Name</label>
                        <input class="form-control" name="reservation_event" value="<?PHP echo $reservation_event;?>" required>
                        <label>Event Start Date</label>
                        <input type="date" class="form-control" name="reservation_date" min="<?PHP echo $currentDate ?>" value="<?PHP echo $reservation_date;?>" required>
                        <label>Event End Date</label>
                        <input type="date" class="form-control" name="reservation_end_date" min="<?PHP echo $currentDate ?>" value="<?PHP echo $reservation_end_date;?>" required>
                        <label>Start Time</label>
                        <input type="time" name="reservation_time" class="form-control" value="<?PHP echo $reservation_time;?>" required>
                        <label>End Time</label>
                        <input type="time" name="reservation_end_time" class="form-control" value="<?PHP echo $reservation_end_time;?>" required>
                        </select>
                        <label>Area</label>
                        <select class="form-control" id="Area" name="reservation_area" required>
                            <option value="">Please Select Area</option>
                        <?PHP
                        if($_SESSION['Account_Type'] == 2 || $_SESSION['Account_Type'] == 3 || $_SESSION['Account_Type'] == 4)
                        {
                            $area_query = "SELECT * FROM info_area WHERE id = $Area_Value";
                        }
                        else
                        {
                            $area_query = "SELECT * FROM info_area";
                        }
                        $connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
                        $area = mysqli_query($connect, $area_query);
                        while($row = mysqli_fetch_assoc($area)){
                            if($row['id'] == $reservation_area){
                                echo "<option value = ". $row['id']." selected>".$row['areaName']."</td>";
                            } else {
                                echo "<option value = ". $row['id'].">".$row['areaName']."</td>";
                            }
                        }
                        mysqli_close($connect);
                        ?>
                        </select>
                        <label>Sector</label>
                        <select class="form-control" id="Sector" name="reservation_sector" required>
                            <option data-group="SHOW" value="">Please Select Sector</option>
                            <?PHP
                                if($_SESSION['Account_Type'] == 3 || $_SESSION['Account_Type'] == 4)
                                {
                                    $sector_query = "SELECT * FROM info_sector WHERE id = $Sector_Value";
                                }
                                else
                                {
                                    $sector_query = "SELECT * FROM info_sector";
                                }
                                $connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");
                                $sector = mysqli_query($connect, $sector_query);
                                while($row = mysqli_fetch_assoc($sector)){
                                    if($row['id'] == $reservation_sector){
                                        echo "<option data-group=". $row['areaId'] ." value = ". $row['id']." selected>".$row['sectorName']."</td>";
                                    } else {
                                        echo "<option data-group=". $row['areaId'] ." value = ". $row['id'].">".$row['sectorName']."</td>";
                                    }
                                }
                                mysqli_close($connect);
                            ?>
                        </select>
                        <label>Chapter</label>
                        <select class="form-control" id="Chapter" name="reservation_chapter" required>
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
                                if($row['id'] == $reservation_chapter){
                                    echo "<option data-group=". $row['sectorId'] ." value = ". $row['id']." selected>".$row['chapterName']."</option>";
                                } else {
                                    echo "<option data-group=". $row['sectorId'] ." value = ". $row['id'].">".$row['chapterName']."</option>";
                                }
                            }
                            mysqli_close($connect);
                        ?>
                        </select>
                        <label>Event Fee</label>
                        <input class="form-control" name="reservation_fee" value="<?PHP echo $reservation_fee;?>" required>
                        <label>Event Type</label>
                        <select class="form-control" name="event_type" required>
                            <?PHP if($event_type == "International") {?>
                            <option value="">Please Select Event Type</option>
                            <option value="Area">Area</option>
                            <option value="Sector">Sector</option>
                            <option value="Chapter">Chapter</option>
                            <option value="International" selected>International</option>
                            <?PHP } elseif ($event_type == "Area") {?>
                            <option value="">Please Select Event Type</option>
                            <option value="Area" selected>Area</option>
                            <option value="Sector">Sector</option>
                            <option value="Chapter">Chapter</option>
                            <option value="International">International</option>
                            <?PHP } elseif ($event_type == "Sector") {?>
                            <option value="">Please Select Event Type</option>
                            <option value="Area">Area</option>
                            <option value="Sector" selected>Sector</option>
                            <option value="Chapter">Chapter</option>
                            <option value="International">International</option>
                            <?PHP } elseif ($event_type == "Chapter") {?>
                            <option value="">Please Select Event Type</option>
                            <option value="Area">Area</option>
                            <option value="Sector">Sector</option>
                            <option value="Chapter" selected>Chapter</option>
                            <option value="International">International</option>
                            <?PHP }?>
                        </select>
                    </div>
                   <button type="submit" class="btn btn-success center-block">Edit</button>
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
