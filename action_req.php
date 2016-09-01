<?php
require_once 'include/emp_request.php';
require_once 'password_compat/lib/password.php';
define('myhost','http://prayergrid.org/uploads/');

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
       elseif($tag=="church_register") //entry for registration
       {
	      try
	       {
		      require_once("church_register.php");
	       }
	      catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	    /*********deep**********/
      elseif($tag=="getAnsweredPrayer") //  country add 
       {
	      try
	       {
		      require_once("getAnsweredPrayer.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
      elseif($tag=="getChurchList") //  country add 
       {
	      try
	       {
		      require_once("getChurchList.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }	  
      elseif($tag=="joinChurch") //  country add 
       {
	      try
	       {
		      require_once("joinChurch.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
      elseif($tag=="getChurchMember") 
       {
	      try
	       {
		      require_once("getChurchMember.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   elseif($tag=="userPostPrayer") //  country add 
       {
	      try
	       {
		      require_once("set_post_prayer.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   elseif($tag=="userPostView") //  country add 
       {
	      try
	       {
		      require_once("get_post_user.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   elseif($tag=="churchPostPrayer") //  country add 
       {
	      try
	       {
		      require_once("set_post_church.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   elseif($tag=="getChurchPost") 
       {
	      try
	       {
		      require_once("getChurchPost.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   elseif($tag=="setPrayers") //  country add 
       {
	      try
	       {
		      require_once("setPrayers.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   elseif($tag=="getAllPrayers") //  country add mam ye apka anwla bhul aaya
       {
	      try
	       {
		      require_once("getAllPrayers.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   elseif($tag=="setComment") //  country add 
       {
	      try
	       {
		      require_once("setComment.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	    elseif($tag=="getComment") //  country add 
       {
	      try
	       {
		      require_once("getComment.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	   elseif($tag=="setMessages") //  country add 
       {
	      try
	       {
		      require_once("setMessages.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	   elseif($tag=="getMessages") //  country add 
       {
	      try
	       {
		      require_once("getMessages.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	    elseif($tag=="getAllMessages") //  country add 
       {
	      try
	       {
		      require_once("getAllMessages.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	 
	    elseif($tag=="getMyPrayerRequest") //  country add 
       {
	      try
	       {
		      require_once("getMyPrayerRequest.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	   elseif($tag=="getMyPrayerForOthers") //  country add 
       {
	      try
	       {
		      require_once("getMyPrayerForOthers.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	   elseif($tag=="getMemberChurchList") //  country add 
       {
	      try
	       {
		      require_once("getMemberChurchList.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	    elseif($tag=="getAutoSuggestName") //  country add 
       {
	      try
	       {
		      require_once("getAutoSuggestName.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	    elseif($tag=="setEditProfile") //  country add 
       {
	      try
	       {
		      require_once("setEditProfile.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	    elseif($tag=="setDeletePrayer") //  country add 
       {
	      try
	       {
		      require_once("DeletePrayer.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	    elseif($tag=="setNewGroup") //  country add 
       {
	      try
	       {
		      require_once("setNewGroup.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	     elseif($tag=="setDeleteChurchPrayer") //  country add 
       {
	      try
	       {
		      require_once("DeleteChurchPrayer.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	    elseif($tag=="getGroupList") //  country add 
       {
	      try
	       {
		      require_once("getGroupList.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	    elseif($tag=="getGroupMemberList") //  country add 
       {
	      try
	       {
		      require_once("getGroupMemberList.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	    elseif($tag=="setDeleteComments") //  country add 
       {
	      try
	       {
		      require_once("DeleteComments.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	    elseif($tag=="setJoinGroup") //  country add 
       {
	      try
	       {
		      require_once("setJoinGroup.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	    elseif($tag=="getDefaultChurch") //  country add 
       {
	      try
	       {
		      require_once("getDefaultChurch.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   elseif($tag=="setGroupPost") //  country add 
       {
	      try
	       {
		      require_once("setGroupPost.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	   elseif($tag=="getGroupAllPost") //  country add 
       {
	      try
	       {
		      require_once("getGroupAllPost.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	    elseif($tag=="onTokenRefresh") //  country add 
       {
	      try
	       {
		      require_once("onTokenRefresh.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	   
	   
	   elseif($tag=="deleteGroupPost") //  country add 
       {
	      try
	       {
		      require_once("deleteGroupPost.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }	   
	   elseif($tag=="inviteUser") //  country add 
       {
	      try
	       {
		      require_once("inviteUser.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }	   
	   elseif($tag=="editGroup") //  country add 
       {
	      try
	       {
		      require_once("editGroup.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }	   
	   elseif($tag=="setPostReport") //  country add 
       {
	      try
	       {
		      require_once("setPostReport.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   elseif($tag=="getGroup") //  country add 
       {
	      try
	       {
		      require_once("getGroup.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   elseif($tag=="viewInvitations") //  country add 
       {
	      try
	       {
		      require_once("viewInvitations.php");
	       }
		catch(Exception $e)
	       {
		       $response["message"]="File not found Please contact with administrator";
		       echo json_encode($response);
	       }
       }
	   
	   
	    elseif($tag=="pushNotification") //  country add 
       {
	      try
	       {
		      require_once("pushNotification.php");
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