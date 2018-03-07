<?php

    include_once "../db.php";

    $request = $_POST;

    $action = $request['action']??"";

    $response = array();
    if($action == 'share_buy_request'){
        //here we are gong to issue the request for buying shares

        $title= $db->real_escape_string($request['title']??"");
        $surname= $db->real_escape_string($request['surname']??"");
        $oname= $db->real_escape_string($request['othername']??"");
        $phone= $db->real_escape_string($request['phone']??"");
        $id= $db->real_escape_string($request['id']??"");
        $gender= $db->real_escape_string($request['gender']??"");
        $dob= $db->real_escape_string($request['dob']??"");
        $nationality= $db->real_escape_string($request['nationality']??"");
        $number= $db->real_escape_string($request['shares']??"");

        //Checking if we have some one with same credentials
        $sql = "SELECT * FROM clients WHERE nidPassport =\"$id\" OR telephone = \"$phone\" ";
        $exiq = $db->query($sql);

        if($exiq && $exiq->num_rows>0){
            //Here there are some people with same identity
            $response = array('status'=>false, 'msg'=>"The identity you are using is already in use $exiq->num_rows");
        }else{
            //No one exists with the identity
            $query = $db->query("INSERT INTO clients(title, surname, otherNames, dob, gender, nidPassport, nationality, telephone) VALUES(\"$title\", \"surname\", \"$oname\", \"$dob\", \"$gender\", \"$id\", \"$nationality\", \"$nationality\") ");
            if($query){
                //successfully retrieved the stuff
                $response = array('status'=>true, 'msg'=>"You are successfully registered and you will receive communication regarding your request");
            }else{
                //whoa error
                $response = array('status'=>false, 'msg'=>"Errror in insertion $db->error");
            }
        }

    }
    echo json_encode($response);
?>