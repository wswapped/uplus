<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="icon" type="image/png" href="frontassets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="frontassets/img/favicon-32x32.png" sizes="32x32">

    <title>Uplus</title>

    <link rel="stylesheet" href="frontassets/bower_components/uikit/css/uikit.almost-flat.min.css" media="all">
	<link rel="stylesheet" href="frontassets/css/main.css" media="all">
	

	<link rel="stylesheet" href="frontassets/css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<link rel="stylesheet" href="frontassets/css/style.css" media="all">
	<script src="frontassets/js/typed.js" type="text/javascript"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function(){

			Typed.new("#typed", {
				stringsElement: document.getElementById('typed-strings'),
				typeSpeed: 30,
				backDelay: 1200,
				loop: false,
				contentType: 'html', // or text
				// defaults to null for infinite loop
				loopCount: null,
				callback: function(){ foo(); },
				resetCallback: function() { newTyped(); }
			});

			var resetElement = document.querySelector('.reset');
			if(resetElement) {
				resetElement.addEventListener('click', function() {
					document.getElementById('typed')._typed.reset();
				});
			}

		});

		function newTyped(){ /* A new typed object */ }

		function foo(){ console.log("Callback"); }
	</script>
<link rel="stylesheet" href="frontassets/css/login.css" />
	<link rel="stylesheet" href="frontassets/css/bootstrap.css">
</head>
<body >
    <!-- navigation -->
<script>// Facebook
function registerFb()
{
	var targetAmount	= document.getElementById('targetAmount').value;
	var targetPerPerson	= document.getElementById('targetPerPerson').value;
	var fundName	 	= document.getElementById('fundName').value;
	var fundPhone	 	= document.getElementById('fundPhone').value;
	var fundBank	 	= document.getElementById('fundBank').value;
	var fundAccount	 	= document.getElementById('fundAccount').value;
	
	
	
	document.getElementById('passage').innerHTML =''
	+'<input type="hidden" id="targetAmount" value="'+targetAmount+'"/>'
	+'<input type="hidden" id="targetPerPerson" value="'+targetPerPerson+'"/>'
	+'<input type="hidden" id="fundName" value="'+fundName+'"/>'
	+'<input type="hidden" id="fundPhone" value="'+fundPhone+'"/>'
	+'<input type="hidden" id="fundBank" value="'+fundBank+'"/>'
	+'<input type="hidden" id="fundAccount" value="'+fundAccount+'"/>'
	
	
	document.getElementById('makegroupBody').innerHTML ='<div class="slide_content_a" style="height: 350px; background: #3b5998; text-align: center;" id="slide_content_a"><div class="loader"></div></div>';
	document.getElementById('makegroupBody').innerHTML =
	'<div class="btnHolder" style="padding: 0px 45px; " id="loginResults">'
		+'<div id="login" onlogin="checkLoginState();">'
			+'<button class="btn btn-block btn-social btn-facebook btn-flat">'
				+'<i class="fa fa-facebook"></i> Sign in using Facebook'
			+'</button>'
		+'</div>'
		+'<br/><button class="btn btn-block btn-social btn-google btn-flat" data-onsuccess="onSignIn" data-gapiscan="true" data-onload="true"><i class="fa fa-google-plus"></i> Sign in using Google+</button><br>'
		+'<button  onclick="getPin()" class="btn btn-block btn-social btn-mobile btn-flat"><i class="fa fa-mobile"></i> Sign in using SMS</button>'
	+'</div>';
	
	function statusChangeCallback(response) 
	{
		if (response.status === 'connected') 
		{
		  testAPI();
		} 
		else if (response.status === 'not_authorized') 
		{
			alert('you are logedin but not connectd');
			document.getElementById('login').innerHTML = 
			'<button class="btn btn-block btn-social btn-facebook btn-flat">'
			+'<i class="fa fa-facebook"></i>Sign up using Facebook</button></div>';
		} 
		else 
		{
			//alert('problems');
		}
	}
	
	function checkLoginState()
	{
		alert('colled checkLoginState');
		FB.getLoginStatus(function(response) {
		  statusChangeCallback(response);
		});
	}

	window.fbAsyncInit = function()
	{
	  FB.init({
		appId      : '1822800737957483',
		cookie     : true,  // enable cookies to allow the server to access 
							// the session
		xfbml      : true,  // parse social plugins on this page
		version    : 'v2.8' // use graph api version 2.8
	  });
		
	  FB.getLoginStatus(function(response) {
		 // alert('in window fb.getLoginStatus response sen statusChangeCallback');
		statusChangeCallback(response);
	  });

	  };
}
</script>

