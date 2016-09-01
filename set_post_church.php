<?php
$user_id=$_POST['user_id'];
$churchid=$_POST['churchid'];
$type=$_POST['type'];
$category=$_POST['category'];
$cpmessage=$_POST['cpmessage'];
$time = date("Y-m-d : H:i:s", time());
$date = date("Y-m-d ");
$table = "church_posts" ;

if(!empty($user_id) || $user_id != "")
{
		       $concol = '`churchid`, `userid`, `cpmessage`, `type`, `category`, `status`, `cpdate`';
			   $value = '"'.$churchid.'","'.$user_id.'","'.$cpmessage.'","'.$type.'","'.$category.'","1","'.$date.'"';
			   
	
			   $data=$db->SaveData($table,$concol,$value);
			   $last_saved_id = mysqli_insert_id($db->dbcon());
                if($data!=false){
                    
                    $response["error"] = 0;
                    $response["success"] = 1;
                    $response["message"] = "Data Inserted successfully";
               
                }
                else
                {
                    $response["error"] = 1;
                    $response["success"] = 0;
                    $response["message"] = "Data Not Inserted successfully";  
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