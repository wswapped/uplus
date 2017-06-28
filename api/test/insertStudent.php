<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"]=="POST") {
	createStudent();
}


function createStudent()
{
	require('connection.php');
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$age = $_POST["age"];

	$sql = $db->query("INSERT INTO student(firstname, lastname, age)
	values ('$firstname', '$lastname', '$age');")or die (mysqli_error());

}
?>
