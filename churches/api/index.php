<?php
	include "../db.php";
	include "../class.message.php";
	$Message = new broadcast();
	$request = array_merge($_POST, $_GET); //$_GET for devt nd $_POST for production
	$action = $request['action']??"";

	if($action == "export_members"){
		$church_id = $request['church'];
		// $branch = $request['branch'];
		$user = $request['user'];


		//checking file
		var_dump($_FILES['members-file']['size']);

		if($_FILES['members-file']['size']>0){

			$target_dir = "uploads/churchmembers/";
			$tmp_file = basename($_FILES["members-file"]['tmp_name']);
			$target_file = $target_dir.basename($_FILES["members-file"]['name']);
			$uploadOk = 1;
			$FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			move_uploaded_file(basename($_FILES["members-file"]['tmp_name']), $target_file);

		}else{
			echo "No file uploaded";
		}
		
	}else if($action == "prayer_request"){
		$member = $request['member']??"";
		$sender = $request['sender']??"admin";
		$message = $request['message']??"";

		$query = $db->query("INSERT INTO prayer_requests(member, message, sender) VALUES(\"$member\", \"$message\", \"$sender\") ") or die($db->error);
	}else if($action == 'buy'){
        $phonenumber = $request['phone'];
        $count = $request['count'];
        $church  = $request['church'];
        $cost = $count*13;

        $query = $db->query("INSERT INTO transactions(church, phone, nsms, cost, mode, status) VALUES(\"$church\", \"$phonenumber\", \"$count\", '$cost', 'mobile', 'pending')") or die("Can't log purchase ".$db->error);



        //INcreasing the smsbalance
        $db->query("UPDATE smsbalance SET balance = balance+$count WHERE church = '$church' ") or die("error updating church ".$db->error);


        echo json_encode(array('status'=>true, 'balance'=>$Message->churchbalance($church)));
    }else if($action == 'invoice'){
    	//Invoice for transaction
    	$transaction = $request['id']??"";
    	$query = $db->query("SELECT *, status as transaction_status FROM transactions WHERE id = \"$transaction\" LIMIT 1 ") or die("Can't get transaction detasils ".$db->conn);
    	$data = $query->fetch_assoc();
    	$data['status'] =1;
    	echo json_encode($data);
    }else{
    	echo json_encode(array('status'=>false, 'msg'=>"Provide action"));
    }
?>