<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);


if(!$_GET['groupId']){
	//No event u are looking for
	die("Click on appropriate event");
}

include "../db.php";
include_once 'functions.php';
$eventId = $eventDb->real_escape_string($_GET['groupId']??"");
$eventLink = 'https://uplus.rw/event/'.$eventId;
// var_dump($eventId);
if($eventId[0] == 'l'){
	echo "string";
	die(0);
}

$host = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/";

//Gettting data on events
$rowEvents = $eventData = get_event($eventId);
if($eventData){
	$eventName 		= $rowEvents["Event_Name"];
	$eventImage 	= $host.$rowEvents["Event_Cover"];
	$eventDesc		= $rowEvents['Event_Desc'];
	$eventStart		= $rowEvents['Event_Start'];
	$eventLocation	= $rowEvents['Event_Location'];

	$prog = 10;
	$prog = round($prog);
	if($prog < 10){$size=10;} else{$size=$prog;}

	$tickets = $eventData['tickets'];

	$organiser = $eventData['organizer'];
	$organizerImage = $host.$organiser['organizer_image'];
	$organizerName = $organiser['organizer_name'];
	$organizerPhone = $organiser['organizer_phone'];
	$organizerEmail = $organiser['organizer_email'];
	$organizerWebsite = $organiser['organizer_website'];





}else{
	$sqlEvents = $eventDb->query("SELECT * FROM akokanya WHERE id = \"$eventId\" ");
	$rowEvents = $sqlEvents->fetch_assoc();			

	$eventId 		= $rowEvents['id'];
	$eventName 		= $rowEvents["name"];
	$eventImage 	= "http://akokanya.com/".$rowEvents["file2"];
	$eventDesc		= $rowEvents['details'];
	$eventStart		= $rowEvents['to_time'];
	$allSeats		= $rowEvents['available_place'];
	$boockedSeats	= $rowEvents['counting'];
	$eventLocation	= $rowEvents['location'];

	$prog = 10;
	$prog = round($prog);
	if($prog < 10){$size=10;} else{$size=$prog;}

}

$social_media_message = "";
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="fb:app_id"             content="1822800737957483">
	<meta property="og:url"                content="https://www.uplus.rw/event/<?php echo $eventId?>" >
	<meta property="og:type"               content="article" >
	<meta property="og:title"              content="<?php echo $eventName?>">
	<meta property="og:description"        content="<?php echo $eventDesc?>">
	<meta property="og:image"              content="<?php echo $eventImage;?>" >

	<meta name="description" content="<?php echo $eventDesc?>">



	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<title>Event | Uplus</title>

	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="icon" sizes="192x192" href="images/android-desktop.png">

	<!-- Add to homescreen for Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

	<!-- Tile icon for Win8 (144x144 + tile color) -->

	<link rel="shortcut icon" href="images/favicon.png">
	<link rel="canonical" href="https://www.uplus.rw/event/<?php echo $eventId?>">
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

