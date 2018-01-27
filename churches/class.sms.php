<?php
    class sms{
	    function churchBalance($church){
	        //Function to find SMS Balance for the church
	        global $conn;
	        $query = $conn->query("SELECT balance FROM smsbalance WHERE church  = \"$church\"") or die($conn->error());
	        if($query->num_rows>0){
	        	$data = $query->fetch_assoc();
	        	return $data['balance'];
	        }else return false;
	    }
    }
    $Sms = new sms();
?>