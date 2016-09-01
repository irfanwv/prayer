<?php
require_once 'include/emp_request.php';
$db = new Webservice();
$table = users;
$id = $_GET["id"];
$verification_code = md5($_GET["veri_code"]);
//$id = 22;
$where = " id=".$id;    
$set = '`status` = "1",`emailcode` = "'.$verification_code.'"';
$select =$db->selectcommand('*',$table,$where);
if(mysqli_num_rows($select) > 0)
{   $data=mysqli_fetch_assoc($select); 
    $update = $db->updateData($table,$set,$where);
    if($update)
    {
        echo "Your account has been verified successfuly.Please login with your device.";      
    }
    else{
        echo "Failed to verify your account.";
    }
    
}
    

?>