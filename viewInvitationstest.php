<?php
require_once 'include/emp_request.php';
$db = new Webservice();
    $user_id    = $_POST['user_id']=33;   
    $data	= array();
    $data1	= array();
    $groups	= array();
    $imgUrl     =myhost.'images/';
    if(!empty($user_id) || $user_id!="")
        {
          $qry= "SELECT * FROM group_members where userid='".$user_id."' and status=0";
          $result= mysqli_query($db->dbcon(), $qry);
          $count=mysqli_num_rows($result); 
           if($count != 0)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    $qry1= "SELECT * FROM groups where id ='".$row['gid']."'";
                    $result1= mysqli_query($db->dbcon(), $qry1);
                   // $obj = mysqli_fetch_assoc($result1);
                    
                   
                   
                while ($row1 = mysqli_fetch_assoc($result1))
                {
                    $qry11= "SELECT * FROM users where id ='".$row1['admin_id']."'";
                    $result11= mysqli_query($db->dbcon(), $qry11);
                    $obj1 = mysqli_fetch_object($result11);
                    $data[]=array('admin_id'=>$row1['admin_id'],'admin_name'=>$obj1->name,'group_name'=>$row1['name'],'group_profilepic'=>$imgUrl.$row1['profilepic'],'group_id'=>$row1['id']);
                    //$data['admin_id']=$row1['admin_id'];
                    //$data['admin_name']=$obj1->name;
                    //$data['group_name']=$row1['name'];
                    //$data['group_profilepic']=$imgUrl.$row1['profilepic'];
                    //$data['group_id']=$row1['id'];
                }
                    //$data1[]	= $data;
                }
                    //$response["count"] 	    = $count;
                    $response["error"] 	        = 0;
                    $response["success"] 	= 1;
                    $response["message"] 	= "Data Get Successfully";
                    $response["invitation_info"] 	= $data;
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
