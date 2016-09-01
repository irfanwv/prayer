<?php
    $user_id = $_POST['user_id'];
    $church_name = $_POST['church_name'];
    $data		= array();
    $data1		= array();
    $imgUrl=myhost;
    if(!empty($user_id) || $user_id!="")
        {
            $qry= "SELECT us.id,us.name,ci.header_image,ci.tithe_image,ci.tithe_link ,ci.address ,us.profilepic,ci.news,ci.phone,ci.churchtiming FROM users as us inner join churchinfo as ci on us.id=ci.userid where us.name='".$church_name."'";
            $result= mysqli_query($db->dbcon(), $qry);
            $count=mysqli_num_rows($result); 
            if($count != 0)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                   // $data['privacy']=$row['privacy'];
                    $data['tithe_link']=$row['tithe_link'];
                    $data['name']=$row['name'];
                    $data['id']=$row['id'];
                    $data['phone']=$row['phone'];
                    $data['address']=json_decode($row['address']);
                    $data['churchtiming']=$row['churchtiming'];
                    $data['news']=$row['news'];
                    $data['tithe_image']=$imgUrl.$row['tithe_image'];
                    $data['profilepic']=$imgUrl.'profilepic/'.$row['profilepic'];
                    $data['header_image']=$imgUrl.'CoverPhotos/'. $row['header_image'];
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
