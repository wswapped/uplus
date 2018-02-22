<?php

	$db = new mysqli("localhost", "clement", "clement123" , "uplus");
	function get_crops($system)
	{
		global $conn;

		$query = $conn->query("SELECT * FROM system_crops WHERE system = \"$system\" ") or die("get system crpos $conn->error");
		$crops = array();

		while ($data = $query->fetch_assoc()) {
			$crops[] = $data;
		}

		return $crops;
	}

	function get_systems($user){
		global $conn;

		$query = $conn->query("SELECT * FROM systems WHERE ownerId = \"$user\" ") or die("Get systems $conn->error");
		$systems = array();

		while ($data = $query->fetch_assoc()) {
			$systems[] = $data;
		}

		return $systems;
	}
	function next_message($field){
		//Next message to be sent
		global $conn;

		$query = $conn->query("SELECT * FROM field_messages JOIN messages ON field_messages.message = messages.id WHERE field_messages.field = \"$field\" LIMIT 1");
		return $query->fetch_assoc();
	}
    function get_fields($farmer){
        global $conn;
        $query = $conn->query("SELECT * FROM fields JOIN farmer ON fields.owner = farmer.id WHERE farmer.id = $farmer ") or die("can't get user fields $conn->error");
        $fields = array();
        while ($data = $query->fetch_assoc()) {
            $fields[] = $data;
        }
        return $fields;
    }
	function sendsms($phone, $message, $subject=""){
        $recipients     = $phone;
        $data = array(
            "sender"        =>'Fata Isuka',
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
