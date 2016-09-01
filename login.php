<?php
require_once 'include/emp_request.php';
$json = array(); $get_id='';
$time = date("Y-m-d : H:i:s", time());
$table = users ;
$infotable = userinfo ;
$usernameEmail=$_POST['email'];
$password=$_POST['password'];

$device_type = $_POST['device_type'];
$device_token = $_POST['device_token'];

$where_email = '`email`="'.$usernameEmail.'"';
$check_email = $db->selectcommand('*',$table,$where_email);
$userinfo=$db->fetchObject($check_email);
$hash=$userinfo->password;
$imgUrl=myhost.'profilepic/';
	if (password_verify($password, $hash))
	{
	    $user=$db->fetchObject($check_email);
		$response['error']=0;
		$response['success']=1;
		$response['message']="User Login Successful";
		$response['user_id']=$userinfo->id;
		$response['name']=$userinfo->name;
		$response['type']=$userinfo->type;
		if($userinfo->default=='' || $userinfo->default == 'null'){ $uinfo = ''; }
		else { $uinfo = $userinfo->default; }
		$response['defaultchurch']=$uinfo;
		$response['email']=$userinfo->email;
		$response['profilepic']=$imgUrl.$userinfo->profilepic;
		$qrry = "UPDATE users SET device_type='".$device_type."', device_token='".$device_token."' WHERE id=".$userinfo->id;
		$results= mysqli_query($db->dbcon(), $qrry);
		//$response["url"] = $imgUrl.$row1['profilepic'];
		if($userinfo->type == 1)
		{
			$qry= "SELECT * FROM churchinfo where userid=".$userinfo->id;
			$result= mysqli_query($db->dbcon(), $qry);
			$row = mysqli_fetch_assoc($result) ;
			$num=mysqli_num_rows($result);
			$response['header_image']=$row['header_image'];
			//$response['country']=$row['country'];
			$response['notifications']=json_decode($row['notifications']);
		} else
		{
			$qry= "SELECT * FROM userinfo where userid=".$userinfo->id;
			$result= mysqli_query($db->dbcon(), $qry);
			$row = mysqli_fetch_assoc($result) ;
			$num=mysqli_num_rows($result);
			$response['gender']=$row['gender'];
			$response['country']=$row['country'];
			if($row['notifications']=='' || $row['notifications'] == 'null'){ $unoti = ''; }
			else { $unoti = json_decode($row['notifications']); }
			$response['notifications']=$unoti;
			$response['state']=$row['state'];	
		}
		
		

	
	} else
	{
		$response["error"] = 1;
		$response["success"] = 0;
		$response["message"] = "Enter correct Email Id/ Password";
	}


echo json_encode($response);
exit;
?>
