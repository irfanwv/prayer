<?php
    
    $user_id = $_POST['user_id'];
    $pid=$_POST['pid'];
    $data		= array();
    $data1		= array();
    
    if(!empty($user_id) || $user_id!="")
        {
        echo   $qry= "SELECT * FROM `prayers` WHERE `pid`=$pid";
           
          $result= mysqli_query($db->dbcon(), $qry);
          $num=mysqli_num_rows($result); 
           if($num != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                  
                    $data['pid']=$row['pid'];
                    $data['uid']=$row['uid'];
                    $data['message']=$row['message'];
                    $data1[]	= $data;
                }
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
