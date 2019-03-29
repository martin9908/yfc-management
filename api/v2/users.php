<?php
// Connect to database
	include("../connection.php");
	$db = new dbObj();
	$connection =  $db->getConnstring();

	$request_method=$_SERVER["REQUEST_METHOD"];

  switch($request_method)
	{
		case 'GET':
			// Retrive Users
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				get_users($id);
			}
      else if (!empty($_GET["user_name"]) && !empty($_GET["password"]) && empty($_GET['fcm']))
      {
        $user_name=intval($_GET["user_name"]);
        $password=$_GET["password"];
        // header("Content-Type: application/json");
        // echo json_encode($password);
        login($user_name, $password);
			}
			else if (!empty($_GET['user_name']) && !empty($_GET["password"]) && !empty($_GET['fcm']))
			{
				$user_name = $_GET['user_name'];
				$password = $_GET['password'];
				$fcm = $_GET['fcm'];
				mobile_login($user_name, $password, $fcm);
			}
			else
			{
				get_users();
			}
			break;
    case 'POST':
      // Insert Users
      insert_users();
      break;
    case 'PUT':
      // Update Users
      $id=intval($_GET["id"]);
      update_employee($id);
      break;
    case 'DELETE':
      // Delete Users
      $id=intval($_GET["id"]);
      delete_employee($id);
      break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}

  function get_users($id=0)
  {
  	global $connection;
  	$query="SELECT * FROM info_user";
  	if($id != 0)
  	{
  		$query.=" WHERE id=".$id." LIMIT 1";
  	}
  	$response=array();
  	$result=mysqli_query($connection, $query);
  	while($row=mysqli_fetch_array($result))
  	{
  		$response[]=$row;
  	}
  	header('Content-Type: application/json');
  	echo json_encode($response);
  }

  function login($username=0,$password=0)
  {
    global $connection;
    $query="SELECT * FROM info_user WHERE User_Number='".$username."' and password='".$password."'";
    $response=array();
    $result=mysqli_query($connection, $query);
    if(mysqli_num_rows($result)>0)
    {
    	while($row=mysqli_fetch_array($result))
    	{
      	$response[]=$row;
      }
  	}
    else
    {
      $response = array(
        "code" => 404,
        "status" => "Not Found",
        "error" => array(
          "code" => 404,
          "message" => "Invalid Username and/or Password"
        )
      );
    }
		header('Content-Type: application/json');
  	echo json_encode($response);
	}
	
	function mobile_login($username=0, $password=0, $fcm=0){
		global $connection;
		$query="SELECT * FROM info_user WHERE User_Number='".$username."' and password='".$password."'";
		$response=array();
		$id = "";
		$result=mysqli_query($connection, $query);
    if(mysqli_num_rows($result)>0)
    {
    	while($row=mysqli_fetch_array($result))
    	{
				$id = $row['id'];
			}
			$update_query="UPDATE info_user SET `FCM_ID` = '".$fcm."' WHERE `id` = ".$id."";
			if(mysqli_query($connection, $update_query))
			{
				$query="SELECT * FROM info_user WHERE User_Number='".$username."' and password='".$password."'";
				$response=array();
				$result=mysqli_query($connection, $query);
				while($row=mysqli_fetch_array($result))
				{
					$response[]=$row;
				}
			}
			else 
			{
				$response=array(
					'status' => 0,
					'status_message' =>'User Update Failed.'
				);
			}
  	}
    else
    {
      $response = array(
        "code" => 404,
        "status" => "Not Found",
        "error" => array(
          "code" => 404,
          "message" => "Invalid Username and/or Password"
        )
      );
    }
  	header('Content-Type: application/json');
		// echo $update_query;
		echo json_encode($response);
	}

  function insert_users()
	{
		global $connection;

		$data = json_decode(file_get_contents('php://input'), true);
    $User_Number=$data["User_Number"];
    $First_Name=$data["First_Name"];
    $Middle_Name=$data["Middle_Name"];
    $Last_Name=$data["Last_Name"];
    $Gender=$data["Gender"];
    $Address=$data["Address"];
    $Contact_Number=$data["Contact_Number"];
    $Account_Type=$data["Account_Type"];
    $Account_Status=$data["Account_Status"];
    $password=$data["password"];
    $Area=$data["Area"];
    $Sector=$data["Sector"];
    $Chapter=$data["Chapter"];
    $Member_Since=$data["Member_Since"];
    $Account_Picture=$data["Account_Picture"];

		echo $query="INSERT INTO info_user SET User_Number='".$User_Number."', First_Name='".$First_Name."', Middle_Name='".$Middle_Name."', Last_Name='".$Last_Name."', Gender='".$Gender."', Address='".$Address."', Contact_Number='".$Contact_Number."', Account_Type='".$Account_Type."', Account_Status='".$Account_Status."', password='".$password."', Area='".$Area."', Sector='".$Sector."', Chapter='".$Chapter."', Member_Since='".$Member_Since."', Account_Picture='".$Account_Picture."'";
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'User Added Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'User Addition Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

  function update_employee($id)
	{
		global $connection;
		$post_vars = json_decode(file_get_contents("php://input"),true);
    $User_Number=$data["User_Number"];
    $First_Name=$data["First_Name"];
    $Middle_Name=$data["Middle_Name"];
    $Last_Name=$data["Last_Name"];
    $Gender=$data["Gender"];
    $Address=$data["Address"];
    $Contact_Number=$data["Contact_Number"];
    $Account_Type=$data["Account_Type"];
    $Account_Status=$data["Account_Status"];
    $password=$data["password"];
    $Area=$data["Area"];
    $Sector=$data["Sector"];
    $Chapter=$data["Chapter"];
    $Member_Since=$data["Member_Since"];
    $Account_Picture=$data["Account_Picture"];
		$query="UPDATE info_user SET User_Number='".$User_Number."', First_Name='".$First_Name."', Middle_Name='".$Middle_Name."', Last_Name='".$Last_Name."', Gender='".$Gender."', Address='".$Address."', Contact_Number='".$Contact_Number."', Account_Type='".$Account_Type."', Account_Status='".$Account_Status."', password='".$password."', Area='".$Area."', Sector='".$Sector."', Chapter='".$Chapter."', Member_Since='".$Member_Since."', Account_Picture='".$Account_Picture."'";
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'User Updated Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'User Updation Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

  function delete_employee($id)
  {
  	global $connection;
  	$query="DELETE FROM info_user WHERE id=".$id;
  	if(mysqli_query($connection, $query))
  	{
  		$response=array(
  			'status' => 1,
  			'status_message' =>'User Deleted Successfully.'
  		);
  	}
  	else
  	{
  		$response=array(
  			'status' => 0,
  			'status_message' =>'User Deletion Failed.'
  		);
  	}
  	header('Content-Type: application/json');
  	echo json_encode($response);
  }
?>
