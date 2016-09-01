
<?php
include 'simplepush.php'; //for iphone notification
$user_id=$_POST['user_id'];
$type=$_POST['type'];
$pid=$_POST['pid'];
$comment=$_POST['comment'];
$time = date("Y-m-d : H:i:s", time());
$date = date("Y-m-d ");
$table = "comments" ;
$pushnoti = array();

if(!empty($user_id) || $user_id != "")
{
		       $concol = '`pid`, `userid`, `type`, `comment`, `created_at`, `updated_at`';
			   $value = '"'.$pid.'","'.$user_id.'","'.$type.'","'.$comment.'","'.$time.'","'.$time.'"';
			   $data=$db->SaveData($table,$concol,$value);
			   $last_saved_id = mysqli_insert_id($db->dbcon());
                if($data!=false){
							  
							  $postqry = "SELECT * FROM posts WHERE id='".$pid."'";
							  $postreslt = mysqli_query($db->dbcon(), $postqry) or die (mysqli_error());
							  $no_of_row_post = mysqli_num_rows($postreslt);
							  if($no_of_row_post > 0)
							  {
								
								 $postrow = mysqli_fetch_assoc($postreslt);
							     $postuserid	= $postrow['userid'];
								
							      $qry = "SELECT * FROM users WHERE id='".$postuserid."'";
			                      $reslt = mysqli_query($db->dbcon(), $qry) or die (mysqli_error());
							      $no_of_row = mysqli_num_rows($reslt);
							      if($no_of_row > 0)
							      {
									$qry1 = "SELECT * FROM users WHERE id='".$user_id."'";
			                      $reslt1 = mysqli_query($db->dbcon(), $qry1) or die (mysqli_error());
								  $row1 = mysqli_fetch_assoc($reslt1);
								   $noti_msg=$row1['name'].' comment on your post';
												
							       $row = mysqli_fetch_assoc($reslt);
								   
								  
								   
								   $pushnoti['type'] = 'comment_notification';	
							       $pushnoti['body'] = array( 'message' => $noti_msg);
							        $deviceToken	= $row['device_token'];
							        $deviceType	= $row['device_type'];
							  
							  
							  /*** Start Favorite Products Notification ***/
								   if($deviceType == 1)
								   {   
								    send_notification_iphone ($deviceToken, $pushnoti);
								   }
								   else
								   {
								     send_notification ($deviceToken, $pushnoti);
								   }
							      }	
								
							  }		
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
