
<style>
#mtnnumber	{
	margin: 0 0 11px 0;
	width: 150px;
	font-size: 20px;
	padding: 5px 5px;
}
#mtnname {
	margin: 0 0 11px 0;
	width: 150px;
	font-size: 20px;
	padding: 5px 5px;
}
.numberSpan{   
	color: #fff;
    float: left;
    background: #009485;
	height: 33px;border-radius: 5px 0px 0 5px;
	padding: 7px 2px 7px 7px;
}
</style>
<?php 
if(isset($_GET['visited'])){
	echo $pageId		= $_GET['pageId'];
	echo $country	= $_GET['country'];
	echo $region		= $_GET['region'];
	echo $city 		= $_GET['city'];
	echo $ip 		= $_GET['ip'];	
	echo $loc 		= $_GET['loc'];	
	echo $org 		= $_GET['org'];
	include("../db.php");
	$sqlDestination = $db->query("
	INSERT INTO `visitstrack`(pageId, country, region, city, ip, loc, org) 
	VALUES ('$pageId', '$country', '$region', '$city', '$ip', '$loc', '$org')
	")or die (mysqli_error());
}
?>					
<?php
if(isset($_GET['method'])){
	$method = $_GET['method'];
	$forGroupId = $_GET['forGroupId1'];
	$adminId = $_GET['adminId'];
	$contributedAmount = $_GET['contributedAmount'];
	
	include("../db.php");
	$sqlDestination = $outCon->query("SELECT * FROM groups WHERE groupId = '$forGroupId'");
	while($row = mysqli_fetch_array($sqlDestination)){
		$bankaccount = $row['accountNumber'];
		$groupBank = $row['bankId'];
	}
	
	$sqlAdmin = $db->query("SELECT * FROM users WHERE id = '$adminId'");
	$rowAdmin = mysqli_fetch_array($sqlAdmin);
	$adminName = $rowAdmin['name'];
	$adminEmail = $rowAdmin['email'];
	$adminPhone = $rowAdmin['phone'];
	
	echo'<input type="hidden" id="opperator" value="'.$method.'">';
	echo'<input type="number" hidden  name="forGroupId" id="forGroupId" value="'.$forGroupId.'">';
	echo'<input type="text" hidden id="amountdone" value="'.$contributedAmount.'">';
	echo'<input type="text" hidden id="sendToAccount" value="'.$bankaccount.'">';
	echo'<input type="text" hidden id="sendToBank" value="'.$groupBank.'">';
			
if($method == '1'){
	?>
	<div class="mdl-dialog__content" style="padding:0px; border-bottom: solid #ccc 0.1px;" >
		<div class="sendMoneyProgress" id="sendMoneyProgress">
			<div class="progressTab proTabLeft">
				<span class="step-number num-active">1</span>
				<div class="step-desc">
					<span class="step-title stepActive">Finance</span>
				</div>
			</div>
			<div class="progressTab proTabActive">
				<span class="step-number num-active">2</span>
				<div class="step-desc">
					<span class="step-title stepActive">Info</span>
				</div>
			</div>
			<div class="progressTab proTabNormal">
				<span class="step-number num-normal">3</span>
				<div class="step-desc">
					<span class="step-title stepNormal">Confirm</span>
				</div>
			</div>
		</div>
		<div style="background-color: #fec907; padding: 40px 15px 15px 15px; height:100%;">
			<div id="showTiming"></div>
			<div class="example-wrap" id="donetransfer">
				<div style="text-align: center; color: #fff;font-size: 16px">Tansfer <?php echo number_format($contributedAmount);?> Rwf using <b  style="font-size: 18px">MTN Mobile Money</b></div>
				<div class="row text-center">
					<div class="col-lg-12" id="sendingInfo" style="font-size: 15px; padding-top: 15px;">
						<div class="numberSpan">
						  Name
						</div>
						<div>
							<input type="text" id="mtnname" style="width: 70%;font-size: 14px;" class="form-control" placeholder="Your Full Name"> 
						</div>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-lg-12" id="sendingInfo" style="font-size: 15px;">
						<div class="numberSpan">
						  +25078
						</div>
						<div>
							<input type="number" style="font-size: 15px;width: 36.5%;" onkeyup="handleChange(this);" id="mtnnumber" class="form-control" placeholder="MTN Phone"> 
						</div>
					</div>
					<div class="col-lg-12" id="sendingInfo">
						<input id="method" value="8" hidden>
						<div id="alowMtn" style="color: #fff; padding: 10px;">
						</div>
					</div>
				</div>
				
			</div>
		</div>		
	</div>	
	<div class="mdl-dialog__actions" id="actionbc" style="padding:15px; display: block;">
		<button type="button" onclick="backBtn()" style="background-color: #757575; color: #eee;cursor: pointer;" class="mdl-button btn-default">Back</button>
		<span id="doneMtn" style="float:right;"><button type="button" style="background-color: #eeeeee; color: #777;" class="mdl-button btn-success" onclick="firtFinish()">NEXT</button></span>
	</div>
	
<?php }
elseif($method == '2'){?>
<div class="mdl-dialog__content" style="padding:0px; border-bottom: solid #ccc 0.1px;" >
		<div class="sendMoneyProgress" id="sendMoneyProgress">
			<div class="progressTab proTabLeft">
				<span class="step-number num-active">1</span>
				<div class="step-desc">
					<span class="step-title stepActive">Finance</span>
				</div>
			</div>
			<div class="progressTab proTabActive">
				<span class="step-number num-active">2</span>
				<div class="step-desc">
					<span class="step-title stepActive">Info</span>
				</div>
			</div>
			<div class="progressTab proTabNormal">
				<span class="step-number num-normal">3</span>
				<div class="step-desc">
					<span class="step-title stepNormal">Confirm</span>
				</div>
			</div>
		</div>
		<div style="background-color: #5572c0; padding:40px 15px 15px 15px; height:100%;">
			<div id="showTiming"></div>
			<div class="example-wrap" id="donetransfer">
				<div style="text-align: center; color: #fff;font-size: 16px; padding-bottom: 15px">Tansfer <?php echo number_format($contributedAmount);?> Rwf using <b  style="font-size: 18px">TIGO Cash</b></div>
				
				<div class="row text-center">
					<div class="col-lg-12" id="sendingInfo" style="font-size: 15px;">
						<div class="numberSpan">
						  Name
						</div>
						<div>
							<input type="text" id="mtnname" style="width: 70%;font-size: 14px;" class="form-control" placeholder="Your Full Name"> 
						</div>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-lg-12" id="sendingInfo" style="font-size: 15px;">
						<div class="numberSpan">
						  +25072
						</div>
						<div>
							<input type="number" style="font-size: 15px;width: 36.5%;" onkeyup="handleChange(this);" id="mtnnumber" class="form-control" placeholder="TIGO Phone"> 
						</div>
					</div>
					<div class="col-lg-12" id="sendingInfo">
						<input id="method" value="2" hidden>
						<div id="alowMtn" style="color: #fff; padding: 10px;">
							Enter your TIGO number after 072
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>	
	<div class="mdl-dialog__actions" id="actionbc" style="padding:15px; display: block;">
		<button type="button" onclick="backBtn()" style="background-color: #757575; color: #eee;cursor: pointer;" class="mdl-button btn-default">Back</button>
		<span id="doneMtn" style="float:right;"><button type="button" style="background-color: #eeeeee; color: #777;" class="mdl-button btn-success" onclick="firtFinish()">NEXT</button></span>
	</div>
	
<?php }

elseif($method == '5'){?>
<form id="payform" method="post" action="../3rdparty/rtgs/transfer.php">	
<input hidden name="bkVisa" />	
<input hidden name="forGroupId" value="<?php echo $forGroupId;?>"/>		
<input hidden name="sentAmount" value="<?php echo $contributedAmount;?>"/>		
<input hidden name="sendToAccount" value="<?php echo $bankaccount;?>"/>
<input hidden name="sendToBank" value="<?php echo $groupBank;?>"/>
<input hidden name="sendToName" value="<?php echo $adminName;?>"/>
<input hidden name="receiverEmail" value="<?php echo $adminEmail;?>"/>
<input hidden name="sendFromBank" value="5"/>
<input hidden name="sendFromAccount" value="VISA/MASTER"/>
				
	
<div class="mdl-dialog__content" style="padding:0px; border-bottom: solid #ccc 0.1px;" >
	<div class="sendMoneyProgress" id="sendMoneyProgress">
		<div class="progressTab proTabLeft">
			<span class="step-number num-active">1</span>
			<div class="step-desc">
				<span class="step-title stepActive">Finance</span>
			</div>
		</div>
		<div class="progressTab proTabActive">
			<span class="step-number num-active">2</span>
			<div class="step-desc">
				<span class="step-title stepActive">Info</span>
			</div>
		</div>
		<div class="progressTab proTabNormal">
			<span class="step-number num-normal">3</span>
			<div class="step-desc">
				<span class="step-title stepNormal">Confirm</span>
			</div>
		</div>
	</div>				
	<div id="showTiming"></div>
	<div style="background-color: #002e6e; padding: 40px 15px 15px 15px; height:100%;">
		<div class="example-wrap" id="donetransfer">
			<div style="text-align: center; color: #fff;font-size: 16px">Tansfer <?php echo number_format($contributedAmount);?> Rwf using <b  style="font-size: 18px">VISA CARD</b></div>
			<div class="row">
				<div class="col-lg-12" id="sendingInfo" style="font-size: 15px; padding: 15px">
					<div class="numberSpan">
					  Name
					</div>
					<div>
						<input type="text" name="sendFromName" style="width: 70%;font-size: 15px;" class="form-control" placeholder="Your Full Name"> 
					</div>
					<div style="color: #fff;"><input type="checkbox" name="senderPrivacy" value="no"> Hide Name from everyone but the organisor</div>
					<br/>
					<div class="numberSpan">
						  Phone
					</div>
					<div>
						<input type="number" name="contactPhone" style="width: 70%;font-size: 15px;" class="form-control" placeholder="+2507"> 
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" id="sendingInfo" style="font-size: 15px;">
					<div class="numberSpan">
					  Email
					</div>
					<div>
						<input type="text" name="senderEmail" id="senderEmail" style="font-size: 15px;width: 70%;"  class="form-control" placeholder="Your email"> 
					</div>
				</div>
				<div class="col-lg-12" id="sendingError">
					<div id="alowMtn" style="color: #fff;font-size: 14px; padding: 10px;">
						We use your email to send you a reciept.<br/>
						For more details, read our <a href="javascript:void()" style="color: #82ff37">privacy policy</a>
					</div>
				</div>
				
			</div>
		</div>
	</div>	
</div>
<div class="mdl-dialog__actions" id="actionbc" style="padding:15px; display: block;">
	<button type="button" onclick="backBtn()" style="background-color: #757575; color: #eee;cursor: pointer;" class="mdl-button btn-default">Back</button>
	<span id="doneMtn" style="float:right;">
		<button type="button" style="background-color: #00897b;" class="mdl-button btn-success" onclick="payVisa()">NEXT</button>
	</span>
</div>
<?php
}
elseif($method == '6'){?>
<form id="payform" method="post" action="../3rdparty/rtgs/transfer.php">	
<input hidden name="bkVisa" />	
<input hidden name="forGroupId" value="<?php echo $forGroupId;?>"/>		
<input hidden name="sentAmount" value="<?php echo $contributedAmount;?>"/>		
<input hidden name="sendToAccount" value="<?php echo $bankaccount;?>"/>
<input hidden name="sendToBank" value="<?php echo $groupBank;?>"/>
<input hidden name="sendToName" value="<?php echo $adminName;?>"/>
<input hidden name="receiverEmail" value="<?php echo $adminEmail;?>"/>
<input hidden name="sendFromBank" value="5"/>
<input hidden name="sendFromAccount" value="VISA/MASTER"/>
				
	
<div class="mdl-dialog__content" style="padding:0px; border-bottom: solid #ccc 0.1px;" >
	<div class="sendMoneyProgress" id="sendMoneyProgress">
		<div class="progressTab proTabLeft">
			<span class="step-number num-active">1</span>
			<div class="step-desc">
				<span class="step-title stepActive">Finance</span>
			</div>
		</div>
		<div class="progressTab proTabActive">
			<span class="step-number num-active">2</span>
			<div class="step-desc">
				<span class="step-title stepActive">Info</span>
			</div>
		</div>
		<div class="progressTab proTabNormal">
			<span class="step-number num-normal">3</span>
			<div class="step-desc">
				<span class="step-title stepNormal">Confirm</span>
			</div>
		</div>
	</div>				
	<div style="background-color: #002e6e; padding: 40px 15px 15px 15px; height:100%;">
		<div id="showTiming"></div>
		<div class="example-wrap" id="donetransfer">
			<div style="text-align: center; color: #fff;font-size: 16px">Tansfer <?php echo number_format($contributedAmount);?> Rwf using <b  style="font-size: 18px">MASTER CARD</b></div>
			<div class="row">
				<div class="col-lg-12" id="sendingInfo" style="font-size: 15px; padding: 15px">
					<div class="numberSpan">
					  Name
					</div>
					<div>
						<input type="text" name="sendFromName" style="width: 70%;font-size: 15px;" class="form-control" placeholder="Your Full Name"> 
					</div>
					<div style="color: #fff;"><input type="checkbox" name="senderPrivacy" value="no"> Hide Name from everyone but the organisor</div>
					<br/>
					<div class="numberSpan">
						  Phone
					</div>
					<div>
						<input type="number" name="contactPhone" style="width: 70%;font-size: 15px;" class="form-control" placeholder="+2507"> 
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" id="sendingInfo" style="font-size: 15px;">
					<div class="numberSpan">
					  Email
					</div>
					<div>
						<input type="text" name="senderEmail" id="senderEmail" style="font-size: 15px;width: 70%;"  class="form-control" placeholder="Your email"> 
					</div>
				</div>
				<div class="col-lg-12" id="sendingError">
					<div id="alowMtn" style="color: #fff;font-size: 14px; padding: 10px;">
						We use your email to send you a reciept.<br/>
						For more details, read our <a href="javascript:void()" style="color: #82ff37">privacy policy</a>
					</div>
				</div>
				
			</div>
		</div>
	</div>	
</div>
<div class="mdl-dialog__actions" id="actionbc" style="padding:15px; display: block;">
	<button type="button" onclick="backBtn()" style="background-color: #757575; color: #eee;cursor: pointer;" class="mdl-button btn-default">Back</button>
	<span id="doneMtn" style="float:right;">
		<button type="button" style="background-color: #00897b;" class="mdl-button btn-success" onclick="payVisa()">NEXT</button>
	</span>
</div>
<?php
}
}
?>

<script>
// Display a recurrunf Invitation
function kwishura(){

console.clear()

	
	var forGroupId			= document.getElementById('forGroupId').value;
	var sentAmount			= document.getElementById('amountdone').value;
	var sendFromAccount		= document.getElementById('mtnnumber').value;
	var sendFromName		= document.getElementById('mtnname').value;
	//var sendFromBank		= document.getElementById('method').value;
	var sendToBank			= document.getElementById('sendToBank').value;
	var sendToAccount		= document.getElementById('sendToAccount').value;
	var method				= document.getElementById('method').value;
	var sendToName			= '<?php echo $adminName;?>';
	if(method == '8'){
		var sendFromBank = 1;
	}
	else if(method == '2'){
		var sendFromBank = 2;
	}
	var sendFromAccount 	= '7'+method+''+sendFromAccount;
	var realphone1 			= sendFromAccount.substring(sendFromAccount.indexOf("7"));
	var prephone2 			= sendToAccount.substring(sendToAccount.indexOf("7"));
	var realphone2 			= '250'+prephone2;
		
	document.getElementById('sendMoneyProgress').innerHTML = '<div class="sendMoneyProgress">'
			+'<div class="progressTab proTabLeft">'
				+'<span class="step-number num-active">1</span>'
				+'<div class="step-desc">'
					+'<span class="step-title stepActive">Finance</span>'
				+'</div>'
			+'</div>'
			+'<div class="progressTab proTabLeft">'
				+'<span class="step-number num-active">2</span>'
				+'<div class="step-desc">'
					+'<span class="step-title stepActive">Info</span>'
				+'</div>'
			+'</div>'
			+'<div class="progressTab proTabActive">'
				+'<span class="step-number num-active">3</span>'
				+'<div class="step-desc">'
					+'<span class="step-title stepActive">Confirm</span>'
				+'</div>'
			+'</div>'
		+'</div>';
	document.getElementById('donetransfer').innerHTML = '<div style="text-align: center;padding-top:10px; color: #fff; text-shadow: 1px 1px 2px #000000;"><div class="loader"></div></div>';
	
	$.ajax(
	{
		type : "POST",
		url : "../api/index.php",
		dataType : "json",
		cache : "false",
		data : {
			action 			: 	"contribute",
			groupId			:	forGroupId,	
			amount			:	sentAmount,	
			pushnumber		:	realphone1,	
			senderBank		:	sendFromBank	
				
				
		},
		success: function (data) { 
	        $.each(data, function(index, element) {
	        	var transactionId = (element.transactionId);
	        	var status = (element.status);
	            //document.getElementById("donetransfer").innerHTML = '<div style="text-align: center;padding-top:10px; color: #fff; text-shadow: 1px 1px 3px #000000"><h5>Float Balance</h5><h4/>'+balance+' Rwf</h4>';
	            
	            //alert(status);
	            document.getElementById('donetransfer').innerHTML = '<div style="text-align: center;padding-top:10px; color: #fff; text-shadow: 1px 1px 3px #000000"><h4>The transaction:<br/>'+status+'</h4>';
	            document.getElementById('doneMtn').innerHTML = '';
	            if(status == "pending"){
	            	alert(transactionId);
	            	//call the check status
	            	checkcontributionstatus(transactionId);
	            }
	        });
	    },
		error : function(xht, textStatus, errorThrown){
			//alert("Error : " + errorThrown);
			document.getElementById('donetransfer').innerHTML = 'System Error';
	        document.getElementById('doneMtn').innerHTML = '';
		}
	});
}
function checkcontributionstatus(transactionId)
{
	$.ajax(
	{
		type : "POST",
		url : "../api/index.php",
		dataType : "json",
		cache : "false",
		data : {
			action 			: 	"checkcontributionstatus",
			transactionId	:	transactionId
		},
		success: function (data) { 
        $.each(data, function(index, element) {
        	var transactionId = (element.transactionId);
        	var status = (element.status);
        	if(status == "pending"){
	            	alert(transactionId);
	            	//call the check status
	            	checkcontributionstatus(transactionId);
	            }
            });

    	}
    });
}
</script>

<!--AJAX CALL THE STATUS-->
<script>
var k =0;
var M =0;
function checking(){
	var check =1;
	if(M > 0){ 
		console.log('Status Change 1');
		K = M;
	}
	if(k<=6)
	{
		var pre_query = new Date().getTime();
		console.log('Request -> ('+k+') at: '+pre_query);
		$.ajax({
			type : "GET",
			url : "../3rdparty/rtgs/transfer.php",
			dataType : "html",
			cache : "false",
			data : {
				
				check : check,
			},
			success : function(html, textStatus){
				
				var post_query = new Date().getTime();
				var duration = (post_query - pre_query) / 1000;
				console.log('Response <- ('+k+') at: '+post_query);
				console.log('('+k+') took: '+duration);
				console.log('');
				setTimeout(function() { checking(); }, 10000);
				$("#donetransfer").html(html);
				k++;
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
		});
	}
	else if(k >=10)
	{
		console.log('canceled tricking to '+k+'th request');
	}
	else
	{
		console.log('timeout after '+k+'0 seconds');
		document.getElementById('donetransfer').innerHTML = '<div style="text-align: center;padding-top:10px; color: #fff; text-shadow: 1px 1px 3px #000000">'
		+'<h5>Timeout, '+reason+'</h5></div>';
	}
}
function stopit()
	{
		clearInterval(interval);
		console.log('TimedOut after 50 Sec');
		
	}
</script>

<?php
if(isset($_GET['back'])){
	
?>
<div style="padding:0px; border-bottom: solid #ccc 0.1px;" >
					<div class="sendMoneyProgress" id="sendMoneyProgress">
						<div class="progressTab proTabActive">
							<span class="step-number num-active">1</span>
							<div class="step-desc">
								<span class="step-title stepActive">Finance</span>
							</div>
						</div>
						<div class="progressTab proTabNormal">
							<span class="step-number num-normal">2</span>
							<div class="step-desc">
								<span class="step-title stepNormal">Info</span>
							</div>
						</div>
						<div class="progressTab proTabNormal">
							<span class="step-number num-normal">3</span>
							<div class="step-desc">
								<span class="step-title stepNormal">Confirm</span>
							</div>
						</div>
					</div>
					<form id="payform" method="post" action="../3rdparty/rtgs/transfer.php">
						<input name="bkVisa" hidden />
						<input name="forGroupId" value="<?php echo $groupID;?>" hidden />
						<div class="form-style-2" style="padding: 40px 20px 15px 20px;">
							<label for="field1" style="width: 100%; text-align:center">
								<span style="font-size: 14px; ">Amount <span class="required" style="color: red;">*</span>
								</span>
								<input value="<?php echo $_GET['back'];?>" class="form-control input-field" name="field1" type="number" id="contributedAmount">
								<span>
									<select HIDDEN disabled style="width: 33%;height: 30px; padding-top: 3px; font-size: 16px;" class="select-field" name="currency" id="currency">
										<option value="RWF">RWF</option>
										<option value="USD">USD</option>
									</select>
								</span>
							</label>
							<h6><div id="amountError" style="color: #f44336;"></div></h6><br>
							<div class="mdl-grid mdl-grid--no-spacing" >
								<div class="transferBtn" style="padding: 0 8px 0 0"> 
									<div onclick="frontpayement2(method=1)" class="payBtn" style="background-image: url(images/1.jpg);"></div>
									
								</div>
								<div class="transferBtn"> 
									<div onclick="frontpayement2(method=2)" class="payBtn" style="background-image: url(images/2.jpg);"></div>
									
								</div>
								<div class="transferBtn"> 
									<div  onclick="frontpayement2(method=5)" class="payBtn" style="background-image: url(../proimg/banks/4.png);"></div>
									
								</div>
								<div class="transferBtn" style="padding:0 0 0 8px"> 
									<div  onclick="frontpayement2(method=6)" class="payBtn" style="background-image: url(../proimg/banks/5.png);"></div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="mdl-dialog__actions" id="actionbc" style="padding:15px; display: block;">
					<button type="button" style="background-color: #eee; color:#757575;" class="mdl-button btn-default">Back</button>
					<button type="button" onclick="frontpayement2(method=<?php echo $_GET['backMethod'];?>)" style="float:right;background-color: #00897b;" class="mdl-button btn-success">Next</button>
				</div>


<?php
}
?>
