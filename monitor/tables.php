<?php
if (isset($_GET['table'])) 
{
	$_GET['table']();
}
function users()
{
	include "db.php";
	$sql = $db->query("SELECT * FROM users ORDER BY id DESC");
	$n= 0;
	$data = "";
	echo'<table class="table table-hover table-striped table-bordered" style="float: left;">
	<thead>
		<tr>
			<th>#</th>
			<th>Image</th>
			<th>UserName</th>
			<th>Phone</th>
			<th>JoinedDate</th>
			<th>Active</th>
		</tr>
	</thead>
	<tbody>';
	while($row = mysqli_fetch_array($sql))
	{
		$n++;
		if ($row['active'] == 1) {
			$active = 'YES';
			# code...
		}else{
			$active = 'NO';
		}
		echo'<tr>
			<th>'.$n.'</th>
			<th><div style="
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    background-image: url('.$row['userImage'].'");
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
	
"></div></th>
			<th>'.$row['name'].'</th>
			<th>'.$row['phone'].'</th>
			<th>'.$row['createdDate'].'</th>
			<th>'.$active.'</th>
		</tr>';
	}
	echo'
	</tbody>
</table>';
}

function groups()
{
	include "db.php";
	$sql = $db->query("SELECT * FROM groups ORDER BY id DESC");
	$n= 0;
	echo'<table class="table table-hover table-striped table-bordered" style="float: left;">
	<thead>
		<tr>
			<th>#</th>
			<th>Image</th>
			<th>GroupName</th>
			<th>AdminName</th>
			<th>Members</th>
			<th>TargetAmount</th>
			<th>CurrentAmount</th>
			<th>CreatedDate</th>
		</tr>
	</thead>
	<tbody>';
	while($row = mysqli_fetch_array($sql))
	{
		$n++;
		$groupId	= $row['id'];
		$sql2 		= $db->query("SELECT count(groupId) gpm FROM members WHERE groupId = '$groupId'");
		$rngm		= mysqli_fetch_array($sql2);
		$members 	= $rngm['gpm'];
		$sqlGroupBalance = $con->query("SELECT IFNULL((SELECT sum(t.amount) FROM rtgs.grouptransactions t WHERE ((t.status = 'Successfull' AND t.operation = 'DEBIT') AND (t.groupId = '$groupId'))),0) AS groupBalance FROM rtgs.groups g");
			$gBalanceRow 	= mysqli_fetch_array($sqlGroupBalance);
		echo'<tr>
			<th>'.$n.'</th>
			<th><div style="
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    background-image: url('.$row['groupImage'].'");
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
	
"></div></th>
			<th>'.$row['groupName'].'</th>
			<th>'.$row['adminName'].'</th>
			<th>'.$members.'</th>
			<th>'.number_format($row['targetAmount']).' Rwf</th>
			<th>'.number_format($gBalanceRow['groupBalance']).' Rwf</th>
			<th>'.$row['createdDate'].'</th>
		</tr>';
	}
	echo'
	</tbody>
</table>';
}


function transactions()
{
	include "db.php";
	$sql = $con->query("SELECT * FROM directtransfers WHERE (`id` % 2) = 1 ORDER BY id DESC");
	$n= 0;
	
	echo'<table class="table table-hover table-striped table-bordered" style="float: left;">
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
	while($row = mysqli_fetch_array($sql))
	{
		$n++;
		$id= $row['id'];
		$sql2 = $con->query("SELECT accountNumber, actorName FROM directtransfers WHERE id = '$id'+1");
		$row2 = mysqli_fetch_array($sql2);
		$status = $row['status'];
			if ($status=='Pending') {
				$hstatus='<th style="background: #fbbc03;">'.$row['status'].'</th>';
			}elseif ($status=='Successfull') {
				$hstatus='<th style="background: #36a753;">'.$row['status'].'</th>';
			}elseif ($status=='Failed') {
				$hstatus='<th style="background: #eb4435;">'.$row['status'].'</th>';
			}
			$transactionDate 	= strftime("%d, %b%y", strtotime($row["transaction_date"]));
		echo'<tr>
			<th>'.$n.'</th>
			<th>'.number_format($row['amount']).'</th>
			<th>'.$row['actorName'].' <em>('.$row['accountNumber'].')</em></th>
			<th>'.$row2['actorName'].' <em>('.$row2['accountNumber'].')</em></th>
			'.$hstatus.'
			<th>'.$transactionDate.'</th>
		</tr>';
	}
	echo'
	</tbody>
</table>';

}

function money()
{
	include "db.php";
	$sql = $db->query("SELECT * FROM users ORDER BY id DESC");
	$n= 0;
	$data = "";
	
}
?>