<?php
    
    $user_id  = $_POST['user_id'];
   
    $data		= array();
    $data1		= array();
 
    if(!empty($user_id) || $user_id!="")
        {
                $qry= "SELECT *, COUNT(*) as count FROM messages WHERE receiverid='".$user_id."' GROUP BY senderid ORDER BY messages.id  DESC";
                $result= mysqli_query($db->dbcon(), $qry);
                $num=mysqli_num_rows($result);
           if($num != 0)
           {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $qry1= "SELECT * FROM users WHERE id =".$row['senderid'];
                    $result1= mysqli_query($db->dbcon(), $qry1);
                    $num1=mysqli_num_rows($result1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $data['count']=$row['count'];
                    $data['message']=json_decode($row['msg']);
                    $data['user_id']=$row1['id'];
                    $data['name']=$row1['name'];
                    $data['profilepic']=myhost.'profilepic/'.$row1['profilepic'];
                    $data1[]	= $data;
                }
                    $response["error"] 	    = 0;
                    $response["success"] 	= 1;
                    $response["message"] 	= "Data Get Successfully";
                    $response["post_info"] 	= $data1;
            }
            else
            {
                $qry1= "SELECT *, COUNT(*) as count FROM messages WHERE senderid='".$user_id."' GROUP BY receiverid ORDER BY messages.id  DESC";
                $result1= mysqli_query($db->dbcon(), $qry1);
                $num1=mysqli_num_rows($result1);
                if($num1 != 0)
                {
                    while ($row1 = mysqli_fetch_assoc($result1))
                    {
                        $qry2= "SELECT * FROM `users` WHERE id =".$row1['receiverid'];
                        $result2= mysqli_query($db->dbcon(), $qry2);
                        $row2 = mysqli_fetch_assoc($result2);
                        $data['user_id']        =$row2['id'];
                        $data['name']           =$row2['name'];
                        $data['profilepic']     =myhost.'profilepic/'.$row2['profilepic'];
                        $data['message']        =json_decode($row1['msg']);
                        $data1[]	            = $data;
                    }
                        $response["error"]          = 0;
                        $response["success"]        = 1;
                        $response["message"]        = "Data Get Successfully";
                        $response["post_info"] 	    = $data1;
                }
                else
                {
                        $response["error"]      = 1;
                        $response["success"]    = 0;
                        $response["message"]    = "NO Message to show";
                }
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
