<?php 
if ($_SERVER["REQUEST_METHOD"]=="POST") 
{
	$_POST['action']();
}
else
{
	echo 'UPLUS API V01';
}
function listGroups()
{
	if (isset($_GET['sentAmount'])) 
	{
		$forGroupId			= 	mysqli_real_escape_string($db, $_GET['forGroupId']);		// COmpanyID
		$amount				= 	mysqli_real_escape_string($db, $_GET['sentAmount']);		// Amount
		$pushAccountNumber 	= 	'0'.mysqli_real_escape_string($db, $_GET['sendFromAccount']);	// From account
		$pushName			= 	mysqli_real_escape_string($db, $_GET['sendFromName']);		// From Name
		$pullName			= 	mysqli_real_escape_string($db, $_GET['sendToName']);		// From Name
		$pushBankId			= 	mysqli_real_escape_string($db, $_GET['sendFromBank']);		// To Bank
		$pullBankId			=	mysqli_real_escape_string($db, $_GET['sendToBank']);		// To Bank
		$pullAccountNumber	=	mysqli_real_escape_string($db, $_GET['sendToAccount']);		// To Phone1
		
		
		
		// For API
		$phone1 = mysqli_real_escape_string($db,$_GET['phone1']);
		$phone2 = mysqli_real_escape_string($db,$_GET['phone2']);
		// For API

		// START DEBIT AND CREDIT
		$sqlRemoveAmount= $outCon->query("INSERT INTO `transactions` 
		(operation, `amount`, `forGroupId`, `3rdparty`, `bankCode`, `actorName`, `status`, `accountNumber`)
		VALUES 
		('DEBIT', '$amount', '$forGroupId', 'TORQUE', '$pushBankId', '$pushName', 'CALLED', '$pushAccountNumber'),
		('CREDIT', '$amount', '$forGroupId', 'TORQUE', '$pullBankId', '$pullName', 'CALLED', '$pullAccountNumber')
		") or mysqli_error();
		$sqlRemovedId= $outCon->query("select id from transactions order by id desc limit 1");
		$remId = mysqli_fetch_array($sqlRemovedId);
		$pullTransactionId = $remId['id'];
		$pushTransactionId = $pullTransactionId - 1;
		
		//Get the bank name
		$sqlNotifyBank = $outCon->query("SELECT name FROM banks WHERE id = '$pushBankId'");
		$rowNotifyBank = mysqli_fetch_array($sqlNotifyBank);
		$notifyBank = $rowNotifyBank['name'];
		
		
		//Notify the user about the action
		$sqlNotify = $db->query("SELECT groupName FROM groups WHERE id = '$forGroupId'");
		$rowNotify = mysqli_fetch_array($sqlNotify);
		$notifyTitle = $rowNotify['groupName'];
		
		// STRAT API HERE //////////////////////////
				
		$url = 'https://lightapi.torque.co.rw/requestpayment/';
		
		$data = array();
		$data["agentName"] 		= "UPLUS";
		$data["agentId"] 		= "0784848236";
		$data["phone"] 			= $phone1;
		$data["phone2"] 		= $phone2;
		$data["amount"] 		= $amount;
		$data["fname"] 			= $pushName;
		$data["policyNumber"]	= ''.$pullName.' / '.$pushName.'';
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
			$Update1= $outCon->query("UPDATE `transactions` SET status='NETWORK ERROR' WHERE id = '$pushTransactionId'");
			$Update2= $outCon->query("UPDATE `transactions` SET status='NETWORK ERROR' WHERE id = '$pullTransactionId'");
			
			echo 'Sorry! We had some network problem connecting to '.$notifyBank.'.<br>
			Please try again.';	
		}
		else
		{
			$server_output = $result;
		
			// FROM JSON TO PHP
			$firstcheck 	= json_decode($server_output);
			$check1 		= $firstcheck->{'information'};
			$check2 		= $firstcheck->{'information2'};
			$transactionId1 = $firstcheck->{'transactionId'};

			$time 			= mysqli_real_escape_string($db,$firstcheck->{'time'});
			$transactionId 	= mysqli_real_escape_string($db,$firstcheck->{'transactionId'});
			$policyNumber 	= mysqli_real_escape_string($db,$firstcheck->{'policyNumber'});
			$invoiceNumber 	= mysqli_real_escape_string($db,$firstcheck->{'invoiceNumber'});
			$phone 			= mysqli_real_escape_string($db,$firstcheck->{'phone'});
			$phone2 		= mysqli_real_escape_string($db,$firstcheck->{'phone2'});
			$amount 		= mysqli_real_escape_string($db,$firstcheck->{'amount'});
			$fname 			= mysqli_real_escape_string($db,$firstcheck->{'fname'});
			$lname 			= mysqli_real_escape_string($db,$firstcheck->{'lname'});
			$nationalId 	= mysqli_real_escape_string($db,$firstcheck->{'nationalId'});
			$information 	= mysqli_real_escape_string($db,$firstcheck->{'information'});
			$information2 	= mysqli_real_escape_string($db,$firstcheck->{'information2'});
			$agentName 		= mysqli_real_escape_string($db,$firstcheck->{'agentName'});
			$agentId 		= mysqli_real_escape_string($db,$firstcheck->{'agentId'});
			$feedback 		= mysqli_real_escape_string($db,$firstcheck->{'feedback'});
			$balance 		= mysqli_real_escape_string($db,$firstcheck->{'balance'});
			
			$outCon->query("INSERT INTO 
				mnoapi(
				`time`, `transactionId`, `policyNumber`, `invoiceNumber`,
				 `phone`, `phone2`, `amount`, `fname`, 
				 `lname`, `nationalId`, `information`, `information2`, 
				 `agentName`, `agentId`, `feedback`, `balance`, myid)
				VALUES(
				'$time', '$transactionId', '$policyNumber', '$invoiceNumber',
				'$phone', '$phone2', '$amount', '$fname', 
				'$lname', '$nationalId', '$information', '$information2', 
				'$agentName', '$agentId', '$feedback', '$balance', '$pushTransactionId'
				)
	")or die(mysqli_error());


			// PUT THE RESPONSE IN SESSION SO THAT I CAN CALL IT'S STATUS
			$_SESSION["notifyBank"] 		= $notifyBank;
			$_SESSION["server_output"] 		= $server_output;
			$_SESSION["forGroupId"]			= $forGroupId;
			$_SESSION["pushTransactionId"] 	= $pushTransactionId;
			$_SESSION["pullTransactionId"] 	= $pullTransactionId;
			$_SESSION["pullName"] 			= $pullName;
			$_SESSION["notifyTitle"] 		= $notifyTitle;

			if($check1 == 'You sent invalid amounts. Error: 404.')
			{
				$Update1= $outCon->query("UPDATE `transactions` SET status='BALANCE', 3rdpartyId='$transactionId1' WHERE id = '$pushTransactionId'");
				$Update2= $outCon->query("UPDATE `transactions` SET status='BALANCE', 3rdpartyId='$transactionId1', actorName ='$balance' WHERE id = '$pullTransactionId'");
				
				echo 'Your company balance in the pull account is: '.$balance;
			}
			else
			{
				$Update1= $outCon->query("UPDATE `transactions` SET status='$check1', 3rdpartyId='$transactionId1' WHERE id = '$pushTransactionId'");
				$Update2= $outCon->query("UPDATE `transactions` SET status='$check2', 3rdpartyId='$transactionId1' WHERE id = '$pullTransactionId'");
				// 1ST STATUS CONNECTED TO THE API WAITNING FOR MTN RESPONSE
			
				echo'<div id="returning">You are going to send '.number_format($amount).' Rwf to '.$pullName.' for '.$notifyTitle.'
				<br><br><b>Connecting ...
				</div>';
				
				// FIRE THE RECURRING CALL AFTER 5 SEC TO CHECK THE STATUS
				echo'
				<script>
					setTimeout(function() { checking(); }, 10000);
				</script>';
			}
		}

	}
	// END API HERE /////////////////////////


	// CHECK IF THE RESPONSE IS BACK
	if(isset($_GET['check']))
	{
		$server_output 		= $_SESSION["server_output"];
		$forGroupId			= $_SESSION["forGroupId"];
		$pushTransactionId 	= $_SESSION["pushTransactionId"];
		$pullTransactionId 	= $_SESSION["pullTransactionId"];
		$notifyBank			= $_SESSION["notifyBank"];
		$pullName 			= $_SESSION["pullName"];
		$notifyTitle 		= $_SESSION["notifyTitle"];

		$data = json_decode($server_output);
		$url = 'https://lightapi.torque.co.rw/requestpayment/';
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
		$tosendtransid	= $obj->{'transactionId'};

		$time 			= mysqli_real_escape_string($db,$obj->{'time'});
		$transactionId 	= mysqli_real_escape_string($db,$obj->{'transactionId'});
		$policyNumber 	= mysqli_real_escape_string($db,$obj->{'policyNumber'});
		$invoiceNumber 	= mysqli_real_escape_string($db,$obj->{'invoiceNumber'});
		$phone 			= mysqli_real_escape_string($db,$obj->{'phone'});
		$phone2 		= mysqli_real_escape_string($db,$obj->{'phone2'});
		$amount 		= mysqli_real_escape_string($db,$obj->{'amount'});
		$fname 			= mysqli_real_escape_string($db,$obj->{'fname'});
		$lname 			= mysqli_real_escape_string($db,$obj->{'lname'});
		$nationalId 	= mysqli_real_escape_string($db,$obj->{'nationalId'});
		$information 	= mysqli_real_escape_string($db,$obj->{'information'});
		$information2 	= mysqli_real_escape_string($db,$obj->{'information2'});
		$agentName 		= mysqli_real_escape_string($db,$obj->{'agentName'});
		$agentId 		= mysqli_real_escape_string($db,$obj->{'agentId'});
		$feedback 		= mysqli_real_escape_string($db,$obj->{'feedback'});
		$balance 		= mysqli_real_escape_string($db,$obj->{'balance'});
		
		$outCon->query("INSERT INTO 
				mnoapi(
				`time`, `transactionId`, `policyNumber`, `invoiceNumber`,
				 `phone`, `phone2`, `amount`, `fname`, 
				 `lname`, `nationalId`, `information`, `information2`, 
				 `agentName`, `agentId`, `feedback`, `balance`, myid)
				VALUES(
				'$time', '$transactionId', '$policyNumber', '$invoiceNumber',
				'$phone', '$phone2', '$amount', '$fname', 
				'$lname', '$nationalId', '$information', '$information2', 
				'$agentName', '$agentId', '$feedback', '$balance', '$pushTransactionId'
				)
			");

		$Update1= $outCon->query("UPDATE `transactions` SET status='$info1' WHERE id = '$pushTransactionId'");
		$Update2= $outCon->query("UPDATE `transactions` SET status='$info2' WHERE id = '$pullTransactionId'");
		
		require_once('../../classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+250'.$phone;
		$from = "uplus";
		$sqlsmsget = $db->query("SELECT successNotificationSms FROM groups WHERE `id` = '$forGroupId'");
		$rowsms = mysqli_fetch_array($sqlsmsget);
		//$successNotificationSms = $rowsms['replymessage'];
		$successNotificationSms = 'Thanks '.$pullName.' for contribuing '.number_format($amount).' Rwf to '.$notifyTitle;
		if($info1 == 'PENDING')
		{
			echo 'You are going to send '.number_format($amount).' Rwf to '.$pullName.' for '.$notifyTitle.'
					<br><br><b>Still Connecting ...
					</div>';
			$sqlcountlotations = $outCon->query("SELECT count(id) count FROM mnoapi PARTITION (p0) WHERE information ='$info1' AND transactionId = '$transactionId'")or die(mysqli_error());
			$fetchcount = mysqli_fetch_array($sqlcountlotations);
			$newK = $fetchcount['count'];
			?>
			<script type="text/javascript">
			var M = <?php echo $newK;?>;
			M = M - 2;
				var reason = 'We havent been able to connect to <?php echo $notifyBank;?>';
			</script>
			<?php
		}elseif($info1 == 'REQUESTED')
		{
			?>
			Please approve a request on your Phone</br>
			<script>
				if(k<2)
				{
					var i = 100;

					var counterBack = setInterval(function()
					{
						i--;
						if (i > 0)
						{
							$('.progress-bar2').css('width', i+'%');
						} 
						else 
						{
							clearInterval(counterBack);
						} 
					}, 600);
					document.getElementById('showTiming').innerHTML =
					'<div class="progress" style="border-radius: 10px;">'
					  +'<div class="progress-bar progress-bar2" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">'
						+'<span class="sr-only">'+i+'</span>'
					  +'</div>'
					+'</div>';
				}
				var reason = 'We havent been able to connect to <?php echo $notifyBank;?>';
			</script>
			<?php
		}
		elseif($info1 == 'DECLINED')
		{
			?>
			<script>
				var k=10;
				console.log('user canceled the request');
				var reason = 'You canceled you request';
			</script>
			Sorry you just canceled, but its okay you can try again.
					
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
			if($phone2 == '' || $phone2 == NULL || $phone2 == '250')
			{
				echo'<script>
					var k=0;
					console.log("Money into the pull, start sending (reset k to 0)");
				</script> 
					Thanks The money has been deposited into the <b>'.$agentName.'</b> Pull account';
			}
			$message    = $successNotificationSms.', transaction id: '.$tosendtransid;// Specify your AfricasTalking shortCode or sender id
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
				echo'<script>var k=10;
				console.log("Money sent successfully stop reqesting (put k to 6)");
				</script> 
					Thanks The money has been received by '.$phone2.'. Status:'.$info2.'';
			}
			elseif($info2 == 'Error sending money.')
			{
				echo'<script>var k=10;
				console.log("Erro sending money, here we shall fire a refund fx (stop the request put k to 6)");
				</script>
					'.$info2.'
					The mobile destination you provided might not be in mobile money, 
						so we are going to return back your money after some fiew tries.  
						Please call 0784848236 if you dont get the money back in the next 2 min.
					';
			}
			else
			{
				echo'<script>var k=10;
				console.log("funny error stop the request (put k to 0)");
				</script>
					'.$info2;
			}
		}
		elseif($info1 == 'ACCOUNTHOLDER_WITH_FRI_NOT_FOU')
		{
			?>
			<script>var k=10;
			console.log("Phone error stop reqesting (put k to 6)");
			</script>
				Opps! this phone (0<?php echo $phone;?>) is not registerd in <?php echo $notifyBank;?>
				<br>Try again if you think you made a mistake<br>
			<?php 
		}
		else
		{
			?>
			<script>var k=10;
			console.log("no money stop reqesting (put k to 10)");
			</script>
				Oops! You don't have <?php echo number_format($amount);?> Rwf 
				on your phone (0<?php echo $phone;?>)
				<br>Try again if you think you made a mistake<br>
				 
		<?php 
		}
	}
}
?>