<script>
  //1 Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
	
  }(document, 'script', 'facebook-jssdk'));

</script>  

    <header id="header_main">
        <nav class="uk-navbar">
            <div class="uk-container uk-container-center">
                <a href="#" class="uk-float-left" id="mobile_navigation_toggle" data-uk-offcanvas="{target:'#mobile_navigation'}"><i class="material-icons">&#xE5D2;</i></a>
                <a href="index.php" class="uk-navbar-brand">
                    <img src="frontassets/img/logo_main.png" alt="" width="71" height="15">
                </a>
                <a href="login.php" class="md-btn md-btn-primary uk-navbar-flip header_cta uk-margin-left">SIGN IN</a>
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav" id="main_navigation">
                        <li>
                            <a href="#sect-overview">
                                Overview
                            </a>
                        </li>
                        <li>
                            <a href="#sect-dothis">
                                What can u Do?
                            </a>
                        </li>
                        <li>
                            <a href="#sect-fund" class="uk-navbar-nav-subtitle">
                                <?php 
								include('db.php');
								$sql= $outCon->query("SELECT sum(balance) totalbalance FROM `groupbalance`");
								$balancerow = mysqli_fetch_array($sql);
								echo number_format($balancerow['totalbalance']);?>
								Rwf
                                <div>Now Raised on Uplus</div>
                            </a>
                        </li>
                        <li>
                            <a href="#sect-team">
                                in-Media
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="mobile_navigation" class="uk-offcanvas">
        <div class="uk-offcanvas-bar">
            <ul>
                <li>
					<a href="#sect-overview" data-uk-smooth-scroll="{offset: 48}">
						<span class="menu_icon"><i class="material-icons">&#xE417;</i></span>
						<span class="menu_title">Overview</span>
					</a>
				</li>
				<li>
					<a href="#dothis" data-uk-smooth-scroll="{offset: 48}">
						<span class="menu_icon"><i class="material-icons">&#xE896;</i></span>
						<span class="menu_title">What can u Do?</span>
					</a>
				</li>
				<li>
					<a href="#raised" class="uk-navbar-nav-subtitle" data-uk-smooth-scroll="{offset: 48}">
						<span class="menu_icon"><i class="material-icons">&#xE227;</i></span>
						<span class="menu_title"><?php echo number_format($balancerow['totalbalance']);?> Rwf<small>Now Raised on Uplus</small></span>
					</a>
				</li>
				<li>
					<a href="#sect-team" data-uk-smooth-scroll="{offset: 48}">
						<span class="menu_icon"><i class="material-icons">&#xE7FB;</i></span>
						<span class="menu_title">Partners</span>
					</a> 
				</li>
            </ul>
        </div>
    </div>

    <section class="banner" id="sect-overview">
        <div>
            <ul class="uk-slideshow" style="height: 480px;">
                <li style=" background-repeat: no-repeat;
    background-attachment: fixed;
	background-image: url(&quot;frontassets/img/slider/car2.jpg&quot;);height: 480px;" aria-hidden="false" class="uk-active">
                    <span class="overlay">
					</span>
					
					<div style="height: 230px;position: absolute;
							width: 590px;
							margin: 77px 0px 0 60px;">
							
									
						<h1 class="heading text-uppercase" style='color: #fff;
							margin: 0 0 18px;
							font: 700 45px/60px "Ubuntu","Helvetica Neue",Helvetica,Arial,sans-serif;'><br>
											Raise money<br>
							
							<span id="typed" style="white-space:pre;"></span></h1>
						<span class="divider white"></span>

						<span class="arrow" style="height: 134px;
							background-image: url(frontassets/img/arrow.png);
							position: absolute;
							width: 300px;
							background-repeat: no-repeat;
							margin: -15px 0 0 410px;"></span>
																		
					</div>
					<div style="color: #000; " class="uk-container uk-container-center" id="moreCard">
                        <div id="status">
							<div class="slide_content_a" id="slide_content_a">
								<div class="makegroupHeader">
									<h2 class="slide_header" id="slide_header">UPLUS</h2>
									<h4 class="text-center" style="color: #696969;margin: 0 0 30px;">
										Raise money from friends and family here!
									</h4>
								</div>
								<div class="makegroupBody" id="makegroupBody">
									<table  width="100%" cellpadding="100px">
										<tr>
											<td width="33.3%"><label>Choose a Reason: </label></td>
											<td width="33.3%">
											<select style="width: 100%;" id="fundTag" placeholder="for">
												<option></option>
												<option>Wedding</option>
												<option>Party</option>
												<option>Event</option>
												<option>Picnic</option>
												<option>Bithday Surprise</option>
												<option>Medecine</option>
												<option>Funeral</option>
												<option>School Fees</option>
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
												<select style="width: 100%;"  id="targeted" onchange="changeTarget()">
													<option value="target">Exactly</option>
													<option value="any">Any Amount</option>
												</select>
											</td>
											<td width="33.3%" id="changeTargetd">
												<input id="isTargetChanged" hidden value="yes">
												<input id="raiseAmount" type="number" placeholder="0.00"/> 
											</td>
										</tr>
										<tr>
											<td></td><td></td><td style="color: red" id="amountError"></td>
										</tr>
										<tr>
											<td width="33.3%">Amount per person</td>
											<td width="33.3%">
												<select style="width: 100%;" id="perPerson" onchange="changeTargetPerPerson()">
													<option value="target">Exactly</option>
													<option value="atleast">Atleast</option>
													<option value="any">Any Amount</option>
												</select>
											</td>
											<td width="33.3%" id="changePerPerson">
												<input id="isTargetPPChanged" hidden value="yes">
												<input id="amountPerPerson" style="width: 100%;" type="number" placeholder="0.00"/> 
											</td>
										</tr>
										<tr>
											<td></td><td></td><td style="color: red" id="amountPerPersonError"></td>
										</tr>
										<tr>
											<td></td><td id="amountError"></td>
										</tr>
									</table>
								</div>
								<div class="makegroupFooter" id="makegroupFooter" style="border-top: 1px solid #a6d2ce; height: 70px;
    border-radius: 0 0 4px 4px; padding: 10px 25px 10px 25px;">
									
									<span style="float: right">
										<a href="javascript:void()" onclick="raise()" class="md-btn md-btn-large md-btn-warning">Raise</a>
									</span>
								</div>
							</div>
						</div>
					</div>
				</li>
           </ul>
        </div>
    </section>

    <section id="sect-dothis" onclick="smoothScroll(document.getElementById('sect-dothis'))"" class="section section_dark" style="padding: unset;">
        <div class="uk-grid">
            <div class="uk-width-1-3 currentHeader customheader">
			<span class="currentSpan" style="left:0;"></span>CONTRIBUTE</div>
            <div class="uk-width-1-3 uncurrentHeader customheader" onclick="changeserv(tab=2)">SAVE</div>
            <div class="uk-width-1-3 uncurrentHeader customheader" onclick="changeserv(tab=3)">INVEST</div>
        </div>
    </section>

	<section id="sect-fund" class="section section_gallery md-bg-blue-grey-50">
        <div id="actions" class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible',delay:300,topoffset:-150}">
            <h2 class="heading_c uk-margin-medium-bottom uk-text-center-medium">
               Public Contributions
            </h2>
			
			
			
				<?php
					echo '<ul class="uk-grid uk-grid-small  uk-grid-width-medium-1-3 uk-grid-width-large-1-3">';
						
					include 'db.php';
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
									
									<div id="heart'.$groupID.'">
										<i class="uk-icon-heart uk-icon-medium md-color-white heart">
											<div id="likes'.$groupID.'" class="likesCount">
												<span class="likes" onclick="likeit(likes='.$likes.', likeid='.$groupID.')">'.$likes.'</span>
											</div>
										</i>
									</div>
									
									
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
								<!--<script>
									(function truncate(){
										String.prototype.trunc = 
										function(n){
											return (this.length > n) ? this.substr(0, n-1) + '<a herf="f/i<?php echo $groupID;?>"> more&hellip;</a>' : this;
										};
										var s = '<?php echo $groupDescription;?> ';
										document.write(s.trunc(95));
										})();
								</script>-->
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
						echo '<center><button class="btn btn-success">See More Contributions</button></center>';
					}
				?>
			<br>
        </div>
		
    </section>

	<section id="sect-team"class="section">
        <div class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-scale-up uk-invisible',delay:300,topoffset:-100}">
			<h4 class="heading_b uk-text-center">
					inMedia
			</h4>
			<div style="height: 126px;" class="uk-grid uk-grid-medium uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3" data-uk-grid-margin="">
				<a target="bank" href="http://www.newtimes.co.rw/section/article/2017-02-20/208173/">
					<span class="awardspan">
					<h3 class="awardh3">
						Data Hacks 4FI
					</h3>
					<h5 class="awardh5">2nd Best fintech as seen on newtimes, and Igihe</h5></span>
					<img src="frontassets/img/avatars/trophy.png" class="awardimg">
				</a>
			</div>
			
			 <div id="passage1"></div>
			 <div id="passage"></div>
            <div id="typed-strings">
								<p><span style="color: #13a89e;">For</span> Anything</p>
								<p><span style="color: #13a89e;">Like</span> A Wedding</p>
								<p><span style="color: #13a89e;">Like</span> A Funeral</p>
								<p><span style="color: #13a89e;">Like</span> A Medical Bill</p>
								<p><span style="color: #13a89e;">Using</span> <span style="color: #ffbe00;text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.12), 0 1px 1px rgba(0, 0, 0, 0.24);">MTN mobile money</span></p>
								<p><span style="color: #13a89e;">Using</span> <span style="color: #6f91ef;text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.12), 0 1px 1px rgba(0, 0, 0, 0.24);">Tigo Cash</span></p>
								<p><span style="color: #13a89e;">Using</span> Visa cards</p>
								<p><span style="color: #13a89e;">Or Using</span> Master Cards</p>
								<p>And Receive it all in <span style="color: #13a89e;text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.12), 0 1px 1px rgba(0, 0, 0, 0.24);">RWF</span></p>
							</div>
      	
        </div>
    </section>

    <section class="section section_dark md-bg-blue-grey-700" style="background:#007569 !important">
        <div class="uk-container uk-container-center">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-3-5 uk-text-center-medium">
                   
				Copyright &copy; 2016 uplus mutual partner, All rights reserved.
                 
				</div>
                <div class="uk-width-medium-2-5">
                    <div class="uk-align-medium-right uk-text-center-medium">
                        <a href="https://www.facebook.com/Uplus-950052218429354/" class="uk-margin-medium-right" data-uk-tooltip="{offset: 12}" title="Facebook">
							<i class="uk-icon-facebook uk-icon-small md-color-white"></i>
						</a>
						<a href="https://twitter.com/uplusMP" class="uk-margin-medium-right" data-uk-tooltip="{offset: 12}" title="Twitter"><i class="uk-icon-twitter uk-icon-small md-color-white"></i></a><!--
                        --><a href="#" class="uk-margin-medium-right" data-uk-tooltip="{offset: 12}" title="Youtube"><i class="uk-icon-youtube uk-icon-small md-color-white"></i></a><!--
                        --><a href="#" data-uk-tooltip="{offset: 12}" title="Google Plus"><i class="uk-icon-google-plus uk-icon-small md-color-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:300,400,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="frontassets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="frontassets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="frontassets/js/altair_lp_common.js"></script>
    
	   
	<script>
	function changeTarget(){
		
		document.getElementById('amountError').innerHTML = '';
			
		var targeted = document.getElementById('targeted').value;
	// check targeted amount
		if(targeted =='target')
		{
			document.getElementById('changeTargetd').innerHTML = '<input hidden id="isTargetChanged" value="yes">'
			+'<input id="raiseAmount" style="width: 100%;" type="number" placeholder="0.00"/>';
		}
		else if(targeted =='atleast')
		{
			document.getElementById('changeTargetd').innerHTML = '<input hidden id="isTargetChanged" value="yes">'
			+'<input id="raiseAmount" style="width: 100%;" type="number" placeholder="0.00"/>';
		}
		else if(targeted =='any')
		{
			document.getElementById('changeTargetd').innerHTML = '<input hidden id="isTargetChanged" value="no">'
			+'<input disabled style="width: 100%;" type="number" placeholder="Any"/>'
			+'<input hidden id="raiseAmount" type="number" value="0"/>';
		}
		
	}
	</script>
	<script>
	function changeTargetPerPerson(){
		document.getElementById('amountPerPersonError').innerHTML = '';
		
		var groupTargetType = document.getElementById('targeted').value;

		
		var targetedPerPerson = document.getElementById('perPerson').value;
	// check targeted amount
		if(targetedPerPerson =='target')
		{
			document.getElementById('changePerPerson').innerHTML = '<input hidden id="isTargetPPChanged" value="yes">'
			+'<input id="amountPerPerson" style="width: 100%;" type="number" placeholder="0.00"/>';
		}
		else if(targetedPerPerson =='atleast')
		{
			document.getElementById('changePerPerson').innerHTML = '<input hidden id="isTargetPPChanged" value="yes">'
			+'<input id="amountPerPerson" style="width: 100%;" type="number" placeholder="0.00"/>';
		}
		else if(targetedPerPerson =='any')
		{
			document.getElementById('changePerPerson').innerHTML = '<input hidden id="isTargetPPChanged" value="no">'
			+'<input disabled style="width: 100%;" type="number" placeholder="Any"/>'
			+'<input hidden id="amountPerPerson" type="number" value="0"/>';
		}
		
	}
