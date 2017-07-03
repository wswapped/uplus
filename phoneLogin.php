<?php ob_start(); session_start(); include('db.php');?>
<?php 
if (isset($_SESSION["phone1"])) {
    header("location: home.php"); 
    exit();
}
error_reporting(0);
?>
<!DOCTYPE html>
<html  class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Clement_Product"> 
  <meta name="author" content="">

  <title>uPlus_Login</title>

  <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="assets/global/css/bootstrap.min3f0d.css?v2.0.0">
  <link rel="stylesheet" href="assets/global/css/bootstrap-extend.min3f0d.css?v2.0.0">
  <link rel="stylesheet" href="assets/css/site.min3f0d.css?v2.0.0">

  
  <link rel="stylesheet" href="assets/css/site.min3f0d.css?v2.0.0">

  <!-- Plugins -->
  <link rel="stylesheet" href="assets/global/vendor/animsition/animsition.min3f0d.css?v2.0.0">

  <link rel="stylesheet" href="assets/examples/css/pages/login-v3.min3f0d.css?v2.0.0">
  <!-- Plugins For This Page -->
  <link rel="stylesheet" href="assets/global/vendor/jquery-wizard/jquery-wizard.min3f0d.css?v2.0.0">

  <!-- Fonts -->
  <link rel="stylesheet" href="assets/global/fonts/web-icons/web-icons.min3f0d.css?v2.0.0">
  <link rel="stylesheet" href="assets/global/fonts/brand-icons/brand-icons.min3f0d.css?v2.0.0">
 
  <!-- Scripts -->
  <script src="assets/global/vendor/modernizr/modernizr.min.js"></script>
  <script src="assets/global/vendor/breakpoints/breakpoints.min.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body class="page-login-v3 layout-full">
 <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
	<div class="page-content vertical-align-middle container-fluid">
        <!-- Panel Wizard Form Container -->
          <div class="panel" id="">
             <div class="panel-heading">
              <h3 class="panel-title">
				<div class="brand">
				<img class="brand-img" width="100" src="assets/images/logo-blue.png" alt="...">
				<h2 class="brand-text font-size-18">uPlus <small>v 1.0</small>
        </h2>
        <!--<small><mark>beta</mark></small>-->
				</div>
			  </h3>
            </div>
            <div class="panel-body">
              <!-- Steps -->
              <div class="pearls row">
                <div class="pearl current col-xs-4">
                  <div class="pearl-icon"><i class="icon wb-user" aria-hidden="true"></i></div>
                  <span class="pearl-title">Phone</span>
                </div>
                <div class="pearl col-xs-4">
                  <div class="pearl-icon"><i class="icon wb-lock" aria-hidden="true"></i></div>
                  <span class="pearl-title">PIN</span>
                </div>
                <div class="pearl col-xs-4">
                  <div class="pearl-icon"><i class="icon wb-check" aria-hidden="true"></i></div>
                  <span class="pearl-title">Confirm</span>
                </div>
              </div>
              <!-- End Steps -->
              <!-- Wizard Content -->
              <form action="login_password.php" method="post" class="wizard-content" id="exampleFormContainer">
				<div class="wizard-pane active" role="tabpanel">
                  <div class="form-group">
                    <label class="control-label" for="inputUserNameOne">Phone</label>
                    <input type="number" class="form-control focus" id="phone" name="phone" required>
                  </div>
                </div>
              <input class="btn btn-raised btn-success btn-block btn-outline active" type="submit" value="Next"/>
			  </form>
             </div> <!-- Wizard Content -->
            
			</div>
			<footer class="page-copyright page-copyright-inverse">
        <div class="social">
          <a class="btn btn-icon btn-pure waves-effect waves-classic" href="https://build.phonegap.com/apps/2382483/download/android/?qr_key=TxuqxfvQJWDB9zebAS7G">
            <i class="icon bd-android" aria-hidden="true"></i>
          </a>
          <a class="btn btn-icon btn-pure waves-effect waves-classic" href="apps/u+ios.apk">
            <i class="icon bd-apple" aria-hidden="true"></i>
          </a>
          <a class="btn btn-icon btn-pure waves-effect waves-classic" href="javascript:void(0)">
            <i class="icon bd-windows" aria-hidden="true"></i>
          </a>
        </div>
      </footer>
          </div>
        <!-- End Panel Wizard Form Container -->
    </div>
  </div>
 <!-- End Page -->
 <!-- Core  -->
  <script src="assets/global/vendor/jquery/jquery.min.js"></script>
  <script src="assets/global/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/global/vendor/animsition/animsition.min.js"></script>

  <!-- Scripts -->
  <script src="assets/global/js/core.min.js"></script>
  <script src="assets/js/site.min.js"></script>
  <script src="assets/global/js/components/animsition.min.js"></script>
  <script src="assets/global/js/components/matchheight.min.js"></script>
  <script src="assets/examples/js/forms/wizard.min.js"></script>

</body>

<!-- Mirrored from getbootstrapadmin.com/remark/iconbar/forms/wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Dec 2015 10:28:40 GMT -->
</html>