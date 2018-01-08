<?php
include 'db.php';
$sql = $outCon->query("SELECT status,amount,pushnumber,pullnumber,myid,type, transactiontime FROM intouchapi ORDER BY id DESC");
$n= 0;
	
	echo'<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered table-responsive" style="float: left;">
	<thead>
		<tr>
			<th>#</th>
			<th>Amount</th>
			<th>From</th>
			<th>To</th>
			<th>Status</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>';
while ($row = mysqli_fetch_array($sql)) {
	$pullnumber = $row['pullnumber'];
	$pushnumber = $row['pushnumber'];
	$myId = $row['myid'];
	if($row['type'] == "grouptransaction")
	{
		$pullnumber = "group";
		$sqlStatus = $outCon->query("SELECT status FROM grouptransactions WHERE id = '$myId'");
		$status = mysqli_fetch_array($sqlStatus)['status'];
		$sqlPull = $db->query("SELECT GR.groupName FROM uplus.groups GR INNER JOIN rtgs.grouptransactions GT ON GT.groupId = GR.id WHERE GT.id= '$myId' LIMIT 1");
		$pullName = mysqli_fetch_array($sqlPull)['groupName'];
		$sqlPush = $outCon->query("SELECT GR.name FROM uplus.users GR INNER JOIN rtgs.grouptransactions GT ON GT.memberId = GR.id WHERE GT.id= '$myId' LIMIT 1");
		$pushName = mysqli_fetch_array($sqlPush)['name'].'<em>('.$pushnumber.')</em>';
	}
	else
	{
		$sqlStatus = $outCon->query("SELECT status FROM directtransfers WHERE id = '$myId'");
		$status = mysqli_fetch_array($sqlStatus)['status'];
		$sqlPull = $outCon->query("SELECT actorName FROM directtransfers WHERE id = '$myId'+1");
		$pullName = mysqli_fetch_array($sqlPull)['actorName'].'<em>('.$pullnumber.')</em>';
		$sqlPush = $outCon->query("SELECT actorName FROM directtransfers WHERE id = '$myId'");
		$pushName = mysqli_fetch_array($sqlPush)['actorName'].'<em>('.$pushnumber.')</em>';
	}
		
	if ($status=='Pending') {
		$hstatus='<th style="background: #fbbc03;">'.$row['status'].'</th>';
	}elseif ($status=='Successfull') {
		$hstatus='<th style="background: #36a753;">'.$row['status'].'</th>';
	}elseif ($status=='Failed') {
		$hstatus='<th style="background: #eb4435;">'.$row['status'].'</th>';
	}else{
		$hstatus='<th style="background: #000; color: #fff";>Low Bal</th>';
	}

	$n++;
	$transactionDate 	= strftime("%d, %b%y", strtotime($row["transactiontime"]));
		echo'<tr>
			<th>'.$n.'</th>
			<th>'.number_format($row['amount']).'</th>
			<th>'.$pushName.'</th>
			<th>'.$pullName.'</th>
			'.$hstatus.'
			<th>'.$transactionDate.'</th>
		</tr>';
}
echo'
	</tbody>
</table>
</div>';
?>


	