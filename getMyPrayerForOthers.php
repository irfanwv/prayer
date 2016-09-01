<?php
    
    $user_id    = $_POST['user_id'];
    $pageid     = $_POST['pageid'];
    $data	= array();
    $data1	= array();
    $imgUrl=myhost.'profilepic/';
    $cat=array('General','School / Education','Careers & Business','Travel','Finances','Health / Healing','Family & Relationships','Addictions / Abuse','Emotions');
    if($pageid=='')
        {
            $limit=0;
        
        } else
        {
            $limit=$pageid*20;
        }
    if(!empty($user_id) || $user_id!="")
        {
            
            $qry=  "SELECT * FROM prayers WHERE uid='".$user_id."' ORDER BY pid  DESC LIMIT $limit , 20";
            $result= mysqli_query($db->dbcon(), $qry);
            $num=mysqli_num_rows($result); 
           if($num != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $qry1= "SELECT * FROM `posts` WHERE `id`=".$row['pid'];
                    $result1= mysqli_query($db->dbcon(), $qry1);
                    $num1=mysqli_num_rows($result1);
                    $row1 = mysqli_fetch_assoc($result1);
                    
                   $qry2= "SELECT * FROM `users` WHERE `id` =".$row1['userid'];
                    $result2= mysqli_query($db->dbcon(), $qry2);
                    $num2=mysqli_num_rows($result2);
                    $row2 = mysqli_fetch_assoc($result2);
                   
                   if($user_id == $row1['userid'])
                    {
                        
                    } else
                    {
                        $data['count']      =$num1;
                        $data['prayer']     ='Yes';
                        $data['name']       =$row2['name'];
                        $data['profilepic'] =$imgUrl.$row2['profilepic'];
                        $data['pid']        =$row['pid'];
                        $data['type']       =$row['type'];
                        $data['userid']     =$row1['userid'];
                        $data['message']    =$row1['message'];
                        $data['category']   =$cat[$row1['category']];
                        $data1[]	        = $data;
                    }
                }
                    $response["error"] 	    = 0;
                    $response["success"]    = 1;
                    $response["message"]    = "Data Get Successfully";
                    $response["post_info"]  = $data1;
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