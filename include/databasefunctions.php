<?php
/*database interaction functions*/

class Dbfunctions 
{     

       function executeResult($dbs,$sql)
		{
			 
			 $result=mysqli_query($dbs,$sql) or die("error in query".mysqli_connect_error($dbs).$sql);
			return $result;
		}
		
		
	        function close()
		{
			mysqli_close($con);
		}
		
		function executeId($sql)
		{
			return mysqli_insert_id();
		}
		
		
		function executeArray($sql)
		{
			
			$response=mysqli_fetch_array($sql);
			return $response;
		}
		function executeAssoc($sql)
		{
			
			$response=mysqli_fetch_assoc($sql);
			return $response;
		}
		
		function executeRows($sql)
		{
			
		 $response=mysqli_num_rows();
		 return $response;
		
	        }
		
		 
		 function executefetchrow($sql)
		{
			
		  $response=mysqli_fetch_row($sql);
		  return $response;
		
		}
		
		
		function executenumberofrows($result)
		{
			$response= mysqli_num_rows($result);
	       return $response;
		
		}
		
		function executefetchObject($sql)
		{
		   $response=mysqli_fetch_object($sql);
		   return $response;
		}
		


}

?>