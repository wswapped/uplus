<?php
$db = new mysqli("localhost", "clement", "clement123" , "uplus");
include_once 'functions.php';
header("Content-Type: text/plain");
session_start(); //For web testing only


//For browser-based testing
if(isset($_GET['ses'])){
	session_destroy();
	session_start();
	session_regenerate_id();
}

//Initialising
$response = "";
$tdata = array();

$conn = $db = $conn;
$req = array_merge($_POST, $_GET); //Keeping get and post for testing and productin handling concurently
$sessionId   = $req["sessionId"]?? session_id();
$serviceCode = $req["serviceCode"]??"*801#";
$phoneNumber = $req["phoneNumber"];
$text        = $req["text"];
//IN USSD phone number is always sent
//CLEAN and sanitize PHONE
$phoneNumber  = preg_replace( '/[^0-9]/', '', $phoneNumber );
$phoneNumber  = substr($phoneNumber, -10);

$mq = $conn->query("SELECT * FROM messages WHERE name = 'location' LIMIT 1");
$md = $mq->fetch_assoc();
$ms = $md['text'];

$message = str_ireplace("\$name", $name, str_ireplace("\$date_today", date("D-M-Y"), str_ireplace("\$fert_kg", rand(6, 9), str_ireplace("\$temperature", rand(19, 29), $ms))));

