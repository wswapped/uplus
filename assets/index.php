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
</head>
<body>
    <!-- navigation -->
    <header id="header_main">
        <nav class="uk-navbar">
            <div class="uk-container uk-container-center">
                <a href="#" class="uk-float-left" id="mobile_navigation_toggle" data-uk-offcanvas="{target:'#mobile_navigation'}"><i class="material-icons">&#xE5D2;</i></a>
                <a href="index.php" class="uk-navbar-brand">
                    <img src="frontassets/img/logo_main.png" alt="" width="71" height="15">
                </a>
                <a href="home" class="md-btn md-btn-primary uk-navbar-flip header_cta uk-margin-left">SIGN IN</a>
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav" id="main_navigation">
                        <li>
                            <a href="#sect-overview">
                                Overview
                            </a>
                        </li>
                        <li>
                            <a href="#sect-features">
                                What can u Do?
                            </a>
                        </li>
                        <li>
                            <a href="#sect-pricing" class="uk-navbar-nav-subtitle">
                                13,600 Rwf
                                <div>Now Raised on Uplus</div>
                            </a>
                        </li>
                        <li>
                            <a href="#sect-team">
                                Advisers
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
					<a href="#sect-features" data-uk-smooth-scroll="{offset: 48}">
						<span class="menu_icon"><i class="material-icons">&#xE896;</i></span>
						<span class="menu_title">What can u Do?</span>
					</a>
				</li>
				<li>
					<a href="#sect-pricing" class="uk-navbar-nav-subtitle" data-uk-smooth-scroll="{offset: 48}">
						<span class="menu_icon"><i class="material-icons">&#xE227;</i></span>
						<span class="menu_title">840,000 Rwf<small>Now Raised on Uplus</small></span>
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
        <div data-uk-slideshow="{animation: 'swipe'}" data-uk-parallax="{yp: '25', velocity: '0.4'}" style="transform: translate3d(0px, 4.984%, 0px);">
            <ul class="uk-slideshow" style="height: 640px;">
                <li style="background-image: url(&quot;frontassets/img/slider/car.jpg&quot;); animation-duration: 500ms; height: 640px;" aria-hidden="false" class="uk-active">
                    <div class="uk-container uk-container-center">
                        <div class="slide_content_a">
                            <h2 class="slide_header">UPlus</h2>
                            <p>
                                You + You + You = wealth.
								<br>Uplus is a digital contribution Platform for social and savings contributions
							</p>
                            <a href="" class="md-btn md-btn-large md-btn-danger">Start a contribution!</a>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(&quot;frontassets/img/slider/stats.jpg&quot;); animation-duration: 500ms; height: 640px;" aria-hidden="true" class="">
                    <div class="uk-container uk-container-center">
                        <div class="slide_content_c">
                            <h2 class="slide_header">KUSANYA</h2>
                            <p>
								Using our website, or  USSD and Android mobile apps,
								you can start collecting money from your friends and family in less time than it takes to read this sentence.
								
                            </p>
                            <a href="home" class="md-btn md-btn-large md-btn-success">START A KUSANYA</a>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(&quot;frontassets/img/slider/paintings.jpg&quot;); animation-duration: 500ms; height: 640px;" aria-hidden="true" class="">
                    <div class="uk-container uk-container-center">
                        <div class="slide_content_b">
                            <h2 class="slide_header">SAVINGS</h2>
                            <p>
								Using your mobile phone thour uplus you can create a group of savings, invite members by thier phone numbers and start saving. The fun part of it is that you can invest your savings to RNIT instantly Uplus and withdrow anytime.
							</p>
                            <a href="home" class="md-btn md-btn-large">Create yours</a>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="slide_navigation">
                <a href="#" class="uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                <a href="#" class="uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
                <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
                    <li data-uk-slideshow-item="0" class="uk-active"><a href="#"></a></li>
                    <li data-uk-slideshow-item="1" class=""><a href="#"></a></li>
                    <li data-uk-slideshow-item="2" class=""><a href="#"></a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section section_dark md-bg-cyan-700">
        <div class="uk-container uk-container-center animate" data-uk-scrollspy="{cls:'uk-animation-slide-right animated',target:'> *',delay:300}">
            <h2 class="heading_a heading_light uk-text-center-medium">
                Make your money work for you
                <span class="sub-heading">
                    Save money, Raise money, Invest money
                </span>
            </h2>
        </div>
    </section>

    <section class="section section_large" id="sect-features">
        <div class="uk-container uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-large-3-5 uk-container-center uk-text-center">
                    <h2 class="heading_b">
                        What can you do on uplus
                        <span class="sub-heading">U+ is a contributional platform for group savings, social fundrasing and investments.<br> with uplus you can do this:</span>
                    </h2>
                </div>
            </div>
            <div class="uk-grid uk-grid-width-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 animate" data-uk-scrollspy="{cls:'uk-animation-slide-bottom animated',target:'> *',delay:300,topoffset:-100}">
                <div class="uk-margin-top">
                    <div class="uk-text-center uk-margin-bottom">
                        <i class="material-icons icon_large icon_dark">&#xE263;</i>
                    </div>
                    <h3 class="heading_c uk-text-center">GROUP SAVINGS</h3>
                    <p>Ikimina is a network of trusties where they put money together to save and lend each other With U+ you can save as a group, and let uplus handles the security, Auto Collections, Auto Reminders, Loans etc... + It finds better deals on stocks to invest in your savings and it can invest and withdraw for you.</p>
                </div>
                <div class="uk-margin-top">
                    <div class="uk-text-center uk-margin-bottom">
                        <i class="material-icons icon_large icon_dark">&#xE85C;</i>
                    </div>
                    <h3 class="heading_c uk-text-center">RAISE MONEY</h3>
                    <p>Raise money from friends and family across the globe made easy, By creating a kusanya easy to share on Facebook, twitter, whatsapp and easy to pay with MTN Money, TIGO cash and Visa Cards, All collected on your one Bank account instantly. +, you have 10,000 Free Bulk SMS for invitations</p>
                </div>
                <div class="uk-margin-top">
                    <div class="uk-text-center uk-margin-bottom">
                        <i class="material-icons icon_large icon_dark md-color-red-500">&#xE3AF;</i>
                    </div>
                    <h3 class="heading_c uk-text-center">INVEST</h3>
                    <p>
					You can invest in any Stock, Business and other forms of investments with a single click and if you are not interested by reading boring papers and doing a lot of calculations, leave it to our <a href="javascript:void()">SIP-AI</a> (Systematic Investment Plan Artificial Intelligence) To help you take a better decision.</p>
                </div>
			</div>
        </div>
    </section>

    <section class="section section_gallery md-bg-blue-grey-50" id="sect-pricing">
        <div class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible',delay:300,topoffset:-150}">
            <h2 class="heading_c uk-margin-medium-bottom uk-text-center-medium ">
                Screen Shoots
            </h2>
            <div data-uk-slider="">
                <div class="uk-slider-container">
                    <ul class="uk-grid uk-grid-small uk-slider uk-grid-width-medium-1-3 uk-grid-width-large-1-4" style="min-width: 2280px; min-height: 490px; transform: translateX(0px);">
                        <li style="left: 0px; width: 285px;">
                            <div class="md-card">
                                <div class="md-card-content padding-reset"><img src="frontassets/img/gallery/phone1.jpg" alt="" draggable="false"></div>
                               
                            </div>
                        </li>
						<li class="uk-slide-after" style="left: 285px; width: 285px;">
                            <div class="md-card">
                                <div class="md-card-content padding-reset"><img src="frontassets/img/gallery/phone2.jpg" alt="" draggable="false"></div>
                                
                            </div>
                        </li>
						<li class="uk-slide-after" style="left: 570px; width: 285px;">
                            <div class="md-card">
                                <div class="md-card-content padding-reset"><img src="frontassets/img/gallery/phone3.jpg" alt="" draggable="false"></div>
                                
                            </div>
                        </li>
						<li class="uk-slide-after" style="left: 855px; width: 285px;">
                            <div class="md-card">
                                <div class="md-card-content padding-reset"><img src="frontassets/img/gallery/phone4.jpg" alt="" draggable="false"></div>
                               
                            </div>
                        </li>
						<li class="uk-slide-after" style="left: 1140px; width: 285px;">
                            <div class="md-card">
                                <div class="md-card-content padding-reset"><img src="frontassets/img/gallery/phone5.JPG" alt="" draggable="false"></div>
                                
                            </div>
                        </li>
						<li class="uk-slide-before" style="left: -855px; width: 285px;">
                            <div class="md-card">
                                <div class="md-card-content padding-reset"><img src="frontassets/img/gallery/phone6.JPG" alt="" draggable="false"></div>
                                
                            </div>
                        </li>
						<li class="uk-slide-before" style="left: -570px; width: 285px;">
                            <div class="md-card">
                                <div class="md-card-content padding-reset"><img src="frontassets/img/gallery/phone7.jpg" alt="" draggable="false"></div>
                                
                            </div>
                        </li>
						<li class="uk-slide-before" style="left: -285px; width: 285px;">
                            <div class="md-card">
                                <div class="md-card-content padding-reset"><img src="frontassets/img/gallery/phone8.jpg" alt="" draggable="false"></div>
                                
                            </div>
                        </li>	
					</ul>
                </div>
                <div class="slide_navigation">
                    <a href="#" class="uk-slidenav uk-slidenav-previous" data-uk-slider-item="previous" draggable="false"></a>
                    <a href="#" class="uk-slidenav uk-slidenav-next" data-uk-slider-item="next" draggable="false"></a>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="sect-team">
        <div class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-scale-up uk-invisible',delay:300,topoffset:-100}">
           <h4 class="heading_b uk-text-center">
					ADVISERS
				</h4>
			<div class="uk-grid uk-grid-medium uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4" data-uk-grid-margin="">
				<div class="md-card" style="box-shadow: unset;">
					<div class="md-card-head md-bg-light-blue-600">
						<div class="uk-text-center" style="margin-top: 25px; ">
							<img class="md-card-head-avatar" src="frontassets/img/avatars/avatar_07.png" alt="">
						</div>
						<h3 class="md-card-head-text uk-text-center md-color-white">
							Kevin Rudahinduka
							<span class="uk-text-truncate">Head of Digital Channels @ BK</span>
						</h3>
					</div>
				</div>
				<div class="md-card">
					<div class="md-card-head md-bg-light-green-600">
						<div class="uk-text-center">
							<img class="md-card-head-avatar" src="frontassets/img/avatars/avatar_05.png" alt="">
						</div>
						<h3 class="md-card-head-text uk-text-center md-color-white">
							Innocent Bagamba Muhizi
							<span class="uk-text-truncate">Regional CIO, AB BANK, Rwanda, Zambia, Liberia</span>
						</h3>
					</div>
				</div>
				
			</div>
                
        </div>
    </section>

     
	<section class="section section_dark md-bg-blue-grey-700">
        <div class="uk-container uk-container-center">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-3-5 uk-text-center-medium">
                    Copyright &copy; 2016 uplus mutual partner, All rights reserved.
                </div>
                <div class="uk-width-medium-2-5">
                    <div class="uk-align-medium-right uk-text-center-medium">
                        <a href="#" class="uk-margin-medium-right" data-uk-tooltip="{offset: 12}" title="Facebook"><i class="uk-icon-facebook uk-icon-small md-color-white"></i></a><!--
                        --><a href="#" class="uk-margin-medium-right" data-uk-tooltip="{offset: 12}" title="Twitter"><i class="uk-icon-twitter uk-icon-small md-color-white"></i></a><!--
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



</body>
</html>