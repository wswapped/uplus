<?php

if ($_SERVER["REQUEST_METHOD"]=="POST") {
	showStrudent();
}
	
function showStrudent(){
	require('connection.php');
	$sqlgroups = $db->query("SELECT * FROM student WHERE 1");
	$groups = array();
	WHILE($group = mysqli_fetch_array($sqlgroups))
	{
	    $groups[] =  $group;
	}
	header('Content-Type: application/json');

	echo $groups = json_encode(array("students"=>$groups));
	
}
?>