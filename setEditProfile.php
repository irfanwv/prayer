<?php
$user_id=$_POST['user_id'];
$name=$_POST['name'];
$email=$_POST['email'];
$gender=$_POST['gender'];
$country=$_POST['country'];
$default=$_POST['church'];
$state=$_POST['state'];
$password=$_POST['password'];
$notifications=$_POST['notifications'];

$time = date("Y-m-d : H:i:s", time());
$date = date("Y-m-d ");
$table = "userinfo";
$table1 = "users";
$imgUrl=myhost.'images/';


$password1=password_hash($password, PASSWORD_DEFAULT);
//$password1=md5($password);	
if(!empty($user_id) || $user_id != "")
{
			    $img_pre=mktime();
                $image="prc".$img_pre."_".$_FILES['profilepic']['name'];
				
                $qry=  "SELECT * FROM userinfo where userid=".$user_id;
                $result= mysqli_query($db->dbcon(), $qry);
				$row = mysqli_fetch_assoc($result);
                $count=mysqli_num_rows($result);
				
                if($count == 0)
                {
								
								if(!empty($password) || $password != "")
								{			
												$set= '`name`="'.$name.'",`email`="'.$email.'",`password`="'.$password1.'",`default`="'.$default.'",`updated_at`="'.$time.'"';
																
								}
								else
								{
												$set= '`name`="'.$name.'",`email`="'.$email.'",`default`="'.$default.'",`updated_at`="'.$time.'"';	   		
								}
								
								
								 if (isset($_FILES['profilepic']['name']))
								{
								     if(!empty($_FILES['profilepic']['name']))
								    {
									  $set .= ',`profilepic`="'.$image.'"';			
								    }
								 
								}
								 $where= "`id`='$user_id'";
								 $data=	$db->updateData($table1,$set,$where);
				
								$concol = '`userid`, `gender`, `country`, `state`, `notifications`, `created_at`, `updated_at`';
								$value = "'".$user_id."','".$gender."','".$country."','".$state."','".$notifications."','".$time."','".$time."'";
								$db->SaveData($table,$concol,$value);
                }
				
				else
				{
								
								if(!empty($password) || $password != "")
								{
											   $set= '`name`="'.$name.'",`email`="'.$email.'",`password`="'.$password1.'",`default`="'.$default.'",`updated_at`="'.$time.'"';		
								}
								else
								{
											   $set= '`name`="'.$name.'",`email`="'.$email.'",`default`="'.$default.'",`updated_at`="'.$time.'"';			   	
								}
								
								
								 if (isset($_FILES['profilepic']['name']))
								{
								     if(!empty($_FILES['profilepic']['name']))
								    {
									  $set .= ',`profilepic`="'.$image.'"';			
								    }
								 
								}
								
								 $where= "`id`='$user_id'";
								 $data=$db->updateData($table1,$set,$where);
							  
								
								$where= "`userid`='$user_id'";
								$set= "`gender`='".$gender."',`country`='".$country."',`state`='".$state."',`notifications`='".$notifications."',`updated_at`='".$time."'";
							    $data=	$db->updateData($table,$set,$where);
                }
				
				               if (isset($_FILES['profilepic']['name']))
	                            {		  
												if($data!=false)
												{
													 $move = move_uploaded_file($_FILES['profilepic']['tmp_name'],"images/".$image);
													 if($move!=false){$response["profilepic"]="Image Uploaded successfuly.";}
													 else{$response["profilepic"]="Failed to upload the image.";}
												}
                               }
				
                if($data!=false){
					$qry1=  "SELECT * FROM users as us inner join userinfo as uf on us.id=uf.userid where us.id=".$user_id;
				    $result1= mysqli_query($db->dbcon(), $qry1);
				    $row1 = mysqli_fetch_assoc($result1);			
					$response["name"] = $row1['name'];
					$response["email"] = $row1['email'];
					$response['gender']=$row1['gender'];
				    $response['country']=$row1['country'];
				    $response['state']=$row1['state'];
					$response['defaultchurch']=$row1['default'];
				    $response['notifications']=json_decode($row1['notifications']);
                    $response["url"] = $imgUrl.$row1['profilepic'];
					$response["error"] = 0;
                    $response["success"] = 1;
                    $response["message"] = "Data Inserted successfully";
                }
                else
                {
                    $response["error"] = 1;
                    $response["success"] = 0;
                    $response["message"] = "Data Not Inserted successfully";  
                }
    }
    else
    {
                    $response["error"] = 1;
                    $response["success"] = 0;
                    $response["message"] = "User Id Not valid";
    }
echo json_encode($response);
	exit;
?>