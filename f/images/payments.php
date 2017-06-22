<style type="text/css">
.form-style-2{
    max-width: 500px;
    padding: 20px 12px 10px 20px;
    font: 13px Arial, Helvetica, sans-serif;
}
.form-style-2-heading{
    font-weight: bold;
    font-style: italic;
    border-bottom: 2px solid #ddd;
    margin-bottom: 20px;
    font-size: 15px;
    padding-bottom: 3px;
}
.form-style-2 label{
    display: block;
    margin: 0px 0px 15px 0px;
}
.form-style-2 label > span{
    width: 100px;
    font-weight: bold;
    float: left;
    padding-top: 8px;
    padding-right: 5px;
}
.form-style-2 span.required{
    color:red;
}
.form-style-2 .tel-number-field{
    width: 40px;
    text-align: center;
}
.form-style-2 input.input-field{
    width: 48%;
    
}

.form-style-2 input.input-field, 
.form-style-2 .tel-number-field, 
.form-style-2 .textarea-field, 
 .form-style-2 .select-field{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid #C2C2C2;
    box-shadow: 1px 1px 4px #EBEBEB;
    -moz-box-shadow: 1px 1px 4px #EBEBEB;
    -webkit-box-shadow: 1px 1px 4px #EBEBEB;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    padding: 7px;
    outline: none;
}
.form-style-2 .input-field:focus, 
.form-style-2 .tel-number-field:focus, 
.form-style-2 .textarea-field:focus,  
.form-style-2 .select-field:focus{
    border: 1px solid #0C0;
}
.form-style-2 .textarea-field{
    height:100px;
    width: 55%;
}
.form-style-2 input[type=submit],
.form-style-2 input[type=button]{
    border: none;
    padding: 8px 15px 8px 15px;
    background: #FF8500;
    color: #fff;
    box-shadow: 1px 1px 4px #DADADA;
    -moz-box-shadow: 1px 1px 4px #DADADA;
    -webkit-box-shadow: 1px 1px 4px #DADADA;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
}
.form-style-2 input[type=submit]:hover,
.form-style-2 input[type=button]:hover{
    background: #EA7B00;
    color: #fff;
}
</style>

