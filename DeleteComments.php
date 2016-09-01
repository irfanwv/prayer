<?php
$user_id=$_POST['user_id'];
$cid=$_POST['cid'];
//$type=$_POST['type'];

$table = "comments";
//$table1 = "prayers";

    if(!empty($user_id) || $user_id != "")
    {
        $qry=  "SELECT * FROM comments where id='$cid' and userid='$user_id'";
        $result= mysqli_query($db->dbcon(), $qry);
        $count=mysqli_num_rows($result);
        if($count > 0)
        {
             $where= "`id`='$cid' and `userid`='$user_id'";
             $data=	$db->delData($table,$where);
                if($data != false)
                {
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