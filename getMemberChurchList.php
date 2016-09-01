<?php
    
    $user_id  = $_POST['user_id'];

    $data		= array();
    $data1		= array();
    $imgUrl=myhost.'profilepic/';
    if(!empty($user_id) || $user_id!="")
        {
                $qry= "SELECT * FROM church_members as cm inner join users as us on cm.cid=us.id where userid=".$user_id." and type=1";
                $result= mysqli_query($db->dbcon(), $qry);
                $num=mysqli_num_rows($result);
            
           if($num != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $data['count']=$num;
                    $data['cid']=$row['id'];
                    $data['name']=$row['name'];
                    $data['profilepic']=$imgUrl.$row['profilepic'];
                    
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
                $response["message"]    = "No Church Request to show";
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
