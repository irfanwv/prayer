<?php
$user_id=$_POST['user_id'];
$gid=$_POST['gid'];
$type=$_POST['type'];
$gpmessage=$_POST['gpmessage'];
$category=$_POST['category'];


$time = date("Y-m-d : H:i:s", time());
$date = date("Y-m-d ");
$table = "group_posts";

if(!empty($user_id) || $user_id != "")
{
          $qry= "SELECT * FROM groups where id=".$gid;
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
           if($count > 0)
           {
                $concol = '`group_id`, `userid`, `gpmessage`, `type`, `category`, `gpdate`';
                $value = "'".$gid."','".$user_id."','".$gpmessage."','".$type."','".$category."','".$time."'";
                $data=$db->SaveData($table,$concol,$value);
                
                if($data!=false)
                {
		    $response["error"] = 0;
                    $response["success"] = 1;
                    $response["message"] = "Data Inserted Successfully";
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
                    $response["message"] = "group not available";  
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