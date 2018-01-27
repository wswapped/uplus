<?php
    class broadcast{
	    function churchBalance($church){
	        //Function to find SMS Balance for the church
	        global $conn;
	        $query = $conn->query("SELECT balance FROM smsbalance WHERE church  = \"$church\"") or die($conn->error());
	        if($query->num_rows>0){
	        	$data = $query->fetch_assoc();
	        	return $data['balance'];
	        }else return false;
	    }
	    function ntarget($message){
	    	//Count number of recepients of message
	    	global $conn;
	    	$query  = mysqli_query($conn, "SELECT count(id) as sum FROM messageslog WHERE message = \"$message\" ") or die(mysqli_error($conn));
	    	if(mysqli_num_rows($query)){
	    		$data = mysqli_fetch_assoc($query);
	    		return $data['sum'];
	    	}else return false;
	    }
	    function channels($message){
	    	global $conn;
	    	$query = mysqli_query($conn, "SELECT COUNT(*) as sum, channel FROM `messageslog` JOIN message ON message.id = messageslog.message WHERE message.id = $message GROUP BY channel") or die(mysqli_error($conn));
	    	$channels = array();
	    	while ($data = mysqli_fetch_assoc($query)) {
	    		$channels[$data['channel']] = $data['sum'];
	    	}
	    	return $channels;
	    }
	    function cost($message){
	    	//Function to estimate cost of message thread
	    	global $conn;
	    	//Getting channels where message was sent
	    	$channels = $this->channels($message);

	    	//Checking failed message to substract them from the cost
	    	$failed = $this->failedthreads($message);

	    	$failed_channels = array_column($failed, 'channel');
	    	$failed_channels = array_count_values($failed_channels);
	    		
	    	foreach ($failed_channels as $key => $value) {
	    		$channels["$key"] = $channels[$key] - $value;
	    	}

	    	//message costs definition
	    	$costs_def = array('sms'=>13, 'app'=>0, 'email'=>0);

	    	$costs = array();
	    	foreach ($channels as $key => $value) {
	    		$costs[$key] = $value * $costs_def[$key];
	    	}
	    	$costs['total'] = array_sum(array_values($costs));
	    	return $costs;

	    }
	    function failedthreads($message){
	    	//Function to find failed message transfers
	    	global $conn;
	    	$query  = mysqli_query($conn, "SELECT * FROM messageslog  WHERE message = \"$message\" AND status = 'failed'") or die(mysqli_error($conn));
	    	$failed = array();


	    	while ($data = mysqli_fetch_assoc($query)) {
	    		$failed[] = $data;
	    	}

	    	return $failed;
	    }
	    function detMessage($messageID){
	    	//Function to return more details on a message
	    	global $conn;

	    	//Getting basic elements in message table table
	    	$messageID = mysqli_real_escape_string($conn, $messageID);
	    	$query  = mysqli_query($conn, "SELECT * FROM message WHERE id = \"$messageID\" LIMIT 1") or die(mysqli_error($conn));
	    	if(mysqli_num_rows($query)){
	    		$data = mysqli_fetch_assoc($query);

	    		//Checking methods used to send message
	    		$channels = $this->channels($messageID);

	    		$data['channels'] = $channels;

	    		//Costs
	    		$data['cost'] = $this->cost($messageID);

				$senttime = new dateTime($data['time']);
                $senttime = $senttime->format('d M Y - H:i:s');
                $data['time'] = $senttime;

	    		$data['ntarget'] = $this->ntarget($messageID);

	    		$data['status'] = $this->chStatus($messageID);

	    		return $data;


	    	}else return false;
	    }
	    function chStatus($message, $channel='%'){
	    	//Function to check status of channel or all channels of the message
	    	global $conn;
	    	$messageID = mysqli_real_escape_string($conn, $message);
	    	$channel = mysqli_real_escape_string($conn, $channel);
	    	$sql = "SELECT COUNT(*) AS sum, channel, status FROM `messageslog` JOIN message ON message.id = messageslog.message WHERE message=\"$message\" AND status LIKE \"%\" GROUP BY status, channel";
	    	$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	    	$chanStatus = array();
	    	while ($data = mysqli_fetch_assoc($query)) {
	    		// if(empty($chanStatus[$data['channel']])){
	    		// 	$chanStatus[$data['channel']] = array();
	    		// }
	    		$chanStatus[$data['channel']][$data['status']] = $data['sum'];
	    	}
	    	return $chanStatus;
	    }
	    function cBroadcast($sender, $num=5){
	    	//Function to check current church-sender broadcasts
	    	global $conn;
	    	$sql = "SELECT * FROM message WHERE sender = \"$sender\" ORDER BY time DESC LIMIT $num";
	    	$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	    	$temp = array();
	    	while ($data = mysqli_fetch_assoc($query)) {
	    		$temp[] = $data;
	    	}
	    	return $temp;
	    }
    }
    $Broadcast = new broadcast();
?>