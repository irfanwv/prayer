<?php
    
    $user_id            = $_POST['user_id'];
    $cid                =$_POST['cid'];
    $data		= array();
    $data1		= array();
    
    if(!empty($user_id) || $user_id!="")
        {
           $qry = "INSERT INTO `church_members`(`cid`, `userid`, `status`, `moderator` ) ";
           $qry .= "VALUES ('".$cid."','".$user_id."',0,0)".$pid;
           
          $result           = mysqli_query($db->dbcon(), $qry);
          $last_saved_id    = mysqli_insert_id($db->dbcon()); 
           if($last_saved_id != 0)
           {
                    //$response["count"] 	    = $count;
                    $response["error"] 	        = 0;
                    $response["success"] 	= 1;
                    $response["message"] 	= "Church join Successfully";
                    $response["post_info"] 	= $data1;
            }
            else
            {
                        $response["error"]      = 0;
                        $response["success"]    = 1;
                        $response["message"]    = "Church not join";
            }
        }
    else
        {
                $response["error"]      = 1;
                $response["success"]    = 0;
                $response["message"]    = "User Not Loged In";
        }
    echo json_encode($response);
    exit;
?>
