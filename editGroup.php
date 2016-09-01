<?php
$gname=$_POST['gname'];
$id=$_POST['id'];
$user_id=$_POST['user_id'];
$type=$_POST['type'];
$privacy=$_POST['privacy'];
$details=$_POST['details'];
$settings=$_POST['settings'];
$news=$_POST['news'];
$status=$_POST['status'];
$cover=$_POST['cover'];
$profilepic=$_POST['profilepic'];
$time = date("Y-m-d : H:i:s", time());
$date = date("Y-m-d ");
$table = 'groups';

                $img_pre=mktime();
                 $image="prc".$img_pre."_".$_FILES['profilepic']['name'];
                 $image1="cov".$img_pre."_".$_FILES['cover']['name'];

if(!empty($user_id) || $user_id != "")
{
				
				 
				
			    $qry = "UPDATE groups SET name='".$gname."',type='".$type."',privacy='".$privacy."',details='".$details."',settings='".$settings."',";
			  //  $qry .= "news='".$news."',status='".$status."',cover='".$image1."',profilepic='".$image."',date='".$time."' WHERE id=".$id;
			  
			    $qry .= "news='".$news."',status='".$status."',date='".$time."'";
			    if (isset($_FILES['profilepic']['name']))
								{
								     if(!empty($_FILES['profilepic']['name']))
								    {
									  $qry .= ',`profilepic`="'.$image.'"';			
								    }
								 
								}
				 if (isset($_FILES['cover']['name']))
								{
								     if(!empty($_FILES['cover']['name']))
								    {
									  $qry .= ',`cover`="'.$image1.'"';			
								    }
								 
								}				
				
				$qry.= "WHERE id=".$id;

				$result= mysqli_query($db->dbcon(), $qry);
			    
                            //$concol = '`name`, `admin_id`, `type`, `privacy`, `details`, `settings`, `news`, `status`, `cover`, `profilepic`, `updated_at`';
                            //$value = "'".$gname."','".$user_id."','".$type."','".$privacy."','".$details."','".$settings."','".$news."','".$status."','".$image1."','".$image."','".$time."'";
                            //$data= $db->SaveData($table,$concol,$value);
		    
			    if($result !=false)
			    {		
			       if (isset($_FILES['profilepic']['name']))
			    {		  
			    $move = move_uploaded_file($_FILES['profilepic']['tmp_name'],"images/".$image);
			    if($move!=false){$response["image"]="Profilepic Uploaded successfuly.";}
			    else{$response["image"]="Failed to upload the image.";}
				 }
				 if (isset($_FILES['cover']['name']))
			    {		  
			    
			    $move = move_uploaded_file($_FILES['cover']['tmp_name'],"images/".$image1);
			    if($move!=false){$response["cover"]="Cover Image Uploaded successfuly.";}
			    else{$response["image"]="Failed to upload the image.";}
				 }
							$response["error"] = 0;
							$response["success"] = 1;
							$response["message"] = "Data Inserted successfully";				
			    }
			    else
			    {
			    $response["error"] = 1;
			    $response["success"] = 0;
			    $response["message"] = "Data Not Inserted";		
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