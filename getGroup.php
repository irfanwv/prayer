<?php
    $user_id    = $_POST['user_id'];
    $id         = $_POST['id'];
    $data	= array();
    $data1	= array();
    $imgUrl     =myhost;
    if(!empty($user_id) || $user_id!="")
        {
            $qry= "SELECT * FROM groups where id='".$id."'";
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
           if($count != 0)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $qry1= "SELECT * FROM users where id ='".$row['admin_id']."'";
                    $result1= mysqli_query($db->dbcon(), $qry1);
                    $obj = mysqli_fetch_object($result1);
                    
                    $data['admin_id']=$row['admin_id'];
                    $data['admin_name']=$obj->name;
                    $data['privacy']=$row['privacy'];
                    $data['type']=$row['type'];
                    $data['name']=$row['name'];
                    $data['id']=$row['id'];
                    $data['details']=json_decode($row['details']);
                    $data['settings']=json_decode($row['settings']);
                    $data['news']=$row['news'];
                    $data['cover']=$imgUrl.'CoverPhotos/'.$row['cover'];
                    $data['profilepic']=$imgUrl.'profilepic/'.$row['profilepic'];
                    //$data1[]	= $data;
                }
                    //$response["count"] 	    = $count;
                    $response["error"] 	        = 0;
                    $response["success"] 	= 1;
                    $response["message"] 	= "Data Get Successfully";
                    $response["group_info"] 	= $data;
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
