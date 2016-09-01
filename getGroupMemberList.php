<?php
    $user_id = $_POST['user_id'];
    $gid = $_POST['gid'];
    $data		= array();
    $data1		= array();
    $imgUrl=myhost.'profilepic/';
    if(!empty($user_id) || $user_id!="")
        {
          $qry= "SELECT us.id,us.name,us.profilepic FROM group_members as gm inner join users as us on us.id=gm.userid where gm.gid=".$gid;
           
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
           if($count != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                   // $data['profilepic']=$row['profilepic'];
                   // $data['type']=$row['type'];
                    $data['name']=$row['name'];
                    $data['user_id']=$row['id'];
                   // $data['profilepic']=$row['profilepic'];
                  //  $data['details']=json_decode($row['details']);
                  //  $data['settings']=json_decode($row['settings']);
                   // $data['news']=$row['news'];
                   // $data['cover']=$imgUrl.$row['cover'];
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
