<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

	// Check if the method exists
	if(function_exists($_POST['tablename']))
	{
		$_POST['tablename']();
	}

	// Call Items methods
	function transfer()
	{
		
	}
?>