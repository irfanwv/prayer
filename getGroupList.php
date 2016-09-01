<?php
    $user_id    = $_POST['user_id'];
    $type       = $_POST['type'];
    $data	= array();
    $data1	= array();
    $imgUrl     =myhost.'images/';
    if(!empty($user_id) || $user_id!="")
        {
            if(!empty($type) || $type!="")
            {
                 $qry= "SELECT gp.* FROM `groups` as gp inner join `groups` as gr on gp.id=gr.id where gr.type='".$type."' and gr.admin_id='".$user_id."' or gp.privacy=0 and gr.type='".$type."'";
            }else
            {
                $qry= "SSELECT gp.* FROM `groups` as gp inner join `groups` as gr on gp.id=gr.id where gr.admin_id='".$user_id."' or gp.privacy=0";
            }
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
           if($count != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $qry1= "SELECT * FROM users where id ='".$row['admin_id']."'";
                    $result1= mysqli_query($db->dbcon(), $qry1);
                    $obj = mysqli_fetch_object($result1);
                    
                    $qry2= "SELECT * FROM group_members where userid ='".$user_id."' and gid=".$row['id'] ;
                    $result2= mysqli_query($db->dbcon(), $qry2);
                    $count1=mysqli_num_rows($result2); 
                     if($count1 == 1)
                     {
                        $data['join']=1;
                     }
                     else
                     {
                       $data['join']=0;
                     }
                    $data['admin_id']=$row['admin_id'];
                    $data['admin_name']=$obj->name;
                    $data['privacy']=$row['privacy'];
                    $data['type']=$row['type'];
                    $data['name']=$row['name'];
                    $data['id']=$row['id'];
                    $data['details']=json_decode($row['details']);
                    $data['settings']=json_decode($row['settings']);
                    $data['news']=$row['news'];
                    $data['cover']=myhost.'MinistryCover/'.$row['cover'];
                    $data['profilepic']=myhost.'MinistryProfile/'.$row['profilepic'];
                    $data1[]	= $data;
                }
                    //$response["count"] 	    = $count;
                    $response["error"] 	    = 0;
                    $response["success"] 	= 1;
                    $response["message"] 	= "Data Get Successfully";
                    $response["post_info"] 	= $data1;
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
