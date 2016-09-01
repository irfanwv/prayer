<?php

require_once 'include/emp_request.php';


function generatePassword($_len) {

    $_alphaSmall = 'abcdefghijklmnopqrstuvwxyz';            // small letters
    $_alphaCaps  = strtoupper($_alphaSmall);                // CAPITAL LETTERS
    $_numerics   = '1234567890';                            // numerics
    $_specialChars = '`~!@#$%^&*()-_=+]}[{;:,<.>/?\'"\|';   // Special Characters

    $_container = $_alphaSmall.$_alphaCaps.$_numerics.$_specialChars;   // Contains all characters
    $password = '';         // will contain the desired pass

    for($i = 0; $i < $_len; $i++) {                                 // Loop till the length mentioned
        $_rand = rand(0, strlen($_container) - 1);                  // Get Randomized Length
        $password .= substr($_container, $_rand, 1);                // returns part of the string [ high tensile strength ;) ] 
    }

    return $password;       // Returns the generated Pass
}

if(($_POST['email']!="" && !empty($_POST['email'])) )
{
    $table = users;    
    $where = '(`email`="'.$_POST['email'].'" ) ';
    $login = $db->selectcommand('*',$table,$where);
    $no_of_row=mysqli_num_rows($login);
    $row1 = mysqli_fetch_assoc($login);
    $time = date("Y-m-d : H:i:s", time());
    $six_digit_random_number = mt_rand(100000, 999999);
  
    if($no_of_row==1)
    {
	 $mail = mail($_POST['email'],"PrayerGrid.org password change request",'Your email ="'.$row1['email'].'" and password ="'.$six_digit_random_number.'"');
            if($mail)
            {
		
		        $tables = 'users' ;
                $wheres ='(`email`="'.$_POST['email'].'" ) ';
				
                $set = '`password`="'.md5($six_digit_random_number).'"';
                $update = $db->updateData($tables,$set,$wheres);
		   
		       $passResetTbl='password_resets';
		       $concol = '`email`,`token`,`created_at`';
			   $value = '"'.$_POST['email'].'","'.md5($six_digit_random_number).'","'.$time.'"';
			   $data=$db->SaveData($passResetTbl,$concol,$value);
			   
                $response["error"]= 0;
                $response["success"] =1;
                $response["message"] = "Password has been sent to your Email ID. Check spam folder also.";
            }
            else
            {
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

?>