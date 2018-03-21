<?php
    //TODO: Authentication
	include '../db.php';
	session_start();
	include_once "../functions.php";

    include_once "../class.message.php";
    $Broad = new broadcast();

	$user = getUser();
	if(!$user){
		echo json_encode(array('status'=>false, 'data'=>'Auth failed'));
		die();
	}

    $req = array_merge($_POST, $_GET);

    //desired action
    $action = $req['act']??$req['action']??"";

    if($action == 'save'){
        $members = $req['members']??"";
        $message = $req['message']??"";
        $mode = $req['mode'];
        $subject = $req['subject']??"";

        $scheduleTime = $req['scheduleTime']??false;
        

        //Adding message in DB as reference
        $messageID = addMessage($user, $message, $mode, $subject, $scheduleTime);

        //Queing messages for sending
        $questat = logMessages($messageID, $members);

        
        echo json_encode(array('status'=>1, 'data'=>'Messages are being sent successfully', 'messageID'=>$messageID));
    }else if($action == 'det'){
        //Checking all the details for message
        $messageID = $req['id'];
        if(!empty($messageID)){
            $details = $Broad->detMessage($messageID);
            echo json_encode(array('status'=>1, 'data'=>$details));
        }else echo json_encode(array('status'=>0, 'data'=>"Provide message ID"));
    }else{
        echo json_encode(array());
    }
   
?>