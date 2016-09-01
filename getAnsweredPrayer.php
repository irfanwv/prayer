<?php
    
    $user_id    = $_POST['user_id'];
    $pageid     = $_POST['pageid'];
    $data	= array();
    $data1	= array();
    $cat=array('General','School / Education','Careers & Business','Travel','Finances','Health / Healing','Family & Relationships','Addictions / Abuse','Emotions');

    if($pageid=='')
        {
            $limit=0;
        }
        else
        {
            $limit=$pageid*20;
        }
       // LIMIT $limit , 20
    
    if(!empty($user_id) || $user_id!="")
        {
           $qry= "SELECT distinct(pr.pid),ur.name,ur.profilepic,ps.* FROM `users` as ur inner join `posts` as ps on ur.id=ps.userid inner join `prayers` as pr on ps.id=pr.pid WHERE pr.uid='".$user_id."' LIMIT $limit , 20" ;
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
           if($count != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                  
                    $data['pid']        =$row['pid'];
                    $data['name']       =$row['name'];
                    $data['userid']     =$row['userid'];
                    $data['profilepic'] =myhost.'profilepic/'.$row['profilepic'];
                    $data['message']    =$row['message'];
                    $data['type']       =$row['type'];
                    $data['category']   =$cat[$row['category']];
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
                        $response["message"]    = "Pray not found";
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
