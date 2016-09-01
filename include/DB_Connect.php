<?php

class DB_Connect {
   
    function __construct() 
    {
     
    }

   function __destruct()
    {
       
    }

//    /*function to connect to database*/
//    public function connect()
//    {	
//     
//	$con = mysql_connect('localhost', 'root', 'success'); // local
//     
//	if(!$con)
//	{
//	    echo mysql_error();die;
//	}
//    
//      mysql_select_db('ppeople',$con); // local
//    
//    /* return database handler*/
//	return $con;
//    }
	
	public function connection()
	{
		$servername = "localhost";
		$username = "prayergrid_main";
		$password = "passw@123";
		$dbname = "prayergrid";
		
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		return $conn;
		
	}

  

}

?>