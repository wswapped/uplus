<?php
/*define('hostname', 'localhost');
define('user', 'clement');
define('password', 'clement123');
define('databaseName', 'testdb');

$connect = mysqli_connect(hostname, user, password, databaseName);
*/
$db = new mysqli("localhost", "clement", "clement123" , "testdb");
	
	if($db->connect_errno){
		die('Sorry we have some problem with the General Database!');
	}