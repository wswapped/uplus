<?php
	$url = 'https://uplus.rw/api/';
	$amount=100;
	$data = array();
	$data["action"] = "contribute";
	$data["amount"] = $amount;

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
		echo "Network error";
	}
	else
	{	
		$result = json_decode($result, true)[0];

		$status = $result['status'];
		echo "$status";
		
		if($status == true)
		{
			//tell him that everything is fine
			//end the comunication he is going to interact with momo with a request of a pin from momo directly
		}
		else
		{
			//Tell him that he doesnt have enough money on his momo and end it
		}
	}
?>