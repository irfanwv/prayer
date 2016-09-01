<?php
require_once('class.phpmailer.php');
include("class.smtp.php");


//======================================
function sendmail($to,$subject,$message,$name)
    {
            $mail = new PHPMailer(); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
            try {
                $mail->SMTPDebug = 3;                               // Enable verbose debug output
               // $mail->isSMTP();
		        $mail->CharSet = 'UTF-8';// Set mailer to use SMTP
                $mail->protocol = 'mail';		
                $mail->Host = 'ssl://smtp.googlemail.com'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                             // Enable SMTP authentication
                $mail->Username   = "james01.matthew@gmail.com"; 
                $mail->Password   = "success@123";                     // SMTP password
                $mail->Port = 465;                                  // TCP port to connect, tls=587, ssl=465
                $mail->From = 'tarun.upadhyay@widevision.co.in';
                $mail->FromName = 'PrayerGrid.org';
                $mail->addAddress($to, $name);     // Add a recipient
                $mail->addReplyTo("tarun.upadhyay@widevision.co.in",$name);
                $mail->WordWrap = 76;                                 // Set word wrap to 50 characters
                $mail->IsHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $message;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->Timeout = 3600; 
                if(!$mail->send()) {                   
                    return 0;
                } else {                  
                    return 1;
                }
                $errors[] = "Send mail sucsessfully";
            } catch (phpmailerException $e) {
                $errors[] = $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
                $errors[] = $e->getMessage(); //Boring error messages from anything else!
            }
    }
//======================================


require_once 'include/emp_request.php';
$json = array(); $get_id='';
$time = date("Y-m-d : H:i:s", time());
if($_FILES['image']['name']!='')
{
 $img_pre=mktime();
 $image=$img_pre.'_'.$_FILES['image']['name'];
}
else
{
  $image='';
}

$table = "users" ;
$infotable = userinfo ;
$where_email = '`email`="'.$_POST['email'].'"  ';
$check_email = $db->selectcommand('*',$table,$where_email);
$count = mysqli_num_rows($check_email);
$name=mysqli_real_escape_string($db->dbcon(), $_POST['name']);
$emailadd=mysqli_real_escape_string($db->dbcon(), $_POST['email']);
$password=password_hash($_POST['password'], PASSWORD_DEFAULT);
$password=mysqli_real_escape_string($db->dbcon(), $password);
$image=mysqli_real_escape_string($db->dbcon(), $image);
$type=mysqli_real_escape_string($db->dbcon(), 0);
$linkname=mysqli_real_escape_string($db->dbcon(), "Null");
$status=mysqli_real_escape_string($db->dbcon(), 0);

if($count < 1)
{

		       $concol = '`name`,`email`,`password`,`type`,`linkname`,`status`,`profilepic`,`created_at`,`updated_at`';
			   $value = '"'.$name.'","'.$emailadd.'","'.$password.'","'.$type.'","'.$linkname.'","'.$status.'","'.$image.'","'.$time.'","'.$time.'"';
			   $data=$db->SaveData($table,$concol,$value);
			   $last_saved_id = mysqli_insert_id($db->dbcon());
			  
			   if($data!=false){
			   move_uploaded_file($_FILES['image']['tmp_name'], "images/".$image);
			   
			   $concolinfo = '`userid`,`created_at`, `updated_at`';
			   $infovalue = '"'.$last_saved_id.'","'.$time.'","'.$time.'"';
			   $infodata=$db->SaveData($infotable,$concolinfo,$infovalue);
			   
			   
			    $verification_code = mt_rand();		        
				$name=$_POST['name'];
				$email=$_POST['email'];			   
				$varification_link="http://".getenv('HTTP_HOST')."/prayergrid/verification.php?id=$last_saved_id&veri_code=$verification_code";		
				$response["error"] = 0;
				$response["success"] = 1;
				$response["message"] = "Registration Succesfully.A verification mail send to your inbox";
				
				$to="tarun.upadhyay@widevision.co.in";
			    
				$user_to=$email;
				$body="<p>Name : $name</p> <p>Email: $email</p>";
				
				
				$user_body="<p>Please click on the given link for verification.</p><a href='$varification_link' target='_blank'>$varification_link</a>";      
				$subject="Register";
				$subject1="Verification";
				$mailsend =   sendmail($to,$subject,$body,$name);
				$mailsend =   sendmail($user_to,$subject1,$user_body,$name);
				if($mailsend==1){				 
				  $response["mail"] = "Mail send Succesfully";
				}
				else{				
				   $response["mail"] = "Mail not send Succesfully";
				}			   

			   }else{$response["error"] = 1; $response["success"] = 0; $response["message"] = "Registration fail!";}
	
}
else{$response["error"] = 1; $response["success"] = 0; $response["message"] = "Email already registered !";}
echo json_encode($response);
?>