</script>
<script>
	function raise()
	{
		document.getElementById('fundTagError').innerHTML = '';
		document.getElementById('amountError').innerHTML = '';
		document.getElementById('amountPerPersonError').innerHTML = '';
		
		var groupTargetType = document.getElementById('targeted').value;
		var perPersonType 	= document.getElementById('perPerson').value;
	
		
		
		var isTargetChanged 	= document.getElementById('isTargetChanged').value;
		var isTargetPPChanged 	= document.getElementById('isTargetPPChanged').value;
		var fundAmount 			= document.getElementById('raiseAmount').value;
		var amountPerPerson 	= document.getElementById('amountPerPerson').value;
		var fundTag				= document.getElementById('fundTag').value;
		
		
		
	// Check the groupname
		if(fundTag == "" || fundTag == null){
			document.getElementById('fundTagError').innerHTML = 'Please choose the fund type';
			return false;
		}
		if(isTargetChanged == 'yes' && (fundAmount == "" || fundAmount == null)){
			document.getElementById('amountError').innerHTML = 'Please fill in the amount you need to raise';
			return false;
		}
		if(isTargetPPChanged == 'yes' && (amountPerPerson == "" || amountPerPerson == null)){
			document.getElementById('amountPerPersonError').innerHTML = 'Please fill in the amount minimum per person';
			return false;
		}
		
		document.getElementById('passage1').innerHTML = 
		'<input hidden id="groupTargetType" value="'+groupTargetType+'">'
		+'<input hidden id="perPersonType" value="'+perPersonType+'">'
		+'<input hidden id="isTargetChanged" value="'+isTargetChanged+'">'
		+'<input hidden id="isTargetPPChanged" value="'+isTargetPPChanged+'">'
		+'<input hidden id="fundAmount" value="'+fundAmount+'">'
		+'<input hidden id="amountPerPerson" value="'+amountPerPerson+'">'
		+'<input hidden id="fundTag" value="'+fundTag+'">';
		
		document.getElementById('makegroupBody').innerHTML = '<div class="loader"></div>';
		document.getElementById('makegroupFooter').innerHTML = '';
		$.ajax({
				type : "GET",
				url : "frontassets/indexscripts.php",
				dataType : "html",
				cache : "false",
				data : {
				fundTag: fundTag,
				fundAmount: fundAmount,
				amountPerPerson: amountPerPerson,
				},
				success : function(html, textStatus){
				$('#makegroupBody').html(html);
				document.getElementById('makegroupFooter').innerHTML = '<span style="float: left">'
										+'<a href="javascript:void()" onclick="raiseBack()" class="md-btn md-btn-large md-btn-default">Back</a>'
									+'</span>'
									+'<span style="float: right">'
										+'<a href="javascript:void()" onclick="registerFb()" class="md-btn md-btn-large md-btn-warning">Raise</a>'
									+'</span>';
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
				}
			});
	}
	
