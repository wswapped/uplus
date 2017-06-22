		<!doctype html>

		<html lang="en">
		  <head>
		    <meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    
			<meta property="fb:app_id"             content="1822800737957483">
			<meta property="og:url"                content="http://uplus.rw/f/i<?php echo $groupID?>" >
			<meta property="og:type"               content="article" >
			<meta property="og:title"              content="<?php echo $groupName?> (<?php echo number_format($saving);?> Rwf)">
			<meta property="og:description"        content="<?php echo $groupDesc?>">
			<meta property="og:image"              content="http://uplus.rw/temp/group<?php echo $groupID;?>.jpeg" >
			
			<meta name="description" content="<?php echo $groupDesc?>">
<style type="text/css">
       @media screen and (max-width:992px){

          .grid_resp {
             width: 45% !important;
       float: left;
       margin-left: 3.5%;
       /* bottom: 20px; */
       margin-bottom: 3.5%;
       }

        
    }

      @media screen and (max-width:549px){

       .grid_resp {
       width:100% !important;
       float: left;
       margin-left:0%;
       /* bottom: 20px; */
       margin-bottom: 3.5%;
       }
    input[type="text"]{height:20px; vertical-align:top;}
    .field_wrapper div{ margin-bottom:10px;}
    .add_button{ margin-top:10px; margin-left:10px;vertical-align: text-bottom;}
    .remove_button{ margin-top:10px; margin-left:10px;vertical-align: text-bottom;}
      
    }

    .social-auth-links {
       margin: 10px 0;
    }
    .btn-flat{
       font-size: 18px; border-radius:0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;border-width:1px;}

    .btn-facebook {
       color: #fff;
       background-color: #3b5998;
       border-color: rgba(0,0,0,0.2);
    }
	
	.btn-mobile {
       color: #fff;
       background-color: #007569;
       border-color: rgba(0,0,0,0.2);
    }

    .btn-social {
       position: relative;
       padding-left: 44px;
       text-align: left;
       white-space: nowrap;
       overflow: hidden;
       text-overflow: ellipsis;
    }    

    .btn-google {
       color: #fff;
       background-color: #dd4b39;
       border-color: rgba(0,0,0,0.2);
    }
    .btn-google:hover {
       color: #fff;
       background-color: #c23321;
       border-color: rgba(0,0,0,0.2);
    }
    .btn-facebook:hover{
       color:#fff;
       background-color:#2d4373;
       border-color:rgba(0,0,0,0.2);
    }
    .btn-social>:first-child {
       position: absolute;
       left: 0;
       top: 0;
       bottom: 0;
       width: 64px;
       line-height: 34px;
       font-size: 1.6em;
       text-align: center;
       border-right: 1px solid rgba(0,0,0,0.2);
    }
    </style>

	
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
			
			<link rel="stylesheet" href="f/css/style.css" />
			
			<link rel="stylesheet" href="frontassets/css/bootstrap.css">
  
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


	
</head>
<body>
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header  class="mdl-layout__header mdl-layout__header--scroll" style="background: #fff; position: fixed;box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);  transition: all 280ms cubic-bezier(0.4, 0, 0.2, 1);">
			<nav class="uk-navbar">
				<div style="margin-left: auto; margin-right: auto; max-width: 1200px; padding: 0 35px; color: #444;
">
						<a href="index.php" >
							<img src="frontassets/img/logo_main.png" alt="" width="71" style="height: 100%;" class="dense-image dense-loading">
						</a>
						<a href="home" style="color: #fff;
    float: right;
    background: #2196F3;
    margin-top: 14px;
    border: none;
    border-radius: 2px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    min-height: 31px;
    min-width: 70px;
    padding: 2px 16px;
    text-align: center;
    text-shadow: none;
    text-transform: uppercase;
    box-sizing: border-box;
    cursor: pointer;
    -webkit-appearance: none;
    display: inline-block;
    vertical-align: middle;
    font: 500 14px/31px 'Roboto', sans-serif !important;">SIGN IN</a>
					</div>
				</nav>
			</header>
			
			<main class="mdl-layout__content" style="    padding: 90px 30%;
    background-image: url(register/assets//paper_img/landscape.jpg);
    background-position: center center;
    background-size: cover;
    min-height: 100vh;
    overflow: hidden;
    position: absolute;
    width: 100%;
">
<div style="background-color: rgba(0, 0, 0, 0.5);
    display: block;
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 2;"></div>
		    	<div style="    position: relative;
    z-index: 4;
    background: #fff;
    min-height: 450px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25); padding: 50px 40px 40px;
	border-radius:10px
    ">
	<div class="logo" style="width:100%; text-align: center;">
	<img src="frontassets/img/logo_main.png" alt="" width="120" style="height: 100%;"/>
	<br/><br/>Login or Creat an acount if you dont have one</div>
	
	<hr/>
	<div style="text-align: center; padding: 0px 30px;" id="loginResults">
			
		<button class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</button>
		<br/>
		<button class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</button>
		<br/>or<br/><br/>
		<button  onclick="location.href = 'login.php';" class="btn btn-block btn-social btn-mobile btn-flat"><i class="fa fa-mobile"></i> Sign in using SMS</button>
		<br/>
	</div>
	</div>
			</main>
		    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
			
		  <!-- MDL Progress Bar with Buffering -->

</body>
</html>
