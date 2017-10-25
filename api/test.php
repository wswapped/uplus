<?php
icnlude 'db.php';
$pullNumber = '0784848236';
$sql = $db->query("SELECT * FROM users WHERE phone = '$pullNumber' LIMIT 1");
$checkAvailb = mysqli_num_rows($sql);
if($checkAvailb > 0)
{
	//$row = mysqli_fetch_array($sql);
	//echo $pullName	= $row['name'];
	//echo $pullId	= $row['id'];
	//echo $token		= $row['token'];
	echo "here";
}else{
	echo "out";
}
?>
