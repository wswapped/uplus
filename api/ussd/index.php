<?php
require('../db.php');
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

$conn = $db;
$req = array_merge($_POST, $_GET); //Keeping get and post for testing and productin handling concurently
$sessionId   = $req["sessionId"]?? session_id();
$serviceCode = $req["serviceCode"]??"*801#";
$phoneNumber = $req["phoneNumber"];
$text        = $req["text"];
//IN USSD phone number is always sent
//CLEAN and sanitize PHONE
$phoneNumber  = preg_replace( '/[^0-9]/', '', $phoneNumber );
$phoneNumber  = substr($phoneNumber, -10);
	//Checking if user exists
	$query  = mysqli_query($conn, "SELECT * FROM users WHERE phone = '$phoneNumber' LIMIT 1");
	if(mysqli_num_rows($query))
	{
		//Here user already exists		
		$signInfo     = array();
		$userData = mysqli_fetch_array($query);
		$userName = $userData['name'];
		$userId = $userData['id'];
		//echo "";
	}
	else{
		//Here the user is new, should I ask the name?
		$code         = rand(1000, 9999);
	    $sqlsavePin = $db->query("INSERT INTO `users`(
	    phone, active, createdDate, password, visits, updatedBy, updatedDate) 
	    VALUES('$phoneNumber', '0', now(), '$code', '0', '1', now())")or die (mysqli_error());
	    $sqlcheckPin = $db->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
	      $userData = mysqli_fetch_array($sqlcheckPin);
	      $userName = $userData['name'];
	      $userId = $userData['id'];
	}
	//Application logic
	if(empty($text) || $text == "#" || $text == "1*#"){
		//First request
		$response .="CON Murakaza neza mu kimina cya Uplus!\n1 Gurupe ndimo\n2 Konti yanjye\n3 Ubusobanuro\n# Exit\n";
	}else{
		//Handling further requests
		$requests = explode("*", $text);
		$nrequests = count($requests); //Number of requests

		//Level1 requests
		if(is_numeric($requests[0])){
			//Handling first menu
			$fmenu = $requests[0];
			if($fmenu == 1){

				if($nrequests == 1){
					//Checking for groups a user is in
					$query = mysqli_query($conn, "SELECT groupId, groupName FROM `members` WHERE memberPhone = \"$phoneNumber\"") or die("Error getting groups you belong in, ".mysqli_error($conn));
					// $groups = array();

					// //Looping through all groups and putting them in $groups arry
					// while ($temp = mysqli_fetch_assoc($query)) {
					// 	$groups[] = $temp['groupName'];
					// 	$groupsIds[] = $temp['groupId'];
					// }
					$groups = usergroups($phoneNumber);

					if(empty($groups)){
						//User does not belong in any group
						$response =  "CON ".$userName." Nta gurupe urimo.\nKugirango ujye muri gurupe shyiramo umubare uyiranga\n";
					}else{
						//Showing groups
						$response.="CON ".$userName.", Hitamo gurupe\n";

						$n=0;
						foreach ($groups as $groupid => $groupname) {
							$n++;
							$tdata[$n] = $groupid;
							$response .= "$n $groupname\n";
						}
						//Logging the tempdata
						keeptempdata($sessionId, $tdata, 'groups');
					}
				}else{
					//Further requests were issued
					$smenu = $requests[1];

					if($nrequests == 2){

						//Checking if user belongs
						$groups = usergroups($phoneNumber);

						if(count($groups)>0){
							//Here the user belongs in a group
							//Here going to handle first request, going to check if sent text is among the groups shown
							$sql = "SELECT * FROM ussdtempdata WHERE session_id = '$sessionId' and type = 'groups' ORDER BY time DESC LIMIT 1";
							$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
							$data = mysqli_fetch_assoc($query);
							
							$data = json_decode($data['data'], true);
							if(is_array($data) )
							{
								if (empty($data)) {
								    // decoded is empty.
									$response =  "CON empty decodded";
								}else
								{
									if(!empty($data[$smenu]))
									{
										//Here the user chose a group presented
										$groupid  = $data[$smenu];
										//Getting group members and name
										$query = mysqli_query($conn, "SELECT groupName, memberId, COALESCE(`memberName`, `memberPhone`) `memberName` FROM members WHERE groupId = \"$groupid\"") or die("Error: ".mysqli_error($conn));
										$membersOrder  = $groupInfo = array();
										$n=0;
										while ($temp = mysqli_fetch_assoc($query)) 
										{
											if($n==0){
												$response = "CON Ikaze muri $temp[groupName]\n"; //Printing the group on first loop
												$groupName = $temp['groupName'];
											}
											$n++;
											$groupInfo[] = $temp;
											$response.="$n $temp[memberName]\n";
											//Storing order of group memebrs
											$membersOrder[$n] = $temp['memberId'];
										}
										keeptempdata($sessionId, $data, "$groupName members");
										//Logging the members
										
									}else{
										//Maybe the user put the group ID
										//checking if text is a group ID
										$query = $db->query("SELECT groupName FROM groups WHERE id = \"$text\" LIMIT 1") or die("Can not get group you want");
										if(mysqli_num_rows($query)){
											//Here the group*
										}
									}
								}
							}
							else
							{
								$response =  "CON Received content contained invalid JSON!".var_dump($temp);
							}
						}else{
							//The user is new and might have put the group code
							//Checking if group exists
							$groupname = is_group($smenu);
							if($groupname){
								//The group requested to join exists
								$response.="Mwasabye kwinjira muri gurupe '$groupname'\n";
								$response.="Turacyari gutunganya ubu buryo\n";
							}
						}

							
					}else{
						//Group was chose or group code was input
						echo "string";
					}
					
				}
				
			}


		}else{
			//Invalid requests
			$response = "END Mwashyizemo ibitari byo\nMusubiremo kandi muhitemo ibiribyo";
		}
	}


	// // else if($text == "1"){
	// }else if($text == 2){
	// 	//Money withdrawal
	// 	$response = "CON Money withdrawal";
	// }else if($text == 3){
	// 	//Information
	// 	$response = "END Uplus igufasha gukusanya no kugenzura amafaranga mu bimina n'amagurupe kuburyo bworoshe kandi bunoze";
	// }else{
	// 	$requests = explode("*", $text);
		
	// 	//Number of requests
	// 	$nrequests = count($requests);
	// 	if($nrequests == 2)
	// 	{
			
	// 		//Here going to handle first request, going to check if sent text is among the groups shown
	// 		$sql = "SELECT * FROM ussdtempdata WHERE session_id = '$sessionId' and type = 'groups' ORDER BY time DESC LIMIT 1";
	// 		$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	// 		$data = mysqli_fetch_assoc($query);
			
	// 		$data = json_decode($data['data'], true); 			

	// 		//There is problem accessing this array with strings which PHP keeps changing to number, here's  work around
	// 		if(is_array($data)  )
	// 		{	
	// 			if (empty($data)) {
	// 			    // decoded is empty.
	// 				$response =  "CON empty decodded";
	// 			}
	// 			else
	// 			{
	// 				if(!empty($data[$text]))
	// 				{
	// 					//Here the user chose a group presented
	// 					$groupid  = $data[$text];
	// 					//Getting group members and name
	// 					$query = mysqli_query($conn, "SELECT groupName, memberId, COALESCE(`memberName`, `memberPhone`) `memberName` FROM members WHERE groupId = \"$groupid\"") or die("Error: ".mysqli_error($conn));
	// 					$membersOrder  = $groupInfo = array();
	// 					$n=0;
	// 					while ($temp = mysqli_fetch_assoc($query)) 
	// 					{
	// 						if($n==0){
	// 							$response = "CON Ikaze muri $temp[groupName]\n"; //Printing the group on first loop
	// 							$groupName = $temp['groupName'];
	// 						}
	// 						$n++;
	// 						$groupInfo[] = $temp;
	// 						$response.="$n $temp[memberName]\n";
	// 						//Storing order of group memebrs
	// 						$membersOrder[$n] = $temp['memberId'];
	// 					}
	// 					keeptempdata($session_id, $data, "$groupName members");
	// 					//Logging the members
						
	// 				}else{
	// 					//Maybe the user put the group ID
	// 					//checking if text is a group ID
	// 					$query = $db->query("SELECT groupName FROM groups WHERE id = \"$text\" LIMIT 1") or die("Can not get group you want");
	// 					if(mysqli_num_rows($query)){
	// 						//Here the group*
	// 					}
	// 				}
	// 			}
	// 		}
	// 		else
	// 		{
	// 			$response =  "CON Received content contained invalid JSON!".var_dump($temp);
	// 		}
	// 	}
	// // }
	function keeptempdata($session_id, $data, $type){
		global $conn;
		$data = json_encode($data);
		$data = mysqli_real_escape_string($conn, $data);
		$sql = "INSERT INTO ussdtempdata(session_id, data, type) VALUES(\"$session_id\", \"$data\", \"$type\")";
		$query = mysqli_query($conn, $sql) or die("Can't log data: ".mysqli_error($conn));
		if($query)
			return true;
		else return false;
	}
	function usergroups($phone){
		//FUnction to check the groups a user with $phone belongs in
		global $conn;
		$sql = "SELECT * FROM members WHERE memberPhone = \"$phone\"";

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
	echo "$response";
?>