<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base" style='' font-family: "Helvetica Neue",HelveticaNeueRoman,Helvetica,Arial,sans-serif!important;'>
<script>
/*  window.fbAsyncInit = function() {
	FB.init({
	  appId      : '1822800737957483',
	  xfbml      : true,
	  version    : 'v2.8'
	});
	FB.AppEvents.logPageView();
  };

  (function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "//connect.facebook.net/en_US/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
*/
</script>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
	<header  class="mdl-layout__header mdl-layout__header--scroll" style="height: 64px;background: #007569; position: fixed;box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);  transition: all 280ms cubic-bezier(0.4, 0, 0.2, 1);">
		<nav class="uk-navbar">
			<div class="navDiv">
				<a href="../index.php" ><img src="../frontassets/img/logo_main_3.png" class="logo" alt="" width="71" class="dense-image dense-loading"></a>
			</div>
		</nav>
	</header>
	
	<main class="mdl-layout__content" style="" >
		<div class="mdl-layout__tab-panel is-active" id="overview" style="padding: unset; padding-top: unset;">
			<div style="width: 100%;height: 100%;max-width: 1200px;margin: 0 auto; ">
				<div class="leftSidePanel" style="position: relative; width: 20%; margin-left: 0px;float: left; padding-top: 80px;">
					<div>
						<div>Event organiser</div>
						<?php  ?>
						<div class="profile" style="background-image: url(<?php echo $organizerImage ?>);"></div>
						<div style="padding: 15px 0;">
							<table border="0">
								<tr style="border-bottom: 1px #ccc solid;">
									<td>
										<b><?php echo $organizerName; ?></b>
									</td>
								</tr>
								<tr>	
									<td onclick="alert('We are still working on this module.')" style="cursor: pointer;">
									<i  class="fa fa-envelope"></i>
										Contact 
										<p><?php echo $organizerPhone; ?></p>
										<p><?php echo $organizerEmail; ?></p>
										<p><a href="<?php echo $organizerWebsite; ?>" target='_blank'><?php echo $organizerWebsite; ?></a></p>
									</td>
								</tr>
							</table>	
						</div>
						<div class="groupMedia">
							<div class="groupMediaTitle">
								<span style="text-align: left;"><i class="fa fa-camera"></i></span>
								<span style="text-align: left;"><a href="javascript:void()" style="font-size: 13px; font-weight: 400;">3 Pictures and Videos</a></span>
							</div>
							<div style="margin: -5px 0 0 -5px; max-height: 176px;overflow: hidden;">
							<p>
								<a class="fancybox-thumbs" title="<?php echo $eventName;?>" data-fancybox-group="thumb" href="<?php echo $eventImage;?>"><span style="background-image: url(<?php echo $eventImage;?>);" class="gallery"></span></a>
								<a class="fancybox-thumbs" title="<?php echo $eventName;?>" data-fancybox-group="thumb" href="<?php echo $eventImage;?>"><span style="background-image: url(<?php echo $eventImage;?>);" class="gallery"></span></a>
								<a class="fancybox-thumbs" title="<?php echo $eventName;?>" data-fancybox-group="thumb" href="<?php echo $eventImage;?>"><span style="background-image: url(<?php echo $eventImage;?>);" class="gallery"></span></a>
							</p>
							</div>
						</div>
					</div>	
				</div>
				<div class="midlePage">
					<section class="section--center mdl-grid mdl-grid--no-spacing" style="margin-bottom: 95px; max-width: 730px;">
						<div class="titleOverlay">
							<div class="fundTitle">
								
								<h6 class="fundDesc"><?php echo $eventDesc;?><br><br></h6>
							</div>
						</div>
						<div class="fundImg" style="background-image: url(<?php echo $eventImage;?>);"></div>
					</section>
			        <section class="section--center contSection" style="margin-top: -100px;">
						<div  style="max-width: 680px;" class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp" style="width: 700px;margin: -140px 0px 0 282px;position: absolute; z-index: 100;">
							<div class="mdl-cell mdl-cell--8-col " style="background: #007569; color: #fff; padding: 7px 25px 7px 25px;">
								<h4 class="fundName"><?php echo $eventName;?></h4>
								<p>Location: <?php echo $eventLocation; ?></p>
								<p>When: <?php echo $eventStart; ?></p>
							</div>
							<!-- <div class="mdl-cell mdl-cell--4-col contribution2" id="contdiv">
							    <span class="sharing">
									<i class="fa fa-share shareicon"></i>
								</span>	
								<span class="contshare">
								</span>
								<span class="sharing">
							    	<i class="fa fa-comment shareicon"></i>
							    </span>
							</div> -->
						</div>	
		        	</section>
					<section id="tabing" class="section--center mdl-grid mdl-grid--no-spacing ">
						<div onclick="openCity(event, '1')" id="defaultOpen" class="mdl-card mdl-cell mdl-cell--3-col activeTab">
							<span class="currentSpan" style="height: 20%"></span>
							<div id="webTabTitle1">TICKETS</div>
							<!-- <div id="mobTabTitle1"><i class="fa fa-group"></i> Members</div> -->
						</div>
						<div onclick="openCity(event, '2'), changeTab(tab=2)" class=" mdl-card mdl-cell mdl-cell--3-col otherTab">
							<span class="updatesLogo"><i class="fa fa-globe"></i></span>
							<div id="webTabTitle2">INFO</div>
							<div id="mobTabTitle2">INFO</div>
						</div>
						<div class="mdl-card mdl-cell mdl-cell--3-col fbShare" id="shareBtn">Share facebook</div>
						<div onclick="javascript:window.open('http://twitter.com/share?url=<?php echo $eventLink; ?>&	text=Get your tickets to <?php echo $eventName ?> via uPlus. You can buy using using MTN mobile money, Tigo cash, Visa cards here:<?php echo $eventLink; ?> size=l&amp;count=none', '_blank','toolbar=no, scrollbars=no, menubar=no, resizable=no, width=700,height=220')" class="mdl-card mdl-cell mdl-cell--3-col twtShare">
							share Twitter</div>
					</section>
					<section class="section--center mdl-grid--no-spacing mdl-shadow--2dp" style="margin: 0 auto; margin-bottom: 10px; max-width: 730px;">
						<div id="1" class="tabcontent mdl-card" style="min-height: 80px;    width: 100%;">
							<div id="tabsCont" style="padding: 12px; ">
								<ul class="demo-list-two mdl-list">
									<?php
										for($n=0; $n<count($tickets); $n++){
											$ticket = $tickets[$n];
											$ticket_name = $ticket['event_property'];
											$ticket_price = $ticket['price'];
											$ticket_numer = $ticket['event_seats'];
											?>
												<li class="mdl-list__item mdl-list__item--two-line">
												    <span class="mdl-list__item-primary-content">
												    	<i class="fas fa-ticket-alt"></i>
												      <!-- <i class="material-icons mdl-list__item-avatar">person</i> -->
												      <span><?php echo $ticket_name." - ".number_format($ticket_price); ?> RWF</span>
												      <span class="mdl-list__item-sub-title"><?php echo $ticket_numer; ?> remaining</span>
												    </span>
												    <span class="mdl-list__item-secondary-content">
												    	<?php
												    		if($ticket_price == 0){
												    			?>
												    			<button class="getTicket btn" data-eventname="<?php echo $eventName; ?>" data-price="<?php echo $ticket_price; ?>" data-ticket="<?php echo $ticket_name ?>" id="contbtn">BOOK</button>
												    			<?php
												    		}else{
												    	?>
												    	<button href="#sendMoney" class="mdl-button mdl-button--raised getTicket fancybox" data-eventname="<?php echo $eventName; ?>" data-price="<?php echo $ticket_price; ?>" data-ticket="<?php echo $ticket_name ?>" id="contbtn">BOOK</button>
												    	<?php } ?>
												    </span>
												  </li>
											<?php
										}
									?>
								  </li>
								</ul>
							</div>
							<div id="membersMob">
								<div id="membersMobCont" style="padding-top: 15px">
								</div>
							</div> 
						</div>
						<div id="2" class="tabcontent">
							<section class="section--center mdl-grid mdl-grid--no-spacing " style="box-shadow:0 1px 1px 0px rgba(0,0,0,.14), 0px 1px 1px -1px rgba(0,0,0,.2), 0 0px 2px 0px rgba(0,0,0,.12);margin-bottom: 10px; max-width: 730px;">
				            	<div class="mdl-card mdl-cell mdl-cell--12-col" id="tabsCont" style="padding: 12px; min-height: unset;">
									<table>
										<tr>
											<td style=" padding-right: 8px;">
														<img src=""></td>
											<td> 
											</td> 
										</tr>
									</table>
								</div> 
							</section>
						</div>
					</section>
				</div>
			</div>
		</div>
	</main>
