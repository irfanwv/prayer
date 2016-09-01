<?php
    
    $user_id = $_POST['user_id'];
    $pid=$_POST['pid'];
    
    //    $user_id = 34;
    //$pid=54;
     $imgUrl=myhost.'images/';
    $data		= array();
    $data1		= array();
    
    if(!empty($user_id) || $user_id!="")
        {
          $qry= "SELECT * FROM prayers as pr inner join `users` as ur on ur.id=pr.uid WHERE pr.pid=".$pid;
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
           if($count != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                  
                    //$data['pid']=$row['pid'];
                   // $data['uid']=$row['uid'];
                    $data['name']=$row['name'];
                    $data['profilepic']=$imgUrl.$row['profilepic'];
                    $data1[]	= $data;
                }
                    //$response["count"] 	    = $count;
                    $response["error"] 	    = 0;
                    $response["success"] 	= 1;
                    $response["message"] 	= "Data Get Successfully";
                    $response["post_info"] 	    = $data1;
            }
            else
            {
                        $response["error"]      = 1;
                        $response["success"]    = 0;
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
