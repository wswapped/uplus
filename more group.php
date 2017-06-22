<?php // Get me backif i havent logedin
session_start();
	if (!isset($_SESSION["phone1"])) {
		header("location: logout.php"); 
    exit();
}
?>
<?php 
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
       $preve = $row['userType'];
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
<?php
$group_id = $_GET['blabla'];
$n = 0;
$sql_account = $outCon->query("SELECT * FROM transactions WHERE forGroupId LIKE '$group_id' ORDER BY id DESC");
$num_row = mysqli_num_rows($sql_account);
?>


<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<!-- Mirrored from getbootstrapadmin.com/remark/material/iconbar/pages/blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Nov 2016 13:59:26 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap material admin template">
  <meta name="author" content="">

  <title>Test</title>

  <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="assets/global/css/bootstrap.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/css/bootstrap-extend.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/css/site.min3f0d.css?v2.2.0">

  
  <!-- Plugins -->
  <link rel="stylesheet" href="assets/global/vendor/animsition/animsition.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/asscrollable/asScrollable.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/switchery/switchery.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/intro-js/introjs.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/slidepanel/slidePanel.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/flag-icon-css/flag-icon.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/vendor/waves/waves.min3f0d.css?v2.2.0">

  <!-- Fonts -->
  <link rel="stylesheet" href="assets/global/fonts/material-design/material-design.min3f0d.css?v2.2.0">
  <link rel="stylesheet" href="assets/global/fonts/brand-icons/brand-icons.min3f0d.css?v2.2.0">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700'>
	
    
    <link href="croppic/assets/css/main.css" rel="stylesheet">
	<link href="croppic/assets/css/croppic.css" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="assets/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="assets/global/vendor/media-match/media.match.min.js"></script>
    <script src="assets/global/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="assets/global/vendor/modernizr/modernizr.min.js"></script>
  <script src="assets/global/vendor/breakpoints/breakpoints.min.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body>
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
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <img class="navbar-brand-logo" src="assets/images/logo.png" title="Uplus">
        <span class="navbar-brand-text hidden-xs"> Uplus</span>
      </div>
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
        <li class="site-menu-item has-sub active open">
          <a href="home">
      <i class="site-menu-icon md-home" aria-hidden="true"></i>
            <span class="site-menu-title">Dash</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
          0
        </span>
            </div>
          </a>
        </li> 
      <li class="site-menu-item">
          <a href="ikimina">
           <i class="site-menu-icon md-accounts-alt" aria-hidden="true"></i>
            <span class="site-menu-title">Ikimina</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
          0
        </span>
            </div>
          </a>
        </li> 
        
		<li class="site-menu-item has-sub">
          <a href="javascript:void(0)" >
            <i class="site-menu-icon md-leak" aria-hidden="true"></i>
            <span class="site-menu-title">Kusanya</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
          0
        </span>
            </div>
          </a>
			<ul class="site-menu-sub">
				<li class="site-menu-item">
				  <a class="animsition-link waves-effect waves-classic" href="onceof">
					<div class="site-menu-label">
						<i class="site-menu-icon md-n-1-square" ></i>
					</div>
					<span class="site-menu-title">Once Off</span>
				  </a>
				</li>
				<li class="site-menu-item">
				  <a class="animsition-link waves-effect waves-classic"  href="recurring.php">
					
					<div class="site-menu-label">
						<i class="site-menu-icon md-rotate-right" ></i>
					</div>
					<span class="site-menu-title">Recurring</span>
					
				  </a>
				</li>
			</ul>
	   </li>  
        <li class="site-menu-item">
          <a href="shora">
           <i class="site-menu-icon md-balance" aria-hidden="true"></i>
            <span class="site-menu-title">Shora</span>
            <div class="site-menu-badge">
              <span class="badge badge-success">
         0
        </span>
            </div>
          </a>
     </li> 
     <?php if ($preve == 'admin'){ ?> 
  <li class="site-menu-item has-sub">
          <a href="javascript:void(0)" >
            <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
            <span class="site-menu-title">Admin</span>
          </a>
      <ul class="site-menu-sub">
        <li class="site-menu-item">
          <a class="animsition-link waves-effect waves-classic" href="superAdmin.php">
          <span class="site-menu-title">Groups</span>
          </a>
        </li>
        <li class="site-menu-item">
          <a class="animsition-link waves-effect waves-classic"  href="superLocation.php">
            <span class="site-menu-title">Location</span>
          
          </a>
        </li>
      </ul>
   </li> 
        <?php }?>
    </ul>
    </div>
  </div>
 

  <!-- Page -->
  <div class="page animsition">
    <div class="page-content">
       <div class="page-header">
      <h1 class="page-title">uPlus
	  
	 
	  
	  
	  </h1>
      <ol class="breadcrumb">
        <li><a href="home">Home</a></li>
        <li class="active">Groups' contribution </li>
      </ol>
      <div class="page-header-actions">
        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-outline btn-round site-tour-trigger">
            <i class="icon md-info" aria-hidden="true"></i>
			<span class="hidden-xs"> I need Help </span>
        </a>
      </div>
    </div>
    <?php
        if($num_row > 0)
        {
        ?>
		<div class="row">
			      <!-- Panel Table Tools -->
      <div class="panel">
        <header class="panel-heading">
          <h3 class="panel-title">Transaction data for: <?php
              $sqlname = $db->query("SELECT * FROM accounts WHERE id = '$group_id'");
              $fetchname = mysqli_fetch_array($sqlname);
              echo  $name = $fetchname['accName'];
          ?></h3>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="exampleTableTools">
            <thead>
              <tr>
              <th>#</th>
                <th>Transaction id -</th>
                <th>Amount -</th>
                <th>From -</th>
                <th>Date -</th>
                <th>Operation -</th>
                <th>Status -</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Transaction id -</th>
                <th>Amount -</th>
                <th>From -</th>
                <th>Date -</th>
                <th>Operation -</th>
                <th>Status -</th>
              </tr>
            </tfoot>
            <tbody>
            <?php
          
              ?>
            <?php while($fetch_account = mysqli_fetch_array($sql_account))
            {
              $n++;
              $tr_id = $fetch_account['id'];
              $tr_amount = $fetch_account['amount'];
              $tr_date = $fetch_account['transaction_date'];
              $tr_operation = $fetch_account['operation'];
              $tr_from = $fetch_account['to_from_client'];
              ?>
              <tr>
              <td><?php echo $n; ?></td>
                <td><?php echo $tr_id;?></td>
                <td><?php echo $tr_amount?></td>
                <td><?php echo $tr_from?></td>
                <td><?php echo $tr_date?></td>
                <td><?php echo $tr_operation?></td>
                <td>*********</td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->
		</div>
              <?php
            }
            else
            {
              echo "Sorry empty";
            }
          ?>
    </div>
  </div>
  <!-- End Page -->


  <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">© 2015 <a href="#">uplus</a></div>
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


  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
  </script>


  
  </script>
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/material/iconbar/pages/blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Nov 2016 13:59:26 GMT -->
</html>