<?php 
require('db.php');
$sentMessage = "testmessage";
$userId = "1";

function send_notification ($tokens, $message)
{
	$url = 'https://fcm.googleapis.com/fcm/send';
	$fields = array(
		 'registration_ids' => $tokens,
		 'data' => $message
		);

	$headers = array(
		'Authorization:key = AIzaSyCVsbSeN2qkfDfYq-IwKrnt05M1uDuJxjg',
		'Content-Type: application/json'
		);

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
   $result = curl_exec($ch);           
   if ($result === FALSE) {
       die('Curl failed: ' . curl_error($ch));
   }
   curl_close($ch);
   return $result;
}

$sql = $db->query("SELECT token FROM users WHERE id = '$userId' AND token IS NOT NULL");

$tokens = array();

if(mysqli_num_rows($sql) > 0 ){
	while ($row = mysqli_fetch_assoc($sql)) {
		$tokens[] = $row["token"];
	}
}
$message = array("message" => $_POST['message']);
send_notification($tokens, $message);
header('Content-Type: application/json');
			echo $message_status;
?>