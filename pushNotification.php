<?php

/*
 *
 *This is Cronjob file, It is reset the current counter of every category in given time.
 */


require_once 'include/emp_request.php';
include 'simplepush.php'; //for iphone notification
    $user_id	= $_POST['user_id']=54;
	
          $pushnoti = array();
          $pushnoti['type'] = 'message_notification';	
          $pushnoti['body'] = array( 'message' => "Your Order id Completed");	

    $db = new Webservice();
    $qry = "SELECT * FROM users WHERE Id='".$user_id."'";
    $reslt = mysqli_query($db->dbcon(), $qry) or die (mysqli_error());
    $no_of_row = mysqli_num_rows($reslt);
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
        {
          echo send_notification ($deviceToken, $pushnoti);
        }
    } else
    {
	$response["error"]   = 1;
	$response["success"] = 0;
	$response["message"] = "Invalid User ID";	    
    }

 ?>
 