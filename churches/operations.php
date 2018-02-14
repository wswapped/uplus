<?php // GLOBAL
include("db.php");
?>

<?PHP
if(isset($_POST['membername'])){

	$name = $_POST['membername'];
	$phone = $_POST['memberphone'];
	$email = $_POST['memberemail'];
	$location = $_POST['memberlocation'];
	$address = $_POST['memberaddress'];
	$type = $_POST['membertype'];
	
	$sqlAddMember = $db->query("
		INSERT INTO members(name, phone, email, branchid, address, type, createdDate)
		VALUES('$name', '$phone', '$email', '$location', '$address', '$type', now())
	");
	header("location: allmembers.php");
	exit();
}
if(isset($_GET['go'])){
	header("location: allmembers.php");
	exit();
}
?>