<?php
if(isset($_GET['forGroupId'])){
	$forGroupId = $_GET['forGroupId'];
	$forGroupName = $_GET['forGroupName'];

echo'
	
<input id="forGroupId" hidden value="'.$forGroupId.'"/>

	<div class="form-style-2">
<div class="form-style-2-heading">Payement Information</div>
<label for="field1"><span>Amount <span class="required">*</span></span><input 
 class="input-field" name="field1" type="number" id="contributedAmount"/></label>
<h6><div id="amountError" style="color: #f44336;"></div></h6>
	<div class="mdl-grid mdl-grid--no-spacing" >
		<div class="mdl-cell mdl-cell--4-col"> <a href="javascript:void()" onclick="frontpayement2(method=1)"><div style="background-image: url(../proimg/banks/1.jpg); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a></div>
		<div class="mdl-cell mdl-cell--4-col"> <a href="javascript:void()" onclick="frontpayement2(method=2)"><div style="background-image: url(../proimg/banks/2.jpg); background-size: 100% 100%; height: 90px; margin: 5px; box-shadow: 0.5px 0.5px 0.25px 0.25px #888888;"></div></a></div>
		<div class="mdl-cell mdl-cell--4-col"> <form action="/your-server-side-code" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_7hXAU0yvdFiH5FgSiGKi0KkC"
    data-amount="999"
    data-name="contribution"
    data-description="'.$forGroupName.'"
    data-image="http://uplus.rw/assets/images/apple-touch-icon.png"
    data-locale="auto">
  </script>
</form></div>
	</div>
</div>
';
}
elseif(isset($_GET['method'])){
	$method = $_GET['method'];
	$forGroupId = $_GET['forGroupId1'];
	$contributedAmount = $_GET['contributedAmount'];
	
	$outCon = mysqli_connect("localhost", "uplus_uplus", "clement123" , "uplus_rtgs");
	$sqlDestination = $outCon->query("SELECT * FROM group_account WHERE groupId = '$forGroupId'");
	while($row = mysqli_fetch_array($sqlDestination)){
		$bankaccount = $row['accountNumber'];
		$groupBank = $row['bankId'];
	}
	
	echo'<input type="number" hidden id="forGroupId" value="'.$forGroupId.'">';
	echo'<input type="text" hidden id="amountdone" value="'.$contributedAmount.'">';
	echo'<input type="text" hidden id="sendToAccount" value="'.$bankaccount.'">';
	echo'<input type="text" hidden id="sendToBank" value="'.$groupBank.'">';
			
if($method == '1'){
	echo'
	<div class="widget-body widget-content"  style="background-color: #FFBE00; height:100%;">
			
	<div class="mdl-card__supporting-text" ><button class="btn btn-round btn-dark btn-raised" onclick="frontpayementOptions()">
				<i class="icon md-arrow-left">back</i>
			</button>
		<div id="doneMtn" class="pull-right"></div>
		<hr/>
  <div class="example-wrap" id="donetransfer">
<div class="row text-center">
	<div class="col-lg-12" id="sendingInfo">
		<div class="form-group">
		  <div class="input-group">
			<span class="input-group-addon">+25078</span>
			<input type="number" onkeyup="handleChange(this);" id="mtnnumber" class="form-control" placeholder="MTN Phone number">
		  </div>
		</div><br/>
		<input id="method" value="'.$method.'" hidden>
		<div id="alowMtn">
			Enter your MTN number after 078
		</div>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
</div></div>	
</div>	
';}
elseif($method == '2'){echo'
	<div class="widget-body widget-content"  style="background-color: #002e6e; height:100%;">
	<button class="btn btn-round btn-dark btn-raised btn" onclick="frontpayementOptions()"><i class="icon md-arrow-left"></i></button>
	<div id="doneMtn" class="pull-right"></div>
		<hr/>
  <div class="example-wrap">
<div class="row text-center">
	<div class="col-lg-12" >
		<div class="form-group">
		  <div class="input-group">
			<span class="input-group-addon">+2507'.$method.'</span>
			<input type="number" onkeyup="handleChange(this);" id="mtnnumber" class="form-control" placeholder="TIGO Phone number">
		  </div>
		</div>
		<input id="method" value="'.$method.'" hidden>
		<div id="alowMtn" style="color: #fff;">
			Enter your TIGO number after 07'.$method.'
		</div>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
</div></div>	
</div>	
';}
elseif($method == '3'){echo'
	<div class="widget-body widget-content"  style="background-color: #db030c; height:100%;">
	<button class="btn btn-round btn-dark btn-raised btn" onclick="frontpayementOptions()"><i class="icon md-arrow-left"></i></button>
	<div id="doneMtn" class="pull-right"></div>
		<hr/>
  <div class="example-wrap">
<div class="row text-center">
	<div class="col-lg-12" >
		<div class="form-group">
		  <div class="input-group">
			<span class="input-group-addon">+2507'.$method.'</span>
			<input type="number" onkeyup="handleChange(this);" id="mtnnumber" class="form-control" placeholder="AIRTEL Phone number">
		
		  </div>
		</div>	
		<input id="method" value="'.$method.'" hidden>
		<div id="alowMtn" style="color: #fff;">
			Enter your AIRTEL number after 07'.$method.'
		</div>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
</div></div>	
</div>	
';}
elseif($method == '4'){echo'
<div class="panel-body container-fluid" style="background-color: #fff; height:100%;">
 <button class="btn btn-round btn-dark btn-raised btn" onclick="frontpayementOptions()"><i class="icon md-arrow-left"></i></button>
	<div id="doneMtn" class="pull-right"></div>
		<hr/>
<div class="row">
	<div class="col-lg-12 form-group">
	  <div class="example-responsive example form-group">
		<div class="col-lg-12 col-md-12 clearfix form-group">
		  <div class="card-wrapper pull-left" id="cardContainer"></div>
		</div>
	  </div>
	  <div class="col-lg-12 col-md-12">
		<div class="example-wrap">
		  <form class="card" data-plugin="card" data-target="#cardContainer">
			<div class="form-group col-lg-6">
			  <input type="text" class="form-control" id="inputCardNumber" name="number" placeholder="Card number">
			</div>
			<div class="form-group col-lg-6">
			  <input type="text" class="form-control" id="inputFullName" name="name" placeholder="Full name">
			</div>
			<div class="form-group col-lg-6">
			  <input type="text" class="form-control" id="inputExpiry" name="expiry" placeholder="MM/YY">
			</div>
			<div class="form-group col-lg-6">
			  <input type="text" class="form-control" id="inputCVC" name="cvc" placeholder="CVC">
			</div>
		  </form>
		</div>
	  </div>
	</div>
  </div>
  <!-- End Example Card -->
</div>
';}
}
?>
<script>
function frontpayement2(method){
	//alert(method);
	var contributedAmount =$("#contributedAmount").val();
	var forGroupId =$("#forGroupId").val();
	if (contributedAmount == null || contributedAmount == "") 
		{
			document.getElementById('amountError').innerHTML = 'Contributed Amount must be filled out';
			return false;
		}
		//alert(forGroupId);
	$.ajax({
			type : "GET",
			url : "payments.php",
			dataType : "html",
			cache : "false",
			data : {
				method : method,
				contributedAmount : contributedAmount,
				forGroupId1 : forGroupId,
			},
			success : function(html, textStatus){
				$("#contBody").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
</script>

<script>
  function handleChange(input) {
	  var method = document.getElementById('method').value;
	  if (method == '1') {
		  var opperator = 'MTN';
		  var errorcolor = '#9c27b0;';
		  }
	  else if (method == '2') {
		  var opperator = 'TIGO';
		  var errorcolor = '#fff;';
		  }
	  else if (method == '3') {
		  var opperator = 'AIRTEL';
		  var errorcolor = '#fff;';
		  }
    if ( input.value < 1000000) {
		document.getElementById('alowMtn').innerHTML = '<div style="color: '+errorcolor+'"> Keep typing till you get a Done button</div>';
		document.getElementById('doneMtn').innerHTML = '';
	}
    else if (input.value > 9999999) {
		document.getElementById('alowMtn').innerHTML = '<div style="color: '+errorcolor+'">Please enter a valid '+opperator+' Rwanda number</div>';
		document.getElementById('doneMtn').innerHTML = '';
	}else{
		document.getElementById('alowMtn').innerHTML = '';
		document.getElementById('doneMtn').innerHTML = '<button class="btn btn-success btn-raised btn-round" onclick="kwishura()"><i class="icon md-check"></i>Done</button>';
	}
  }
  
</script>
<script>
// Display a recurrunf Invitation
function kwishura(){
	
	var forGroupId			= document.getElementById('forGroupId').value;
	var sentAmount			= document.getElementById('amountdone').value;
	var sendFromAccount		= document.getElementById('mtnnumber').value;
	var sendFromBank		= document.getElementById('method').value;
	var sendToBank			= document.getElementById('sendToBank').value;
	var sendToAccount		= document.getElementById('sendToAccount').value;
	var sendFromAccount = '78'+sendFromAccount;	
	document.getElementById('donetransfer').innerHTML = '<div style="text-align: center;padding-top:20px;"><h5>Contacting MTN...</h5></div>';
	$.ajax({
			type : "GET",
			url : "../3rdparty/rtgs/transfer.php",
			dataType : "html",
			cache : "false",
			data : {
				
				forGroupId		:	forGroupId,	
				sentAmount		:	sentAmount,	
				sendFromAccount	:	sendFromAccount,	
				sendFromBank	:   sendFromBank,	
				sendToBank		:   sendToBank,		
				sendToAccount	:   sendToAccount,		
			},
			success : function(html, textStatus){
				$("#donetransfer").html(html);
				document.getElementById('doneMtn').innerHTML = '';
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
</script>
