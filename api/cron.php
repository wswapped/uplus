<?php
$phone 		= 0784848236;
$sender 	= "CRONNER";
$message 	= "The cron is just launched";
	

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
	
	header('Content-Type: application/json');
	$signInfo = json_encode($signInfo);
	echo '['.$signInfo.']';
}
else
{
	echo 'System error';
}
?>