if($phone && $name){
	//Adding user
	$conn->query("INSERT INTO farmer(name, phone) VALUES(\"$name\", \"$phone\")");

	$id = $conn->insert_id;

	$sms = sendsms($phone, $message);
	$query = $conn->query("INSERT INTO location_subscribers(location, username, phone, subscribed) VALUES(\"$location\", \"$name\", \"$phone\", 'true')  ");
	if($query){
		$response = array("status"=>true);
	}else{
		$response = array("status"=>false, 'msg database error $db->error');
	}
}

	//Handling further requests
	$requests = explode("*", $text);
	$nrequests = count($requests); //Number of requests
	$temp = array('');

	$ntemp = array_search("#", $requests);
	$ntemp = is_int($ntemp)?$ntemp:0;

	// if($ntemp){
	// 	for($n=$ntemp; ($n<$nrequests && $ntemp>0); $n++){
	// 		if(($n+1)!=$nrequests){
	// 			$temp[]=$requests[$n+1];
	// 		}
	// 	}
	// 	$requests = $temp;
	// 	$nrequests = count($requests);	
	// }

	//If last request is hash, then user should go back to home
	if(isset($requests[$nrequests-1]) && ($requests[$nrequests-1] == "#")){
		$text="#";
	}

	//Application logic
	if(empty($text) || $text == "#" || $text == "1*#"){
		//First request
		$response .="CON Ikaze ku iteganyagihe n'ubuhinzi!\n1. Iteganyagihe\n2. Imirima yanjye\n3. Gutanga amakuru\n# Exit\n";
	}else{
		//Level1 requests
		if(is_numeric($requests[0])){
			//Handling first menu
			$fmenu = $requests[0];
			if($fmenu == 1){

				if($nrequests == 1){
					//Checking for groups a user is in
					$t = rand(19,25);
					$response.="Uyu munsi hari ubushyuhe bwa $t - ubushyuhe buringaniye, nta mvura iragwa\nreba iteganyagihe ry'\n1.Icyumweru cyose\n2. Ukwezi kose\n3. Igihembwe cy'ihinga\n4. Iyandiishe kubona amakuru\n0. Gusubira inyuma";
				}else{
					echo "Turacyari kubikoraho, uzabona amakuru vuba";
					
				}
				
			}else if($fmenu == 2){

				$conts = $withs = 0;
				$fields = get_fields(1);

				$response.="CON Amakuru ajyanye n'imirima yanyu\nHitamo umurima\n";
				for ($n=0; $n < count($fields) ; $n++) {
					$response .= ($n+1).".".$fields[$n]['locationName']."\n";	

				}
			}
			else if($fmenu == 3){
				//konti
				$response.="CON Gutanga amakuru!\n1.Umusaruro\n2.Ikirere\n";
			}



		}else{
			//Invalid requests
			$response = "END Mwashyizemo ibitari byo\nMusubiremo kandi muhitemo ibiribyo";
		}
	}
	function keeptempdata($session_id, $data, $type){
		global $conn;
		$data = json_encode($data);
		$data = mysqli_real_escape_string($conn, $data);
		$sql = "INSERT INTO ussdtempdata(session_id, data, type) VALUES(\"$session_id\", \"$data\", \"$type\")";
		$query = mysqli_query($conn, $sql) or die("OK Error: Can't log data: ".mysqli_error($conn));
		if($query)
			return true;
		else return false;
	}

	function groupmembers($groupid){
		//Return names, ids of group members
		global $conn;
		$query = mysqli_query($conn, "SELECT memberId as id, COALESCE(memberName, memberPhone) as name FROM members WHERE groupId = \"$groupid\"") or die("CON Error getting group members ".mysqli_error($conn));

		$groups = array();
		while ($temp = mysqli_fetch_assoc($query)) {
			$groups[$temp['id']] = $temp['name'];
		}
		return $groups;
	}

	function gettempdata($session_id, $type){
		//return tempdta
		global $conn;
		$query = mysqli_query($conn, "SELECT data FROM ussdtempdata WHERE session_id = \"$session_id\" AND type= \"$type\" ORDER BY time DESC LIMIT 1 ") or die("END Error: can't get temp data ".mysqli_error($conn));
		if(mysqli_num_rows($query)>0){
			$data = mysqli_fetch_assoc($query);
			return $data['data'];
		}else return false;
	}
	function groupname($groupid){
		//Function to check if group with $groupid exists
		global $conn;
		$query = mysqli_query($conn, "SELECT groupName FROM groups WHERE id = \"$groupid\"") or die("CON cn lookup group ".mysqli_error($conn));
		if(mysqli_num_rows($query)){
			$data = mysqli_fetch_assoc($query);
			return $data['groupName'];
		}else return false;
	}
	function groupinfo($groupid){
		global $conn;
		//Return info for display in about group's section
		$query = mysqli_query($conn, "SELECT targetAmount, COALESCE(adminName, adminPhone) as admin, createdDate FROM groups WHERE id =\"$groupid\" LIMIT 1") or die("CON Error".mysqli_error($conn));
		return mysqli_fetch_assoc($query);
	}
	function usergroups($userdata, $type='memberPhone'){
		//FUnction to check the groups a user with $userdata of column $type belongs in
		global $conn;
		$sql = "SELECT * FROM members WHERE $type = \"$userdata\"";
		$query = mysqli_query($conn, $sql) or die("END Error Checking groups u belong in\n".mysqli_error($conn));


		//Looping through all groups and putting them in $groups array
		$groups = array();
		while ($temp = mysqli_fetch_assoc($query)) {
			$groups[$temp['groupId']] = $temp['groupName'];
		}

		return $groups;
	}
	function is_group($groupid){
		//Function to check if group with $groupid exists
		global $conn;
		$query = mysqli_query($conn, "SELECT groupName FROM groups WHERE id = \"$groupid\"") or die("CON cn lookup group ".mysqli_error($conn));
		if(mysqli_num_rows($query)){
			$data = mysqli_fetch_assoc($query);
			return $data['groupName'];
		}else return false;
	}


	function api($data){
		//Function to query the API with action and specify $data as required per $action
		//FOr example if action is contribute, then $data will be memberId, groupId, amount, pushnumber, senderBank as keys of arrays and values
		$url = 'https://uplus.rw/api/';

		//Add all data
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		if ($result === FALSE) 
		{ 
			return "Network error";
		}
		else
		{
			return $result;			
		}
		
	}

	// function api($data){
	// 	//Using curl
	// 	$curl = curl_init();

	// 	curl_setopt_array($curl, array(
	// 	    CURLOPT_RETURNTRANSFER => 1,
	// 	    CURLOPT_URL => 'http://uplus.rw/api',
	// 	    CURLOPT_USERAGENT => 'USSD',
	// 	    CURLOPT_POST => 1,
	// 	    CURLOPT_POSTFIELDS => $data
	// 	));

	// 	$resp = curl_exec($curl);

	// 	if($resp){
	// 		return $resp;
	// 	}else{
	// 		die("END Error:". curl_error($curl)." of ". curl_error($curl));
	// 	}

	// 	curl_close($curl);

	// 	return $resp;
	// }

	function contribute($data){
		$result = api($data);

		$result = json_decode($result, true)[0];

		$status = $result['status'];
		
		if($status == true)
		{
			return true;
			//tell him that everything is fine
			//end the comunication he is going to interact with momo with a request of a pin from momo directly
		}
		else
		{
			return false;
			//Tell him that he doesn't have enough money on his momo and end it
		}
	}
	function withdraw($data){
		$result = api($data);
		return $result;
	}
	function senderbank($phoneNumber){
		$phoneNumber  = preg_replace( '/[^0-9]/', '', $phoneNumber );
		$phoneNumber  = substr($phoneNumber, -8);
		if($phoneNumber[0] == 8)
			return 1;
	}
	echo "$response";
?>
