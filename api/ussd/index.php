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
		$response .="CON Murakaza neza mu kimina cya Uplus!\n1. Gurupe ndimo\n2. Konti yanjye\n3. Ubusobanuro\n# Exit\n";
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
							$response .= "$n. $groupname\n";
						}
						$response .="0. Jya muri gurupe\n";
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

							//checking chose group's and it's menu
							$tdata = gettempdata($sessionId, 'groups');
							$tdata = json_decode($tdata, true);

							if(is_array($tdata)){
								if(!empty($tdata[$smenu])){
									//User chose correct group
									$groupid = $tdata[$smenu];
									$groupname = groupname($groupid);
									$response.="CON Ikaze muri $groupname\n";
									$response.="1. Tanga umusanzu\n2. Bikuza\n3. Abanyamuryango\n4. Amakuru ya gurupe\n# Ahabanza";
								}else if($smenu == 0){
									//Joining a group
									$response.="CON Mushyiremo umubare uranga gurupe\nComing soon";
								}else{
									$response.="Ibyo mwahisemo sibyo\n# Gutangira";
								}

							}else{
								//No data stored or invalid JSON
							}

						}else{
							//The user is new and might have put the group code
							//Checking if group exists
							$groupname = is_group($smenu);
							if($groupname){
								//The group requested to join exists
								$response.="CON Mwasabye kwinjira muri gurupe '$groupname'\n";
								$response.="Turacyari gutunganya ubu buryo\n";
							}
						}

							
					}else{
						//Group was chose or group code was input
						$tmenu = $requests[2]; //Third menu choice

						if($nrequests == 3){
							$groups = usergroups($phoneNumber);

							//Group chose earlier
							$groupId = json_decode(gettempdata($sessionId, 'groups'), true)[$requests[1]];
							$groupname = is_group($groupId);

							if(!empty($groups)){
								//User chose from the group menu
								if($tmenu == 1){
									//gutanga umusanzu
									$response.="CON Shyiramo amafaranga ushaka kwitanga\n";
								}else if($tmenu == 2){
									//Kubikuza
									$response.="CON Shyiramo amafaranga ushaka kubikuza\n";
								}elseif ($tmenu == 3) {
									# members
									$members = groupmembers($groupId);																		
									$response.="CON Abanyamuryango ba '$groupname'\n";
									$n=0;
									$tdata = array(); //To keep temparary dta
									foreach ($members as $memberid => $membername) {
										$n++;
										$response.="$n. $membername\n";
										$tdata[$n]= $memberid;
									}
									$response.="#. Ahabanza\n";
									keeptempdata($sessionId, $tdata, '$groupname members');

								}elseif ( $tmenu == 4) {
									# group info
									$response.="CON Ibyerekeye gurupe '$groupname'\n#.Ahabanza\n";
									$groupinfo = groupinfo($groupId);
									$response.="Amafaranga ifite:\n";
									$response.="Ayo ishaka kugeraho: $groupinfo[targetAmount]\n";
									$response.="Yatangiye: ".date("d-m-Y", strtotime($groupinfo['createdDate']))."\n";
									$response.="Itangizwa: \n";
									$response.="Iyobowe: $groupinfo[admin]\n";
									$response.="#.Ahabanza\n";

								}else{
									//Wrong choice
									$response.="CON Mwashyizemo ibitari byo.\n#.Ahabanza\n";
								}
							}
						}else{
							$fomenu = $requests[3]; //Fourth menu item

						}
						
					}
					
				}
				
			}else if($fmenu == 2){
				//konti
				$response.="CON Konti ya $userName\n";
			}
			else if($fmenu == 3){
				//konti
				$response.="END Uplus igufasha gukusanya no kugenzura amafaranga 
		mu bimina n'amagurupe kuburyo bworoshe kandi bunoze\nKu bindi bisobanuro sura www.uplus.rw\n";
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
