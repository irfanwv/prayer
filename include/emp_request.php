<?php 

if (!file_exists("include/DB_Connect.php")) { 
    die('File DB_Connect.php does not exist');
}else{
    require('DB_Connect.php');
}
if (!file_exists("include/databasefunctions.php")) { 
    die('File databasefunctions.php does not exist');
}else{
    require_once('databasefunctions.php');
}
if (!file_exists("include/tablenames.php")) { 
    die('File tablenames.php does not exist');
}else{
    require 'tablenames.php';
}




class Webservice extends Dbfunctions
{
    #code
    private $db;
    public $dbfunction;
    
    /*Constructor*/
    function __construct()
    {
       
        $this->db = new DB_Connect();
		$this->dbfunction=new Dbfunctions();
		$this->dbconn=$this->db->connection();	
        

	global $dbprefix;
	$dbprefix="";
    }
	
	public function dbcon()
	{
		return $this->dbconn;
	}


     
    public function selectcommand($select,$table,$where)
	{		
		 
		try
		{	
			if($where=="")
				   {			
			 $query="Select ".$select." from ".$GLOBALS['dbprefix']."".$table."";
				   }
				   else{
	          	 $query="Select ".$select." from ".$GLOBALS['dbprefix']."".$table." where".$where."";						 
				   }			
				
			 $result=$this->dbfunction->executeResult($this->dbconn,$query);
			
			 return $result;
		}
		catch(Exception $e)
		{
			return $e;
		}
	
		
	}

        
        
        /*Save data */  
	public function SaveData($table,$concol,$values)
	{
		
		try
		{	
			
			
			 $sql = "INSERT INTO ".$GLOBALS['dbprefix']."".$table." (".$concol.") VALUES (".$values.")"; 
			
			$result=$this->dbfunction->executeResult($this->dbconn,$sql);
		 	
		       if ($result)
		       {
				/*get user details*/
				$id = $this->dbfunction->executeId($result);
				
				
				$result = $this->dbfunction->executeResult($this->dbconn,"SELECT * FROM ".$GLOBALS['dbprefix']."".$table." ");
				
				
				/* return user details*/
				return $this->dbfunction->executeArray($result);
		   }
		   else
		   {
			return false;
		   }
		}
		catch(Exception $e)
		{
			return $e;
		}
		
	}/*end function save data*/
	
	
        /*
	*Update query
	*/  
	public function updateData($table,$set,$where)
	{
		try
		{	
			
			
			$sql="Update ".$GLOBALS['dbprefix']."".$table." set ".$set." where ".$where."";
			 
			   $result=$this->dbfunction->executeResult($this->dbconn,$sql);
		 	    return $result;
			}
		catch(Exception $e)
		{
			return $e;
		}
    		
		
	}
	
	 /*delete query*/
    public function delData($table,$where)
    {
	try
	{	
	    
	    $sql="Delete from ".$GLOBALS['dbprefix']."".$table." where ".$where."";
	    
	    $result=$this->dbfunction->executeResult($this->dbconn,$sql);
	    return $result;
	}
	catch(Exception $e)
	{
	    return $e;
	}
    } /*end function delData*/
	
		 /*fetchObject query*/
    public function fetchObject($sql)
    {
		
		try
		{	 	  
			
			$result=$this->dbfunction->executefetchObject($sql);
			return $result;
		}
		catch(Exception $e)
		{
			return $e;
		}
    } /*end function fetchObject*/
    
}

?>