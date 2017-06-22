<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
if (isset($_GET['groupId'])){	
		$groupID = (int)$_GET['groupId'];
		require_once "parsedown/Parsedown.php";
		$parsedown = new parsedown();
		include "../db.php"; 
		$sql2 = $db->query("SELECT * FROM groups WHERE id='$groupID' "); 
		while($row = mysqli_fetch_array($sql2)){ 
			$groupName = $row["groupName"];
			$targetAmount = round($row['targetAmount']);
			$adminPhone = $row['adminPhone'];
			$adminId = $row['adminId'];
			$adminName = $row['adminName'];
			$groupDesc = $row["groupDesc"];
			$groupStory = $parsedown->text($row["groupStory"]);
			$createdDate = $row["createdDate"];
			$contributionDate = $row["expirationDate"];
			$visits = $row["visits"];
			$newVisit = $visits + 1;
			$sqlVisits = $db->query("UPDATE `groups` SET visits = '$newVisit' WHERE id ='$groupID'");
			
			
			$sqlbalance = $outCon->query("SELECT * FROM groupbalance WHERE groupId = '$groupID'");
			$rowbalance = mysqli_fetch_array($sqlbalance);
			$currentAmount = $rowbalance['Balance'];
			
			$prog = $currentAmount*100/$targetAmount;
			$progressing =$prog + (20*$prog/100);
			
		}
		$sqladminId = $db->query("SELECT id adminId, gender adminGender FROM users WHERE id = '$adminId'");
		$rowAdminId = mysqli_fetch_array($sqladminId);
		$adminGender = $rowAdminId["adminGender"];
		
		if($currentAmount == ''){
			$currentAmount = 0;
		}
	}
else{
	echo 'nothig isset';
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta property="fb:app_id"             content="1822800737957483">
	<meta property="og:url"                content="https://www.uplus.rw/f/i<?php echo $groupID?>" >
	<meta property="og:type"               content="article" >
	<meta property="og:title"              content="<?php echo $groupName?> (<?php echo number_format($targetAmount);?> Rwf)">
	<meta property="og:description"        content="<?php echo $groupDesc?>">
	<meta property="og:image"              content="https://www.uplus.rw/temp/group<?php echo $groupID;?>.jpeg" >

	<meta name="description" content="<?php echo $groupDesc?>">



	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<title>uplus</title>

	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="icon" sizes="192x192" href="images/android-desktop.png">

	<!-- Add to homescreen for Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

	<!-- Tile icon for Win8 (144x144 + tile color) -->

	<link rel="shortcut icon" href="images/favicon.png">
	<link rel="canonical" href="https://www.uplus.rw/f/i<?php echo $groupID?>">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!--<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.green-indigo.min.css" />
	-->
	<link rel="stylesheet" href="css/style.css" /><!-- <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.green-indigo.min.css" />
	 --><!-- 
	<link rel="stylesheet" href="css/material.deep_purple-pink.min.css"> -->

	<link rel="stylesheet" href="../frontassets/css/bootstrap.css">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<link rel="stylesheet" href="styles.css">



	<!-- Add jQuery library -->
	<script type="text/javascript" src="fancy/jquery-1.10.2.min.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="fancy/jquery.fancybox.pack.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancy/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancy/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="fancy/jquery.fancybox-thumbs.js?v=1.0.7"></script>


	<script type="text/javascript">
		$(document).ready(function() {
			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.php',
					type : 'iframe',
					padding : 5
				});
			});

			
			$('.fancybox').fancybox();
			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				padding: 0,
				
				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,
				
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});
		});
	</script>
</head>

<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">

				<div class="dialogHeader">
					Money Transfer
				</div>
			<div id="contBody">
				<div style="padding:0px; border-bottom: solid #ccc 0.1px;" >
					<div class="sendMoneyProgress">
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
								<span style="font-size: 14px; ">Amount <span class="required">*</span>
								</span>
								<input placeholder="Rwf..." class="form-control input-field" name="field1" type="number" id="contributedAmount">
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
					<button type="button" style="background-color: #eee; color:#757575;cursor: default;" class="mdl-button btn-default disabled">Back</button>
					<button type="button" style="float:right;background-color: #00897b;" class="mdl-button btn-success">Next</button>
				</div>
			</div>
		</div>
			
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/popup-polyfill.min.js"></script>

	<script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	
  <!-- MDL Progress Bar with Buffering -->
