<?php

$device_token=$_POST['device_token'];
$device_type=$_POST['device_type'];
$user_id=$_POST['user_id'];

$time = date("Y-m-d : H:i:s", time());
$date = date("Y-m-d ");
$table = 'groups';

if(!empty($user_id) || $user_id != "")
{
			    $qry = "UPDATE users SET device_type='".$device_type."',device_token='".$device_token."' WHERE id=".$user_id;
				$result= mysqli_query($db->dbcon(), $qry);
			    
                           
			    if($result !=false)
			    {		
			       	$response["error"] = 0;
			        $response["success"] = 1;
			        $response["message"] = "Data Updata Successfully";	
			    }
			    else
			    {
                    $response["error"] = 1;
                    $response["success"] = 0;
                    $response["message"] = "Data Not Inserted";		
			    }
    }
    else
    {
            $response["error"] = 1;
            $response["success"] = 0;
            $response["message"] = "User Id Not valid";
 }
echo json_encode($response);
	exit;
?>