<?php
require_once 'include/emp_request.php';
require_once 'password_compat/lib/password.php';

 $tag = $_POST['tag'];

if(isset($tag)){}else{ $tag = "none";}
$handle = fopen('php://input','r');
$jsonInput = fgets($handle);
$decoded = json_decode($jsonInput,true);

if(isset($tag) ||  $decoded['tag'])
{
    /*create object of class logsheet*/
       $db = new Webservice();
       $response=array();
       $response['error']=1;
       $response['success']=0;
       $response['tag']=$tag;
       
       if($tag=="register") //entry for registration
       {
	      try
	       {
		      require_once("register.php");
	       }
		  catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	     if($tag=="registerlocal") //entry for registration
       {
	      try
	       {
		      require_once("register_local.php");
	       }
		  catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }

       elseif($tag=="login") // login
       {
	      try
	       {
		      require_once("login.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	  elseif($tag=="loginlocal") // login
       {
	      try
	       {
		      require_once("login_local.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	  elseif($tag=="forget_pass_local") //  forget_password screen 
       {
	      try
	       {
		      require_once("forget_pass_local.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       } 
       
       elseif($tag=="state") // finding states 
       {
	      try
	       {
		      require_once("state.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
       
       elseif($tag=="forget_pass") //  forget_password screen 
       {
	      try
	       {
		      require_once("forget_pass.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }       
       
        elseif($tag=="edit_profile") //  edit profile screen 
       {
	      try
	       {
		      require_once("edit_profile.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
   
       
       elseif($tag=="pdf_generation") //  pdf generation 
       {
	      try
	       {
		      require_once("pdf_generation.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
       elseif($tag=="subscription_check") //  subscription check 
       {
	      try
	       {
		      require_once("subscription_check.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
      elseif($tag=="subscription") //  subscription add 
       {
	      try
	       {
		      require_once("subscription.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
      elseif($tag=="country") //  country add 
       {
	      try
	       {
		      require_once("country.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }	   
       else
       {
	    echo "tag didn't matched !";    
       }
}
else
{
	echo "Oops .....Invalid Access";
}
?>