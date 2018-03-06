<?php
@ob_start();
session_start();
include("../db.php");
?>
<?php
if(isset($_GET['raiseBack'])){ 
$backgroupTargetType 	= mysqli_real_escape_string($db, $_GET['backgroupTargetType']);	
$backisTargetChanged 	= mysqli_real_escape_string($db, $_GET['backisTargetChanged']); 	
$backperPersonType	 	= mysqli_real_escape_string($db, $_GET['backperPersonType']); 	
$backisTargetPPChanged 	= mysqli_real_escape_string($db, $_GET['backisTargetPPChanged']);	
$backfundAmount 		= mysqli_real_escape_string($db, $_GET['backfundAmount']);		
$backamountPerPerson 	= mysqli_real_escape_string($db, $_GET['backamountPerPerson']);	
$backfundTag 			= mysqli_real_escape_string($db, $_GET['backfundTag']);

?>
<table  width="100%" cellpadding="100px">
	<tr>
		<td width="33.3%"><label>Choose a Reason: </label></td>
		<td width="33.3%">
		<select class="newinput" style="width: 100%;" id="fundTag" placeholder="for">
			<option><?php echo $backfundTag;?></option>
			<option>Wedding</option>
			<option>Party</option>
			<option>Event</option>
			<option>Funeral</option>
			<option>School Fees</option>
			<option>Picnic</option>
			<option>Bithday Surprise</option>
			<option>Other</option>
		</select>
		</td>
		<td></td>
	</tr>
	<tr>
		<td></td><td style="color: red" id="fundTagError"></td><td></td>
	</tr>
	<tr>
		<td width="33.3%">Target Amount</td>
		<td width="33.3%">
			<select class="newinput" style="width: 100%;"  id="targeted" onchange="changeTarget()">
				<option value="<?php echo $backgroupTargetType;?>"><?php echo $backgroupTargetType;?></option>
				<option value="target">Exactly</option>
				<option value="atleast">Atleast</option>
				<option value="any">Any Amount</option>
			</select>
		</td>
		<td width="33.3%" id="changeTargetd">
			<?php 
			if($backgroupTargetType =='any')
			{
				echo '<input hidden id="isTargetChanged" value="no">
				<input class="newinput" disabled style="width: 100%;" type="number" placeholder="Any"/>
				<input hidden id="raiseAmount" type="number" value="0"/>';
			}else{
			?><input id="isTargetChanged" hidden value="yes">
			<input class="newinput" class="newinput" id="raiseAmount" type="number" value="<?php echo $backfundAmount;?>" placeholder="0.00"/>
			<?php }?>
		</td>
	</tr>
	<tr>
		<td></td><td></td><td style="color: red" id="amountError"></td>
	</tr>
	<tr>
		<td width="33.3%">Amount per person</td>
		<td width="33.3%">
			<select  class="newinput"style="width: 100%;" id="perPerson" onchange="changeTargetPerPerson()">
				<option value="<?php echo $backperPersonType;?>"><?php echo $backperPersonType;?></option>
				<option value="target">Exactly</option>
				<option value="atleast">Atleast</option>
				<option value="any">Any Amount</option>
			</select>
		</td>
		<td width="33.3%" id="changePerPerson">
		<?php 
			if($backperPersonType =='any')
			{
				echo '<input hidden id="isTargetPPChanged" value="no">
			<input class="newinput" disabled style="width: 100%;" type="number" placeholder="Any"/>
			<input hidden id="amountPerPerson" type="number" value="0"/>';
			}else{
			?>
			<input id="isTargetPPChanged" hidden value="yes">
			<input class="newinput" id="amountPerPerson" value="<?php echo $backamountPerPerson;?>" style="width: 100%;" type="number" placeholder="0.00"/> 
			<?php }?>
		</td>
	</tr>
	<tr>
		<td></td><td></td><td style="color: red" id="amountPerPersonError"></td>
	</tr>
	<tr>
		<td></td><td id="amountError"></td>
	</tr>
</table>
<?php
}
?>
<?PHP // 1 START HOLD: FOR, AMOUNT RWF && PROMPT THE  PHONE AND DESC
	
