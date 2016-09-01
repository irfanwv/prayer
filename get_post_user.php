<?php
    
    $user_id  = $_POST['user_id'];
    $category = $_POST['category'];
    $country  = $_POST['country'];
    $pageid     = $_POST['pageid'];
    $data		= array();
    $data1		= array();
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
            
            if((!empty($category) || $category!="") && (!empty($country) || $country!=""))
            {
                
               $qry=  "SELECT ps.id,ps.category,us.name,ps.type,us.profilepic,ps.message,ps.userid, uf.country   FROM posts as ps inner join users as us on us.id=ps.userid inner join userinfo as uf on us.id=uf.userid WHERE ps.category ='".$category."' and uf.country='".$country."' ORDER BY ps.id DESC LIMIT $limit , 20";
                
                //$qry= " SELECT ps.id,ps.category,us.name,ps.type,us.profilepic,ps.message ,ps.userid FROM posts as ps inner join users as us on us.id=ps.userid ORDER BY ps.id DESC LIMIT $limit , 20";
                $result= mysqli_query($db->dbcon(), $qry);
                $num=mysqli_num_rows($result);                
            } else if(!empty($country) || $country!="")
            {
                $qry= "SELECT ps.id,ps.category,us.name,ps.type,us.profilepic,ps.message,ps.userid, uf.country   FROM posts as ps inner join users as us on us.id=ps.userid inner join userinfo as uf on us.id=uf.userid WHERE uf.country='".$country."'  ORDER BY ps.id DESC LIMIT $limit , 20";
                $result= mysqli_query($db->dbcon(), $qry);
                $num=mysqli_num_rows($result);                
            }else if(!empty($category) || $category!="")
            {
                $qry= "SELECT ps.id,ps.category,us.name,ps.type,us.profilepic,ps.message,ps.userid  FROM posts as ps inner join users as us on us.id=ps.userid WHERE ps.category ='".$category."' ORDER BY ps.id DESC LIMIT $limit , 20";
                $result= mysqli_query($db->dbcon(), $qry);
                $num=mysqli_num_rows($result);                
            } else
            {
                $qry= "SELECT ps.id,ps.category,us.name,ps.type,us.profilepic,ps.message ,ps.userid FROM posts as ps inner join users as us on us.id=ps.userid ORDER BY ps.id DESC LIMIT $limit , 20";
                $result= mysqli_query($db->dbcon(), $qry);
                $num=mysqli_num_rows($result);
            }
           if($num != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                  $qry= "SELECT * FROM `prayers` WHERE `pid`=".$row['id'];
                  $qry2= "SELECT * FROM `prayers` WHERE `pid`=".$row['id']." && uid=".$user_id."";
                  $result2= mysqli_query($db->dbcon(), $qry2);
                  $num2=mysqli_num_rows($result2);
                  if($num2 ==0)
                  {
                    $data['prayer']='No';
                  }
                  else
                  {
                    $data['prayer']='Yes';
                  }
                   $result1= mysqli_query($db->dbcon(), $qry);
                    $num1=mysqli_num_rows($result1);
                 //   $num2=mysqli_num_rows($result2);
                    //if($row['id'] == )
                    $data['pid']=$row['id'];
                    $data['count']=$num1;
                    $data['type']=$row['type'];
                    $data['category']=$cat[$row['category']];
                    $data['userid']=$row['userid'];
                    $data['name']=$row['name'];
                    $data['profilepic']=$imgUrl.$row['profilepic'];
                    $data['message']=$row['message'];
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
                        $response["message"]    = "No Prayer Request to show";
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
