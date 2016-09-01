<?php
    
    $user_id            = $_POST['user_id'];
    $pid                = $_POST['pid'];
    $type               = $_POST['type'];
    $data		= array();
    $data1		= array();
    $imgUrl             =myhost.'profilepic/';    
    if(!empty($user_id) || $user_id!="")
        {
           $qry= "SELECT cm.id,cm.type,cm.comment,cm.userid,us.name,us.profilepic FROM comments as cm inner join users as us on us.id=cm.userid WHERE cm.pid=".$pid." and cm.type=".$type;
           
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
           if($count != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                  
                    $data['comment']=$row['comment'];
                    $data['type']=$row['type'];
                    $data['cid']=$row['id'];
                    $data['name']=$row['name'];
                    $data['userid']=$row['userid'];
                    $data['profilepic']=$imgUrl.$row['profilepic'];
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