if(isset($_GET['fundTag'])){ // HOLD THE DATA IN VARIABLE
	$groupName			= mysqli_real_escape_string($db, $_GET['fundTag']);
	$fundAmount 		= mysqli_real_escape_string($db, $_GET['fundAmount']);
	$amountPerPerson	= mysqli_real_escape_string($db, $_GET['amountPerPerson']);
?>
<input type="hidden" id="targetAmount" value="<?php echo $fundAmount;?>"/>
<input type="hidden" id="targetPerPerson" value="<?php echo $amountPerPerson;?>"/>

	<table border="0" style="width: 100%;">
		<tr>
			<td><?php echo $groupName;?> Title:<td>
			<td>Login <em>(admin)</em> Phone:</td>
		</tr>
		<tr>
			<td><input class="newinput" id="fundName" style="width: 100%;" /><td>
			<td><input class="newinput" id="fundPhone" style="width: 100%;"></td>
		</tr>
	</table>
	<hr style="margin-top: 10px;
    margin-bottom: 15px;" />
	<div style="text-align: center;">Collection Account:</div>
	<table border="0" style="width: 100%;">
		<tr>
			<td>Bank/ Telcom</td>
			<td>Account</td>
		</tr>
		<tr>
			<td>
				<select class="newinput" style="width: 100%;" id="fundBank">
					<option></option>
					<?php $sqlListBanks = $outCon->query("SELECT * FROM banks");
							while($rowBanks = mysqli_fetch_array($sqlListBanks))
							{
								echo'<option value="'.$rowBanks['id'].'">'.$rowBanks['name'].'</option>';
							}?>
				</select>
			</td>
			<td><input class="newinput" id="fundAccount" style="width: 100%;" ></td>
		</tr>
	</table>

<!-- START JAVASCRIPTS TO CHECK THE PHONE AND SEND DATA -->
<script>
function change (el) 
{
	var max_len = 9;
	var full_phone = 8;
	if (el.value.length > max_len) 
	{
		el.value = el.value.substr(0, max_len);
	}
	if (el.value.length > full_phone) 
	{
	var userphone	 = '0'+document.getElementById('raisePhone').value;
	var fundAmount	 = document.getElementById('fundAmount').value;
	var fundCurrency = document.getElementById('fundCurrency').value;
	//alert(userphone);
	$.ajax({
		type		:"GET",
		url			:"frontassets/indexscripts.php",
		datatype	:"html",
		data		:{
			Checkuserphone 	: userphone,
			fundAmount		: fundAmount,
			fundCurrency 	: fundCurrency,
		},
		success	:function(html, textStatus)
		{
			$('#returnName').html(html);
		},
		error: function(xht, textStatus, errorThrown)
		{
			alert("Error:"+ errorThrown);
		}
	});
	$.ajax({
		type		:"GET",
		url			:"frontassets/indexscripts.php",
		datatype	:"html",
		data		:{
			CheckuserphoneBtn 	: userphone,
		},
		success	:function(html, textStatus)
		{
			$('#doneBtn').html(html);
		},
		error: function(xht, textStatus, errorThrown)
		{
			alert("Error:"+ errorThrown);
		}
	});
	}
	//document.getElementById('raisePhone').innerHTML =
}
function changedesc (el) 
{
	var max_len = 102;
	if (el.value.length > max_len) 
	{
		el.value = el.value.substr(0, max_len);
	}
}
</script>
<!-- END JAVASCRIPTS TO CHECK THE PHONE AND SEND DATA -->  

<?php // 1 END HOLD FOR AMOUNT RWF && PROMPT THE  PHONE AND DESC
}
?>  

