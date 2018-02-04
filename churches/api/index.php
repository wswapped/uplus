<?php
	include "../db.php";
	include "../class.message.php";
	$Message = new broadcast();
	$request = array_merge($_POST, $_GET); //$_GET for devt nd $_POST for production
    $response = array();
	
	$action = $request['action']??"";

	if($action == "export_members"){
		$church_id = $request['church'];
		// $branch = $request['branch'];
		$user = $request['user'];


		//checking file
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
    }else if($action == 'create_group'){
    	//api route for group creatinon
    	$name = $request['name'];
    	$type = $request['type'];
    	$location = $request['location'];
    	$rep = $request['rep'];
    	$church = $request['church'];

        if(!empty($_FILES)){
            $pic = $_FILES['profile_picture'];
            if($pic['error'] == 0){
                //Image has no error
                //checking if it's image
                $ext = strtolower(pathinfo($pic['name'], PATHINFO_EXTENSION));
                if($ext == 'png' || $ext == 'jpg'){
                    //moving file to disk
                    $filename = "gallery/groups/$name"."_".time().".$ext";
                    if(move_uploaded_file($pic['tmp_name'], "../$filename")){
                        //Updating database


                        //Creating group
                        $sql = "INSERT INTO groups(name, branchId, representative, type, location, profile_picture) VALUES(\"$name\", \"$church\", $rep, \"$type\", \"$location\", \"$filename\" )";
                        // echo "$sql\n";
                        $conn->query($sql) or die("Error $conn->error");
                        $response = array('status'=>true, 'msg'=>"Success");

                    }else $response = array('status'=>false, 'msg'=>"Error keeping file on server\nPlease try again");
                }else{
                    //We dont recognize this file format
                    $response = array('status'=>false, 'msg'=>"The file uploaded seems to be not an image, $ext only png and jpeg are allowed\nPlease try again");
                }
            }else{
                $response = array('status'=>false, 'msg'=>"Error uploading group image\nPlease try again");
            }
        }
    	
    }else{
    	echo json_encode(array('status'=>false, 'msg'=>"Provide action"));
    }

    echo json_encode($response);
    flush();
    die();
?>