<?php
include_once './db_functions.php';

$db = new DB_Functions();

$json = $_POST["usersJSON"];
//Remove Slashes
if(get_magic_quotes_gpc()){
	$json = stripcslashes($json);
}
//Decode JSON into an Array
$data = json_decode($json);
//Util arrays to create response JSON
$a = array();
$b = array();

for($i=0; $i<count($data); $i++)
{
// Store User into the db
$res = $db->storeUser($data[$i]->userId,$data[$i]->userName);
	
	if($res){
		$b["id"] = $data[$i]->userId;
		$b["status"] = 'yes';
		array_push($a, $b);
	}else{
		$b["id"] = $data[$i]->userId;
		$b["status"] = 'no';
		array_push($a, $b);
	}
}

echo json_encode($a);
?>