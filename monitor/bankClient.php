<?php // Get me backif i havent logedin
session_start();
	if (!isset($_SESSION["email"])) {
		header("location: logout.php"); 
    exit();
}
?>
<?php 
		
$account_type = preg_replace('#[^0-9]#i', '', $_SESSION["account_type"]); // filter everything but numbers and letters
 $password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
 $email = $_SESSION["email"]; // filter everything but numbers and letters
include "db.php"; 
$sql = $con->query("SELECT * FROM `users` WHERE `email` = '$email' and `pwd` = '$password' LIMIT 1")or die ($db->error);
$existCount = mysqli_num_rows($sql); // count the row nums
if ($existCount > 0) 
{ 
	while($row = mysqli_fetch_array($sql))
	{ 
		$thisid = $row["id"];
		$name = $row["name"];
		$level = $row["level"];
	}
}
else
{
echo "

<br/><br/><br/><h3>Your account has been temporally deactivated</h3>
<p>Please contact: <br/><em>(+25) 078 484-8236</em><br/><b>muhirwaclement@gmail.com</b></p>		
Or<p><a href='logout.php'>Click Here to login again</a></p>

";
exit();
}
?>

<?php
include 'db.php';
if (isset($_GET['accountNumber']) && isset($_GET['page']) && isset($_GET['ClientName'])) {
	$ClientName = $_GET['ClientName'];
	$accountNumber = $_GET['accountNumber'];
	$page = $_GET['page'];
	$sqlgetbank= $con->query("SELECT * FROM banks WHERE id ='$page'");
	$countBanks = mysqli_num_rows($sqlgetbank);
	$fetchname = mysqli_fetch_array($sqlgetbank);
	$bankName = $fetchname['name'];
	$bankcolor = $fetchname['bankcolor'];
	$transactions="";
	$pushSql =$con->query("SELECT * FROM transactionsview WHERE operation = 'DEBIT' AND status <> 'BALANCE' AND bankCode = '$page' AND accountNumber='$accountNumber' AND actorName='$ClientName'");
$n=0;
while ($row=mysqli_fetch_array($pushSql)) 
{
	$pushTransactionId 	= $row['transactionId'];
	$amount				= $row['amount'];
	$forGroupId 		= $row['forGroupId'];
	$push3rdparty 		= $row['3rdparty'];
	$push3rdpartyId 	= $row['3rdpartyId'];
	$pushBank 			= $row['bankName'];
	$pushBankId 		= $row['bankCode'];
	$transaction_date 	= $row['transaction_date'];
	$pushName 			= $row['actorName'];
	$pushStatus 		= $row['status'];
	$pushAccountNumber	= $row['accountNumber'];
	$n++;
	$pullTransactionId = $pushTransactionId + 1;
	$pullSql =$con->query("SELECT * FROM transactionsview WHERE transactionId = '$pullTransactionId'");
	while($pullRow=mysqli_fetch_array($pullSql))
	{
		$pullStatus 		= $pullRow['status'];
		$pull3rdpartyId 	= $pullRow['3rdpartyId'];
		$pull3rdparty 		= $pullRow['3rdparty'];
		$pullName 			= $pullRow['actorName'];
		$pullBank	 		= $pullRow['bankName'];
		$pullBankId 		= $row['bankCode'];
		$pullAccountNumber	= $row['accountNumber'];
	}
	if($pushStatus=='TARGET_AUTHORIZATION_ERROR'){
		$pushStatus='NO MONEY';
	}
	if($pushStatus=='NETWORK ERROR'){
		$pushStatus='NET?';
	}
	if($pullStatus=='NETWORK ERROR'){
		$pullStatus='NET?';
	}
	if($pushStatus=='Approved' || $pushStatus=='APPROVED'){
		$bg="#4caf50";
	}
	elseif($pushStatus=='DECLINED' || $pushStatus=='Declined' || $pushStatus=='NO MONEY' || $pushStatus=='NET?'){
		$bg="#f44336";
	}
	else{
		$bg="#000";
	}
	if($pullStatus=='COMPLETE'){
		$bg2="#4caf50";
	}
	elseif($pullStatus=='DECLINED' || $pullStatus=='Error sending money.' || $pullStatus=='NET?'){
		$bg2="#f44336";
	}
	else{
		$bg2="#000";
	}
	$link1="'account.php?accountId=".$pushAccountNumber."&clientId=".$pushName."&page=".$pushBankId."'";
	$link2="'account.php?accountId=".$pullAccountNumber."&clientId=".$pullName."&page=".$pullBankId."'";
	$transactions.= '
		<tbody>
			<tr>
				<td>'.$n.'</td>
				<td>'.number_format($amount).'</td>
				<td>'.$pushStatus.' / '.$pullStatus.'</td>
				<td>'.$push3rdpartyId.' / '.$pull3rdpartyId.'</td>
				<td>'.strftime("%d %b", strtotime($row['transaction_date'])).'</td>
				<td style="background: '.$bg.'; cursor: pointer; color: #fff" onclick="location.href = '.$link1.'">'.$pushName.' | '.$pushBank.'</td>
				<td style="background: '.$bg2.'; cursor: pointer; color: #fff" onclick="location.href = '.$link2.'">'.$pullName.'| '.$pullBank.'</td>
			</tr>
		</tbody>';
		}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $bankName;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
      <span class="icon-bar"></span> 
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
      <a class="navbar-brand" href="../">RTGS</a>
    </div>
  <div class="collapse navbar-collapse" id="menu">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="banks.php">Banks</a></li>
      <li ><a href="bank.php?page=<?php echo $page;?>"><?php echo $bankName;?></a></li>
      <li ><a href="account.php?page=<?php echo $page;?>&accountNumber=<?php echo $accountNumber;?>"><?php echo $accountNumber;?></a></li>
      <li class="active"><a href="javascript:void()"><?php echo $ClientName;?></a></li>
    </ul>
    
	<ul class="nav navbar-nav navbar-right">
		<li class="active" style="padding: 5px;"><span style="float: left; padding-right: 10px; text-align: right;"><?php echo $name;?><br/><span style="font-size: 12px"><?php echo $level;?></span></span> <button onclick="window.location.href='logout.php'" class="btn btn-danger">Logout</button> <span class="sr-only">(current)</span></li>
    </ul>
    </div>
  </div>
</nav>
<div class="container">
	<?php
		if ($countBanks == 1) {
			echo '  <div style="    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    color: #fff; color: #fff; font-size: 20px; background-color: '.$bankcolor.'; height: 100px;">
						<img style="margin: 15px; border: solid 2px white; " src="img/'.$bankName.'.png" height="70" >
						&nbsp;&nbsp;&nbsp;('.$n.') transactions from '.$ClientName.' in '.$bankName.'
					</div>';
		}else{
			echo $countBanks.'You are trying to access a bank which does not exist';
		}
	}

	?><br>
  	<div class="jumbotron">
		<div class="row">
		<div class="col-xs-2">
		</div>
		<div class="col-xs-10">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered" style="float: left;">
					<thead>
						<tr>
							<th>#</th>
							<th>Amount</th>
							<th>Status</th>
							<th>3rdpartyId</th>
							<th>Date__</th>
							<th>From</th>
							<th>To</th>
						</tr>
					</thead>
					<?php
						echo $transactions;
					?>
				</table>
			</div>
		</div>
		</div>
  	</div>
  	<div class="footer">
  	</div>
</div>
</body>
</html>