
<?php
include 'simplepush.php'; //for iphone notification
$user_id=$_POST['user_id'];
$type=$_POST['type'];
$category=$_POST['category'];
$message=$_POST['message'];
$time = date("Y-m-d : H:i:s", time());
$date = date("Y-m-d ");
$table = "posts" ;

if(!empty($user_id) || $user_id != "")
{

		       $concol = '`userid`, `message`, `date`, `status`, `type`, `category`, `created_at`, `updated_at`';
				$value = '"'.$user_id.'","'.$message.'","'.$date.'","1","'.$type.'","'.$category.'","'.$time.'","'.$time.'"';
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
