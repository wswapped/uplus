<?php
ob_start(); session_start(); include('db.php');?>
<?php // 1 Get the sent password and code from login_password 2.2 and save them into the db
if (isset($_POST['phone3'])){	
	$results = "";
	$phone3 = $_POST['phone3'];
	$password3 = $_POST['password3'];
	$code = $_POST['code'];
	require_once('classes/sms/AfricasTalkingGateway.php');
$username   = "cmuhirwa";
$apikey     = "7ffaed2780ff7d179d4ebe07ecabc8ba857dd04ab0c1cc406be7ca2596d3824a";
$recipients = '+25'.$phone3;
$message    = 'Wellcome to uPlus, Please use '.$code.' to activate your uPlus account.';// Specify your AfricasTalking shortCode or sender id
$from = "UPLUS";

  $gateway    = new AfricasTalkingGateway($username, $apikey);

  try 
  {
     
     $results = $gateway->sendMessage($recipients, $message, $from);
        
    foreach($results as $result) {
     // echo " Number: " .$result->number;
     // echo " Status: " .$result->status;
     // echo " MessageId: " .$result->messageId;
     // echo " Cost: "   .$result->cost."\n";
    }
  }
  catch ( AfricasTalkingGatewayException $e )
  {
    $results.="Encountered an error while sending: ".$e->getMessage();
  }
	
	$sql = $db->query("SELECT * FROM users WHERE phone='$phone3'");
	$count_sql = mysqli_num_rows($sql);
	// 1.1 maybe your password was 0 and the system needs a real password
	if($count_sql > 0){ 
	$sql = $db->query("UPDATE `users` SET `password` = '$password3', code= '$code' WHERE phone = '$phone3'")or die (mysqli_error());
	}
	else{
	// if you are fresh new not existing lets create you
	$sql = $db->query("INSERT INTO `users` (`phone`, `password`, visits, `code`, joinedDate)
	VALUES ('$phone3', '$password3', 1, '$code', now())")
	or die (mysqli_error());
	}
	$results.= 'Please use the code we sent on your phone to activate your account<br/>
	<form action="login_code.php" method="post" class="wizard-content" id="exampleFormContainer">
	<div class="wizard-pane active" role="tabpanel">
        <div class="form-group">
            <label class="control-label" for="inputUserNameOne">Code:</label>
		<input type="number" max="9999" name="vcode" class="form-control"/>
		<input type="number" name="code2" hidden value="'.$code.'"/>
		<input type="number" name="phone4" hidden value="'.$phone3.'"/>
		<input type="text" name="password4" hidden value="'.$password3.'" />
		</div>
	</div>
		<input type="submit" class="btn btn-raised btn-success btn-block btn-outline active" value="activate"/>
	</form>
	';
}
?>

<?php // 2 Grab the code from the db and the code the user types and compare them if maches then activate the account, set session and login.
if (isset($_POST['vcode'])){
	$results = "";
	$vcode = $_POST['vcode'];
	$phone4 = $_POST['phone4'];
	$password4 = $_POST['password4'];
	$code2 = $_POST['code2'];
	if ($vcode == $code2){ // 2.1 Verify if the use uses the code sent on his her phone, if yes then activate the account.
		
		$sql = $db->query("UPDATE users SET active ='1' WHERE phone = '$phone4' and code = '$code2'")
		or die (mysqli_error());
		
		// 2.2 Set the session and login.
		
		$sql2 = $db->query("SELECT * FROM users WHERE phone = '$phone4' and code = '$code2' LIMIT 1")
		or die (mysqli_error()); // query the person
		$existCount= mysqli_num_rows($sql2);
		if ($existCount == 1) { // evaluate the count
			while($row = mysqli_fetch_array($sql2)){ 
				$id = $row["id"];
			}
		
			$_SESSION["id"] = $id;
			//$_SESSION["id"] = 'cat';
			$_SESSION["phone1"] = $phone4;
			//$_SESSION["phone1"] = '12';
			$_SESSION["password"] = $password4;
			//$_SESSION["password"] = 'pig';
		
			$results.='account activated! <a href="home.php">Please Click here to login</a>';
		}
		else{
			$results.='there is an error on the id and phone session.';
		}
	}
	else{
		$results.='code did not meet please try again<br/>
	<form action="login_code.php" method="post" class="wizard-content" id="exampleFormContainer">
	<div class="wizard-pane active" role="tabpanel">
        <div class="form-group">
            <label class="control-label" for="inputUserNameOne">Code:</label>
		<input type="number" max="9999" name="vcode" class="form-control"/>
		<input type="number" name="code2" hidden value="'.$code2.'"/>
		<input type="number" name="phone4" hidden value="'.$phone4.'"/>
		<input type="text" name="password4" hidden value="'.$password4.'" />
		</div>
	</div>
		<input type="submit" class="btn btn-raised btn-success btn-block btn-outline active" value="activate"/>
	</form>';
		}
};
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
                  <span class="pearl-title">Pin</span>
                </div>
                <div class="pearl current col-xs-4">
                  <div class="pearl-icon"><i class="icon wb-check" aria-hidden="true"></i></div>
                  <span class="pearl-title">Confirm</span>
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
			url : "scripts/testlog.php",
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