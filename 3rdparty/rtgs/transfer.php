

<div style="text-align: center;padding-top:10px; color: #fff; text-shadow: 1px 1px 3px #000000">

<h5>
<?php // MTN AND TIGO TRANSFERS
error_reporting(E_ALL);
ini_set('display_errors', 0);
	
include "db.php";
if (isset($_GET['sentAmount'])) 
{
	$forGroupId			= 	$_GET['forGroupId'];		// COmpanyID
	$amount				= 	$_GET['sentAmount'];		// Amount
	$pushAccountNumber 	= 	'0'.$_GET['sendFromAccount'];	// From account
	$pushName			= 	$_GET['sendFromName'];		// From Name
	$pullName			= 	$_GET['sendToName'];		// From Name
	$pushBankId			= 	$_GET['sendFromBank'];		// To Bank
	$pullBankId			=	$_GET['sendToBank'];		// To Bank
	$pullAccountNumber	=	$_GET['sendToAccount'];		// To Phone1
	
	
	
	// For API
	$phone1 = $_GET['phone1'];
	$phone2 = $_GET['phone2'];
	// For API

	// START DEBIT AND CREDIT
	$sqlRemoveAmount= $con->query("INSERT INTO `transactions` 
	(operation, `amount`, `forGroupId`, `3rdparty`, `bankCode`, `actorName`, `status`, `accountNumber`)
	VALUES 
	('DEBIT', '$amount', '$forGroupId', 'TORQUE', '$pushBankId', '$pushName', 'CALLED', '$pushAccountNumber'),
	('CREDIT', '$amount', '$forGroupId', 'TORQUE', '$pullBankId', '$pullName', 'CALLED', '$pullAccountNumber')
	") or mysqli_error();
	$sqlRemovedId= $con->query("select id from transactions order by id desc limit 1");
	$remId = mysqli_fetch_array($sqlRemovedId);
	$pullTransactionId = $remId['id'];
	$pushTransactionId = $pullTransactionId - 1;
	
	//Get the bank name
	$sqlNotifyBank = $con->query("SELECT name FROM banks WHERE id = '$pushBankId'");
	$rowNotifyBank = mysqli_fetch_array($sqlNotifyBank);
	$notifyBank = $rowNotifyBank['name'];
	
	
	//Notify the user about the action
	$sqlNotify = $db->query("SELECT groupName FROM groups WHERE id = '$forGroupId'");
	$rowNotify = mysqli_fetch_array($sqlNotify);
	$notifyTitle = $rowNotify['groupName'];
	
	// STRAT API HERE //////////////////////////
			
	$url = 'https://lightapi.torque.co.rw/requestpayment/';
	
	$data = array();
	$data["agentName"] = "UPLUS";
	$data["agentId"] = "0784848236";
	$data["phone"] = $phone1;
    $data["phone2"] = $phone2;
	$data["amount"] = $amount;
	$data["policyNumber"] = ''.$pullName.' / '.$pushName.'';
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
		$Update1= $con->query("UPDATE `transactions` SET status='NETWORK ERROR' WHERE id = '$pushTransactionId'");
		$Update2= $con->query("UPDATE `transactions` SET status='NETWORK ERROR' WHERE id = '$pullTransactionId'");
		
		echo 'Sorry! We had some network problem connecting to '.$notifyBank.'.<br>
		Please try again.';	
	}
	else
	{
		$server_output = $result;
	
		// FROM JSON TO PHP
		$firstcheck 	= json_decode($server_output);
		$agentName 		= $firstcheck->{'agentName'};
		$balance 		= $firstcheck->{'balance'};
		$check1 		= $firstcheck->{'information'};
		$check2 		= $firstcheck->{'information2'};
		$transactionId1 = $firstcheck->{'transactionId'};
		
		// PUT THE RESPONSE IN SESSION SO THAT I CAN CALL IT'S STATUS
		session_start();
		$_SESSION["notifyBank"] 		= $notifyBank;
		$_SESSION["server_output"] 		= $server_output;
		$_SESSION["forGroupId"]			= $forGroupId;
		$_SESSION["pushTransactionId"] 	= $pushTransactionId;
		$_SESSION["pullTransactionId"] 	= $pullTransactionId;

		if($check1 == 'You sent invalid amounts. Error: 404.')
		{
			$Update1= $con->query("UPDATE `transactions` SET status='BALANCE', 3rdpartyId='$transactionId1' WHERE id = '$pushTransactionId'");
			$Update2= $con->query("UPDATE `transactions` SET status='BALANCE', 3rdpartyId='$transactionId1', actorName ='$balance' WHERE id = '$pullTransactionId'");
			
			echo 'Your company balance in the pull account is: '.$balance;
		}
		else
		{
			$Update1= $con->query("UPDATE `transactions` SET status='$check1', 3rdpartyId='$transactionId1' WHERE id = '$pushTransactionId'");
			$Update2= $con->query("UPDATE `transactions` SET status='$check2', 3rdpartyId='$transactionId1' WHERE id = '$pullTransactionId'");
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
	session_start();
	$server_output = $_SESSION["server_output"];
	$forGroupId			= $_SESSION["forGroupId"];
    $pushTransactionId 	= $_SESSION["pushTransactionId"];
	$pullTransactionId 	= $_SESSION["pullTransactionId"];
	$notifyBank			=	$_SESSION["notifyBank"];

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
	$agentName 	= $obj->{'agentName'};
	$info1 	= $obj->{'information'};
	$info2 	= $obj->{'information2'};
	$amount	= $obj->{'amount'};
	$phone	= $obj->{'phone'};
	$phone2	= $obj->{'phone2'};
	$tosendtransid	= $obj->{'transactionId'};
	$Update1= $con->query("UPDATE `transactions` SET status='$info1' WHERE id = '$pushTransactionId'");
	$Update2= $con->query("UPDATE `transactions` SET status='$info2' WHERE id = '$pullTransactionId'");
	
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
			?>
			
			Please approve a request on your Phone</br>
		
		<script>
			if(k<2){
			var i = 100;

			var counterBack = setInterval(function(){
			  i--;
			  if (i > 0){
				$('.progress-bar2').css('width', i+'%');
			  } else {
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
		</script>
			<?php
		}
	elseif($info1 == 'DECLINED')
	{
?>
		<script>
		var k=10;
		console.log('user canceled the request');
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
		$message    = $tosendsms.', transaction id: '.$tosendtransid;// Specify your AfricasTalking shortCode or sender id
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
			Opps! You don't have <?php echo number_format($amount);?> Rwf 
			on your phone (0<?php echo $phone;?>)
			<br>Try again if you think you made a mistake<br>
			 
	<?php 
	}
}
?></b>
</h5>
</div>

<?php // BK VISA AND MASTER CARDS TRANSFERS
if(isset($_POST['bkVisa'])){
	
	$forGroupId			= 	$_POST['forGroupId'];		// COmpanyID
	$amount				= 	$_POST['sentAmount'];		// Amount
	$pushAccountNumber 	= 	$_POST['sendFromAccount'];	// From account
	$pushName			= 	$_POST['sendFromName'];		// From Name
	$pullName			= 	$_POST['sendToName'];		// From Name
	$pushBankId			= 	$_POST['sendFromBank'];		// To Bank
	$pullBankId			=	$_POST['sendToBank'];		// To Bank
	$pullAccountNumber	=	$_POST['sendToAccount'];	// To Phone1
	$pushEmail			=	$_POST['senderEmail'];		// FROM email
	$pullEmail			=	$_POST['receiverEmail'];	// To email 
	$pushContacts		=	$_POST['contactPhone'];		// From ContactPhone
	$pushPrivate		=	$_POST['senderPrivacy'];		// From privacy
	

	// START DEBIT AND CREDIT
	$sqlRemoveAmount= $con->query("INSERT INTO `transactions` 
	(operation, `amount`, `forGroupId`, `3rdparty`, `bankCode`, `actorName`, `status`, `accountNumber`, email, contacts, privateor)
	VALUES 
	('DEBIT', '$amount', '$forGroupId', 'BK', '$pushBankId', '$pushName', 'CALLED', '$pushAccountNumber', '$pushEmail', '$pushContacts', '$pushPrivate'),
	('CREDIT', '$amount', '$forGroupId', 'TORQUE', '$pullBankId', '$pullName', 'CALLED', '$pullAccountNumber', '$pullEmail', '', '')
	") or mysqli_error();
	$sqlRemovedId= $con->query("select id from transactions order by id desc limit 1");
	$remId = mysqli_fetch_array($sqlRemovedId);
	$pullTransactionId = $remId['id'];
	$pushTransactionId = $pullTransactionId - 1;
	
	require __DIR__ . '/function.php';
	//$amount = $_POST['sentAmount'];
	$currency = 'RWF';//$_POST['currency'];
	$orderInfo = $pushTransactionId;
	session_start();
	$_SESSION['pushTransactionId'] = $pushTransactionId;
	$_SESSION['pullTransactionId'] = $pullTransactionId;
	$_SESSION['phone2'] = $pullAccountNumber;
	$_SESSION['amount'] = $amount;
	
	$accountData = array(
		'merchant_id' => 'TESTBOK000009',
		'access_code' => '325B081C',
		'secret'      => 'D566F4162F2D922E0B882BB551E11F7D'
	);
	if($currency=="RWF"){
		// $_PDT['vpc_Currency']=646;
		$mult = 1;
	}elseif($currency=="USD"){
		// $_PDT['vpc_Currency']=840;
		$mult = 100;
	}
	$queryData = array(
		'vpc_AccessCode' => $accountData['access_code'],
		'vpc_Merchant' => $accountData['merchant_id'],

		'vpc_Amount' => ($amount * $mult), // Multiplying by 100 to convert to the smallest unit
		'vpc_OrderInfo' => $orderInfo,

		'vpc_MerchTxnRef' => generateMerchTxnRef(), // See functions.php file

		'vpc_Command' => 'pay',
		'vpc_Currency' => $currency,
		'vpc_Locale' => 'en',
		'vpc_Version' => 1,
		'vpc_ReturnURL' => 'http://localhost/uplusProd/3rdparty/rtgs/return_url.php',

		'vpc_SecureHashType' => 'SHA256'
	);

	// Add secure secret after hashing
	$queryData['vpc_SecureHash'] = generateSecureHash($accountData['secret'], $queryData); // See functions.php file

	// 
	$migsUrl = 'https://migs.mastercard.com.au/vpcpay?'.http_build_query($queryData);

	// Redirect to the bank website to continue the 
	header("Location: " . $migsUrl);
}
?>