function raiseBack(){
	var raiseBack = 1;
	var groupTargetType 	= document.getElementById('groupTargetType').value;
	var perPersonType 	= document.getElementById('perPersonType').value;
	var isTargetChanged 	= document.getElementById('isTargetChanged').value;
	var isTargetPPChanged 	= document.getElementById('isTargetPPChanged').value;
	var fundAmount 			= document.getElementById('fundAmount').value;
	var amountPerPerson 	= document.getElementById('amountPerPerson').value;
	var fundTag 			= document.getElementById('fundTag').value;
	
	//alert();
	
	$.ajax({
		type : "GET",
		url : "frontassets/indexscripts.php",
		dataType : "html",
		cache : "false",
		data : {
			raiseBack				: raiseBack,
			backgroupTargetType 	: groupTargetType,	
			backperPersonType 		: perPersonType,	
			backisTargetChanged 	: isTargetChanged,	
			backisTargetPPChanged 	: isTargetPPChanged, 	
			backfundAmount 			: fundAmount,		
			backamountPerPerson 	: amountPerPerson, 	
			backfundTag 			: fundTag,
			
		},
		success : function(html, textStatus){
		$('#makegroupBody').html(html);
		document.getElementById('makegroupFooter').innerHTML = '<span style="float: right">'
										+'<a href="javascript:void()" onclick="raise()" class="md-btn md-btn-large md-btn-warning">Raise</a>'
									+'</span>';
		},
		error : function(xht, textStatus, errorThrown){
			alert("Error : " + errorThrown);
		}
	});								
	
}
</script>

	<script>
		window.smoothScroll = function(target) {
    var scrollContainer = target;
    do { //find scroll container
        scrollContainer = scrollContainer.parentNode;
        if (!scrollContainer) return;
        scrollContainer.scrollTop += 1;
    } while (scrollContainer.scrollTop == 0);
    
    var targetY = 0;
    do { //find the top of target relatively to the container
        if (target == scrollContainer) break;
        targetY += target.offsetTop;
    } while (target = target.offsetParent);
    
    scroll = function(c, a, b, i) {
        i++; if (i > 30) return;
        c.scrollTop = a + (b - a) / 30 * i;
        setTimeout(function(){ scroll(c, a, b, i); }, 20);
    }
    // start scrolling
    scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
}
		
		function changeserv(tab)
		{
			if(tab == 1)
			{
				var calltab = '1';
				document.getElementById('sect-dothis').innerHTML = '<div class="uk-grid"><div class="uk-width-1-3 currentHeader customheader"><span class="currentSpan" style="left:0;"></span>CONTRIBUTE</div><div class="uk-width-1-3 uncurrentHeader customheader" style="color: #eee;" onclick="changeserv(tab=2)">SAVE</div><div class="uk-width-1-3 uncurrentHeader customheader" onclick="changeserv(tab=3)">INVEST</div></div>';
				$.ajax({
				type		:"GET",
				url			:"frontassets/indexscripts.php",
				datatype	:"html",
				data		:{
					calltab 		: calltab,
				},
				success		:function(html, textStatus)
				{
					$('#sect-fund').html(html);
				},
				error: function(xht, textStatus, errorThrown)
				{
					alert("Error:"+ errorThrown);
				}
			});
			}
			else if(tab == 2)
			{
				document.getElementById('sect-dothis').innerHTML = '<div class="uk-grid"><div class="uk-width-1-3 uncurrentHeader customheader " onclick="changeserv(tab=1)">CONTRIBUTE</div><div class="uk-width-1-3 currentHeader customheader"><span class="currentSpan" style="margin: 93px -170px"></span>SAVE</div><div class="uk-width-1-3 uncurrentHeader customheader"  onclick="changeserv(tab=3)">INVEST</div></div>';
				document.getElementById('actions').innerHTML = '<h1 class="text-center">Savings service, Coming Soon!</h1>';
			}
			else if(tab == 3)
			{
				document.getElementById('sect-dothis').innerHTML = '<div class="uk-grid"><div class="uk-width-1-3 uncurrentHeader customheader " onclick="changeserv(tab=1)">CONTRIBUTE</div><div class="uk-width-1-3 uncurrentHeader customheader" onclick="changeserv(tab=2)">SAVE</div><div class="uk-width-1-3 customheader currentHeader" ><div style="float: right;"><span class="currentSpan" style=" right: 0;margin: 93px 0;"></span></div>INVEST</div></div>';
				document.getElementById('actions').innerHTML = '<h1 class="text-center">Investments opportunities are Coming Soon!</h1>';
			var calltab = '3';
			$.ajax({
				type		:"GET",
				url			:"frontassets/indexscripts.php",
				datatype	:"html",
				data		:{
					calltab 		: calltab,
				},
				success		:function(html, textStatus)
				{
					$('#sect-fund').html(html);
				},
				error: function(xht, textStatus, errorThrown)
				{
					alert("Error:"+ errorThrown);
				}
			});}
		}
	
		function likeit(likes, likeid)
		{
			var newlikes = likes+1;
			$.ajax({
				type		:"GET",
				url			:"frontassets/indexscripts.php",
				datatype	:"html",
				data		:{
					newlikes		: newlikes,
					likeId 			: likeid,
				},
				success		:function(html, textStatus)
				{
					//alert("success");
					document.getElementById('likes'+likeid+'').innerHTML = '<span class="likes" style="color:#fff; font-size: 14px;margin: 20px 327px;font-weight: 700;">'+newlikes+'</span>';
					document.getElementById('heart'+likeid+'').innerHTML = '<i class="uk-icon-heart uk-icon-large md-color-red heart" style="color: #ff2222;"></i>';
				},
				error: function(xht, textStatus, errorThrown)
				{
					alert("Error:"+ errorThrown);
				}
			});
		}
	