<script>
document.getElementById('shareBtn').onclick = function() {
	//alert('done');
  FB.ui({
	method: 'share',
	mobile_iframe: true,
	display: 'popup',
	href: 'https://www.uplus.rw/f/index.php?groupId=<?php echo $groupID?>',
	hashtag: '#kusanya',
	quote: 'You can contribute with MTN mobile money, Tigo Cash and Visa Card.',
  }, function(response){});
}
</script>
<script>
function changeTab(tab)
{
	var twitter="('http://twitter.com/share?url=https://www.uplus.rw/f/i<?php echo $groupID;?>;text=<?php echo $adminName;?> Is rasing <?php echo number_format($targetAmount);?>Rwf for <?php echo $groupName;?>. You can contribute using MTN mobile money, Tigo cash, Visa cards here:;size=l&amp;count=none', '_blank','toolbar=no, scrollbars=no, menubar=no, resizable=no, width=700,height=220')";
	var shares = '<div class="mdl-card mdl-cell mdl-cell--3-col fbShare" id="shareBtn">Share facebook</div>'
	+'<div onclick="javascript:window.open'+twitter+'" class="mdl-card mdl-cell mdl-cell--3-col twtShare">share Twitter</div>';
	if(tab == 1)
	{
		document.getElementById('tabing').innerHTML = 
			'<div class="activeTab mdl-card mdl-cell mdl-cell--3-col">'
				+'<span class="currentSpan" style="height: 20%"></span>Story'
			+'</div>'
			+'<div onclick="openCity(event, 2), changeTab(tab=2)" class="otherTab mdl-card mdl-cell mdl-cell--3-col ">'
				+'<span class="updatesLogo"><i class="fa fa-globe"></i></span>'
				+'UPdates'
			+'</div>'+shares;
	}
	else if(tab == 2)
	{
		document.getElementById('tabing').innerHTML = 
			'<div onclick="openCity(event, 1),  changeTab(tab=1)" class="otherTab mdl-card mdl-cell mdl-cell--3-col">'
				+'Story'
			+'</div>'
			+'<div  class="activeTab  mdl-card mdl-cell mdl-cell--3-col ">'
				+'<span class="updatesLogo"><i class="fa fa-globe"></i></span>'
				+'<span class="currentSpan" style="height: 20%"></span>UPdates'
			+'</div>'+shares;
	}
}	
</script>
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<?php 
	$nowthis = date_create($contributionDate);
	$year = date_format($nowthis, "Y");
	$month = date_format($nowthis, "n");
	$day = date_format($nowthis, "j");
?>
<script>
	$(document).ready(function(){
	var year1 = " <?php echo $year ?> ";
	var month2 = " <?php echo $month ?> ";
	var day3 = " <?php echo $day ?> ";
	$('#countDown').revolver({
		year : year1,	
		month : month2,	
		day : day3,	
	});
	});
</script>

<script type="text/javascript" src="../assets/js/timer.js"></script>
<script src="js/js.js"></script>

