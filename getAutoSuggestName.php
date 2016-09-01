<?php
    
    $user_id  = $_POST['user_id'];
    $keyword=$_POST['keyword'];

    $data		= array();
    $data1		= array();
    if(!empty($user_id) || $user_id!="")
        {
                $qry= "SELECT *  FROM users WHERE type = 0 AND name LIKE '%".$keyword."%'";
                $result= mysqli_query($db->dbcon(), $qry);
                $num=mysqli_num_rows($result);
             
           if($num != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                  
                    $data['user_id']    =$row['id'];
                    $data['name']       =$row['name'];
                    
                    $data1[]	= $data;
                }
                
                $response["error"] 	    = 0;
                $response["success"] 	= 1;
                $response["message"] 	= "Data Get Successfully";
                $response["post_info"] 	= $data1;
            }
            else
            {
                $response["error"]      = 0;
                $response["success"]    = 1;
                $response["message"]    = "Suggestion Not Available";
                $response["post_info"] 	= $data1;
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
