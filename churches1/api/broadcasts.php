<?php
    //TODO: Authentication
	include '../db.php';
	session_start();
	include_once "../functions.php";

	$user = getUser();
	if(!$user){
		echo json_encode(array('status'=>false, 'data'=>'Auth failed'));
		die();
	}

    $req = array_merge($_POST, $_GET);

    if(!empty($req['act']) && $req['act']=='save'){
        
    }
   
?>