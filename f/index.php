<?php
//require_once 'System.php';
//var_dump(class_exists('System', false));
?>
<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
if (isset($_GET['groupId'])){	
		$groupID = (int)$_GET['groupId'];
		require_once "parsedown/Parsedown.php";
		$parsedown = new parsedown();
		include "../db.php"; 
		$sql2 = $db->query("SELECT * FROM groups WHERE archive is null AND id='$groupID' "); 
		$countAvail = mysqli_num_rows($sql2);
		if($countAvail > 0){
		while($row = mysqli_fetch_array($sql2)){ 
			$groupName = $row["groupName"];
			$groupImage = $row["groupImage"];
			$groupTargetType= $row['groupTargetType'];
			$targetAmount 	= round($row['targetAmount']);
			$perPersonType 	= $row['perPersonType'];
			$perPerson 		= round($row['perPerson']);
			$adminId 		= $row['adminId'];

			$sql3 = $db->query("SELECT * FROM users WHERE id='$adminId' "); 
			$rowAdmin = mysqli_fetch_array($sql3); 

			$adminPhone 	= $rowAdmin['phone'];
			$adminName 		= $rowAdmin['name'];
			$groupDesc 		= $row["groupDesc"];
			$groupStory 	= $parsedown->text($row["groupStory"]);
			$createdDate 	= $row["createdDate"];
			$contributionDate = $row["expirationDate"];
			$visits 		= $row["visits"];
			
			$newVisit 		= $visits + 1;
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
		else
		{
			echo 'This Group Does Not Exist';
			exit();
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
<!---->
	<meta property="fb:app_id"             content="1822800737957483">
	<meta property="og:url"                content="https://www.uplus.rw/f/i<?php echo $groupID?>" >
	<meta property="og:type"               content="article" >
	<meta property="og:title"              content="<?php echo $groupName?> (<?php echo number_format($targetAmount);?> Rwf)">
	<meta property="og:description"        content="<?php echo $groupDesc?>">
	<meta property="og:image"              content="<?php echo $groupImage;?>" >

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
  window.fbAsyncInit = function() {
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
							<div>Group Admin</div>
							<div class="profile" style="background-image: url(../proimg/<?php echo $adminId;?>.jpg);"></div>
							<div style="padding: 15px 0;">
								<table border="0">
									<tr style="border-bottom: 1px #ccc solid;">
										<td>
											<b><?php echo $adminName;?></b>
										</td>
									</tr>
									<tr style="border-bottom: 1px #ccc solid;">
										<td>
											<b style="
												color: #000;
												opacity: 0.5;
											"><i class="fa fa-facebook-square"></i> Facebook Verified</b>
										</td>
									</tr>
									<tr>	
										<td onclick="alert('We are still working on this module.')" style="cursor: pointer;">
										 <i  class="fa fa-envelope"></i>
											Contact <?php if($adminGender == 'male' || $adminGender == 'MALE'){echo 'him';}else{echo 'her';}?>
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
									<a class="fancybox-thumbs" title="<?php echo $groupName;?>" data-fancybox-group="thumb" href="../temp/supper<?php echo $groupID;?>.jpg"><span style="background-image: url(../temp/group<?php echo $groupID;?>.jpeg);" class="gallery"></span></a>
									<a class="fancybox-thumbs" title="<?php echo $groupName;?>" data-fancybox-group="thumb" href="../temp/supper15.jpg"><span style="background-image: url(../temp/group15.jpeg);" class="gallery"></span></a>
									<a class="fancybox-thumbs" title="<?php echo $groupName;?>" data-fancybox-group="thumb" href="../temp/supper7.jpg"><span style="background-image: url(../temp/group7.jpeg);" class="gallery"></span></a>
								</p>
								</div>
							</div>
						</div>	
					</div>
					<div class="midlePage">
						<section class="section--center mdl-grid mdl-grid--no-spacing" style="margin-bottom: 95px; max-width: 730px;">
							<div class="titleOverlay">
								<div class="fundTitle">
									<h4 class="fundName"><?php echo $groupName;?></h4>
									<h6 class="fundDesc"><?php echo $groupDesc;?><br><br></h6>
								</div>
							</div>
							<div class="fundImg" style="background-image: url(<?php echo $groupImage;?>);"></div>
						</section>
				        <section class="section--center contSection">
							<div  style="max-width: 680px;" class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp" style="width: 700px;margin: -140px 0px 0 282px;position: absolute; z-index: 100;">
								<div class="mdl-cell mdl-cell--8-col " style="background: #007569; color: #fff; padding: 7px 25px 7px 25px;">
									To date<i style="float: right;">Target</i>
									<div style="font-size: 20px; font-weight: 800;">
										<?php 
											echo number_format($currentAmount);
										?>RWF
										<b style="float: right;">

											<?php 
											if($groupTargetType == 'target'){
												echo number_format($targetAmount).'Rwf';
												}
											elseif($groupTargetType == 'any'){
												echo 'any amount';
												}
											?></b>
									</div>
									<div class="progress" style="background-color: #e1eae9;">
									
										<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $prog;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php if($prog < 10){echo 10;} else{echo $prog;}?>%">
										  <?php echo number_format($prog);?>%
										</div>
									</div>
									<span style="float: right" id="countDown"></span>
								</div>
								<div class="mdl-cell mdl-cell--4-col contribution2" id="contdiv">
    <span class="sharing">
		<i class="fa fa-share shareicon"></i>
	</span>	
	<span class="contshare">
    		<button  href="#sendMoney" class="mdl-button mdl-button--raised fancybox" id="contbtn">Contribute Now</button>
								</span>
								<span class="sharing">
    	<i class="fa fa-comment shareicon"></i>
    </span>
</div>
								</div>	
				        </section>
						
						<section id="tabing" class="section--center mdl-grid mdl-grid--no-spacing ">
							<div onclick="openCity(event, '1')" id="defaultOpen" class="mdl-card mdl-cell mdl-cell--3-col activeTab">
								<span class="currentSpan" style="height: 20%"></span>
								Story 
							</div>
							<div onclick="openCity(event, '2'), changeTab(tab=2)" class=" mdl-card mdl-cell mdl-cell--3-col otherTab">
								<span class="updatesLogo"><i class="fa fa-globe"></i></span>
								UPdates
							</div>
							<div class="mdl-card mdl-cell mdl-cell--3-col fbShare" id="shareBtn">Share facebook</div>
							<div onclick="javascript:window.open('http://twitter.com/share?url=https://www.uplus.rw/f/i<?php echo $groupID;?>;text=<?php echo $adminName;?> Is rasing <?php echo number_format($targetAmount);?>Rwf for <?php echo $groupName;?>. You can contribute using MTN mobile money, Tigo cash, Visa cards here:;size=l&amp;count=none', '_blank','toolbar=no, scrollbars=no, menubar=no, resizable=no, width=700,height=220')" class="mdl-card mdl-cell mdl-cell--3-col twtShare">
								share Twitter</div>
						</section>
						<section class="section--center mdl-grid--no-spacing mdl-shadow--2dp" style="margin: 0 auto; margin-bottom: 10px; max-width: 730px;">
							<div id="1" class="tabcontent mdl-card" style="min-height: 80px;    width: 100%;">
								<div id="tabsCont" style="padding: 12px; ">
										<?php echo $groupStory;?>
										
									</div> 
							</div>
							<div id="2" class="tabcontent">
								<?php
									$sqlgetUpdates = $db->query("SELECT * FROM updatestransaction WHERE groupId = '$groupID' ORDER  BY id DESC");
									 $countUpdates = mysqli_num_rows($sqlgetUpdates);
									if($countUpdates > 0){
										while($rowUpdates = mysqli_fetch_array($sqlgetUpdates)){
								?>
								<section class="section--center mdl-grid mdl-grid--no-spacing" style="box-shadow:0 1px 1px 0px rgba(0,0,0,.14), 0px 1px 1px -1px rgba(0,0,0,.2), 0 0px 2px 0px rgba(0,0,0,.12);margin-bottom: 10px; max-width: 730px;">
					            	<div class="mdl-card mdl-cell mdl-cell--12-col" id="tabsCont" style="padding: 12px; min-height: unset;">
										<table>
											<tr>
												<td style=" padding-right: 8px;">
													<img src=""></td>
												<td>
													<small style="#657786">On (<?php echo strftime("%d %b", strtotime($rowUpdates['createdDate']));?>)</small>
													<p style="font-size: 16px; font-weight: normal;line-height: 1.38;"><?php echo $rowUpdates['body'];?>.</p> 
												</td> 
											</tr>
										</table>
										<textarea hidden><iframe src="https://www.uplus.rw/f/embed<?php echo $groupID;?>" width="300px" height="445px" frameborder="0" scrolling="no"></iframe></textarea>
									</div> 
									
								</section>
								<?php }
									}?>
							
			          
								<section class="section--center mdl-grid mdl-grid--no-spacing " style="box-shadow:0 1px 1px 0px rgba(0,0,0,.14), 0px 1px 1px -1px rgba(0,0,0,.2), 0 0px 2px 0px rgba(0,0,0,.12);margin-bottom: 10px; max-width: 730px;">
					            	<div class="mdl-card mdl-cell mdl-cell--12-col" id="tabsCont" style="padding: 12px; min-height: unset;">
										<table>
											<tr>
												<td style=" padding-right: 8px;">
															<img src=""></td>
												<td>
													<p style="font-size: 14px;font-weight: normal;line-height: 1.38;">On (<?php echo '<small>'.$createdDate.'</small>) <br/>'; if($adminGender == 'male'){echo '<a href="javascript:void()" style="color: #006157;">Mr. ';}else{echo '<a href="javascript:void()" style="color: #006157;">Mrs. ';} echo ''.$adminName.'</a>';?>.<span style="color:#90949c">Created this contribution group.</span><p> 
												</td> 
											</tr>
										</table>
									</div> 
								</section>
							</div>
						</section>
						<section class="section--center mdl-grid mdl-grid--no-spacing" style="margin-bottom: 30px; max-width: 730px;">
							<div class="fb-comments" data-href="https://www.uplus.rw/f/index.php?groupId=<?php echo $groupID;?>" data-width="650" data-numposts="5"></div>
							<div class="tab">
							</div>
						</section>
					</div>
					<div class="rightSidePanel" style="width: 20%; float: left; padding-top: 80px;">
						<div>
							<h5 style="text-align: center; font-size: 17px;"><i class="fa fa-group"></i> <?php 
													$sqlcountcontr = $outCon->query("SELECT `amount` FROM `transactionsview` WHERE `operation` = 'debit' and `forGroupId` = '$groupID' AND status = 'Approved' OR 'COMPLITEAAA'");
													echo $countContr = mysqli_num_rows($sqlcountcontr);
													?> Contributors</h5><hr style="margin-top: 18px;margin-bottom: 20px;border: 0; border-top: 1px solid #616161;">
							<div>
								<?php 
									$sqlcontributors = $outCon->query("SELECT `amount`, actorName FROM `transactionsview` WHERE `operation` = 'debit' and`forGroupId` = '$groupID' AND status = 'Approved' ORDER BY amount DESC limit 5");
									$ncontrib = 0;
									while($row = mysqli_fetch_array($sqlcontributors))
									{
										$ncontrib++;
										echo '<div style="padding-bottom: 15px;">
										<i class="fa fa-user-circle" style="
										color: #007569;
										float: left;
										font-size: 32px;
										"></i>
										<div style="padding-top: 5px;padding-left: 40px;">'.$ncontrib.' <a style="
										font-weight: 400;
										">'.$row['actorName'].'</a>: '.number_format($row['amount']).' Rwf</div>
										</div>';
									}
									if($countContr > 5)
									{
										$leftmore = $countContr - 5;
										echo'
										<div style="text-align: center"><a style="
										font-weight: 400;
										"href="#">Show me other '.$leftmore.' more</a></div>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
		        <!--<footer class="mdl-mega-footer" style="background: #007569 !important;z-index: 50;position: relative;">
		          <div class="mdl-mega-footer--bottom-section">
		            <div class="mdl-logo">
		              Copyright © 2016 uplus mutual partner, All rights reserved.
		            </div>
		          </div>
		        </footer>-->
		      </main>
		    </div>
			<div id="sendMoney">
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
				<input name="forGroupId" value="<?php echo $groupID;?>" hidden />
				<div class="form-style-2" style="padding: 40px 20px 15px 20px;">
					<label for="field1" style="width: 100%; text-align:center">
						<span style="font-size: 14px; ">Amount <span class="required">*</span>
						</span>
						<?php 

						if($perPersonType=='atleast')
						{	?>
							<input min="<?php echo $perPerson;?>" value="<?php echo $perPerson;?>" class="form-control input-field" name="field1" type="number" id="contributedAmount">
							<?php 
						}
						elseif($perPersonType=='fixed')
						{	?>
							<input value="<?php echo $perPerson;?>" disabled class="form-control input-field" name="field1" type="number" id="contributedAmount">
							<?php 
						}
						else
						{	?>
							<input placeholder="Rwf..." class="form-control input-field" name="field1" type="number" id="contributedAmount">
							<?php 
						}
						?>
						
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
	var minAmount = <?php echo $perPerson;?>;
	var perPersonType = '<?php echo $perPersonType;?>';
	
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

function errorselect(){
	var contributedAmount =$("#contributedAmount").val();
	var minAmount = <?php echo $perPerson;?>;
	var perPersonType = '<?php echo $perPersonType;?>';
	
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

</script>
</body>
</html>
