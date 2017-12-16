<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uplus</title>

  <link rel="icon" type="image/png" href="frontassets/img/favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="frontassets/img/favicon-32x32.png" sizes="32x32">
  
  <link rel="stylesheet" href="frontassets/bower_components/uikit/css/uikit.almost-flat.min.css" media="all">
  <link rel="stylesheet" href="frontassets/css/main.css" media="all">

  <link rel="stylesheet" href="frontassets/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
  <link rel="stylesheet" href="frontassets/css/style.css" media="all">

  <link rel="stylesheet" href="frontassets/css/login.css" />
  <link rel="stylesheet" href="frontassets/css/bootstrap.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
  
    .col-md-3{
        padding: 0px 30px 0px 15px;
    }
</style>
</head>
<body>
<header id="header_main">
    <nav class="uk-navbar" style="background-color: #007569">
        <div class="uk-container uk-container-center">
          <a href="index.php" class="uk-float-left" id="mobile_navigation_toggle" data-uk-offcanvas="{target:'#mobile_navigation'}"><i class="material-icons" style="color: #fff;">&#xE5D2;</i></a>
          <div class="homelogocont">
      			<a href="index.php" >
      				<img src="frontassets/img/logo_main_3.png" alt="" width="71" style="box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
      		    height: 50px;
      		    width: 50px;
      		    border-radius: 100px;
      		    margin: auto;
      		    background-color: #fff;
      		    cursor: pointer;" class="dense-image dense-loading">
      			</a>
	        </div>
          <span class="loginspan"><a href="login.php" class="md-btn md-btn-primary uk-navbar-flip header_cta uk-margin-left">SIGN IN</a></span>
          <div class="uk-navbar-flip">
            <ul class="uk-navbar-nav" id="main_navigation">
                <li>
                    <a href="./">
                        Home
                    </a>
                </li>
                <li class="current_active">
                    <a href="#">
                        About Us
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
  			<a href="./">
  				<span class="menu_icon"><i class="material-icons">&#xE7FB;</i></span>
  				<span class="menu_title">Home</span>
  			</a> 
  		</li>
  		<li>
  			<a href="section2" data-uk-smooth-scroll="{offset: 48}">
  				<span class="menu_icon"><i class="material-icons">&#xE7FB;</i></span>
  				<span class="menu_title">About</span>
  			</a> 
  		</li>
    </ul>
  </div>
