<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_GET['receiptCode'])){
	$receiptCode = $_GET['receiptCode'];
	include('../db.php');
	$pushSql= $outCon->query("SELECT * FROM transactionsview WHERE transactionId ='$receiptCode'");
	$n=0;
	$checkExist= mysqli_num_rows($pushSql);
	if ($receiptCode % 2 == 0) {
		$exists = 0;
	}else
	{
		$exists = 1;
	}
	if($checkExist > 0 && $exists == 1)
{
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
	$pushEmail			= $row['email'];
	$pushPhone			= $row['contacts'];
	$pushMethod			= $row['cardType'];
	$invoiceNumber		= $row['invoiceNumber'];
	$n++;
	$pullTransactionId = $pushTransactionId + 1;
	$pullSql =$outCon->query("SELECT * FROM transactionsview WHERE transactionId = '$pullTransactionId'")or die (mysqli_error());
	while($pullRow=mysqli_fetch_array($pullSql))
	{
		$pullStatus 		= $pullRow['status'];
		$pull3rdpartyId 	= $pullRow['3rdpartyId'];
		$pull3rdparty 		= $pullRow['3rdparty'];
		$pullName 			= $pullRow['actorName'];
		$pullBank	 		= $pullRow['bankName'];
		$pullBankId 		= $pullRow['bankCode'];
		$pullAccountNumber	= $pullRow['accountNumber'];
		$pullEmail			= $pullRow['email'];
		$pullPhone			= $pullRow['contacts'];
		
		
	}
}

?>
<!doctype html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
	<link rel="stylesheet" href="../monitor/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/receipt.css">
  
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<script language="javascript" type="text/javascript">
	function printDiv(divID) {
		//Get the HTML of div
		var divElements = document.getElementById(divID).innerHTML;
		//Get the HTML of whole page
		var oldPage = document.body.innerHTML;

		//Reset the page's HTML with div's HTML only
		document.body.innerHTML = 
		  "<html><head><title></title></head><body>" + 
		  divElements + "</body>";
		//Print Page
		window.print();
		//Restore orignal HTML
		document.body.innerHTML = oldPage;
	}
</script>

</head>
<body>
	<section class="content content_content">
		<div class="invoice" id="printablediv">
			<div class="row titleRow ">
				<div class="col-xs-12 titleCol">
					<img src="../frontassets/img/logo_main_3.png" class="logo" onclick="javascript:location.href='i<?php echo $forGroupId;?>'">
					<br/>
					<span class="companyTytle">
						Uplus Mutual Partners Reciept
					</span>
                </div>
				<div class="col-xs-8 receiptFor">
							For: <?php 
								$sqlGp = $db->query("SELECT * FROM groups WHERE id = '$forGroupId'");
								$rowGp = mysqli_fetch_array($sqlGp);
								echo $rowGp['groupName'];
								?>
							</div>
				<div class="col-xs-4 receiptDate">
                    Date: <?php echo strftime("%d %b, %Y", strtotime($transaction_date));?>
                </div>
                <div class="col-xs-8 receiptAmount">
                   Amount: <?php echo number_format($amount);?> Rwf<br/>
				</div>
				<div class="col-xs-4 receiptStatus">	
									STATUS: <strong><?php echo $pushStatus;?></strong><br/>
                            
							
							</div>
			</div>
			<div class="row">
                <div class="col-xs-6 table-responsive">
					<div class="toFrom" style="padding: 15px;"><i class="fa fa-arrow-up"></i> From: <?php echo $pushName;?></div>
				
						<table class="table table-striped" style="font-size: 14px;">
							<tbody>
								<tr>
									<td>Phone</td>
									<td><em><?php echo $pushPhone;?></em></td>
								</tr>
								<tr>
									<td>Email</td>
									<td><em><?php echo $pushEmail;?></em></td>
								</tr>
								<tr>
									<td>Card Num</td>
									<td><?php echo $pushAccountNumber;?></td>
								</tr>
								<tr>
									<td>Using</td>
									<td><?php 
									if($pushMethod == 'VC'){
										echo 'VISA CARD';
									}
									elseif($pushMethod == 'MC'){
										echo 'MASTER CARD';
									}else{
										echo $pushMethod;
									}?></td>
								</tr>
							</tbody>
						</table>
					</div>
				<div class="col-xs-6 table-responsive">
					<div class="toFrom" style="border-left: 1px solid #a6d2ce; padding: 15px;"><i class="fa fa-arrow-down"></i> TO: <?php echo $pullName;?></div>
			
					<table class="table table-striped"  style="font-size: 14px;">
						<tbody>
							<tr>
								<td>Phone</td>
								<td><em><?php echo $pullPhone;?></em></td>
							</tr><tr>
								<td>Email</td>
								<td><em><?php echo $pullEmail;?></em></td>
							</tr>
							<tr>
								<td>ACC Num</td>
								<td><?php echo $pullAccountNumber;?></td>
							</tr>
							<tr>
								<td>Using</td>
								<td><?php echo $pullBank;?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<hr style="margin-top: unset; margin-bottom: 10px;"/>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="row">
						<div class="col-xs-9">
							Uplus Mutual Partners ltd<br/>
							Tax ref. / TIN: 106774687<br/> 
							RECEIPT NUMBER: <?php echo $invoiceNumber;?><br/>
						</div>
						<div class="col-xs-3">
							<img src="../frontassets/img/uplus.png" class="qr">
						</div>
					</div>
				</div>
				<!--
				<div class="col-xs-12 col-sm-6" style="height: 100px;">
					<div class="total">
						<table style="FONT-SIZE: 14px;color: #fff; background: #007569; height: 100%; width: 100%">
							<tbody>
								<tr>
									<td style="text-align: right;">VISA (2.5%):</td>
									<td style="text-align: right;"><?php
									 $VISA = $amount*2.5/100;
									 echo number_format(($VISA));
									?> RWF</td>
								</tr>
								<tr>
									<td style="text-align: right;">MTN (2%):</td>
									<td style="text-align: right;"><?php
									 $MTN = $amount*2/100;
									 echo number_format(($MTN));
									?> RWF</td>
								</tr>
								<tr>
									<td style="text-align: right;">UPLUS(0.5%):</td>
									<td style="text-align: right;"><?php
									 $U = $amount*0.5/100;
									 echo number_format(($U));
									?> RWF</td>
								</tr>
								<tr>
									<th style="text-align: right;">TOTAL RECEIVED (-5%):</th>
									<td style="text-align: right;"><?php
									echo number_format(($amount- ($VISA + $MTN + $U)));
									?> RWF</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				-->
			</div>
			<div class="row">
				<div class="col-xs-12" style="padding: 15px">
					<div style="color:#fff; padding:15px; width: 100%;height: 100px;background: #bbb;">
					<p><b>CONTACTS:</b><br/>For more info contact uplus mutual partners ltd on<br>
					Phone: +250784848236 <br>
					Email: support@uplus.rw</p>
					</div>
				</div>
			</div>
			<div class="row no-print" style="padding-bottom: 30px">
				<div class="col-xs-12">
					<button href="javascript:void()" class="btn btn-primary" onclick="javascript:printDiv('printablediv')"><i class="fa fa-print"></i> Print</button>
					<button onclick="javascript:location.href='i<?php echo $forGroupId;?>'" class="btn btn-success pull-right"><i class="fa fa-share"></i> Continue</button>
					<button class="btn btn- pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Save PDF</button>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
<?php
}else{
	echo "Sorry, This receipt never existed!";
}
}
?>