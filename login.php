<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<title>uplus</title>
	<!-- Tile icon for Win8 (144x144 + tile color) -->
	
	<link rel="shortcut icon" href="images/favicon.png">
	<link rel="stylesheet" href="f/css/style.css" />
	<link rel="stylesheet" href="frontassets/css/login.css" />
	<link rel="stylesheet" href="frontassets/css/bootstrap.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name="google-signin-client_id" content="379438117383-o6vjannfqu8kj0r9e686nuajqei2gjfm.apps.googleusercontent.com">
	
	
	
	<link rel="stylesheet" href="frontassets/css/material.teal-deep_orange.min.css">
	<script defer src="frontassets/js/material.min.js"></script>	
</head>
<body>
<script>
 // This is called with the results from from FB.getLoginStatus().
	function statusChangeCallback(response){
		console.log('statusChangeCallback');
		if (response.status === 'connected') {
			testAPI();
		} else if (response.status === 'not_authorized') {
			alert('you are logedin but not connectd');
			document.getElementById('login').innerHTML = '<button class="btn btn-block btn-social btn-facebook btn-flat">'
			+'<i class="fa fa-facebook"></i>Sign up using Facebook</button></div>';
		} else {
			//alert('problems');
		}
	}
	function checkLoginState(){
		alert('colled checkLoginState');
		FB.getLoginStatus(function(response) {
		  statusChangeCallback(response);
		});
	}

  window.fbAsyncInit = function(){
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

  //1 Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
	
  }(document, 'script', 'facebook-jssdk'));
  
	function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', 'GET', {fields: 'email, first_name,last_name,name,id,gender,picture.with(15).height(150)'}, function(response) {
		var email = response.email;
		var name = response.name;
		var gender = response.gender;
		var fbId = response.id;
		var picture = response.picture.data.url;
		document.getElementById('soza').innerHTML = 'Loadding...<br/><div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div><br/>';
	
	FB.logout(function(response) {
		//alert('loged out');// Person is now logged out
	});
		$.ajax({
				type : "GET",
				url : "scripts/savefacebook.php",
				dataType : "html",
				cache : "false",
				data : 
				{
					email : email,
					savename : name,
					fbId : fbId,
					gender : gender,
					picture : picture,
					
				},
				success : function(html, textStatus){
					
				window.location.replace("home");
				//$("#soza").html(html);
				//document.getElementById('soza').innerHTML = '';
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
		});
   });
  }

</script>
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header  class="mdl-layout__header mdl-layout__header--scroll" style="background: #fff; position: fixed;box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);  transition: all 280ms cubic-bezier(0.4, 0, 0.2, 1);">
			<nav class="uk-navbar">
				<div class="topBar">
					<a href="index.php" >
						<img src="frontassets/img/logo_main.png" alt="" width="71" style="height: 100%;" class="dense-image dense-loading">
					</a>
					<a href="index.php" class="backBtn"><i class="fa fa-arrow-left"></i> Back Home</a>
				</div>
			</nav>
		</header>
		<main class="mdl-layout__content loginBody">
			<div class="darken"></div>
			<div class="loginBack">
				<div class="logo">
					<img src="frontassets/img/logo_main.png" alt="" width="120" style="height: 100%;"/>
					<br/><br/>Login or Create an acount if you dont have one
				</div>
				<div id="soza"><hr/></div>
				<div class="btnHolder" id="loginResults">
					<div id="login" onlogin="checkLoginState();">
						<button class="btn btn-block btn-social btn-facebook btn-flat">
						<i class="fa fa-facebook"></i> Sign in using Facebook</button>
					</div>
					<br/>
					<br/>
					<div class="g-signin2" data-onsuccess="onSignIn"></div>
					<button class="btn btn-block btn-social btn-google btn-flat" data-onsuccess="onSignIn" data-gapiscan="true" data-onload="true"><i class="fa fa-google-plus"></i> Sign in using Google+</button>
					<br/><br/>
					<button  onclick="location.href = 'phoneLogin.php';" class="btn btn-block btn-social btn-mobile btn-flat"><i class="fa fa-mobile"></i> Sign in using SMS</button>
					<br/>
				</div>
			</div>
		</main>
	</div>
	<script>
	  document.querySelector('#p1').addEventListener('mdl-componentupgraded', function() {
		this.MaterialProgress.setProgress(44);
	  });
	</script>
	<script>
	(function ($) {
	$(function () {
		$("#login button").on("click", function () {
			FB.login(function(response) {
				if (response.authResponse) {
					testAPI();
				}
			});
		});
	});
	})(jQuery);
	</script>

<script>
  
function onSignIn(googleUser) {
	var profile = googleUser.getBasicProfile();
	var name = profile.getName();
	var gender = 'male';
	var fbId = profile.getId();
	var picture = profile.getImageUrl();
	
	var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
	document.getElementById('soza').innerHTML = 'Loadding...<br/><div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div><br/>';
	$.ajax({
			type : "GET",
			url : "scripts/savefacebook.php",
			dataType : "html",
			cache : "false",
			data : 
			{
				savename : name,
				fbId : fbId,
				gender : gender,
				picture : picture,
			},
			success : function(html, textStatus){
			window.location.replace("home");
			//$("#soza").html(html);
			//document.getElementById('soza').innerHTML = '';
		},
		error : function(xht, textStatus, errorThrown){
			alert("Error : " + errorThrown);
		}
	});
}
</script>	
</body>
</html>
