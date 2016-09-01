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

function random_password( $length = 10 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

require_once 'include/emp_request.php';

if(($_POST['email']!="" && !empty($_POST['email'])) )
{
    $table = users;    
    $where = '(`email`="'.$_POST['email'].'" ) ';
    $login = $db->selectcommand('*',$table,$where);
    $no_of_row=mysqli_num_rows($login);
    $row1 = mysqli_fetch_assoc($login);
    $time = date("Y-m-d : H:i:s", time());
   // $six_digit_random_number = mt_rand(100000, 999999);
	$generatedPassword=random_password();	
    $random_password=password_hash($generatedPassword, PASSWORD_DEFAULT);
    if($no_of_row==1)
    {
		
		        $name='PrayerGrid.org';
		        $to=$_POST['email'];						
				$body="<h1>PrayerGrid.org</h1><p>Email : ".$row1['email']."</p><p>Password : ".$generatedPassword."</p>";      
				$subject="PrayerGrid.org password change request";			
				$mailsend =   sendmail($to,$subject,$body,$name);			
				if($mailsend==1){				 
				        $tables = 'users' ;
						$wheres ='(`email`="'.$_POST['email'].'" ) ';
						
						$set = '`password`="'.$random_password.'"';
						$update = $db->updateData($tables,$set,$wheres);
				   
					   $passResetTbl='password_resets';
					   $concol = '`email`,`token`,`created_at`';
					   $value = '"'.$_POST['email'].'","'.$random_password.'","'.$time.'"';
					   $data=$db->SaveData($passResetTbl,$concol,$value);
					   
						$response["error"]= 0;
						$response["success"] =1;
						$response["message"] = "Password has been sent to your Email ID. Check spam folder also.";
				}
				else{				
				    $response["error"]= 1;
					$response["success"] =0;
					$response["message"] = "error sending mail.";
				}	

    }   
    else
    {
        $response["error"] = 1;
        $response["success"] = 0;
        $response["message"] = "Invalid Email";
    }
}
else
{
   
     $response["error"] = 1;
     $response["success"] = 0;
     $response["message"] = "Send Proper Data!";
}

echo json_encode($response);
exit;
?>