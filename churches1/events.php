<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <?php
        $title = "Events";
        //Including common head configuration
        include_once "head.php";
    ?>
</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <?php
        include_once "menu-header.php";
    ?>
    <!-- main sidebar -->
    <?php
        include_once "sidebar.php";
    ?>

    <div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_b uk-margin-bottom"><?php echo $churchname; ?> - Events</h3>
        
            <div class="uk-grid" data-uk-grid-margin>
                <?php
                    $events = $conn->query("SELECT * FROM event WHERE church = \"$churchID\" ORDER BY CONCAT(eventDate, eventTime) DESC LIMIT 20") or die("$conn->error");
                    while ($data = $events->fetch_assoc()) {
                        $event = $data;
                ?>
                <div class="uk-width-medium-1-3">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                <?php echo $event['eventName']; ?>
                            </h3>
                        </div>
                        <a href="events.php?branch=<?php //echo $branch['id']; ?>"><img class="img-full branch_img" src="<?php echo $event['picture']; ?>" /></a>
                        <div class="md-card-content">

                            <p>Date:<span><?php echo $event['eventDate']." - ".$event['eventTime']; ?></span></p> 
                            <p>Venue:<span><?php echo $event['eventLocation']; ?></span></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.js"></script>

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>

    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>
    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "assets/js/custom/dense.min.js", function(data) {
                    // enable hires images
                    altair_helpers.retina_images();
                });
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>
</body>
</html>