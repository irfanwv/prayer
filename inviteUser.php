<?php

include 'simplepush.php';
$user_id=$_POST['user_id'];
$gid=$_POST['gid'];
$time = date("Y-m-d : H:i:s", time());
$date = date("Y-m-d");
$table = "group_members";
$pushnoti = array();

   if(!empty($user_id) || $user_id != "")
   {
          $qry= "SELECT * FROM groups where id=".$gid;
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
          if($count > 0)
          {
       
		    $concol = ' `gid`, `userid`, `status`, `date`';
		    $value = "'".$gid."','".$user_id."','0','".$time."'";
		    $data=$db->SaveData($table,$concol,$value);
		    
                if($data!=false){
					 
					 $obj = mysqli_fetch_assoc($result);
					 
			  
					 $qry1= "SELECT * FROM users where Id ='".$user_id."'";
                     $result1= mysqli_query($db->dbcon(), $qry1);
                     $row1 = mysqli_fetch_assoc($result1);
					 $msg=$row1['name'].' sent you invitation to join '.$obj['name'].' Group';
					 
					 $qry11= "SELECT * FROM users where id ='".$user_id."'";
                     $result11= mysqli_query($db->dbcon(), $qry11);
                     $row2 = mysqli_fetch_assoc($result11);
					 
					 
					 $pushnoti['type'] = 'Invitations_notification';
					 $pushnoti['body'] = array( 'message' => $msg);
					
					  $deviceToken	= $row2['device_token'];
			          $deviceType	= $row2['device_type'];
					 
					 /*** Start Favorite Products Notification ***/
								 
								   if($deviceType == 1)
								   {   
								    send_notification_iphone ($deviceToken, $pushnoti);
								   }
								   else
								   {
								     send_notification ($deviceToken, $pushnoti);
								   }	 
		    $response["error"] = 0;
                    $response["success"] = 1;
                    $response["message"] = "Invite user successfully";
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