</div>
<div id="sendMoney">
	<div class="dialogHeader">
		Buy Ticket
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
		<input name="forGroupId" value="<?php echo $eventId;?>" hidden />
		<div class="form-style-2" style="padding: 40px 20px 15px 20px;">
			<label for="field1" style="width: 100%; text-align:center">
				<span style="font-size: 14px; ">Amount <span class="required">*</span>
				</span>
				
					<input value="500000" disabled class="form-control input-field" name="field1" type="number" id="contributedAmount">
					
				
				<span>
					<select HIDDEN disabled style="width: 33%;height: 30px; padding-top: 3px; font-size: 16px;" class="select-field" name="currency" id="currency">
						<option value="RWF">RWF</option>
						<option value="USD">USD</option>
					</select>
				</span>
			</label>
			<h6><div id="amountError" style="color: #f44336;"></div></h6>
			<label for="field1" style="width: 100%; text-align:center">
				<span style="font-size: 14px; ">Payment Method<span class="required">*</span>
				</span>
			</label>
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

		</div>
		<div class="mdl-dialog__actions" id="actionbc" style="padding:15px; display: block;">
			<button type="button" style="background-color: #eee; color:#757575;cursor: default;" class="mdl-button btn-default disabled">Back</button>
			<button type="button" onclick="errorselect()" style="float:right;background-color: #00897b;" class="mdl-button btn-success">Next</button>
		</div>
	</div>
