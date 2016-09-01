<?php

require_once 'include/emp_request.php';
$table="country";
$countries = $db->selectcommand('*',$table,'');
while($row = mysql_fetch_assoc($countries))
{
    
    $response['COUNTRY'][] = array("id"=>$row['country_id'],"country_name"=>$row['name']);
}
if($countries!=false)
{
    $response["ERROR"] = 0;
    $response["STATUS"] = 1;
}
else
{
    $response["ERROR"] = 1;
    $response["STATUS"] = 0;    
}
echo json_encode($response);
?>