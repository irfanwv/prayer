<?php
    
    $user_id  = $_POST['user_id'];
    $receiverid = $_POST['receiverid'];
   
    $data		= array();
    $data1		= array();
    $imgUrl=myhost.'profilepic/';
   
    if(!empty($user_id) || $user_id!="")
        {    
                $qry= "SELECT * FROM messages WHERE senderid = '".$user_id."' AND receiverid= '".$receiverid."'";
                $result= mysqli_query($db->dbcon(), $qry);
                $num=mysqli_num_rows($result);
                
                $qry1="SELECT * FROM messages WHERE senderid ='".$receiverid."' AND receiverid='".$user_id."'";
                $result1= mysqli_query($db->dbcon(), $qry1);
                $num1=mysqli_num_rows($result1);
                
                $qry3= "SELECT * FROM users WHERE id=".$receiverid;
                $result3= mysqli_query($db->dbcon(), $qry3);
                $row3 = mysqli_fetch_assoc($result3);
                //print_r($row3);
                
                
                //$qry4= "SELECT * FROM users WHERE senderid ='".$receiverid."'";
                //$result4= mysqli_query($db->dbcon(), $qry4);
                //$row4 = mysqli_fetch_assoc($result4);
                //$data['profilepic_sen']=$row4['profilepic'];
                
        }
           if($num != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $data['id']=json_decode($row['id']);
                    $data['message']=json_decode($row['msg']);
                    $data1[]	= $data;
                }
                while ($row1 = mysqli_fetch_assoc($result1))
                {
                    $data['id']=json_decode($row1['id']);
                    $data['message']=json_decode($row1['msg']);
                    $data1[]	= $data;
                }
                
                function cmp($a, $b)
                {
                 return strcmp($a['id'], $b['id']);
                }
                    usort($data1, "cmp");
                    $response["error"] 	        = 0;
                    $response["success"] 	= 1;
                    $response["message"] 	= "Data Get Successfully";
                    $response['profile_rec']    =$imgUrl.$row3['profilepic'];
                    $response["post_info"]      = $data1;
            }
            else
            {
                        $response["error"]      = 1;
                        $response["success"]    = 0;
                        $response["message"]    = "No message to show";
            }
       
    echo json_encode($response);
    exit;
?>
