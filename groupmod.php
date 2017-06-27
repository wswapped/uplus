<?php // Get me backif i havent logedin
session_start();
if (!isset($_SESSION["phone1"])) 
{
	header("location: logout.php"); 
	exit();
}
?>
<?php // If loged in get me all info
$session_id = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter everything but numbers and letters
$phone = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["phone1"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
include "db.php"; 
$sql = $db->query("SELECT * FROM users WHERE phone='$phone' AND password='$password' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($sql); // count the row nums
$label="";
if ($existCount > 0) { 
	while($row = mysqli_fetch_array($sql)){ 
			 $thisid = $row["id"];
			 $userPhone = $row["phone"];
			 $name = $row["name"];
			}
	}
else{
	echo "
	<br/><br/><br/><h3>Your account has been temporally deactivated</h3>
	<p>Please contact: <br/><em>(+25) 078 484-8236</em><br/><b>muhirwaclement@gmail.com</b></p>		
	Or<p><a href='logout'>Click Here to login again</a></p>
";
exit();
}?>
<?php // Give me info of the group
if (isset($_GET['groupId']))
{	
	$groupID = $_GET['groupId'];
	//include "db.php"; 
	$sql2 = $db->query("SELECT * FROM groups WHERE id='$groupID'"); 
	while($row = mysqli_fetch_array($sql2)){ 
		$groupName 		= $row["groupName"];
		$saving 		= round($row['targetAmount']);
		$adminPhone 	= $row['adminPhone'];
		$adminName 		= $row['adminName'];
		$groupDesc 		= $row["groupDesc"];
		$groupStory 	= $row["groupStory"];
		$custommessage 	= $row["invitationSms"];
		$contributionDate 	= $row["expirationDate"];			
		$replymessage 	= $row["successNotificationSms"];			
		$sms 			= $row["sms"];			
	}
	$sqladminID = $db->query("SELECT id adminID FROM users WHERE phone = '$adminPhone'");
	$fetchAdminID = $rowAdminID = mysqli_fetch_array($sqladminID);
	$adminID = $rowAdminID["adminID"];
	
	$sqlbalance = $outCon->query("SELECT * FROM groupbalance WHERE groupId = '$groupID'");
	$rowbalance = mysqli_fetch_array($sqlbalance);
	$balance = $rowbalance['Balance'];
	
	$prog = $balance*100/$saving;
	$progressing=''.$prog.'%';
	if($balance == ''){
		$balance = 0;
	}
	
	if(isset($_POST['inviteSms']))
	{
		$invitationSms 		= $_POST['inviteSms'];
		$phone 				= $_POST['invitePhone'];
		$groupId 			= $groupID;
		$lastAccountName 	= $groupName;
		//// START SMS ////
		require_once('classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+250'.$phone;
		$message    = $invitationSms;
		
		$from = "uplus";

		$gateway    = new AfricasTalkingGateway($username, $apikey);
		try
		{
			$results = $gateway->sendMessage($recipients, $message, $from);
			foreach($results as $result) 
			{
				// REDUCE THE SMS COUNTS
				$sms = $sms-1;
				$sqlupdatesms = $db->query("UPDATE groups SET sms='$sms' WHERE id = '$groupId'");
				?>
					<script>
						alert('GREAT INVITATION SUCCESFURLY SENT, KEEP UP THE GOOD WORK! Redirecting to editCont <?php echo $lastAccountId;?>');
					</script>
				<?php
			}
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		  ?>
			<script>
				alert('Encountered an error while sending invitation to <?php echo $phone;?> <?php echo $e->getMessage();?>');
			</script>
		<?php
		}
		//// END SMS ////
		
		
	} 
	  
}
else{
	echo 'nothig isset';
}
?>


<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    
			<meta property="fb:app_id"             content="1822800737957483">
			<meta property="og:url"                content="https://uplus.rw/f/i<?php echo $groupID?>" >
			<meta property="og:type"               content="article" >
			<meta property="og:title"              content="<?php echo $groupName?> (<?php echo number_format($saving);?> Rwf)">
			<meta property="og:description"        content="<?php echo $groupDesc?>">
			<meta property="og:image"              content="http://uplus.rw/temp/group<?php echo $groupID;?>.jpeg" >
			
			<meta name="description" content="<?php echo $groupDesc?>">
		    
			
			
			<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		    <title><?php echo $groupName;?></title>
			  
		    <!-- Add to homescreen for Chrome on Android -->
		    <meta name="mobile-web-app-capable" content="yes">
		    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

		    <!-- Add to homescreen for Safari on iOS -->
		    <meta name="apple-mobile-web-app-capable" content="yes">
		    <meta name="apple-mobile-web-app-status-bar-style" content="black">
		    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

		    <!-- Tile icon for Win8 (144x144 + tile color) -->
		    
		    <link rel="shortcut icon" href="f/images/favicon.png">
			<link rel="canonical" href="http://uplus.rw/f/i<?php echo $groupID?>">
		    
  <!-- Stylesheets -->
  <link rel="stylesheet" href="assets/global/css/bootstrap.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/css/bootstrap-extend.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/css/site.min3f0d.css?v2.2.0">

  
  <!-- Plugins -->
  <link rel="stylesheet" href="assets/global/vendor/animsition/animsition.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/asscrollable/asScrollable.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/switchery/switchery.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/slidepanel/slidePanel.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/flag-icon-css/flag-icon.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/waves/waves.min3f0d.css?v2.2.0">

  <!-- Fonts -->
  <link rel="stylesheet" href="assets/global/fonts/material-design/material-design.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/fonts/brand-icons/brand-icons.min3f0d.css?v2.2.0">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700'>
  <link rel="stylesheet" href="assets/global/fonts/font-awesome/font-awesome.min3f0d.css?v2.2.0">

    
    <link href="croppic/assets/css/main.css" rel="stylesheet">
	<link href="croppic/assets/css/croppic.css" rel="stylesheet">

 
	<link href="assets/tagle/bootstrap-toggle.css" rel="stylesheet">
	<script src="assets/tagle/jquery-2.1.1.min.js"></script>
 
 
  <link rel="stylesheet" href="assets/global/vendor/bootstrap-markdown/bootstrap-markdown.min3f0d.css?v2.2.0">
  <script src="assets/global/vendor/modernizr/modernizr.min.js"></script>
  <script src="assets/global/vendor/breakpoints/breakpoints.min.js"></script>
	<script>
    Breakpoints();
  </script>
  <style>
	p{
		font-size: 16px;
		color: #757575;
		font-family: Roboto,sans-serif;
	}
	.md-editor .md-footer, .md-editor>.md-header {
		padding: unset;
	}
  </style>
</head>
<body>
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

  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

   <nav class="site-navbar navbar navbar-inverse navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon md-more" aria-hidden="true"></i>
      </button>
	   <a href="index.php">
        <div style="padding: 12px 50px;" class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
          <img style="    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    height: 50px;
    width: 50px;
    border-radius: 100px;
    /* margin: auto; */
    background-color: #fff;
    cursor: pointer;" class="navbar-brand-logo" src="frontassets/img/logo_main_3.png" title="Uplus">
        </div></a>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon md-search" aria-hidden="true"></i>
      </button>
    </div>

    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
		<!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="hidden-float">
            <a class="icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
            role="button">
              <span class="sr-only">Toggle Search</span>
            </a>
          </li>
        </ul>
	  
	  
        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
          <li class="dropdown" id="profile">
            <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
            data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="proimg/<?php echo $thisid;?>.jpg" alt="...">
                <i></i>
              </span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a href="profile" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
              </li>
              <li role="presentation">
                <a href="privacy" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
              </li>
              <li class="divider" role="presentation"></li>
              <li role="presentation" >
                <a href="logout" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
</li>
            </ul>
          </li>
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->

      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon md-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>
 
 <div class="site-menubar site-menubar-dark">
    <div class="site-menubar-body">
      <ul class="site-menu">
        <li class="site-menu-item has-sub open">
          <a href="home">
      <i class="site-menu-icon md-home" aria-hidden="true"></i>
            <span class="site-menu-title">Home</span>
            
          </a>
        </li> 
    </ul>
    </div>
  </div>
 

  <!-- Page -->
  <div class="page animsition">
    <div class="page-content">
		<div class="row">
			<div class="col-md-6 col-xs-12 masonry-item">
			  <!-- Widget User list -->
			  <div class="widget widget-article widget-shadow"" id="widgetUserList">
				<div class="widget-header cover -hover overlay">
					<div style="position: absolute; margin: 5px 0px 0 5px;">
						<?php
							$sqllevel = $db->query("SELECT state FROM groups WHERE id='$groupID'");
							$stateRow = mysqli_fetch_array($sqllevel);
							$state = $stateRow['state'];
							if($state == 'public')
							{
								echo'<input id="toggle-event" data-toggle="toggle" type="checkbox" checked data-toggle="toggle"  data-on="Private" data-off="Publish" data-onstyle="danger" data-offstyle="success">';
							}
							elseif($state == 'private')
							{	
								echo'<input id="toggle-event" data-toggle="toggle" type="checkbox" data-toggle="toggle" data-on="Private" data-off="Publish" data-onstyle="danger" data-offstyle="success">';
							}
						?>
						<div id="console-event"></div>
					</div>
					<div  id="cropContainerModal">
						<img class="cover-image overlay-spin" src="temp/group<?php echo $groupID;?>.jpeg"/>
						
					</div>
				</div>
				<div class="widget-body widget-content">
					<div class="widget-content" id="groupDiv">
						<div class="tab-content">
							<input type="number" hidden id="groupID" value="<?php echo $groupID;?>">
							<div class="form-group">
								<label class="widget-metas" for="groupName">Contribution Title:</label>
								<input id="groupName" class="form-control" value= "<?php echo $groupName;?>">
							</div>
							<div class="form-group">
								<label class="widget-metas" for="groupDesc">Short Descriotion:</label>
								<textarea id="groupDesc" class="form-control" placeholder="Briefly Describe Yourself"><?php echo $groupDesc;?></textarea>
							</div>
							<div class="form-group">
								<label class="widget-metas" for="groupStory">Long Story (Whats going on?):</label>
								<textarea id="groupStory" placeholder="Take your time to tell us what is happening, you can even add photos and website links" data-provide="markdown" data-hidden-buttons="cmdCode cmdListO" data-iconlibrary="fa" rows="7"><?php echo $groupStory;?></textarea>
							</div>
						</div>
					</div>
					<div class="widget-body-footer">
						<a class="btn btn-dark" href="javascript:void(0)" onclick="updateGroup()">UPDATE</a>
					</div>	
				</div>
			  </div>
			</div>
			<div class="col-md-6 col-xs-12">	
				<h4>
					<a href="javascript:void()" data-target="#changeAmount" data-toggle="modal"><?php echo number_format($balance);?>Rwf/
					<small><?php echo number_format($saving);?> Rwf</small></a>
                    <div class="pull-right" >
						<span id="countDown"></span>
						<a href="javascript:void()" data-target="#changeEndDate" data-toggle="modal"><i class="icon md-edit"></i></a>
					</div>
					<!-- Change Date Modal -->
	                <div class="modal fade modal-fade-in-scale-up" id="changeAmount" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
	                    <div class="modal-dialog">
	                      <div class="modal-content">
	                        <div class="modal-header">
	                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                            <span aria-hidden="true">×</span>
	                          </button>
								<div class="row">
									<div class="col-md-6">
										<h4 >Change The Targeted Amount</h4>
									</div>
									<div class="col-md-6">
										<input type="number" class="form-control" id="targetAmount" value="<?php echo $saving;?>"/>
										<h5 id="targetAmountError" style="color: red;"></h5>
									</div>
								</div>
	                        </div>
	                        <div class="modal-footer">
	                          <button type="button" class="btn btn-default btn-pure margin-0" data-dismiss="modal">Cancel</button>
	                          <button onclick="changeTargetAmount()" class="btn btn-primary">Change</button>
	                        </div>
	                      </div>
	                    </div>
					</div>
					<!-- End Change Date Modal -->
					<!-- Change Date Modal -->
	                <div class="modal fade modal-fade-in-scale-up" id="changeEndDate" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
	                    <div class="modal-dialog">
	                      <div class="modal-content">
	                        <div class="modal-header">
	                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                            <span aria-hidden="true">×</span>
	                          </button>
								<div class="row">
									<div class="col-md-6">
										<h4 >Change Expiry Date</h4>
									</div>
									<div class="col-md-6">
										<input type="date" class="form-control" id="expirationDate" value="<?php echo $contributionDate;?>"/>
										<h5 id="expirationDateError" style="color: red;"></h5>
									</div>
								</div>
	                        </div>
	                        <div class="modal-footer">
	                          <button type="button" class="btn btn-default btn-pure margin-0" data-dismiss="modal">Cancel</button>
	                          <button onclick="changeExpirationDate()" class="btn btn-primary">Change</button>
	                        </div>
	                      </div>
	                    </div>
					</div>
					<!-- End Change Date Modal -->
				</h4>
				<div class="progress progress-lg" style="    box-shadow: 0 0px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);">
				  <div class="progress-bar progress-bar-success progress-bar-indicating active" style="    box-shadow: 0 0px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12); width: <?php echo $progressing;?>;" role="progressbar">
					<span class="sr-only"><?php echo $progressing;?> Complete</span>
				  </div>
				</div>
				<div class="example-wrap">
					<div class="nav-tabs-horizontal nav-tabs-inverse nav-tabs-animate">
						<ul class="nav nav-tabs" data-plugin="nav-tabs" role="tablist">
							
							<li role="presentation">
								<a data-toggle="tab" href="#exampleTabsInverseZero" aria-controls="exampleTabsInverseOne" role="tab" aria-expanded="true">
									 <i class="icon md-settings"></i>
									 Setings
								</a>
							</li>
							<li class="active" role="presentation">
								<a data-toggle="tab" href="#exampleTabsInverseOne" aria-controls="exampleTabsInverseOne" role="tab" aria-expanded="true">
									<span class="badge badge-default">
									  <?php echo $sms;?>
									</span> Invite
								</a>
							</li>
							<li role="presentation">
								<a data-toggle="tab" href="#exampleTabsInverseTwo" aria-controls="exampleTabsInverseTwo" role="tab" aria-expanded="false">
									<span class="badge badge-danger">
										<?php 
											$sqlcontributors = $outCon->query("SELECT * FROM transactionsview WHERE operation='debit' AND forGroupID = '$groupID'  ORDER BY amount DESC");
											echo $countContr = mysqli_num_rows($sqlcontributors);
											$ncontrib = 0;
											$contlist="";
											if($countContr > 0)
											{
												while($row2 = mysqli_fetch_array($sqlcontributors))
												{
													$ncontrib++;
													$contlist.='<li class="list-group-item ">
																	<div class="media">
																	  <div class="media-left">
																		<a class="avatar" href="javascript:void(0)">
																		  <i class="fa fa-user" style="position: inherit;color: #007569;font-size: 32px;
"></i>
																		</a>
																	  </div>
																	  <div class="media-body">
																		<h4 class="media-heading">'.number_format($row2['amount']).' Rwf</h4>
																		<small>'.$row2['actorName'].' <em>('.$row2['accountNumber'].')</em></small>
																	  </div>
																	  <div class="media-right">
																		<a href="javascript:void()"><i class="icon md-comment"></i></a>
																	  </div>
																	</div>
																</li>';
												}
											}
											else
											{
												$contlist.='<div>Ohhh! Sorry, None contributed Yet, But it is still cool because you still have '.$sms.' free SMS to let them know. <a data-toggle="tab" href="#exampleTabsInverseOne" aria-controls="exampleTabsInverseOne" role="tab" aria-expanded="true">just click here</a></div>';
											}
										?>
										
									</span> Contribution
								</a>
								<!-- Modal -->
								<div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
								  aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
										  <form action="editCont<?php echo $groupID;?>" method="post">
											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											  </button>
											  <h4 class="modal-title" style="text-align:center">INVITE USING BULK SMS</h4>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Phones</label>
															<div class="input-group">
																<input type="number" name="invitePhone" class="form-control" id="invitePhone" name="invitePhone" required="" value="" placeholder="Type a phone and hit enter">
																<span class="input-group-btn">
																	<button type="button" name="add" id="add_input" class="btn btn-primary waves-effect waves-light">+</button>
																</span>
															</div>
															<div id="dynamic">
															</div>
														</div>
														<input type="hidden" class="form-control" name="groupID" id="groupID" value="<?php echo $groupID;?>"/>
														<input type="hidden" class="form-control" name="byname" id="byname" value="<?php echo $thisid;?>" />
													</div>
													<div class="col-md-6">
														<label>SMS (160char max/ sms)</label>
														<textarea class="form-control" rows="5" name="inviteSms"><?php echo $custommessage;?> </textarea>
														<br/><br/>
													</div>
												</div>
												<div class="modal-footer">
												  <button type="button" class="btn btn-default btn-pure margin-0" data-dismiss="modal">Cancel</button>
												  <button type="submit" class="btn btn-primary">SEND</button>
												</div>
											</div>
										  </form>
										</div>
								  </div>
							  <!-- End Modal -->
							</li>
							
							<li role="presentation">
								<a data-toggle="tab" href="#exampleTabsInverseZero" aria-controls="exampleTabsInverseOne" role="tab" aria-expanded="true">
									<span class="badge badge-default">
									  0
									</span> Updates
								</a>
							</li>
						</ul>
							
						<div class="tab-content padding-20">
							<div class="tab-pane animation-slide-right " id="exampleTabsInverseZero" role="tabpanel">
								<form action="scripts/updateGroup.php" method="post">
								  <div class="input-search-dark">
									<input name="groupId" hidden value="<?php echo $groupID;?>">
									<input name="adminId" hidden value="<?php echo $adminID;?>">
									<textarea name="newupdate" class="form-control" placeholder="Whats New"></textarea>
									<div style="position: absolute;margin: -20px 0 0 423px;"><button class="btn btn-success btn-sm waves-effect waves-light">SAVE</button></div>
								  </div>
								</form>
								<br>
							
							</div>
							<div class="tab-pane animation-slide-left active" id="exampleTabsInverseOne" role="tabpanel">
								<p>Invite your friends and family to contribute to <?php echo $groupName;?>, 
								You have <?php echo $sms?> free SMS left, or Share on Facebook and Twitter.</p>
								<button class="btn btn-warning" href="javascript:void()" data-target="#exampleNiftyFadeScale" data-toggle="modal">
									INVITE by <?php echo $sms;?> SMS
									</button>
								
								<button class="btn btn-primary fbShare" id="shareBtn" style="background-color: #225ca0; border-color: #1b4c9c;"><i class="icon md-share"></i>Invite Facebook</button>
								<!--<button class="btn btn-primary">Share on Whatsapp</button>-->
								<button class="btn btn-primary" onclick="javascript:window.open('http://twitter.com/share?url=http://uplus.rw/f/i<?php echo $groupID;?>;text=<?php echo $adminName;?> Is rasing <?php echo number_format($saving);?>Rwf for <?php echo $groupName;?>. You can contribute using MTN mobile money, Tigo cash, Visa cards here:;size=l&amp;count=none', '_blank','toolbar=no, scrollbars=no, menubar=no, resizable=no, width=700,height=220')" style="background-color: #03A9F4; border-color: #2196F3;"><i class="icon md-share"></i>Share on Twitter</button>
								<!--<div><hr/></div>
								<div class="row">
									<div class="col-md-5">
									Set a thank you Message the one that the contibutor recieves right after contributing
									</div>
									<div class="col-md-7">
										<form>
										  <div class="input-search-dark">
<textarea class="form-control" placeholder="Whats New" rows="5">Thank you so much for your contribution,
Your Contribution Made <?php echo $groupName;?> Move up to <?php echo number_format($balance);?>Rwf
</textarea><div style="position: absolute; margin: -20px 0 0 215px;"><button class="btn btn-success btn-sm">SAVE</button></div>
										  </div>
										</form>
									</div>
								</div>-->
							</div>
							<?php  
								$sqlgAccount = $outCon->query("SELECT g.accountNumber, b.name bank, b.id bankId FROM `groups` g INNER JOIN banks b ON b.id = g.bankId WHERE g.`groupId` = '$groupID'");
								$rowgAcc = mysqli_fetch_array($sqlgAccount);
								 $bankaccount = $rowgAcc['accountNumber'];		
								 $bank = $rowgAcc['bank'];	
								 $bankingId = $rowgAcc['bankId'];	
								$bankslist="";
								$sqlListBanks = $outCon->query("SELECT * FROM banks");
								while($rowBanks = mysqli_fetch_array($sqlListBanks))
								{
									$bankslist.='<option value="'.$rowBanks['id'].'">'.$rowBanks['name'].'</option>';
								}
								?>
							<div class="tab-pane animation-slide-left" id="exampleTabsInverseTwo" role="tabpanel">
								 
								<div class="row" id="anableDisableAccount">
									<div class="col-md-12">
									WITHDRAW ACCOUNT: <a href="javascript:void()" onclick="anableChangeAccount()"><i class="fa fa-wrench"></i> Change </a>
									<br/>
									</div>
									<div class="col-md-6">
										<input class="form-control" disabled value="<?php echo $bankaccount;?>">
									</div>
									<div class="col-md-6">
										<select class="form-control" disabled><option><?php echo $bank;?></option></select>
									</div>
								</div>
								<hr>
								Contributors:
								
								<ul class="list-group list-group-dividered list-group-full">
									<?php echo $contlist;?>
								</ul>
							</div>
						</div>
					</div>
				  </div>
			</div>
		</div>
    </div>
  </div>
  <!-- End Page -->


  <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">� 2016 <a href="http://uplus.rw/">kusanya</a></div>
    <div class="site-footer-right">
       Collect money from everywhere at no cost <a >uplus</a>
    </div>
  </footer>
  <script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script>
   
	<script src="croppic/assets/js/bootstrap.min.js"></script>
	<script src="croppic/assets/js/jquery.mousewheel.min.js"></script>
   	<script src="croppic.min.js"></script>
    <script src="croppic/assets/js/main.js"></script>
    <script>
		var croppicContainerModalOptions = {
				uploadUrl:'img_save_to_file.php?groupId=<?php echo $groupID;?>',
				cropUrl:'img_crop_to_file.php?groupId=<?php echo $groupID;?>',
				modal:true,
				imgEyecandyOpacity:0.4,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContainerModal = new Croppic('cropContainerModal', croppicContainerModalOptions);
		
	</script>
	
	
  <!-- Core  -->
  <script src="assets/global/vendor/jquery/jquery.min.js"></script>
  <script src="assets/global/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/global/vendor/animsition/animsition.min.js"></script>
  <script src="assets/global/vendor/asscroll/jquery-asScroll.min.js"></script>
  <script src="assets/global/vendor/mousewheel/jquery.mousewheel.min.js"></script>
  <script src="assets/global/vendor/asscrollable/jquery.asScrollable.all.min.js"></script>
  <script src="assets/global/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>
  <script src="assets/global/vendor/waves/waves.min.js"></script>

  <!-- Plugins -->
  <script src="assets/global/vendor/switchery/switchery.min.js"></script>
  <script src="assets/global/vendor/intro-js/intro.min.js"></script>
  <script src="assets/global/vendor/screenfull/screenfull.min.js"></script>
  <script src="assets/global/vendor/slidepanel/jquery-slidePanel.min.js"></script>

  <!-- Scripts -->
  <script src="assets/global/js/core.min.js"></script>
  <script src="assets/js/site.min.js"></script>

  <script src="assets/js/sections/menu.min.js"></script>
  <script src="assets/js/sections/menubar.min.js"></script>
  <script src="assets/js/sections/sidebar.min.js"></script>

  <script src="assets/global/js/components/asscrollable.min.js"></script>
  <script src="assets/global/js/components/animsition.min.js"></script>
  <script src="assets/global/js/components/slidepanel.min.js"></script>
  <script src="assets/global/js/components/switchery.min.js"></script>
  <script src="assets/global/js/components/tabs.min.js"></script>

  <script src="assets/tagle/bootstrap-toggle.js"></script>
  
  <!--Markdown-->
  <script src="assets/global/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
  <script src="assets/global/vendor/marked/marked.min.js"></script>
  <script src="assets/global/vendor/to-markdown/to-markdown.js"></script>


  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
  </script>
<script>
	document.getElementById('shareBtn').onclick = function() {
		//alert('done');
	  FB.ui({
		method: 'share',
		mobile_iframe: true,
		display: 'popup',
		href: 'http://uplus.rw/f/index.php?groupId=<?php echo $groupID?>',
		hashtag: '#kusanya',
		quote: 'You can contribute with MTN mobile money, Tigo Cash and Visa Card.',
	  }, function(response){});
	}
</script>
<script>
	$(function() 
{
		$('#toggle-event').change(function() 
	{
		var rebaneza = $(this).prop('checked')
		var groupId		= document.getElementById('groupID').value;
		//$('#console-event').html('Toggle: ' + rebaneza);
		//alert(rebaneza);
		
		if(rebaneza == true)
		{
			alert('This group is going public to anybody!');
			var state = 'public';
			
			$.ajax(
			{
				type : "GET",
				url : "scripts/updateGroup.php",
				dataType : "html",
				cache : "false",
				data : {
					state		:   state,		
					groupId		:   groupId,		
				},
				success : function(html, textStatus){
					$('#console-event').html('This Fundraiser is now Public');
					//document.getElementById('levelpub').innerHTML ='make it private:<input type="checkbox" checked onclick="makeitpublic(pub=0)">';
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
				}
			});
		}
		else if(rebaneza == false)
		{
			alert('This group is going private, None is going to see it!');
			var state = 'private';
			
			$.ajax(
			{
				type : "GET",
				url : "scripts/updateGroup.php",
				dataType : "html",
				cache : "false",
				data : {
					state		:   state,		
					groupId		:   groupId,		
				},
				success : function(html, textStatus){
					$('#console-event').html('This Fundraiser is now Pivate');
					//document.getElementById('levelpub').innerHTML ='make it public:<input type="checkbox" onclick="makeitpublic(pub=1)">';
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
				}
			});
		}
	})
})
</script>

<script type="text/javascript">
function updateGroup(){
	var groupName		= document.getElementById('groupName').value;
	var groupStory		= document.getElementById('groupStory').value;
	var groupID			= document.getElementById('groupID').value;
	var groupDesc		= document.getElementById('groupDesc').value;
	document.getElementById('groupDiv').innerHTML = '<div style="text-align: center;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/updateGroup.php",
			dataType : "html",
			cache : "false",
			data : {
				groupName		:	groupName,	
				groupID			:	groupID,	
				groupStory		:	groupStory,	
				groupDesc		:   groupDesc,		
			},
			success : function(html, textStatus){
				window.location.replace("editCont"+groupID);
				$("#groupDiv").html(html);
				document.getElementById('doneMtn').innerHTML = '';
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}

function changeExpirationDate()
{
	document.getElementById('expirationDateError').innerHTML = '';
	var expirationDate	= document.getElementById('expirationDate').value;
	var currentExpiration = '<?php echo $contributionDate;?>';
	if(expirationDate == null || expirationDate == "" || expirationDate == currentExpiration)
	{
		document.getElementById('expirationDateError').innerHTML = 'Please Chose a date';
		return false;
	}
	var groupId		= document.getElementById('groupID').value;
	//alert(groupId);
	$.ajax({
			type : "GET",
			url : "scripts/updateGroup.php",
			dataType : "html",
			cache : "false",
			data : {
				expirationDate	:	expirationDate,	
				groupId			:	groupId,		
			},
			success : function(html, textStatus){
				window.location.replace("editCont"+groupId);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}

 function changeTargetAmount()
{
	document.getElementById('targetAmountError').innerHTML = '';
	var targetAmount	= document.getElementById('targetAmount').value;
	var currentAmount = '<?php echo $saving;?>';
	if(targetAmount == null || targetAmount == "" || targetAmount == currentAmount)
	{
		document.getElementById('targetAmountError').innerHTML = 'Please the New target amount is needed.';
		return false;
	}
	var groupId	= document.getElementById('groupID').value;
	$.ajax({
		type : "GET",
		url : "scripts/updateGroup.php",
		dataType : "html",
		cache : "false",
		data : {
			targetAmount	:	targetAmount,	
			groupId			:	groupId,		
		},
		success : function(html, textStatus){
			window.location.replace("editCont"+groupId);
		},
		error : function(xht, textStatus, errorThrown){
			alert("Error : " + errorThrown);
		}
	});
}

function anableChangeAccount()
{
	document.getElementById('anableDisableAccount').innerHTML = '<div class="col-md-12">'
		+'Make this your withdraw account for this group: <a href="javascript:void()" onclick="changeWithdrawAccount()"><i class="fa fa-save"></i> SAVE </a>'
		+'</div>'
		+'<div class="col-md-6">'
			+'<input id="accountNumberStand" class="form-control" value="<?php echo $bankaccount;?>">'
		+'</div>'
		+'<div class="col-md-6">'
			+'<select id="bankIdstand" class="form-control" ><option value="<?php echo $bankingId;?>"><?php echo $bank;?></option><?php echo $bankslist;?></select>'
		+'</div>';
}

function changeWithdrawAccount()
{
	document.getElementById('targetAmountError').innerHTML = '';
	var accountNumberStand	= document.getElementById('accountNumberStand').value;
	var bankIdstand	= document.getElementById('bankIdstand').value;
	if(accountNumberStand == null || accountNumberStand == "")
	{
		alert('Please add an account');
		return false;
	}
	var groupId	= document.getElementById('groupID').value;
	$.ajax({
		type : "GET",
		url : "scripts/updateGroup.php",
		dataType : "html",
		cache : "false",
		data : {
			accountNumberStand	:	accountNumberStand,	
			bankIdstand			:	bankIdstand,		
			groupId			:	groupId,		
		},
		success : function(html, textStatus){
			$("#anableDisableAccount").html(html);
			//window.location.replace("editCont"+groupId);
		},
		error : function(xht, textStatus, errorThrown){
			alert("Error : " + errorThrown);
		}
	});
}
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
	<script type="text/javascript" src="assets/js/timer.js"></script>
	
<script>
$(document).ready(function(){
	var i=1;
	$('#add_input').click(function(){
		i++;
		$('#dynamic').append('<tr id="row'+i+'"><td>'
		+'<input type="number" name="invitePhone[]" class="form-control" id="invitePhone" name="invitePhone" required="" value="" placeholder="Type a phone and hit enter">'
		+'</td><td><button type="button" name="remove" id="'+i+'" class="btn_remove btn-danger btn">-</button></td></tr>');
	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id");
		$('#row'+button_id+'').remove();
	});
	$('#submit').click(function(){
		$.ajax({
			url:"insert.php",
			method:"POST",
			data:$('#add_me').serialize(),
			success: function(data)
			{
				alert(data);
				$('#add_me')[0].reset();
			}
		});
	});
});
</script>
</body>
</html>