</div>
<div class="row" style="background: #e9ebee;">
  <div class="col-md-9" style="padding: unset; margin: unset;">
    <section id="about-us" class="clearfix bgColor2" id="section1">
      <div class="sectionContent">
        <div class="row" style="background: #fff;">
          <div class="col-md-12">
          <h3 class="aboutTitle">About:</h3>
          <div style="margin: 0 30px;">
            <div class="aboutSubTitle">Business Information</div>
              <p>
                <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
              Founded on Sept 2, 2017</p>
              <p>
                <i class="fa fa-whatsapp" aria-hidden="true"></i>
              Conctacts: +250784848236 / info@uplus.rw</p>
                <p>Uplus stands for you + me = wealth, A digital contribution platform which enables people to pool money togather in a group and make something happen like a Savings group,
                a Wedding party, Investment vehicles, etc...
                </p>
              <div class="aboutSubTitle">Why uplus</div>
                <ul class="fa-ul" style="line-height: 200%;">
                  <li><i class="fa-li fa fa-shield "></i> Security: All transaction are secured by a blockchain technology</li>
                  <li><i class="fa-li fa fa-mobile fa-lg"></i> Smarter & Faster: It takes less than a minute to create a group and start recieving your first cashless contribution.</li>
                  <li><i class="fa-li fa fa-credit-card"></i>CrossBorder: With uplus you can accept contributions from any country any currency into your local currency</li>
                  <li><i class="fa-li fa fa-connectdevelop"></i>CrossNetwork: With uplus, money is just money, you dont have to worry about using mtn mobile money or tigo cash, 
                  You just contribute as easy as sending an sms.</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section  id="sect-team" class="section" id="section2">
      <div class="sectionContent">
        <h3 class="aboutTitle">SERVICES</h3>
        <div class="row">
          <div class="col-md-4">
            <div class="thumbnail">
              <div class="thumbTitle" style="background: #3f50b6;">Smart contributions</div> 
              <div class="caption">
                  <p>With your smartphone, collect money in a group and make something happen!
                  <br/>Like: Wedding, birthday party.</p>
                </div>
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="thumbnail">
              <div class="thumbTitle" style="background: #4caf50;">Village Savings Groups</div>
              <div class="caption">
                <p>Village Savings And Loans Associations uses uplus to manage and secure their contributions</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="thumbnail">
              <div class="thumbTitle" style="background: #870e4e;">Churches</div>
              <div class="caption">
                <p>Churches use uplus to accept donations from any source easly 
                  and stay connected whith thier church members.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="col-md-3 aboutBlog">
    <ul class="uk-grid uk-grid-small  uk-grid-width-medium-1-1 uk-grid-width-large-1-1">
      <li style="margin: 10px 0;">
        <div class="md-card" style="border-radius: 5px;">
          <div class="md-card-content padding-reset">
            <div class="cont-image" style="height: 170px; background-image: url(frontassets/img/aboutimg/ssa2.jpg); border-radius: 5px 5px 0 0;">
              <div class="cont-image" style="height: 100%; width: 100%; border-radius: 5px 5px 0 0; background-image: url(temp/group'.$row['id'].'.jpeg);"></div>
            </div>
          </div> 
          <div class="md-card-content" style="min-height: 74px;    padding: 10px;">
            <a href="http://inyarwanda.com/articles/show/BusinessNews/urubyiruko-rukomeje-kugaragaza-udushya-mu-kwihangira-imirimo-79343.html" class="cardTitle">Best Mobile App</a>
            <div class="cardSubTitle" style="font-size: 13px;">On 25 sept 2017 at smart services awards, uplus wan the best mobile app awrd</div>
          </div>
        </div>
      </li>
      <li style="margin: 10px 0;">
        <div class="md-card" style="border-radius: 5px;">
          <div class="md-card-content padding-reset">
            <div class="cont-image" style="height: 170px; background-image: url(frontassets/img/aboutimg/itu2.jpg); border-radius: 5px 5px 0 0;">
              <div class="cont-image" style="height: 100%; width: 100%; border-radius: 5px 5px 0 0; background-image: url(temp/group'.$row['id'].'.jpeg);"></div>
            </div>
          </div> 
          <div class="md-card-content" style="min-height: 74px;    padding: 10px;">
            <a href="https://telecomworld.itu.int/exhibitor-sponsor-list/uplus-mutual-partners/" target="blank"  class="cardTitle">ITU exhibition</a>
            <div class="cardSubTitle" style="font-size: 13px;">On 25 sept 2017 Uplus was exhibiting at 2017 ITU world summit (South Korea)</div>
          </div>
        </div>
      </li>
      <li style="margin: 10px 0;">
        <div class="md-card" style="border-radius: 5px;">
          <div class="md-card-content padding-reset">
            <div class="cont-image" style="height: 170px; background-image: url(frontassets/img/aboutimg/ussd1.jpg); border-radius: 5px 5px 0 0;">
              <div class="cont-image" style="height: 100%; width: 100%; border-radius: 5px 5px 0 0; background-image: url(temp/group'.$row['id'].'.jpeg);"></div>
            </div>
          </div> 
          <div class="md-card-content" style="min-height: 74px;    padding: 10px;">
            <a target="blank"  class="cardTitle">Introducing USSD</a>
            <div class="cardSubTitle" style="font-size: 13px;">You can use uplus on a simple phone witought intenet by *801*2#</div>
          </div>
        </div>
      </li>
      <li style="margin: 10px 0;">
        <div class="md-card" style="border-radius: 5px;">
          <div class="md-card-content padding-reset">
            <div class="cont-image" style="height: 170px; background-image: url(frontassets/img/aboutimg/mtn.jpg); border-radius: 5px 5px 0 0;">
              <div class="cont-image" style="height: 100%; width: 100%; border-radius: 5px 5px 0 0; background-image: url(temp/group'.$row['id'].'.jpeg);"></div>
            </div>
          </div> 
          <div class="md-card-content" style="min-height: 74px;    padding: 10px;">
            <a target="blank" class="cardTitle">MTN M.M transactions</a>
            <div class="cardSubTitle" style="font-size: 13px;">Uplus started accepting MTN Mobile Money Transactions</div>
          </div>
        </div>
      </li>
      <li style="margin: 10px 0;">
        <div class="md-card" style="border-radius: 5px;">
          <div class="md-card-content padding-reset">
            <div class="cont-image" style="height: 170px; background-image: url(frontassets/img/aboutimg/akoma.jpg); border-radius: 5px 5px 0 0;">
              <div class="cont-image" style="height: 100%; width: 100%; border-radius: 5px 5px 0 0; background-image: url(temp/group'.$row['id'].'.jpeg);"></div>
            </div>
          </div> 
          <div class="md-card-content" style="min-height: 74px;    padding: 10px;">
            <a href="http://akomanet.com/uplus-app-thats-changing-rwandas-saving-culture/" target="blank" class="cardTitle">Seen on Akoma</a>
            <div class="cardSubTitle" style="font-size: 13px;">Uplus cover story on akomma</div>
          </div>
        </div>
      </li>
      <li style="margin: 10px 0;">
        <div class="md-card" style="border-radius: 5px;">
          <div class="md-card-content padding-reset">
            <div class="cont-image" style="height: 170px; background-image: url(frontassets/img/aboutimg/data4fi.jpg); border-radius: 5px 5px 0 0;">
              <div class="cont-image" style="height: 100%; width: 100%; border-radius: 5px 5px 0 0; background-image: url(temp/group'.$row['id'].'.jpeg);"></div>
            </div>
          </div> 
          <div class="md-card-content" style="min-height: 74px; padding: 10px;">
            <a href="http://www.newtimes.co.rw/section/read/208173/" target="blank" class="cardTitle">Uplus Won the hackathon</a>
            <div class="cardSubTitle">Uplus became the 2nd best fintech in the DataHacks 4fi hackathon</div>
          </div>
        </div>
      </li>
      <li style="margin: 10px 0;">
        <div class="md-card" style="border-radius: 5px;">
          <div class="md-card-content padding-reset">
            <div class="cont-image" style="height: 170px; background-image: url(frontassets/img/aboutimg/afr.jpg); border-radius: 5px 5px 0 0;">
              <div class="cont-image" style="height: 100%; width: 100%; border-radius: 5px 5px 0 0; background-image: url(temp/group'.$row['id'].'.jpeg);"></div>
            </div>
          </div> 
          <div class="md-card-content" style="min-height: 74px; padding: 10px;">
            <a href="http://www.afr.rw/focus-areas/digitalizing-financial-services/article/digitization-of-savings-groups" target="blank" class="cardTitle">Partnership With AFR</a>
            <div class="cardSubTitle">Uplus started a partnership with AFR to digitize 200 village saving groups</div>
          </div>
        </div>
      </li>
      <li style="margin: 10px 0;">
        <div class="md-card" style="border-radius: 5px;">
          <div class="md-card-content padding-reset">
            <div class="cont-image" style="height: 170px; background-image: url(frontassets/img/aboutimg/topstartup.jpg); border-radius: 5px 5px 0 0;">
              <div class="cont-image" style="height: 100%; width: 100%; border-radius: 5px 5px 0 0; background-image: url(temp/group'.$row['id'].'.jpeg);"></div>
            </div>
          </div> 
          <div class="md-card-content" style="min-height: 74px;    padding: 10px;">
            <a href="http://www.igihe.com/ikoranabuhanga/article/ibigo-12-by-ikoranabuhanga-mu-rwanda-bifite-udushya-dushobora-guhangwa-amaso-mu" target="blank" class="cardTitle">Listed in Rwanda top Startups</a>
            <div class="cardSubTitle" style="font-size: 13px;">Uplus was listed in the top Rwandan Startups</div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>
<?php include 'footer.php';?>
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
</body>
</html>