<?php // 4 SAVE FACEBOOK DATA
if(isset($_GET['savename']))
{
	$savename 	= mysqli_real_escape_string($db, $_GET['savename']);
	$rdpartyId  = mysqli_real_escape_string($db, $_GET['rdpartyId']);
	$rdparty 	= mysqli_real_escape_string($db, $_GET['rdparty']);
	$gender 	= mysqli_real_escape_string($db, $_GET['gender']);
	$picture 	= mysqli_real_escape_string($db, $_GET['picture']);
	
	$fundName	 = mysqli_real_escape_string($db, $_GET['fundName']);
	$fundAmount	 = mysqli_real_escape_string($db, $_GET['fundAmount']);
	$fundCurrency= mysqli_real_escape_string($db, $_GET['fundCurrency']);
	$fundPhone	 = mysqli_real_escape_string($db, $_GET['fundPhone']);
	$fundDesc	 = mysqli_real_escape_string($db, $_GET['fundDesc']);
	
	// Check if fb is new
	$sqlCheckFb = $db->query("SELECT * FROM users WHERE 3rdpartyId = '$rdpartyId' LIMIT 1");
	$countCheckFb = mysqli_num_rows($sqlCheckFb);
	if($countCheckFb > 0)
	{
		$rowUserFbs = mysqli_fetch_array($sqlCheckFb);
		$passworduser = $rowUserFbs['password'];
		$iduser = $rowUserFbs['id'];
		$lastvisit = $rowUserFbs['visits'];
		$phoneuser = $rowUserFbs['phone'];
			
			$_SESSION["id"] = $iduser;
			$_SESSION["phone1"] = $phoneuser;
			$_SESSION["password"] = $passworduser;
			$newvisit = $lastvisit + 1;
			$sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now() WHERE id = $iduser")or die (mysqli_error());
	}
	else
	{
		$sql = $db->query("INSERT INTO users
		(3rdparty, 3rdpartyId, gender, phone, active, createdDate, last_visit,
		name, password, visits)
		VALUES
		('$rdparty', '$rdpartyId', '$gender', '$fundPhone', '1', now(), now(),
		'$savename', '1234', '1')
		") or die (mysqli_error());
		//echo 'it was not in';
		$sqllastUser = $db->query("SELECT * FROM users ORDER BY id DESC limit 1");
		$rowUserLast = mysqli_fetch_array($sqllastUser);
			
		$phoneuser = $rowUserLast['phone'];
		$passworduser = $rowUserLast['password'];
		$iduser = $rowUserLast['id'];
		$lastvisit = $rowUserLast['visits'];
			 
		$_SESSION["id"] = $iduser;
		$_SESSION["phone1"] = $phoneuser;
		$_SESSION["password"] = $passworduser;
		$newvisit = $lastvisit + 1;
		$sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now(), active =1 WHERE id = $iduser")or die (mysqli_error());
		
		$contents	= file_get_contents($picture);
		$save_path="../proimg/".$iduser.".jpg";
		file_put_contents($save_path,$contents);
	}
	
// CREAT THE GROUP

	$adminId 	= $iduser;
	$groupName 	= $fundName;
	$adminName 	= $savename;
	$adminPhone = $phoneuser;
	$groupDesc	= $fundDesc;
	$targetAmount = $fundAmount;
	
	
	// 1 add the account with the phone
		$sql = $db->query("INSERT INTO groups
		(groupName, adminId, adminName, adminPhone, 
		groupDesc, targetAmount, createdDate,state, createdBy)
		VALUES
		('$groupName', '$adminId', '$adminName', '$adminPhone', 
		'$groupDesc','$targetAmount',now(), 'private', '$adminId')
		") or die (mysqli_error());
		
		// 2 GRAB ACCONT ID
		$sqlid = $db->query("SELECT id FROM groups ORDER BY id DESC LIMIT 1") or die (mysqli_error());
		$rowid = mysqli_fetch_array($sqlid);
		$lastid = $rowid['id'];
		
		$defaltSMS = 'Hi! '.$adminName.' is raising '.number_format($targetAmount).' Rwf for '.$groupName.'. To contribute visit this link https://www.uplus.rw/f/i'.$lastid.' , for more info call '.$adminName.' on '.$adminPhone.'';
		$insertSMS = $db->query("UPDATE groups SET invitationSms = '$defaltSMS' WHERE id = '$lastid'")or die (mysqli_error());

		// 3 ADD A WITHDRAW ACCOUNT 3//////////////////////////////////////////////3
		$conectGroupBank = $outCon->query("
		INSERT INTO `groups`(`groupId`, `accountNumber`, `bankId`) 
		VALUES ('$lastid', '$adminPhone', '1')")or die (mysqli_error());
		//3 END ADD A WITHDRAW ACCOUNT 3///////////////////////////////////////////////////
		
		$sqljoin = $db->query("INSERT INTO groupuser
		(`joined`, `groupId`, `userId`,`createdBy`, `createdDate` )
		VALUES
		('yes', '$lastid', '$adminId', '$adminName', now())")or die (mysqli_error());
		
	
	echo '<div style="text-align: center; color: #fff; font-size:18px;">
			Thanks '.$adminName.', Your contribution {'.$groupName.'} is now created.<br/>
			<a style="color: #7cb342;" href="editCont'.$lastid.'">Click here</a>..
		<div>';
	//header('location: ../editCont'.$lastFundId.'');*/
}
?>

<?php // 5 IF CHOSEN TO USE PHONE SEND PIN
if(isset($_GET['getPin']))
{
	$fundPhone	 = mysqli_real_escape_string($db, $_GET['fundPhone']);
	$sqlcheckPin = $db->query("SELECT password FROM users WHERE phone = '$fundPhone' LIMIT 1");
	$countPin = mysqli_num_rows($sqlcheckPin);
	if($countPin > 0)
	{
		//echo 'the pin was in there';
		$rowpin = mysqli_fetch_array($sqlcheckPin);
		 $code = $rowpin['password'];
	}else
	{
		//echo 'dint find a pin for this lets create one';
		$code = rand(1000, 9999);
		$sqlsavePin = $db->query("INSERT INTO `users`(
		phone, active, createdDate, password,visits) 
		VALUES('$fundPhone','0',now(),'$code','0')")or die (mysqli_error());
	}
	$results="";
	// 'went to require sms class';
	require_once('../classes/sms/AfricasTalkingGateway.php');
	$username   = "cmuhirwa";
	$apikey     = "7ffaed2780ff7d179d4ebe07ecabc8ba857dd04ab0c1cc406be7ca2596d3824a";
	$recipients = '+25'.$fundPhone;
	$message    = 'Welcome to UPLUS, please use '.$code.' to log into your account.';// Specify your AfricasTalking shortCode or sender id
	$from = "uplus";

	$gateway    = new AfricasTalkingGateway($username, $apikey);

	try 
	{
		$results = $gateway->sendMessage($recipients, $message, $from);
		
		
		ECHO'
		<div style="color: #000;">
			Enter a 4digit pin we sent you on '.$fundPhone.'
			<input hidden id="pincode" value="'.$code.'">
			<div class="inputContainer">
				<input name="pin" onkeyup="changePin(this);" id="pin" class="newinput" style="width: 30%; text-align: unset;" placeholder="PIN"/> 	
			</div>
		</div>';
	}
	catch (AfricasTalkingGatewayException $e)
	{
		$results.="Encountered an error while sending: ".$e->getMessage();
	}
}
?>

<?PHP // 6 VERIFY THE PIN
if(isset($_GET['checkPin']))
{
	$pin			= mysqli_real_escape_string($db, $_GET['pin']);
	$fundPhone	 	= mysqli_real_escape_string($db, $_GET['fundPhone']);
	$targetAmount	= mysqli_real_escape_string($db, $_GET['targetAmount']);
	$targetPerPerson= mysqli_real_escape_string($db, $_GET['targetPerPerson']);
	$fundName		= mysqli_real_escape_string($db, $_GET['fundName']);
	$fundBank	 	= mysqli_real_escape_string($db, $_GET['fundBank']);
	$fundAccount	= mysqli_real_escape_string($db, $_GET['fundAccount']);
	$groupTargetType= mysqli_real_escape_string($db, $_GET['groupTargetType']);
	$perPersonType	= mysqli_real_escape_string($db, $_GET['perPersonType']);
	
	
	$sqlcheckPin 	= $db->query("SELECT * FROM users WHERE phone = '$fundPhone' LIMIT 1");
	$rowPin 		= mysqli_fetch_array($sqlcheckPin);
	$PinCheck 		= $rowPin['password'];
	if($PinCheck == $pin)
	{// KEEP SESSION AND CREAT THE ACCOUNT
		
		$phoneuser		= $rowPin['phone'];
		$passworduser 	= $rowPin['password'];
		$adminId 		= $rowPin['id'];
		$lastvisit 		= $rowPin['visits'];
		$adminName 		= $rowPin['name'];
			 
		$_SESSION["id"] = $adminId;
		$_SESSION["phone1"] = $phoneuser;
		$_SESSION["password"] = $passworduser;
		$newvisit = $lastvisit + 1;
		$sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now(), active =1 WHERE id = $adminId")or die (mysqli_error());
		
		// CREAT THE GROUP

		$groupName 	= $fundName;
		$adminPhone = $phoneuser;
		$bankaccount= $fundAccount;
		$groupBank	= $fundBank;
		$perPerson	= $targetPerPerson;
		$state	= 'private';
		
		//groupTargetType,  perPersonType,
		// 1 add the account with the phone
		$sql = $db->query("INSERT INTO groups
		(groupName, adminId, adminPhone, 
		 targetAmount, perPerson, createdDate, createdBy, state,
		 groupTargetType, perPersonType)
		VALUES
		('$groupName', '$adminId', '$adminPhone', 
		'$targetAmount','$perPerson', now(), '$adminId', '$state', '$groupTargetType', '$perPersonType')
		") or die (mysqli_error());
		
		// 2 GRAB ACCONT ID
		$sqlid = $db->query("SELECT id FROM groups ORDER BY id DESC LIMIT 1") or die (mysqli_error());
		$rowid = mysqli_fetch_array($sqlid);
		$lastid = $rowid['id'];
		
		$defaltSMS = 'Hi! '.$adminName.' is raising '.number_format($targetAmount).' Rwf for '.$groupName.'. To contribute visit this link http://uplus.rw/f/i'.$lastid.' , for more info call '.$adminName.' on '.$adminPhone.'';
		$insertSMS = $db->query("UPDATE groups SET invitationSms = '$defaltSMS' WHERE id = '$lastid'")or die (mysqli_error());

		// 3 ADD A WITHDRAW ACCOUNT 3//////////////////////////////////////////////3
		$conectGroupBank = $outCon->query("
		INSERT INTO `groups`(`groupId`, `accountNumber`, `bankId`) 
		VALUES ('$lastid', '$bankaccount', '$groupBank')")or die (mysqli_error());
		//3 END ADD A WITHDRAW ACCOUNT 3///////////////////////////////////////////////////
		
		$sqljoin = $db->query("INSERT INTO groupuser
		(`joined`, `groupId`, `userId`,`createdBy`, `createdDate` )
		VALUES
		('yes', '$lastid', '$adminId', '$adminId', now())")or die (mysqli_error());
		
	
		echo '<div style="text-align: center; font-size:20px;">
			Thanks '.$adminName.', we have created your contribution.
			<a href="home">Click here</a> to get started.
		<div>';
		
	
	}else
	{
		echo '
		<div style="color: #000;">
		Oops! Pin did not much, please try again and enter a 4 digit pin we sent you on '.$fundPhone.'
		<div class="inputContainer">
			<input name="pin" onkeyup="changePin(this);" id="pin" class="newinput" style=" width: 30%; text-align: unset;" placeholder="PIN"/> 	
		</div>
	</div>';
	}
}

?>

<?php // 7 START CHANGE TABS FROM FUNDS, INVEST TO SAVINGS

	if(isset($_GET['calltab'])){
		if($_GET['calltab'] == 1){
			?>
		<div id="actions" class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible',delay:300,topoffset:-150}">
		<h2 class="heading_c uk-margin-medium-bottom uk-text-center-medium">
                Public Contributions
            </h2> 	
			<?php
			echo '<ul class="uk-grid uk-grid-small  uk-grid-width-medium-1-3 uk-grid-width-large-1-3">
			';
					include '../db.php';
					$n="";
					$sql = $db->query("SELECT * FROM groups WHERE state = 'public' ORDER BY rand() limit 9");
					$sqlres = $db->query("SELECT * FROM groups WHERE state = 'public'");
					$countresults = mysqli_num_rows($sqlres);
					while($row = mysqli_fetch_array($sql))
					{
						$groupID = $row['id'];
						$groupName = $row["groupName"];
							$targetAmount = round($row['targetAmount']);
							$likes = round($row['likes']);
							$adminPhone = $row['adminPhone'];
							$groupDescription = $row["groupDesc"];
							
							$sqlbalance = $outCon->query("SELECT * FROM groupbalance WHERE groupId = '$groupID'");
							$balanceCount = mysqli_num_rows($sqlbalance);

							$rowbalance = mysqli_fetch_array($sqlbalance);
							$currentAmount = $rowbalance['Balance'];
							if($balanceCount == 0){
								$currentAmount = 0;
							}
							if($currentAmount < 0){
								$prog = 0;
							
							}else{
								$prog = $currentAmount*100/$targetAmount;
							}
								//$prog = rand(0,100);
								$prog = round($prog);
								if($prog < 10){$size=10;} else{$size=$prog;}
					echo'<li>
							<div class="md-card" style="border-radius: 5px;">
								<div class="md-card-content padding-reset">
									<div class="cont-image" style="background-image: url(proimg/6.jpg); border-radius: 5px 5px 0 0;">
										<div class="cont-image" style="height: 100%; width: 100%; border-radius: 5px 5px 0 0; background-image: url(temp/group'.$row['id'].'.jpeg);"></div>
									</div>
									<div id="likes'.$groupID.'"><span class="likes" onclick="likeit(likes='.$likes.', likeid='.$groupID.')">'.$likes.'</span></div>
									<div id="heart'.$groupID.'"><i class="uk-icon-heart uk-icon-medium md-color-white heart"></i></div>
									<a class="fundname" href="f/i'.$row['id'].'">
										<h4 class="fundtitle">'.$groupName.'</h4>
									</a>
									
								</div>
								<div class="progress">
									<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="'.$prog.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$size.'%">
									  '.$prog.'%
									</div>
								</div>
								<div class="raisedNow">Raised '.number_format($currentAmount).' Rwf </div> 
								<div class="md-card-content" style="min-height: 74px;">
									';?>
								<?php echo $groupDescription;?> 
							<?php
							echo'
								</div>
							</div>
							<br>
						</li>';
						
					}
					echo '</ul>';	
					if($countresults > 9){
						echo '<div class="text-center"><button class="btn btn-success">See More Contributions</button></div>';
					}
				?>
			<br>
		</div>
		<?php
		}
elseif($_GET['calltab'] == 3){
	?>
	<div id="actions" class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible',delay:300,topoffset:-150}">
		<h2 class="heading_c uk-margin-medium-bottom uk-text-center-medium">
               Investment Opportunities <a href="javascript:void()" onclick="csd()">CSD</a>
            </h2> 
	<ul id="csdback" class="uk-grid uk-grid-small  uk-grid-width-medium-1-3 uk-grid-width-large-1-3">
				<?php $sql1 = $investdb->query("SELECT * FROM `productcategory` JOIN items1");
												
							while($rowcats = mysqli_fetch_array($sql1))	
							{?>
				
				<li>
					<div class="md-card md-shadow-2dp">
						<div class="md-card-header" style="background: #007569;
    color: #fff;
    text-align: center;
    font-weight: 500;
    padding: 10px;">
							<?php 
							$CategId = $rowcats['catId'];
							echo $rowcats['catNane'];?>
						</div>
						<div class="md-card-content" style="padding-top: 0px;">
							<table class="uk-table">
								<thead>
									<tr>
										<th class="cmeFixedProduct">Product</th>
										<th class="cmeFixedLast">Price(Rwf)</th>
										<th class="cmeFixedChange">Change(%)</th>
										<th class="cmeFixedChange">Action</th>
									</tr>
								</thead>
								<tbody style="font-size: 13px">
										<?php 
		$sqlinvest = $investdb ->query("SELECT * FROM `items1` where status ='open' AND productCode = '$CategId'");
		$countData = mysqli_num_rows($sqlinvest);
		if($countData > 0){
		while($row = mysqli_fetch_array($sqlinvest)){
			$itemId = $row['itemId'];
						$postTitle = $row['itemName'];
						$abrev = $row['abrev'];
						
						$sqlPrevPrice = $investdb->query("SELECT * FROM (SELECT * FROM `theask`  WHERE itemCode = '$itemId' ORDER BY `transactionId` DESC LIMIT 2) AS Ptab ORDER BY `transactionId` ASC LIMIT 1");
						$sqlNewPrice = $investdb->query("SELECT * FROM theask WHERE itemCode = '$itemId' ORDER BY transactionID DESC limit 1");
						$rowPrevPrice = mysqli_fetch_array($sqlPrevPrice);
						$rowNewPrice = mysqli_fetch_array($sqlNewPrice);
						$prevPrice = number_format(($rowPrevPrice['unitPrice']),2);
						$updatedDate = $rowNewPrice['doneOn'];
						$currentPrice = number_format(($rowNewPrice['unitPrice']),2);
						$indicator = $currentPrice - $prevPrice;
						if($prevPrice == 0){
							$percindicator = 0;
						}else
						{
							$percindicator = round(($indicator * 100/$prevPrice),2);
						}
						if($prevPrice > $currentPrice)
						{
							$sign = '<span style="float: left;
    background: #ba031d;
    width: 50px;
    padding: 1px 2px;
    text-align: right;
    display: block;
    margin: 0 3px 0 0;
    color: #fff;
    border-radius: 4px;
"> '.$percindicator.'</span>
<i class="fa fa-angle-down" style="
    float: left;
    font-size: 18px;
    color: #ba031d;
"></i>';
						}
						elseif($prevPrice == $currentPrice)
						{
							$sign = "(0)";
						}
						else
						{
							$sign = '<span style="float: left;
    background: #4bac43;
    width: 50px;
    padding: 1px 2px;
    text-align: right;
    display: block;
    margin: 0 3px 0 0;
    color: #fff;
    border-radius: 4px;
">+ '.$percindicator.'</span>
<i class="fa fa-angle-up" style="
    float: left;
    font-size: 18px;
    color: #4bac43;
"></i>';
						}																
			?><tr>
											<td><a><?php echo $row['abrev'];?></a></td>
											<td><?php echo $currentPrice;?></td>
											<td><?php echo $sign?></td><td>
<a href="invest">More</a>
</td>
		</tr><?php }
		} ?>
								</tbody>
							</table>
						</div>
					</div>
				</li>
			<?php }?>
			</ul>
			<br>
			<br>
		</div>
		<?php
}		
	} // END CHANGE TABS FROM FUNDS, INVEST TO SAVINGS
?>

<?php // 8 LIKE THE FUND
// Check if the method exists
if(isset($_GET['newlikes'])){
	$newlikes 	= mysqli_real_escape_string($db, $_GET['newlikes']);
	$likeId 	= mysqli_real_escape_string($db, $_GET['likeId']);
	
	$sql = $db->query("UPDATE groups SET likes='$newlikes' WHERE id = '$likeId'");
	echo 'yes';
} // END LIKE THE FUND
?> 