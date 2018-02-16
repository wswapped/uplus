<?php
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    //TODO: Authentication
    include '../db.php';
    session_start();
    include_once "../functions.php";

    $user = getUser();
    if(!$user){
        $str = json_encode(array('status'=>false, 'data'=>'Auth failed'));
        die("data: $str\n\n");
    }
    
    $req = array_merge($_POST, $_GET);

    if(!empty($req['id'])){
        //Checking for the message loads
        $id = $req['id'];

        //Unsent messages logs - instances
        $unsent = msgStat($id, 'pending');

        for($n=0; $n<count($unsent); $n++){
            //sending one message
           $sendstat = msend($unsent[$n]['id']);           
           break;
        }

        $unsent = msgStat($id, 'pending');
        echo "data: ".json_encode(array('not_sent'=>count($unsent)) )."\n\n";        
    }
?>