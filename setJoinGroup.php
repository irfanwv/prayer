<?php
$user_id=$_POST['user_id'];
$gid=$_POST['gid'];
$type=$_POST['type'];

$time = date("Y-m-d : H:i:s", time());
$date = date("Y-m-d ");
$table = "group_members";

if(!empty($user_id) || $user_id != "")
{
          $qry= "SELECT * FROM groups where id=".$gid;
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
           if($count > 0)
           {
            
			if($type == 1)
			{
					 $qry1 = "UPDATE group_members SET status=1 WHERE gid='".$user_id."' AND userid='".$gid."'";
					 $data = mysqli_query($db->dbcon(), $qry1);
			}
			else
			{
					$concol = '`gid`, `userid`, `status`, `date`, `updated_at`, `created_at`';
                    $value = "'".$gid."','".$user_id."','1','".$time."','".$time."','".$time."'";
                    $data=$db->SaveData($table,$concol,$value);
			}
		   
		    
                if($data!=false)
		        {
					$response["error"]   = 0;
                    $response["success"] = 1;
                    $response["message"] = "Join Group successfully";
                }
                else
                {
                    $response["error"] = 1;
                    $response["success"] = 0;
                    $response["message"] = "group not Join";  
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