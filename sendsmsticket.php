<?php

include 'db.php';

//get registrants
$query = $eventDb->query("SELECT * FROM free_tickets_buy");

while ($data = $query->fetch_assoc()) {
	//adding people to transaction database
	$phone = $data['phone'];
	$send_data = array('action'=>'eventBook', 'pullNumber'=>$data['phone'], 'name'=>$data['name'], 'email'=>$data['email'], 'eventId'=>9, 'seatCode'=>1, 'userId'=>2);
	$ret_data = curl('https://uplus.rw/api/index.php', $send_data);
	$ret = json_decode($ret_data, 1);
	$ticket_code = $ret[0]['ticketCode'];

	$message = "Congratulations!
	Your registration for Youth Financial Literacy Seminar has been confirmed.
	Ticket code: $ticket_code
	Any inquiry call 0785054743";

	echo "<div>To: $phone<br />message:$message</div>";

	// sendsms($phone, $message);
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
function sendsms($phone, $message, $subject=""){
        $recipients     = $phone;
        $data = array(
            "sender"        =>'Uplus',
            "recipients"    =>$recipients,
            "message"       =>$message,
        );
        $url = "https://www.intouchsms.co.rw/api/sendsms/.json";
        $data = http_build_query ($data);
        $username="cmuhirwa";
        $password="clement123";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
                
        if($httpcode == 200)
        {
            return "Yes";
        }
        else
        {
            return "No";
        }
    }
?>