<!-- SEND METHOD AND GET ME THE PHONE INPUT-->
<script>
function frontpayement2(method)
{
	var forGroupId = <?php echo $groupID;?>;
	var adminName = '<?php echo $adminName;?>';
	var adminId = '<?php echo $adminId;?>';
	var contributedAmount =$("#contributedAmount").val();
	var currency =$("#currency").val();
	//alert(adminName);
	/*if (!currency == 'RWF') 
		{
			document.getElementById('amountError').innerHTML = 'For MTN and TIGO we only RWF currency';
			return false;
		}
	*/
	if (contributedAmount == null || contributedAmount == "") 
		{
			document.getElementById('amountError').innerHTML = 'Contributed Amount must be  out';
			return false;
		}
	if (contributedAmount < 500) 
		{
			document.getElementById('amountError').innerHTML = 'The minimum contribution allowed is 500 Rwf';
			return false;
		}
		document.getElementById('contBody').innerHTML = '<div style="margin: 100px;">Loading...</div>';	
		$.ajax({
			type : "GET",
			url : "payments.php",
			dataType : "html",
			cache : "false",
			data : {
				method : method,
				contributedAmount : contributedAmount,
				forGroupId1 : forGroupId,
				adminName 	: adminName,
				adminId		: adminId
			},
			success : function(html, textStatus){
				$("#contBody").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
function backBtn()
{
	var back =$("#amountdone").val();
	var method =$("#opperator").val();
	document.getElementById('contBody').innerHTML = '<div style="margin: 100px;">Loading...</div>';	
		$.ajax({
			type : "GET",
			url : "payments.php",
			dataType : "html",
			cache : "false",
			data : {
				back : back,
				backMethod : method,
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

<!-- SUBMIT VISA CARDS-->
<script>
function payVisa()
 {
	var contributorEmail =$("#senderEmail").val();
	var emailsArray = contributorEmail.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
	if (emailsArray != null && emailsArray.length) {
		document.getElementById('payform').submit();
		document.getElementById('contBody').innerHTML ='<br/><br/><br/><div class="loader"></div> <br/><br/><br/>';
	}else{
		document.getElementById('sendingError').innerHTML = '<div id="alowMtn" style="color: #ffe500;font-size: 20px; padding: 10px;">'
					+'Please Provide a valid email</div>';
	}
}
</script>

<!-- GET ME THE DONE BTN -->
<script>
function handleChange(input)
{
	var method = document.getElementById('opperator').value;
	if (method == '1') 
	{
		var opperator = 'MTN';
		var errorcolor = '#e91e63;';
	}
	else if (method == '2') 
	{
		var opperator = 'TIGO';
		var errorcolor = '#fff;';
	}
	else if (method == '3') 
	{
		var opperator = 'AIRTEL';
		var errorcolor = '#fff;';
	}
    if ( input.value < 1000000) 
	{
		document.getElementById('alowMtn').innerHTML = '<div style="color: '+errorcolor+'"> Keep typing till you get a NEXT button</div>';
		document.getElementById('doneMtn').innerHTML = '<button type="button" style="background-color: #eeeeee; color: #777;" class="mdl-button btn-success">NEXT</button>';
	}
    else if (input.value > 9999999) 
	{
		document.getElementById('alowMtn').innerHTML = '<div style="color: '+errorcolor+'">Please enter a valid '+opperator+' Rwanda number</div>';
		document.getElementById('doneMtn').innerHTML = '<button type="button" style="background-color: #eeeeee; color: #777;" class="mdl-button btn-success" onclick="firtFinish()">NEXT</button>';
	}
	else
	{
		document.getElementById('alowMtn').innerHTML = '';
		document.getElementById('doneMtn').innerHTML = '<button class="mdl-button btn-success" style="background-color: #00897b;" onclick="kwishura()"><i class="icon md-check"></i>NEXT</button>';
	}
}
function firtFinish(){
	alert('Pleas, fist fill in the phone number propertly!');
}

$.get("http://ipinfo.io", function (response) {
pageId	= <?php echo $groupID;?>;
//alert(pageId);
country = response.country;
region 	= response.region;
city 	= response.city;
ip 		= response.ip;
loc 	= response.loc;
org 	= response.org;
var visited = 1;
$.ajax({
		type : "GET",
		url : "payments.php",
		dataType : "html",
		cache : "false",
		data : {
			visited	 : visited,
			pageId	 : pageId,
			country  : country,
			region 	 : region,
			city 	 : city,
			ip 		 : ip,	
			loc 	 : loc, 	
			org 	 : org 
		},
		success : function(html, textStatus){
			//console.log('tracked');
		},
		error : function(xht, textStatus, errorThrown){
			//console.log('not tracked');
		}
	});
}, "jsonp");


</script>
</body>
</html>
