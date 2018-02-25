<?php
	$request = $_POST;
	include "../db.php";

	$action = $request['action'];
	if($action == 'free_ticket_submission'){
		//register the user in a free event
		$name = $request['name'];
		$phone = $request['phone']??"";
		$email  = $request['email']??"";

		if($email && $phone && $name){
			//adding the user in the attendance DB

			$q  = $eventDb->query("INSERT INTO free_tickets_buy(name, phone, email) VALUES(\"$name\", \"$phone\", \"$email\") ");
			if($q){
				$response = array('status'=>true);
			}else{
				$response = array('status'=>false, 'msg'=>"$eventDb->error");
			}
			echo json_encode($response);

		}
	}
?>