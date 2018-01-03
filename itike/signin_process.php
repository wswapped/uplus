<?php
error_reporting(0);
session_start();
if(isset($_SESSION['user_id']))
{
	header('location:events.php');
}
elseif(!isset($_SESSION['user_id']))
{

if (isset($_POST['username']) && isset($_POST['password'])) 
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (!empty($username) && !empty($password)) 
	{
		require_once("dbconnect.php");
		$query = "SELECT user_id FROM users WHERE phone LIKE '$username' AND password LIKE '$password'";
		if ($query_run = $eventDb->query($query) or die("error please in seller account select".mysqli_error())) 
		{
			$query_num_row = mysqli_num_rows($query_run);
			if ($query_num_row == 0) 
			{
				echo "You are not register please";
			}
			elseif($query_num_row ==1)
			{
				$userArray = mysqli_fetch_array($query_run);
				$user_id = $userArray['user_id'];
				echo $_SESSION['user_id'] = $user_id;
				header('location:events.php');
			}
		}
	}
	else
	{
		echo "Not good";
	}
}
}
?>