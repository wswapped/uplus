<?php
require_once("dbconnect.php");
$phone = $_POST['phone_client'];
$event = $_POST['event'];
$property = $_POST['property'];
$userid = $_POST['user_id'];

$selectprice = $eventDb->query("SELECT price  FROM pricing WHERE pricing_id LIKE '$property'");
$fetchrow = mysqli_fetch_assoc($selectprice);
$price = $fetchrow['price'];

$eventDb->query("INSERT INTO transaction (customer_pay_id, cust_event_choose, cust_pay_phone, amount, cust_event_seats,user_id, createdBy, paidStatus, status) 
	VALUES('','$event','$phone','$price','$property','$userid','$userid', 'PAID', 'UNUSED')") or die("error please in inserting".mysqli_error());

if($eventDb)
{
	$ticketId 	=mysqli_insert_id($eventDb);
}

$time = time();
$code = rand(1,1000);
$passive = $time."".$code;
$str = md5($passive);
function String2Stars($string='',$first=0,$last=0,$rep=''){
  $begin  = substr($string,0,$first);
  $stars  = $begin;
  return $stars;
}
$str2 = String2Stars($str, 4, -4);
$ticketCode = $ticketId."".$str2;
$eventDb->query("UPDATE transaction SET ticketCode = '$ticketCode' WHERE customer_pay_id = '$ticketId'") or die("error please in inserting".mysqli_error());

?>