</div>
<div class="modal fade" id="freedialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Book your ticket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<p>Enter your details</p>
      	<div class="form-group">
		    <label for="exampleInputPassword1">Name</label>
		    <input type="text" class="form-control" id="nameInput" placeholder="Enter your name">
		</div>
      	<div class="form-group">
		    <label for="exampleInputEmail1">Email address</label>
		    <input type="email" class="form-control" id="emailInput" placeholder="Enter email">
		</div>
		<div class="form-group">
		    <label for="exampleInputEmail1">Phone number</label>
		    <input type="number" class="form-control" id="phoneInput" placeholder="Enter phone number">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" id="getFreeTicket" class="btn btn-success">REGISTER</button>
      </div>
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
	href: "$eventLink",
	hashtag: '#kusanya',
	quote: 'You can contribute with MTN mobile money, Tigo Cash and Visa Card.',
  }, function(response){});
}
</script>
<script>
function changeTab(tab)
{
	var twitter="('http://twitter.com/share?url=<?php echo $eventLink ?>;text=<?php echo $social_media_message; ?>size=l&amp;count=none', '_blank','toolbar=no, scrollbars=no, menubar=no, resizable=no, width=700,height=220')";
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
	$nowthis = date_create($eventStart);
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
	var forGroupId = <?php echo $eventId;?>;
	var adminName = 'Clement';
	var adminId = '1';
	var contributedAmount =$("#contributedAmount").val();
	var currency =$("#currency").val();
	var minAmount = 100;
	var perPersonType = 100;
	
	if(perPersonType == 'atleast'){
		if (contributedAmount < minAmount) 
			{
				document.getElementById('amountError').innerHTML = 'The minimum contribution for this group is '+minAmount+'Rwf';
				return false;
			}
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
				action: 'back',
				event: <?php echo $eventId; ?>
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
pageId	= <?php echo $eventId;?>;
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

function errorselect(){
	var contributedAmount =$("#contributedAmount").val();
	var minAmount = 100;
	var perPersonType = 1000;
	
	if(perPersonType == 'min'){
		if (contributedAmount < minAmount) 
			{
				document.getElementById('amountError').innerHTML = 'The minimum contribution allowed is 500 Rwf';
				return false;
			}
	}
	if (contributedAmount < 500) 
		{
			document.getElementById('amountError').innerHTML = 'The minimum contribution allowed is 500 Rwf';
			return false;
		}
	document.getElementById('amountError').innerHTML = 'Please choose a payment method';
			return false;
}
$(".getTicket").on("click", function(e){
	//Here we have to show the modal information
	eventName = $(this).data('eventname')
	price = $(this).data('price');
	ticketName = $(this).data('ticket');

	if(price == 0)
	{
		e.preventDefault();
		$("#freedialog").modal('show')
		return 0;
	}else{
		$("#modalTicketAmount").html(price+" Frw");
		$("#contributedAmount").val(price)
	}	

});

//When free ticket modal is submitted
$("#getFreeTicket").on('click', function(e){
	e.preventDefault();

	name = $("#nameInput").val();
	phone = $("#phoneInput").val()
	email = $("#emailInput").val();

	if(name && phone && email){
		//User can be put in database
		$.post('api.php', {action:'free_ticket_submission', name:name, phone:phone, email:email}, function(data){
			try{
				ret = JSON.parse(data);
				if(ret.status){
					alert("REGISTERED");
					setTimeout(function(){
						location.reload()
					}, 1000)
				}
			}catch(e){
				alert(e)
			}
		})
	}else{
		alert("Please add all detail")
	}
})

$("#contbtn")
function log(data){
	console.log(data)
}
</script>
</body>
</html>
