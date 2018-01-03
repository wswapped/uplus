<?php 
include 'db.php';
if (isset($_GET['contributions'])) 
{
	$sql = $outCon->query("SELECT id FROM grouptransactions WHERE status = 'Pending'") or die(mysql_error($outCon));
	echo"<ul>";
	$n=0;
	while($peniding = mysqli_fetch_array($sql))
	{
		$n++;
		$tobeup = $peniding['id'];
		$url = 'https://uplus.rw/api/';
						
		$data = array();
		
		$data["action"] 				= "checkcontributionstatus";
		$data["transactionId"] 			= $tobeup;

	    $options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result == false) 
		{ 
			echo 'There was a system error, of:'.$tobeup;
		}
		else
		{
			$result = json_decode($result);	
			$status = $result[0]->{'status'};
			$transactionId = $result[0]->{'transactionId'};
			echo "<li>".$n." ".$status." of: ".$transactionId."</li>";		
		}
	}
	echo "</ul>";
}
elseif (isset($_GET['directtransfers'])) 
{
	$sql = $outCon->query("SELECT id FROM directtransfers WHERE status = 'Pending'") or die(mysql_error($outCon));
	echo"<ul>";
	$n=0;
	while($peniding = mysqli_fetch_array($sql))
	{
		$n++;
		$tobeup = $peniding['id'];
		$url = 'https://uplus.rw/api/';
						
		$data = array();
		
		$data["action"] 				= "checktransferstatus";
		$data["transactionId"] 			= $tobeup;

	    $options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result == false) 
		{ 
			echo 'There was a system error, of:'.$tobeup;
		}
		else
		{
			$result = json_decode($result);	
			$status = $result[0]->{'status'};
			$transactionId = $result[0]->{'transactionId'};
			echo "<li>".$n." ".$status." of: ".$transactionId."</li>";			
		}
	}
	echo "</ul>";
}
elseif (isset($_GET['voteResults']) && isset($_GET['groupId']) && isset($_GET['condition']))
{
	$groupId 	= $_GET['groupId'];
	$condition 	= $_GET['condition'];
	$voters 	= (mysqli_num_rows($db->query("SELECT createdBy FROM treasurervotes WHERE groupId = '$groupId'")))/3;
	$members 	= mysqli_num_rows($db->query("SELECT memberId FROM members WHERE groupId = '$groupId'"));
	$comparesion= round((100 * $voters)/$members); //(100 * $voters)/($members * 3);
	if($comparesion > $condition)
	{
		$sql = $db->query("SELECT count(votedId) votes, votedId FROM treasurervotes WHERE groupId = '$groupId' GROUP BY votedId ORDER BY count(votedId) DESC LIMIT 3"); 
		while($row = mysqli_fetch_array($sql))
		{
			$votedId = $row['votedId'];
			if($db-query("UPDATE groupuser SET memberType = 'Group treasurer' WHERE userId = '$votedId' AND groupId = '$groupId'"))
			{
				echo $row['votes']." of ".$row['votedId'].".<br/>";
			}
		}
	}
	elseif($condition==30||$condition==50)
	{
		// NOTIFY ALL MEMBERS PENDING TO VOTE THAT THEY HAVE TO VOTE
		$sql5 = $db->query("SELECT memberPhone, groupName FROM members WHERE groupId = '$groupId'") or die(mysqli_error());
		$recipients = "";
		while($member = mysqli_fetch_array($sql5))
		{
			$recipients.= $member['memberPhone'].", ";
			$groupName 	= $member['groupName'];
		}

		//CLEAN CONTACTS
		$recipients		= rtrim($recipients,", ");
		$message    = 'Hello!, Member of '.$groupName.'. Please vote for your group treasurers. Chose 3 members in the group you trust, who can manage your group money wisely, You can even chose yourself.';
		$data = array(
		 		"sender"		=>"UPLUS",
		 		"recipients"	=>$recipients,
		 		"message"		=>$message,
		 	);
	 	include 'sms.php';
	 	if($httpcode == 200){}
	}
}
elseif (isset($_GET['status']))
{
	$sql 			= $outCon->query("SELECT sum(amount) todaybalance FROM directtransfers WHERE (`id` % 2) = 1 AND transaction_date > DATE_SUB(NOW(), INTERVAL 1 DAY)");
	$sql2			= $outCon->query("SELECT count(id) todaytransactions FROM directtransfers WHERE (`id` % 2) = 1 AND transaction_date > DATE_SUB(NOW(), INTERVAL 1 DAY)");
	$balancerow 	= mysqli_fetch_array($sql);
	$balancerow2 	= mysqli_fetch_array($sql2);
	$balance 		= $balancerow['todaybalance'];
	$transactions 	= $balancerow2['todaytransactions'];
	$phone 			= '0784848236';
	$sender 		= "UPLUS CLOUD";
	$message 		= 'Hello Uplus manager, Today we had '.number_format($balance).' Rwf through UPLUS, from '.number_format($transactions).' transactions. For more info vist https://uplus.rw/monitor/';

	$recipients 	= $phone;
	$data 			= array(
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