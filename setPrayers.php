<?php
include 'simplepush.php'; //for iphone notification
$uid=$_POST['uid'];
$pid=$_POST['pid'];
$type=$_POST['type'];
$pushnoti = array();
$pushnoti['type'] = 'prayer_notification';	


$table = "prayers" ;

if(!empty($uid) || $uid != "")
{
			   
		       $concol = 'pid, uid, type';
			   $value = '"'.$pid.'","'.$uid.'","'.$type.'"';
			   $data=$db->SaveData($table,$concol,$value);
			   $last_saved_id = mysqli_insert_id($db->dbcon());
                if($data!=false)
                {
							
						      $postqry = "SELECT * FROM posts WHERE id='".$pid."'";
							  $postreslt = mysqli_query($db->dbcon(), $postqry) or die (mysqli_error());
							  $no_of_row_post = mysqli_num_rows($postreslt);
							  if($no_of_row_post > 0)
							  {
							   
								// $postrow = mysqli_fetch_row($postreslt);
								$postrow = mysqli_fetch_assoc($postreslt);
							    $postuserid	= $postrow['userid'];
								
							
							      $qry = "SELECT * FROM users WHERE Id='".$postuserid."'";
			                      $reslt = mysqli_query($db->dbcon(), $qry) or die (mysqli_error());
							      $no_of_row = mysqli_num_rows($reslt);
							      if($no_of_row > 0)
							      {
											 $qry1 = "SELECT * FROM users WHERE Id='".$uid."'";
											 $reslt1 = mysqli_query($db->dbcon(), $qry1) or die (mysqli_error());
											 $row1 = mysqli_fetch_assoc($reslt1);
											 $row = mysqli_fetch_assoc($reslt);
											 $msa= $row1['name'].' pray on your prayer request';
											 $pushnoti['body'] = array( 'message' => $msa);	
												
							      
								  // print_r($row);
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
					$response['insertedId']=$last_saved_id;
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