<?php
    
    $user_id            = $_POST['user_id'];
    $cid                =$_POST['cid'];
    $data		= array();
    $data1		= array();
    
    if(!empty($user_id) || $user_id!="")
        {
           $qry= "SELECT ur.name,ur.profilepic, cm.* FROM `users` as ur inner join `church_members` as cm on ur.id=cm.userid WHERE cm.status=1 AND cm.cid=".$cid;
           
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
           if($count != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                  
                    $data['userid'] =$row['userid'];
                    $data['name']   =$row['name'];
                    $data['profilepic']=$row['profilepic'];
                    $data1[]	= $data;
                }
                    //$response["count"] 	    = $count;
                    $response["error"] 	        = 0;
                    $response["success"] 	= 1;
                    $response["message"] 	= "Data Get Successfully";
                    $response["post_info"] 	= $data1;
            }
            else
            {
                        $response["error"]      = 0;
                        $response["success"]    = 1;
                        $response["message"]    = "data not found";
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
