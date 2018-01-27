<?php
	// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://edorica.com/api.php?action=get_result&code=0208032olc#',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
$marks = json_decode($resp, 1);
// Close request to clear up some resources
curl_close($curl);
?>