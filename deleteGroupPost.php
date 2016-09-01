<?php
$user_id=$_POST['user_id'];
$pid=$_POST['pid'];

$table = "group_posts";
$table1 = "prayers";

    if(!empty($user_id) || $user_id != "")
    {
        $qry=  "SELECT * FROM group_posts where id='$pid' and userid='$user_id'";
        $result= mysqli_query($db->dbcon(), $qry);
        $count=mysqli_num_rows($result);
        if($count > 0)
        {
             $where= "`id`='$pid' and `userid`='$user_id'";
             $data=	$db->delData($table,$where);
                
             $where1= "`pid`='$pid' and `type`='0'";
             $data=	$db->delData($table1,$where1);
             $response["error"] = 0;
             $response["success"] = 1;
             $response["message"] = "Prayer Deleted successfully";       
        }
        else
        {
            $response["error"] = 1;
            $response["success"] = 0;
            $response["message"] = "Prayer Not Deleted";  
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