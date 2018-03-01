<?php

include 'db.php';

//get registrants
$query = $eventDb->query("SELECT * FROM free_tickets_buy");

while ($data = $query->fetch_assoc()) {
	//adding people to transaction database
	$data = array('action'=>'eventBook', 'pullNumber'=>$data['phone'], 'name'=>$data['name'], 'email'=>$data['email'], 'eventId'=>9, 'seatCode'=>1, 'userId'=>2);

	var_dump(curl('http://uplus.com/api/index.php', $data));
}
function curl($url, $data, $method = "POST"){
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_USERAGENT => 'heree',
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => $data
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);

	return $resp;
}
?>