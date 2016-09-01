<?php
require_once 'include/emp_request.php';
$json = array(); $get_id='';
$time = date("Y-m-d : H:i:s", time());
$table = users ;
$infotable = userinfo ;
$usernameEmail=$_POST['email'];
$password=md5($_POST['password']);
$where_email = '`email`="'.$usernameEmail.'"  and `password` = "'.$password.'"';
$check_email = $db->selectcommand('*',$table,$where_email);
//$count = mysqli_num_rows($check_email);
$emailCount = mysqli_num_rows($check_email);

if($emailCount>0)
{
	$count=$emailCount;
	$user=$db->fetchObject($check_email);
	$response['error']=0;
	$response['success']=1;
	$response['message']="User Login Successful";
	$response['user_id']=$user->id;
	$response['name']=$user->name;
	$response['username']=$user->username;
	$response['email']=$user->email;
}
else
{
	$response["error"] = 1;
	$response["success"] = 0;
	$response["message"] = "Login Fail";
}

echo json_encode($response);
?>
