<?php
 $user_id=$_POST['user_id'];
 $pid=$_POST['pid'];
 $cid=$_POST['cid'];

$table = "church_posts";
$table1 = "prayers";

    if(!empty($user_id) || $user_id != "")
    {
        $qry=  "SELECT * FROM church_posts where cpid='$pid' and userid='$user_id'";
        $result= mysqli_query($db->dbcon(), $qry);
         $count=mysqli_num_rows($result);
        if($count > 0)
        {
             $where= "`cpid`='$pid' and `userid`='$user_id' and `churchid`='$cid'";
              $data=	$db->delData($table,$where);
                
             $where1= "`pid`='$pid' and `type`='1'";
             $data=	$db->delData($table1,$where1);
             if($data !=false)
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
            $response["message"] = "No Prayer To Delete";  
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