</script>
<script>// Facebook
	function testAPI() //IF you are connected do this
	{
		document.getElementById('moreCard').innerHTML = '<div class="loader"></div>';
		console.log('Welcome!  Fetching your information.... ');
		FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id,gender,picture.with(15).height(150)'}, 
		function(response) {
			console.log('Successful login for: ' + response.last_name);
			var name = response.name;
			var picture = response.picture.data.url;
			var gender = response.gender;
			//alert(name);
			if(gender == 'male'){
				var gender = 'Mr';
			}
			else{
				var gender = 'Mrs';
			}
			document.getElementById('moreCard').innerHTML = '<div class="slide_content_a" style="height: 350px; background: #3b5998; text-align: center;" id="slide_content_a"><div id="login" style="text-align: center; color: #fff; font-size:20px;">'+gender+' '+name+', is this you?<br/><br/><img src="'+picture+'"><br><br><button onclick="yesthisisme()" class="md-btn md-btn-success">Yes, this is me!</button> / <button onclick="logoutthis()" class="md-btn md-btn-danger">Nop this is not me!</button></div></div>';
		});
	}
	function yesthisisme()
	{
		document.getElementById('login').innerHTML = '<div class="loader"></div>';
		FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id,gender,picture.with(15).height(150)'}, 
		function(response) 
		{
			var fundName	 = document.getElementById('fundName').value;
			var fundAmount	 = document.getElementById('fundAmount').value;
			var fundCurrency = document.getElementById('fundCurrency').value;
			var fundPhone	 = document.getElementById('fundPhone').value;
			var fundDesc	 = document.getElementById('fundDesc').value;
			//alert(fundDesc);
		
			var name 	= response.name;
			var fbId 	= response.id;
			var rdParty = 'FACEBOOK';
			var picture = response.picture.data.url;
			var gender 	= response.gender;
			//alert("we are sending the data to the backend");
			$.ajax({
				  type : "GET",
				  url : "frontassets/indexscripts.php",
				  dataType : "html",
				  cache : "false",
				  data : {
					savename	: name,
					gender 		: gender,
					rdpartyId 	: fbId,
					rdParty 	: rdParty,
					picture		: picture,
					
					fundName	: fundName,	
					fundAmount	: fundAmount,	
					fundCurrency: fundCurrency,
					fundPhone	: fundPhone,	
					fundDesc	: fundDesc	
					
				  },
				  success : function(html, textStatus){
					$('#loginResults').html(html);
					//alert('good!');
					window.location.replace("adminonce.php");
				},
				  error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
				  }
			});
			//alert('Finished did you get the response?');
		});
	}
	
	
	function getPin()
	{
		var fundPhone	 = document.getElementById('fundPhone').value;
		//alert(fundPhone);
		//alert('sending an sms pin');
		document.getElementById('makegroupBody').innerHTML = '<div class="loader"></div>';
		var getPin = 'yes';
		$.ajax({
				type : "GET",
				url : "frontassets/indexscripts.php",
				dataType : "html",
				cache : "false",
				data : {
				getPin: getPin,
				fundPhone: fundPhone,
				},
				success : function(html, textStatus){
					//alert('getting the result back after sending the sms');
				$('#makegroupBody').html(html);
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
				}
			});
	}
	
