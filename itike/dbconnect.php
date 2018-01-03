<?php  
error_reporting(E_ALL); 
ini_set('display_errors', 1);
	$eventDb = new mysqli("localhost", "clement", "clement123" , "events");
	
	if($eventDb->connect_errno){
		die('Uplus is currently not available in your country!');
	}
?>