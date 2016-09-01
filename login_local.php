<?php
require_once 'include/emp_request.php';
$json = array(); $get_id='';
$time = date("Y-m-d : H:i:s", time());
$table = users ;
$infotable = userinfo ;
$usernameEmail=$_POST['email'];
$password=$_POST['password'];

$where_email = '`email`="'.$usernameEmail.'"';
$check_email = $db->selectcommand('*',$table,$where_email);
$userinfo=$db->fetchObject($check_email);
$hash=$userinfo->password;

if (password_verify($password, $hash)) {
    $user=$db->fetchObject($check_email);
	$response['error']=0;
	$response['success']=1;
	$response['message']="User Login Successful";
	$response['user_id']=$userinfo->id;
	$response['name']=$userinfo->name;	
	$response['email']=$userinfo->email;
} else {
    $response["error"] = 1;
	$response["success"] = 0;
	$response["message"] = "Login Fail";
}


echo json_encode($response);
?>
