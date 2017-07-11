<?php

class DB_Functions {

	private $db;

	//put your code here
	// constructor
	function __constructor(){
		include('./connection.php');
		// connecting to database
		$this->db = new DB_Connect();
		$this->db->connect();
	}

	// destructor
	function __destruct(){

	}

	/**
	* Storing new user
	* returns user details
	*/
	public function storeUser($Id, $User){
		$sidedb = new mysqli("localhost", "clement", "clement123" , "test_offline");
		// Insert user into database
		$result = $sidedb->query("INSERT INTO users values ($Id, '$User')");

		if($result){
			return true;
		} else{
			if(mysqli_error() == 1062){
				// Duplicate key - Primary Key Violation
				return true;
			}else{
				// For other errors
				return false;
			}
		}
	}
	/**
	* Getting all users
	*/
	public function getAllUsers(){
		$sidedb = new mysqli("localhost", "clement", "clement123" , "test_offline");
		$result = $sidedb->query("SELECT * FROM users");
		return $result;
	}
}

?>
