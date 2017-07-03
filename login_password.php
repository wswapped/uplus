<?php ob_start(); session_start(); include('db.php');?>
<?php
if (isset($_SESSION["phone1"])) {
    header("location: index.php"); 
    exit();
}
error_reporting(0);
?>
<?php // 2 If the phone exists ask password if not ask to create password
if (isset($_POST['phone'])){
	$phone = $_POST['phone'];
	$results="";
	$code="";
	$sql = $db->query("SELECT * FROM users WHERE phone='$phone' AND password != 0");
	$count_sql = mysqli_num_rows($sql);
	if($count_sql > 0){ 
	// 2.1 the user exists then ask the password and send to this page to login or try again
	$results.=' 
	<form action="login_password.php" method="post" class="wizard-content" id="exampleFormContainer"> 
	<div class="wizard-pane active" role="tabpanel">
                  <div class="form-group">
                    <label class="control-label" for="password" >Pin:</label>
		<input type="text" name="phone2" id="phone2" value="'.$phone.'" hidden/><br/>
		<input type="number" name="password" id="password" max="9999" required class="form-control focus"/>
			</div>
                  
                </div>
              <input class="btn btn-raised btn-success btn-block btn-outline active" type="submit" value="Next"/>
	</form>';
	
	}
	else{
	
	// 2.2 the user does not extist then ask to create the password and send to login_code.php for verification
		$a1 = rand(1,9);
		$a2 = rand(9,1);
		$a3 = rand(1,9);
		$a4 = rand(9,1);
		$code .=''.$a1.''.$a2.''.$a3.''.$a4.'';
		$results.='
		You are new to this creat a password <br/>
	<form action="login_code.php" method="post" class="wizard-content" id="exampleFormContainer">
		<div class="wizard-pane active" role="tabpanel">
			<div class="form-group">
					<label class="control-label" for="inputUserNameOne">Pin:</label>
				<input type="text" name="phone3" id="phone3" value="'.$phone.'" hidden/>
				<input type="text" name="code" id="code" value="'.$code.'" hidden>
				<input type="number" name="password3" id="password3" max="9999" required class="form-control focus"/>
			</div>
		</div>
				<input class="btn btn-raised btn-success btn-block btn-outline active" type="submit" value="Next"/>
	</form>';
	}
}

?>

<?php // 3 If the password from 2.1 maches establishe a session and redirect
if (isset($_POST['password'])){
	$results ="";
	$phone2 = $_POST['phone2'];
	$password = $_POST['password'];
	$help ="";
	$sql_check_phone = $db->query("SELECT * FROM users WHERE phone = '$phone2' AND password = '$password' limit 1");
	$existCount= mysqli_num_rows($sql_check_phone);
	if ($existCount == 1) { // evaluate the count
	     while($row = mysqli_fetch_array($sql_check_phone)){ 
             $id = $row["id"];
		 }
		
		 $_SESSION["id"] = $id;
		 $_SESSION["phone1"] = $phone2;
		 $_SESSION["password"] = $password;
		 $sqlvisitation = $db->query("SELECT `visits` FROM `users` WHERE id = $id")or die (mysqli_error());
		 while($row = mysqli_fetch_array($sqlvisitation)){
			 $lastvisit = $row['visits'];
		 }$newvisit = $lastvisit + 1;
		 $sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now() WHERE id = $id")or die (mysqli_error());
		 header("location: home");
         exit();
    }else {$results.='Password did not much, please check your password again.<br/>
	or go back to change you phone number <a href="login.php">back</a>
	<br/>
	<br/>
	<form action="login_password.php" method="post" class="wizard-content" id="exampleFormContainer">
	<div class="wizard-pane active" role="tabpanel">
                  <div class="form-group">
                    <label class="control-label" for="inputUserNameOne">Password:</label>
		<input type="text" name="phone2" id="phone2" value="'.$phone2.'" hidden><br/>
		<input type="number" name="password" id="password" value="'.$password.'" required class="form-control"/>
			</div>
                  
                </div>
              <input class="btn btn-raised btn-success btn-block btn-outline active" type="submit" value="Next"/>
	</form>
	';}
}
else{
	 $help="";
}
?>
<!DOCTYPE html>
<html  class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Clement_Product"> 
  <meta name="author" content="">

  <title>uPlus_Password</title>

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
				
            <h2 class="brand-text font-size-18">uPlus</h2>
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
                <div class="pearl current col-xs-4">
                  <div class="pearl-icon"><i class="icon wb-lock" aria-hidden="true"></i></div>
                  <span class="pearl-title">Password</span>
                </div>
                <div class="pearl col-xs-4">
                  <div class="pearl-icon"><i class="icon wb-check" aria-hidden="true"></i></div>
                  <span class="pearl-title">Confirmation</span>
                </div>
              </div>
              <!-- End Steps -->

              <!-- Wizard Content -->
			  
              <?php echo $results;?>
             </div> <!-- Wizard Content -->
            </div>
          </div>
        <!-- End Panel Wizard Form Container -->
       
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
  
  
   <script>
function register(){
	var reg = $("#phone").val();
	alert (reg);
	$.ajax({
			type : "GET",
			url : "../tables/testlog.php",
			dataType : "html",
			cache : "false",
			data : {
				
				reg : reg,
			},
			success : function(html, textStatus){
				$("#reg").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
  </script>

</body>
</html>