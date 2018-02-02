<?php include ("db.php"); ?>
<?php
    session_start();
    $userId ='';
    define("SMS_PRICE", 13); //Constant for SMS price
    include 'db.php';

    if (isset($_SESSION['loginusername'])) {
        $loginusername = $_SESSION['loginusername'];
        $loginpassword = $_SESSION['loginpassword'];
        $sql = "SELECT *, church.name as churchname FROM users JOIN church ON users.church = church.id WHERE loginName='$loginusername' AND loginpsw='$loginpassword'";
        $selectid = $db ->query($sql) or die("Error 1 ".$conn->error);
        $fetchid = mysqli_fetch_array($selectid);
        $userId = $fetchid['Id'];
        $churchname = $fetchid['churchname'];
        $churchID = $fetchid['church'];
        $adminImage = $fetchid['profileImage'];
    }
    elseif (!isset($_SESSION['loginusername'])) {
        header("location: login.php");
    }

    $banchesCards ="";
    $branchSelect ="";
    $sqlGetBranches = $db->query("SELECT * FROM `branches`")or die (mysqli_error());
    while($rowBranches = mysqli_fetch_array($sqlGetBranches))
    {
        $branchName = $rowBranches['name'];
    	$branchId = $rowBranches['id'];
    	$sqlCountMembers = $db->query("SELECT * FROM members WHERE locationId = '$branchId'")or die (mysqli_error());
    	$countMembers = mysqli_num_rows($sqlCountMembers);
    	
    	$branchSelect .='
    	<option value="'.$rowBranches['name'].'">'.$rowBranches['name'].'</option>';
    	$banchesCards .='
            <div>
        		<a href="branche.php?brancId='.$rowBranches['id'].'">
        			<div class="md-card">
        				<img src="gallery/branches/'.$rowBranches['profile'].'" alt="'.$rowBranches['name'].'" height="60%" width="100%">
        				<div class="md-card-content">
        					<strong>'.$rowBranches['name'].'</strong><br>
        					<span class="uk-text-muted">Members ('.$countMembers.') </span>
        				</div>
        			</div>
        		</a>
        	</div>
        ';
    }
?>

<!-- event card -->

<?php
    $EventCards = '';
    $selectevent = $db ->query("SELECT * FROM event");
    while($rowevent = mysqli_fetch_array($selectevent))
    {
        $EventCards .='
            <div>
                <a href="selfevent.php?eventId='.$rowevent['eventId'].'">
                    <div class="md-card">
                        <img src="gallery/event/'.$rowevent['profile'].'" alt="'.$rowevent['eventName'].'" height="60%" width="100%">
                        <div class="md-card-content">
                            <strong>'.$rowevent['eventName'].'</strong><br>
                            <span class="uk-text-muted">'.$rowevent['eventDate'].'</span>
                            <span class="uk-text-muted">'.$rowevent['eventTime'].'</span>
                        </div>
                    </div>
                </a>
            </div>
        ';
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">

    <title><?php echo !empty($title)?$title." | ":"" ?> U+ Church</title>

    <!-- additional styles for plugins -->
    <!-- weather icons -->
    <link rel="stylesheet" href="bower_components/weather-icons/css/weather-icons.min.css" media="all">
    <!-- metrics graphics (charts) -->
    <link rel="stylesheet" href="bower_components/metrics-graphics/dist/metricsgraphics.css">
    <!-- chartist -->
    <link rel="stylesheet" href="bower_components/chartist/dist/chartist.min.css">
    <!-- c3.js (charts) -->
    <link rel="stylesheet" href="bower_components/c3js-chart/c3.min.css">
        
    
    <!-- uikit -->
    <link rel="stylesheet" href="bower_components/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="assets/icons/flags/flags.min.css" media="all">

    <!-- style switcher -->
    <link rel="stylesheet" href="assets/css/style_switcher.min.css" media="all">
    
    <!-- altair admin -->
    <link rel="stylesheet" href="assets/css/main.min.css" media="all">
    
    <!-- Bootstrap-css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Selectize -->
    <link rel="stylesheet" type="text/css" href="assets/css/selectize.css">

    <!-- themes -->
    <link rel="stylesheet" href="assets/css/themes/themes_combined.min.css" media="all">

    <!-- Dropify -->
    <link rel="stylesheet" href="assets/skins/dropify/css/dropify.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class=" sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                                
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image"><img class="md-user-image" src="assets/img/avatars/avatar_11_tn.png" alt=""/></a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="page_user_profile.html">My profile</a></li>
                                    <li><a href="page_settings.html">Settings</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header><!-- main header end -->
    <!-- main sidebar -->
    <aside id="sidebar_main">
        
        <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <a href="index.html" class="sSidebar_hide sidebar_logo_large">
                    <img class="logo_regular" src="assets/img/logo_main.png" alt="" height="15" width="71"/>
                    <img class="logo_light" src="assets/img/logo_main_white.png" alt="" height="15" width="71"/>
                </a>
                <a href="index.html" class="sSidebar_show sidebar_logo_small">
                    <img class="logo_regular" src="assets/img/logo_main_small.png" alt="" height="32" width="32"/>
                    <img class="logo_light" src="assets/img/logo_main_small_light.png" alt="" height="32" width="32"/>
                </a>
            </div>
        </div>
        
        <div class="menu_section">
            <ul>
                <li title="Dashboard">
                    <a href="index.php">
                        <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                        <span class="menu_title">Dashboard</span>
                    </a>
                    
                </li>
                <li title="Members">
                    <a href="allmembers.php">
                        <span class="menu_icon">
                        <i class="material-icons"></i>
                        </span>
                        <span class="menu_title">Members</span>
                    </a>
                </li>
                <li title="Branches">
                    <a href="branches.php">
                        <span class="menu_icon">
                        <i class="material-icons"></i>
                        </span>
                        <span class="menu_title">Branches</span>
                    </a>
                </li>
                <li title="Groups">
                    <a href="groups.php">
                        <span class="menu_icon">
                        <i class="material-icons">group</i>
                        </span>
                        <span class="menu_title">Groups</span>
                    </a>
                    
                </li>
                <li title="Finance">
                    <a href="allfinance.php">
                        <span class="menu_icon"><i class="fa fa-money fa-3"></i></span>
                        <span class="menu_title">Donations</span>
                    </a>
                </li>
                <li title="Communication">
                    <a class="nolink" href="">
                        <span class="menu_icon"><i class="material-icons">comment</i></span>
                        <span class="menu_title">Communication</span>
                    </a>
                    <ul>
                        <li>
                            <a href="request.php">Prayer Requests</a>
                        </li>
                        <li>
                            <a href="broadcast.php">Broadcasts</a>
                        </li>
                        <li>
                            <a href="invoices.php">Invoices</a>
                        </li>
                    </ul>
                </li>
                <li title="Events">
                    <a href="event.php">
                        <span class="menu_icon">
                        <i class="material-icons"></i>
                        </span>
                        <span class="menu_title">Events</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside><!-- main sidebar end -->

    <script type="text/javascript">
        elem = document.querySelectorAll(".nolink");

        elem.forEach(function(value, index){
            value.addEventListener('click', function(e){
                e.preventDefault();
                return false;
            });
        });
    </script>
