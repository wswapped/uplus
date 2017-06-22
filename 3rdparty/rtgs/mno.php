<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
include('db.php');

if(isset($_GET['phone2'])){	
session_start();
$amount = $_SESSION['amount'];	
$phone2	= $_GET['phone2'];	




	$fromTransactionId	= $_SESSION['fromTransactionId'];
	$ToTransactionId	= $_SESSION['ToTransactionId'];	
	// STRAT API HERE //////////////////////////
			
	$url = 'http://51.141.48.174:9000/requestpayment/';
	
	$data = array();
	$data["agentName"] = "UPLUS";
	$data["agentId"] = "0784848236";
	$data["phone"] = '';
    $data["phone2"] = $phone2;
	$data["amount"] = $amount;
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
		//var_dump($result);
		echo 'We are having some connectivity issue connecting to the 3rdparty.<br>
		Please try again.';	
	}
	else
	{
		$server_output = $result;
	
		// FROM JSON TO PHP
		$firstcheck = json_decode($server_output);
		$agentName = $firstcheck->{'agentName'};
		$balance = $firstcheck->{'balance'};
		$check1 = $firstcheck->{'information'};
		$check2 = $firstcheck->{'information2'};
		$transactionId1 = $firstcheck->{'transactionId'};

		// PUT THE RESPONSE IN SESSION SO THAT I CAN CALL IT'S STATUS
		$_SESSION["server_output"] 		= $server_output;

		if($check1 == 'You sent invalid amounts. Error: 404.'){
			echo $agentName.' pull balance at Torque is: '.$balance;
		}
		else{
			$Update2= $con->query("UPDATE `transactions` SET status='$check2', 3rdpartyId='$transactionId1' WHERE id = '$ToTransactionId'");
			// 1ST STATUS CONNECTED TO THE API WAITNING FOR MTN RESPONSE

			echo'<div id="returning">Sending '.number_format($amount).'Rwf .</div>';
			
			// FIRE THE RECURRING CALL AFTER 5 SEC TO CHECK THE STATUS
			echo'
			<script>
				interval = setInterval(function() { checking();}, 10000);
				interval;
				stopcall = setInterval(
					function() { 
						stopit();
					}, 50000);
				stopcall;
			</script>';}

	}

}
	// CHECK IF THE RESPONSE IS BACK
	if(isset($_GET['check']))
	{
		
		session_start();
		$server_output = $_SESSION["server_output"];
		$fromTransactionId 	= $_SESSION["fromTransactionId"];
		$ToTransactionId 	= $_SESSION["ToTransactionId"];
		$forGroupId			= $_SESSION["forGroupId"];

		$data = json_decode($server_output);
		$url = 'http://51.141.48.174:9000/requestpayment/';
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
			var_dump($result);	
		}
		$server_results = $result;
		

			// CHANGE THE INFORMATION TO RESEND
		$_SESSION["server_output"] = $server_results;
			// DECODE THE RETURNED STATUS FROM PHONE 1 AND 2
		$obj = json_decode($server_results);
		$info1 	= $obj->{'information'};
		$info2 	= $obj->{'information2'};
		$amount	= $obj->{'amount'};
		$phone	= $obj->{'phone'};
		$phone2	= $obj->{'phone2'};
		$tosendtransid	= $obj->{'transactionId'};
		$Update2= $con->query("UPDATE `transactions` SET status='$info2' WHERE id = '$ToTransactionId'");
		
		require_once('../../classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+250'.$phone;
		$from = "uplus";
		$sqlsmsget = $db->query("SELECT replymessage FROM accounts WHERE `id` = '$forGroupId'");
		$rowsms = mysqli_fetch_array($sqlsmsget);
		$tosendsms = $rowsms['replymessage'];
		
		
		if($info1 == 'REQUESTED')
			{
				echo'Please approve a request on your Phone</br>';
			}
		elseif($info1 == 'DECLINED')
			{
				$Update2= $con->query("UPDATE `transactions` SET status='NO BALANCE' WHERE id = '$ToTransactionId'");
		
				?>
			<script>clearInterval(interval);</script>
						<h4>Opps! Sorry</h4>
						<p>We are out of float</p>
						<h4>But</h4>
						<p>We refiel our acounts every 24h</p>
						<h4>So!</h4>
						<p>The reiciver should get the money in not more than 24 hour from now.</p>
						<h4>Not satisfied?</h4>
						<p>
							<ul>
								<li>Call the support team: <b>+250784848236</b></li>
								<li>Email the support team: <b>support@uplus.rw</b></li>
							</ul>
						</p>
			<?php
				$message    = 'You have just canceled a transfer of '.$amount.' to '.$phone2.', but you can still try again';// Specify your AfricasTalking shortCode or sender id
				$gateway    = new AfricasTalkingGateway($username, $apikey);
				try 
				{
					$results = $gateway->sendMessage($recipients, $message, $from);	
					foreach($results as $result) {}
				}
				catch ( AfricasTalkingGatewayException $e )
				{
					$results.="Encountered an error while sending: ".$e->getMessage();
				}
			}
		elseif($info1 == 'APPROVED')
			{
				$message    = $tosendsms.' with transaction id of '.$tosendtransid;// Specify your AfricasTalking shortCode or sender id
				$gateway    = new AfricasTalkingGateway($username, $apikey);
				try 
				{
					$results = $gateway->sendMessage($recipients, $message, $from);	
					foreach($results as $result) {}
				}
				catch ( AfricasTalkingGatewayException $e )
				{
					$results.="Encountered an error while sending: ".$e->getMessage();
				}
				if($info2 == 'COMPLETE')
					{
						echo'<script>clearInterval(interval);</script> 
							Thanks The money has been received by '.$phone2.'. Status:'.$info2.'';
					}
				elseif($info2 == 'Error sending money.')
					{
						echo'<script>clearInterval(interval);</script>
							<h4>Opps!  Sorry!<h4/>
							<p>
								We are not able to comunicate to the receiver so that we can
								deposite the money <br/>
								We will Return back your money after some few tries, In 24hours max. <br/> 
								</p>
								<h4>What hapened?</h4>
								<p>Here are some suspected reasons:<br/>
									<ul>
										<li>Receiver account misspelled</li>
										<li>Receiver account blocked</li>
										<li>Error connecting to the bank or mobile money</li>
									</ul>
								</p>
								<h4>What"s next?</h4>
								<p>We will be trying to send 30 times in 1/2h interval<br/>
									<ul>
										<li>And the receiver get the money</li>
										<li>Or we refund you the total amount ('. number_format($amount) .'Rwf)</li>
									</ul>
								</p>
								<h4>Not satisfied?</h4>
								<p>
									<ul>
										<li>Call the support team: <b>+250784848236</b></li>
										<li>Email the support team: <b>support@uplus.rw</b></li>
									</ul>
								</p>
									
							';
					}
				else{
						echo'<script>clearInterval(interval);</script>
							'.$info2;
					}
			}
		else
			{
				echo'<script>clearInterval(interval);</script>
					Something is not right.<br> 
					You might not have '.number_format($amount).' Rwf on your phone
					or, This 0'.$phone.'';?>
					is not registred in MTN Mobile Money Rwanda
					 <br>Try again if you think you made a mistake <br><button class="myButton" onClick="document.location.href='i<?php echo $forGroupId;?>'">Try again</button>
			<?php 
			}

	}

