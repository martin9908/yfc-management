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
            Area Information
          </div>
          <div class="panel-body">
            <form action="database/create_area.php" enctype="multipart/form-data" method="post">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-12">
                    <label>Area Name</label>
                    <input class="form-control" name="AreaName" required>
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
