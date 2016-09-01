
<?php
include 'simplepush.php'; //for iphone notification
$senderid=$_POST['senderid'];
$receiverid=$_POST['receiverid'];
$msg=$_POST['msg'];
$time = date("Y-m-d : H:i:s", time());
$pushnoti = array();
$pushnoti['type'] = 'message_notification';	
//$pushnoti['body'] = array( 'message' => $msg);
//$status =0;

$table = "messages" ;

	if(!empty($senderid) || $senderid != "")
    {
		       $concol = '`senderid`, `receiverid`, `msg`, `sdelete`, `rdelete`, `status`, `updated`';
               $value = "'".$senderid."','".$receiverid."','".$msg."','".$sdelete."','".$rdelete."','".$status."','".$time."'"; 
			   $data=$db->SaveData($table,$concol,$value);
			   $last_saved_id = mysqli_insert_id($db->dbcon());
                if($data!=false)
				{
					 $qry = "SELECT * FROM users WHERE Id='".$receiverid."'";
					  $reslt = mysqli_query($db->dbcon(), $qry) or die (mysqli_error());
					  $no_of_row = mysqli_num_rows($reslt);
					  
					  $qry1 = "SELECT * FROM users WHERE Id='".$senderid."'";
					  $reslt1 = mysqli_query($db->dbcon(), $qry1) or die (mysqli_error());
					  //$no_of_row = mysqli_num_rows($reslt1);
					  $row1 = mysqli_fetch_assoc($reslt1);
					  $msg1=json_decode($msg);
					  $pushnoti['body']=array( 'name' => $row1['name'],'message' => $msg1);
					
					  
					  if($no_of_row > 0)
					  {
						
						$row = mysqli_fetch_assoc($reslt);
						$deviceToken	= $row['device_token'];
						$deviceType	= $row['device_type'];
						
						
						/*** Start Favorite Products Notification ***/
						  if($deviceType == 1)
						  {   
							send_notification_iphone ($deviceToken, $pushnoti);
						  } else
						  {       $pushnoti1=  json_encode($pushnoti);
							 send_notification ($deviceToken, $pushnoti1);
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
