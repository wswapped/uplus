<?php
if (isset($_GET['tightbank'])) {
	$checkBank		= 	$_GET['tightbank'];
	$checkAccount 	= 	$_GET['tightbankaccount'];
	$clientname 	= 	$_GET['clientname'];
	include "db.php";
	
//START CHECK IF THE SENDER IS NOT NEW
	$sqlCheckExist = $con -> query("SELECT * FROM bank_accounts WHERE accountNumber ='$checkAccount' AND bankName ='$checkBank' limit 1");
	$countExistAccount = mysqli_num_rows($sqlCheckExist);
	if(!$countExistAccount > 0){
	// START INSERT THE ACCOUNT
		$sql = $con->query("insert into clients(name) values('$clientname')");
		$sqllaststu= $con->query("select id from clients order by id desc limit 1");
		$laststu_id=$row=mysqli_fetch_array($sqllaststu);
		$client_id=$row['id'];
		$sqlsklstu= $con->query("insert into bank_client(client_id, bank_id, accountNumber) 
		  values('$client_id','$checkBank','$checkAccount')")or mysqli_error();
	// END INSERT THE ACCOUNT
	echo'bank account created';
	}
  	else{
		echo'
		accountNumber: '.$checkBank.' <br/>
		bankName: '.$checkAccount.'<br/>
		Cleint: '.$clientname;
	}
}
?>