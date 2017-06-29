<?php ob_start(); session_start(); include('../../db.php');?>

<?php 
$firstDates = strftime("%d%m", strtotime("now"));
$secondDates = date('y');
$firstInvoice = $firstDates.''.$secondDates;

				
				
require __DIR__ . '/function.php';
$transaction['status'] = getInput('vpc_TxnResponseCode');
$transaction['key']    = getInput('vpc_TransactionNo');
$transaction['message'] = getInput('vpc_Message');
$transaction['currency'] = getInput('vpc_Currency');
$transaction['merchant'] = getInput('vpc_Merchant');
$transaction['amount'] = getInput('vpc_Amount');
$transaction['orderInfo'] = getInput('vpc_OrderInfo');
$transaction['pushMethod'] = getInput('vpc_Card');
$transaction['pushReceiptNo'] = getInput('vpc_ReceiptNo');
$transaction['cardNum'] = getInput('vpc_CardNum');

	$amount = $transaction['amount'];
	$pushMethod = $transaction['pushMethod'];
	$pushReceiptNo = $transaction['pushReceiptNo'];
	$transaction['currency'];
	$check1 = $transaction['message'];
	$cardNum = $transaction['cardNum'];
	$transaction['merchant'];
	$transactionId1 = $transaction['key'];
	$transaction['orderInfo'];
	$pushTransactionId	= $_SESSION['pushTransactionId'];
	$pullTransactionId	= $_SESSION['pullTransactionId'];
	$phone2				= '25'.$_SESSION['phone2'];
	$invoiceNumber = 'U'.$firstInvoice.'000'.$pushTransactionId;

	$Update1= $outCon->query("UPDATE transactions SET status='$check1', 3rdpartyId='$transactionId1', accountNumber='$cardNum', cardType ='$pushMethod', invoiceNumber='$invoiceNumber' WHERE id = '$pushTransactionId'")or Die(mysqli_error());

///////////////
	$pushSql= $outCon->query("SELECT * FROM transactionsview WHERE transactionId ='$pushTransactionId'");
	$n=0;

	while ($row=mysqli_fetch_array($pushSql)) 
	{
		$pushTransactionId 	= $row['transactionId'];
		$amount				= $row['amount'];
		$forGroupId 		= $row['forGroupId'];
		$push3rdparty 		= $row['3rdparty'];
		$push3rdpartyId 	= $row['3rdpartyId'];
		$pushBank 			= $row['bankName'];
		$pushBankId 		= $row['bankCode'];
		$transaction_date 	= $row['transaction_date'];
		$pushName 			= $row['actorName'];
		$pushStatus 		= $row['status'];
		$pushAccountNumber	= $row['accountNumber'];
		$pushEmail			= $row['email'];
		$n++;
		$pullTransactionId = $pushTransactionId + 1;
		$pullSql =$outCon->query("SELECT * FROM transactionsview WHERE transactionId = '$pullTransactionId'")or die (mysqli_error());
		while($pullRow=mysqli_fetch_array($pullSql))
		{
			$pullStatus 		= $pullRow['status'];
			$pull3rdpartyId 	= $pullRow['3rdpartyId'];
			$pull3rdparty 		= $pullRow['3rdparty'];
			$pullName 			= $pullRow['actorName'];
			$pullBank	 		= $pullRow['bankName'];
			$pullBankId 		= $pullRow['bankCode'];
			$pullAccountNumber	= $pullRow['accountNumber'];
			$pullEmail			= $pullRow['email'];
			
			
		}
	}

	$sqlGp = $db->query("SELECT * FROM groups WHERE id = '$forGroupId'");
	$rowGp = mysqli_fetch_array($sqlGp);
	echo $rowGp['groupName'];
	$to      = $pushEmail;
	$subject = 'UPLUS TRANSFER RECEIPT';
	$message = 'Hello! '.$pushName.', Your transfer of '.number_format($amount).' Rwf to '.$pullName.' for '.$rowGp['groupName'].'
Was '.$pushStatus.'.
Your tracking code is: U0617000'.$pushTransactionId.'.  
Your Receipt: https://www.uplus.rw/f/receipt'.$pushTransactionId.'';

	$headers = "From: Muhirwa From Uplus <business@uplus.rw>\r\n";
	$headers .= "Reply-To: business@uplus.rw\r\n";
	$headers .= "Return-Path: business@uplus.rw\r\n";
	$headers .= "BCC: muhirwaclement@gmail.com\r\n";

	
	
	mail($to, $subject, $message, $headers);
//////////////////////////////////	

	$to      = $pullEmail;
	$subject = 'UPLUS TRANSFER NOTIFICATION';
	$message = 'Hello! '.$pullName.', '.$pushName.' sent you '.number_format($amount).' Rwf for '.$rowGp['groupName'].'
And it was '.$pushStatus.'.
The tracking code is: '.$invoiceNumber.'.  
The Receipt: https://www.uplus.rw/f/receipt'.$pushTransactionId.'';

	$headers = "From: Muhirwa From Uplus <business@uplus.rw>\r\n";
	$headers .= "Reply-To: business@uplus.rw\r\n";
	$headers .= "Return-Path: business@uplus.rw\r\n";
	$headers .= "BCC: muhirwaclement@gmail.com\r\n";

	mail($to, $subject, $message, $headers);
//////////////////////////////////	
	
	
	
	header("location: ../../f/receipt".$pushTransactionId."");
	exit();
?>