</script>
<script>
		function changePin (el) 
		{
			var fundPhone	 = document.getElementById('fundPhone').value;
			var pin = document.getElementById('pin').value;
			var max_len = 3;
			if (el.value.length > max_len) 
			{
				var targetAmount = document.getElementById('targetAmount').value;
				var targetPerPerson	 = document.getElementById('targetPerPerson').value;
				var fundName	 = document.getElementById('fundName').value;
				var fundBank	 = document.getElementById('fundBank').value;
				var fundAccount	 = document.getElementById('fundAccount').value;
				var groupTargetType	 = document.getElementById('groupTargetType').value;
				var perPersonType	 = document.getElementById('perPersonType').value;
				
				//alert(groupTargetType);
				//alert(perPersonType);
				
				el.value = el.value.substr(0, max_len);
				document.getElementById('makegroupBody').innerHTML ='<div font-size: 20px;">Lets Check this pin <div class="inputContainer">'
				+'<input disabled value="'+pin+'" style="color: #000; font-size: 25px; border-radius: 4px; width: 50%; text-align: unset;"/></div></div>';
				var checkPin = 1;
				//alert('going to create');
				$.ajax({
					type : "GET",
					url : "frontassets/indexscripts.php",
					dataType : "html",
					cache : "false",
					data : {
						pin: pin,
						fundPhone: fundPhone,
						checkPin: checkPin,
						
						targetAmount	: targetAmount,	
						targetPerPerson	: targetPerPerson,	
						fundName		: fundName,
						fundBank		: fundBank,	
						fundAccount		: fundAccount,
						groupTargetType	: groupTargetType,
						perPersonType	: perPersonType
					},
					success : function(html, textStatus){
						//alert('reslut back');
					$('#makegroupBody').html(html);
					},
					error : function(xht, textStatus, errorThrown){
						alert("Error : " + errorThrown);
					}
				});
			}
		}


	</script>
</body>
</html>