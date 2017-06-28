<?php 

class DB_Connect{

	// constructor
	function __construct(){

	}

	//destructor
	function __destruct(){
		//this->close();
	}

	// Connecting to database
	public function connect()
	{
		require_once 'config.php';
		// connecting to mysql
		$con = new mysqli(DB_Hhost, DB_USER, DB_PASSWORD , DB_DATABASE);
		//shit
		//stuff

		//return database handler
		return $con;
	}

	// Closing database connection
	public function close(){
		mysqli_close();
	}
}

$sidedb = new mysqli("localhost", "clement", "clement123" , "test_offline");
	
	if($sidedb->connect_errno){
		die('Sorry we have some problem with the General Database!');
	}
?>