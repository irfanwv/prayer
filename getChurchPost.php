<?php
    
    $user_id    = $_POST['user_id'];
    $cid        = $_POST['cid'];
    $type        = $_POST['type'];
    
    $pageid     = $_POST['pageid'];
    $data	= array();
    $data1	= array();
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
           //$qry= "SELECT * FROM church_posts as cp inner join users as us on us.id=cp.cpid ORDER BY ps.id DESC";
        //  $qry= "SELECT ur.name,ur.profilepic,cp.* FROM `users` as ur inner join `church_posts` as cp on ur.id=cp.userid WHERE cp.churchid='".$cid."'ORDER BY `cp`.`cpid` DESC LIMIT $limit , 20";
          $qry= "SELECT ur.name,ur.profilepic,cp.* FROM `users` as ur inner join `church_posts` as cp on ur.id=cp.userid WHERE cp.churchid='".$cid."' and cp.type='".$type."' ORDER BY `cp`.`cpid` DESC LIMIT $limit , 20";
          $result= mysqli_query($db->dbcon(), $qry);
          $num=mysqli_num_rows($result); 
           if($num != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    $qry2= "SELECT * FROM prayers WHERE pid=".$row['cpid']." AND uid=".$user_id."";
                    $result2= mysqli_query($db->dbcon(), $qry2);
                    $num2=mysqli_num_rows($result2);
                    $qry1= "SELECT * FROM prayers WHERE pid=".$row['cpid'];
                    $result1= mysqli_query($db->dbcon(), $qry1);
                    $num1=mysqli_num_rows($result1);
                    if($num2 ==0)
                    {
                      $data['prayer']   ='No';
                    }
                    else
                    {
                      $data['prayer']   ='Yes';
                    }
                    $data['count']      =$num1;
                    $data['name']       =$row['name'];
                    $data['userid']     =$row['userid'];
                    $data['profilepic'] =myhost.'profilepic/'.$row['profilepic'];
                    $data['cpid']       =$row['cpid'];
                    $data['cpmessage']  =$row['cpmessage'];
                    $data['category']   =$cat[$row['category']];
                    $data1[]	        = $data;
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
