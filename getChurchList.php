<?php
    
    $user_id            = $_POST['user_id'];
    $data		= array();
    $data1		= array();
    
    if(!empty($user_id) || $user_id!="")
    {
        $qry= "SELECT ur.id,ur.name, ci.header_image,ci.leader,ci.denomination,ci.churchtiming,ci.address,ci.tithe_image,ci.volunteer_image FROM `users` as ur inner join `churchinfo` as ci on ci.userid=ur.id WHERE ur.type=1";
        
       $result= mysqli_query($db->dbcon(), $qry);
       $count=mysqli_num_rows($result); 
        if($count != 0)
        {
             while ($row = mysqli_fetch_assoc($result))
             {
                $qry2 = "SELECT * FROM `church_members` where userid='".$user_id."' AND cid='".$row['id']."'";
                $result1    = mysqli_query($db->dbcon(), $qry2);
                $count1     = mysqli_num_rows($result1);
                if($count1 > 0)
                {
                    $data['join']      = 1;
                } else
                {
                    $data['join']      = 0;
                }
                $data['id']            = $row['id'];
                $data['name']          = $row['name'];
                $data['header_image']  = $row['header_image'];
                $data['leader']        = $row['leader'];
                $data['denomination']  = $row['denomination'];
                $data['churchtiming']  = $row['churchtiming'];
                $data['tithe_image']   = $row['tithe_image'];
                $data['address']       = json_decode($row['address'], true);
                $data1[]	        = $data;
             }
                 //$response["count"] 	    = $count;
                 $response["error"] 	    = 0;
                 $response["success"] 	    = 1;
                 $response["message"] 	    = "Data Get Successfully";
                 $response["post_info"]     = $data1;
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
