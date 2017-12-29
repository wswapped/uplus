<?php
require_once("dbconnect.php");
$phone = $_POST['phone_client'];
$event = $_POST['event'];
$property = $_POST['property'];
$userid = $_POST['user_id'];

$selectprice = mysql_query("SELECT price  FROM pricing WHERE pricing_id LIKE '$property'");
$fetchrow = mysql_fetch_assoc($selectprice);
$price = $fetchrow['price'];

mysql_query("INSERT INTO transaction (customer_pay_id, cust_event_choose, cust_pay_phone, amount, cust_event_seats,user_id) VALUES('','$event','$phone','$price','$property','$userid')") or die("error please in inserting".mysql_error());
?>