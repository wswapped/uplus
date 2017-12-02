<?php
	//Defining hoost and database related constants
	define("_HOST", "localhost");
	define("_DBUNAME", "edori604_edorica");
	define("_DBPWD", 'Admin@#.');
	define("_DBNAME", "uplus");

	$db = $conn = mysqli_connect(_HOST, _DBUNAME, _DBPWD) or die(mysqli_connect_error());

	mysqli_select_db($conn, _DBNAME);
?>
