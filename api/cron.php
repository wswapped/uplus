<?php
if(isset($_GET['action']))
{
	$_GET['action']();
}

function status(){
	include 'db.php';
	$sql= $outCon->query("SELECT sum(amount) todaybalance FROM directtransfers WHERE transaction_date > DATE_SUB(NOW(), INTERVAL 1 DAY)");
	$sql2= $outCon->query("SELECT count(id) todaytransactions FROM directtransfers WHERE transaction_date > DATE_SUB(NOW(), INTERVAL 1 DAY)");
	$balancerow = mysqli_fetch_array($sql);
	$balancerow2 = mysqli_fetch_array($sql2);
	$balance 		= $balancerow['todaybalance'];
	$transactions 	= $balancerow2['todaytransactions'];
	$phone 		= '0784848236';
	$sender 	= "UPLUS SERVER";
	$message 	= 'Hello Uplus manager, Today we had '.$balance.' Rwf through UPLUS, from '.$transactions .' transactions.';
		

	//CLEAN PHONE
	$phone 	= preg_replace( '/[^0-9]/', '', $phone );
	$phone 	= substr($phone, -10); 

	$recipients = '+25'.$phone;
	//$message    = 'Welcome to UPLUS, please use '.$code.' to log into your account.';
	$data = array(
		"sender"		=>$sender,
		"recipients"	=>$recipients,
		"message"		=>$message,
	);
	include 'sms.php';
	if($httpcode == 200)
	{
		echo "yes";
	}
	else
	{
		echo 'System error';
	}
}
?>