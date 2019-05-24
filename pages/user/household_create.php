<?PHP
//Database Connection String
require("database/connect.php");

//Connect Strings
$connect = mysqli_connect($host, $user, $pass,$databasename) or die("Couldn't connect to database!");

//SQL Scripts
$household = mysqli_query($connect, "SELECT * FROM info_user");
$users = mysqli_query($connect, "SELECT * FROM info_user");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Janine Sapinoso">

    <title>User - YFC Events Management System</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Add jQuery library -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- Select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

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
            Household Information
          </div>
          <div class="panel-body">
            <form action="database/create_household.php" enctype="multipart/form-data" method="post">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-12">
                    <label>Household Name</label>
                    <input class="form-control" name="household_name" required>
                    <label>Household Leader</label>
                    <select class="js-example-basic-single" name="household_leader">
                        <?PHP  while($row = mysqli_fetch_assoc($household)){?>
                            <option value="<?PHP echo $row['id']; ?>"><?PHP echo $row['First_Name']. " ". $row['Last_Name']?></option>
                        <?PHP }?>
                    </select>
                    <br />
                    <label>Select Members</label>
                    <div style="height:250px;width:350px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                      <?PHP  while($row1 = mysqli_fetch_assoc($users)){?>
                        <input type="checkbox" name="household_members[]" value="<?PHP echo $row1['First_Name']. " ". $row1['Last_Name']; ?>"><?PHP echo $row1['First_Name']. " ". $row1['Last_Name']?><br/>
                      <?PHP }?>
                    </div>
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
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<!-- / .wrapper -->
</body>
</html>
