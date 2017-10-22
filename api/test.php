<?php 
transactions();
function transactions()
{
	require('db.php');
	$userId	= 1;
	$sql 	= $outCon->query("SELECT id, amount, status FROM `directtransfers` WHERE (`id` % 2) = 1 AND `userId` = '$userId' ORDER BY id DESC");
	
	$returnedinformation   = array();   
	while ($row = mysqli_fetch_array($sql))
	{
		$pushId 	= $row['id'];
		$pullId 	= $pushId + 1;
		$amount 	= $row['amount'];
		$status 	= $row['status'];
		$sql2 		= $outCon->query("SELECT accountNumber, actorName, transaction_date FROM `directtransfers` WHERE `id` = '$pullId' LIMIT 1");
		$row2 		= mysqli_fetch_array($sql2);
		$pullName 	= $row2['actorName'];
		$pullPhone 	= $row2['accountNumber'];
		$transactionDate 	= strftime("%b, %d", strtotime($row2["transaction_date"]));

		// GET THE USER TRANSATIONS
		
		$returnedinformation[] = array(
				"amount" 	=> $amount,
		        "pullName" 	=> $pullName,
		        "phone" 	=> $pullPhone,
		        "status"	=> $status,
		        "transactionDate"	=> $transactionDate
		    );
		
	}
	
	header('Content-Type: application/json');
	$returnedinformation = json_encode($returnedinformation);
	echo $returnedinformation;
	}

	?>
