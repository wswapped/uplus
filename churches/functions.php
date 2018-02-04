<?php
    function getUser(){
        global $conn;
        if (isset($_SESSION['loginusername'])) {
            $loginusername = $_SESSION['loginusername'];
            $loginpassword = $_SESSION['loginpassword'];
            $selectid = $conn ->query("SELECT * FROM users WHERE loginName='$loginusername' AND loginpsw='$loginpassword'");
            $fetchid = mysqli_fetch_array($selectid);
            $userId = $fetchid['Id'];
            return $userId;
        }else return false;
    }
    function user_details($userid){
        //Function to get user's details
        global $conn;
        $user = $conn->query("SELECT * FROM members WHERE id = \"$userid\" LIMIT 1 ") or die("Errror getting user's details $conn->error");

        $user = $user->fetch_assoc();
        return $user;
    }
    function logMessages($messageID, $receivers, $status='pending'){
        global $conn;

        $receivers = is_array($receivers)?$receivers:array($receivers);

        //Buildiing query - insert values
        $sql = "INSERT INTO messageslog(message, receiver, status) VALUES ";
        $iquery = '';
        for($n=0; $n<count($receivers); $n++){
           $iquery .= "('$messageID', '$receivers[$n]', '$status'), ";
        }
        $iquery = trim($iquery,  ', ');
        $sql .= $iquery;

        $query = $conn->query($sql) or die($conn->error());

        return true;
    }

    function msend($logID){
        include 'db.php';
        //Getting details of the message log

        $det = $conn->query("SELECT email, subject, token, members.phone as receiver, message.message as message, channel FROM messageslog JOIN message ON messageslog.message = message.id JOIN members ON messageslog.receiver = members.id WHERE messageslog.id = \"$logID\" LIMIT 1 ")or die("can get log data ".mysqli_error($conn));

        if(mysqli_num_rows($det)){
            $smsdet = mysqli_fetch_assoc($det);
            $channel = $smsdet['channel'];
            $receiver = $smsdet['receiver'];
            $message = $smsdet['message'];

            if($channel == 'sms'){
                //Sending sms
                $smsstatus = sendsms($receiver, $message);
            }else if($channel == 'app'){
                $token = $smsdet['token'];
                $sendstatus = send_notification(array($token), array("message" => $message));

                $sendstatus = json_decode($sendstatus, 1);
                if($sendstatus['success'] == 1)
                {
                   $smsstatus = "Yes"; 
                }else
                {
                $smsstatus = "No";
               }                
            }
            else if($channel == 'email'){
                $token = $smsdet['token'];
                $email = $smsdet['email'];
                $subject = $smsdet['subject'];
                $sendstatus = email($email, $subject, $message);

                $sendstatus = json_decode($sendstatus, 1);
                if($sendstatus['success'] == 1)
                {
                   $smsstatus = "Yes"; 
                }else
                {
                $smsstatus = "No";
               }
                
            }

            if($smsstatus == "Yes")
            {
                $query = $conn->query("UPDATE messageslog SET status='sent' WHERE id = \"$logID\"") or die(mysqli_error($conn));
                return true;
            }
            elseif($smsstatus == "No")
            {
                $query = $conn->query("UPDATE messageslog SET status='failed' WHERE id = \"$logID\"") or die(mysqli_error($conn));
                return false;
            }
        }
        else
        {
            return false;
        }       
    }
    function list_groups($churchID){
    	global $conn;
    	$query = $conn->query("SELECT groups.*, branches.name as branchname FROM groups JOIN branches ON groups.branchid = branches.id WHERE branches.church = \"$churchID\" ") or die("Cant get groups ".$conn->error);

    	$churches = array();

    	while ($data = $query->fetch_assoc()) {
    		$churches[] = $data;
    	}
    	return $churches;
    }
    function email($email, $subject, $body, $header=''){
        echo("dkfjdk");
              require_once 'mailer/PHPMailerAutoload.php';

                $headers  = $header.= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
               $mail = new PHPMailer;
               $mail->isSMTP();
               $mail->SMTPSecure = 'tls';
               $mail->SMTPAuth = true;

               //Enable SMTP debugging.
                //$mail->SMTPDebug = 3;

               $mail->Host = 'tls://smtp.gmail.com:587';
               $mail->Port = 587;
               $mail->Username = 'wswapped@gmail.com';
               $mail->Password = 'Laa1001Laa#';
               $mail->setFrom('wswapped@gmail.com');
               $mail->addAddress($email);
               $mail->Subject = $subject;
               $mail->SMTPDEbug = 4;    
               $mail->Body = $body;
               $mail->smtpConnect(
                    array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
                );
               $mail->addCustomHeader($headers);
               //send the message, check for errors
               if (!$mail->send()) {
                   //Sending with traditional mailer
                   $this->init("default"); //Initializing mail parameters SMPTP settings

                   $header = "From: "._FROM_EMAIL;
                   if(mail($email, $subject, $body, $headers."From:"._FROM_EMAIL)){
                       return true; //Here the e-mail was sent
                       }
                    else{
                        //echo "ERROR: " . $mail->ErrorInfo;
                        return false;
                        }



               }
               else {
                   return true;
               }
               var_dump($mail->ErrorInfo);  

    }
    function church_members($churchid){
    	//returns members of $churchid
    	global $conn;
    	$query = $conn->query("SELECT members.* FROM members JOIN branches ON members.locationId = branches.id WHERE branches.church = $churchid ") or die("Can't get members $conn->error");
    	$members = array();
    	while ($data = $query->fetch_assoc()) {
    		$members[] = $data;
    	}
    	return $members;
    }
    function Semail($email, $subject, $body, $header=''){
        require_once 'mailer/PHPMailerAutoload.php';
        $email = "info@edorica.com";
        $server = "mail.edorica.com:465";
        $headers  = $header.= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;

        $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );

        //Enable SMTP debugging.
        $mail->Host = '$server';
        $mail->Port = 587;
        $mail->Username = $email;
        $mail->Password = 'laa1001laa';
        $mail->setFrom($email);
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->addCustomHeader($headers);

        $data = "";

        //send the message, check for errors
        if (!$mail->send())
        {
           //Sending with traditional mailer
           // $header = "From: $email";
           // if(mail($email, $subject, $body, $headers."From:$email")){
           //     $data = true; //Here the e-mail was sent
           //     }
           //  else{
           //      $data = false;
           //  }

            $data = false;
        }
        else
        {
           $data = true;
        }

        echo json_encode($data);
    }
    function sendsms($phone, $message, $subject=""){
        $recipients     = $phone;
        $data = array(
            "sender"        =>'Church Test',
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
    function addMessage($sender, $message, $channel, $subject){
        //$time = $time??date('Y-m-d h:m:s');
        global $conn;
        $sql = "INSERT INTO message(sender, message, channel, subject) VALUES (\"$sender\", \"$message\", \"$channel\", \"$subject\")";

        $query = mysqli_query($conn, $sql) or die("Okay".$conn->error);
        return mysqli_insert_id($conn);
    }
    function msgStat($id, $stat){
        global $conn;
        //Message logs of $id
        $sql = "SELECT * FROM messageslog WHERE message = \"$id\" AND  status=\"$stat\"";
        $query  = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $logs = array();
        while ($data = mysqli_fetch_assoc($query)) {
            $logs[] = $data;
        }
        return $logs;
    }

    function mlogs($id){
        global $conn;

        //Message logs of $id
        $query  = mysqli_query($conn, "SELECT * FROM messageslog WHERE message = \"$id\"") or die(mysqli_error($conn));

        $logs = array();
        while ($data = mysqli_fetch_assoc($query)) {
            $logs[] = $data;
        }

        return $logs;
    }
      function churchbranches($church){
        global $db;
        $query = $db->query("SELECT * FROM branches WHERE church = \"$church\" ") or die("Error getting church branches ".$db->conn);
        $branches = array();
        while ($data = $query->fetch_assoc()) {
          $branches[] = $data;
        }
        return $branches;
      }
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
?>