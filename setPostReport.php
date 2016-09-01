
<?php
$user_id=$_POST['user_id'];
$type=$_POST['type'];
$pid=$_POST['pid'];
$time = date("Y-m-d : H:i:s", time());
$date = date("Y-m-d");
$table = "report" ;

if(!empty($user_id) || $user_id != "")
{
    
    
		       $concol = '`pid`, `ptype`, `uid`, `date`';
		       $value = '"'.$pid.'","'.$type.'","'.$user_id.'","'.$time.'"';
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
