<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <link rel="stylesheet" type="text/css" href="assets/css/uikit.min.css">
    <!-- additional styles for plugins -->
    <!-- jquery ui -->
    <link rel="stylesheet" href="assets/skins/jquery-ui/material/jquery-ui.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="assets/js/custom/xeditable/select2/select2.css">
    <?php
        $title = "Broadcasts";
        //Including common head configuration
        include_once "head.php";

        if (isset($_POST['msg'])) {
            $msg = $_POST['msg'];
            $receiver = $_POST['receiver'];
            $insertmsg = $db ->query("INSERT INTO message(receiver, msg, sendtime)
                VALUES('$receiver', '$msg', now())");
            echo "sent";
            header("location: broadcast.php");
        }
        include_once "class.user.php";
        include_once "class.sms.php";
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
            <h4 class="heading_b uk-margin-bottom"><?php echo $churchname; ?> - Broadcasts</h4>        
            <div class="pagesCont" data-page='send'>            
            </div>
        </div>

        <!-- Send message modal -->
        <div class="uk-modal" id="sendMessageModal">
            <div class="uk-modal-dialog">
                <div class="uk-modal-header uk-tile uk-tile-default"><p class="sendMessageModalTitle">Broadcast messages, sure?</p></div>
                <p class="transDet"></p>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="md-btn md-btn-danger uk-modal-close">Cancel</button>
                    <button type="button" class="md-btn md-btn-success broadcastMsg">Send</button>
                </div>
            </div>
        </div>

        <!-- Scheduling modal -->
        <div class="uk-modal uk-modal-dialog-large" id="scheduleMessageModal">
            <div class="uk-modal-dialog">
                <div class="uk-modal-header uk-tile uk-tile-default"><p class="sendMessageModalTitle">Scheduling message</p></div>

                <div class="">
                    <form id="scheduleMessage">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="md-card">
                                    <div class="md-card-content">
                                        <h3 class="heading_a">Date</h3>
                                        <div class="uk-grid">
                                            <div class="uk-width-large-2-3 uk-width-1-1">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">Select date</label>
                                                    <input class="md-input" type="text" id="schedDate" data-uk-datepicker="{format:'DD.MM.YYYY'}" required="required">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="md-card">
                                    <div class="md-card-content">
                                        <h3 class="heading_a">Time</h3>
                                        <div class="uk-grid">
                                            <div class="uk-width-large-2-3 uk-width-1-1">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-clock-o"></i></span>
                                                    <label for="uk_tp_1">Select time</label>
                                                    <input class="md-input" type="text" id="schedTime" data-uk-timepicker required="required">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-modal-footer uk-text-right">
                            <button type="button" class="md-btn md-btn-danger uk-modal-close">Cancel</button>
                            <button type="submit" class="md-btn md-btn-success broadcastMsg">SCHEDULE</button>
                        </div>
                    </form>
                </div>
                
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


    <!-- page specific plugins -->
    <!-- d3 -->
    <script src="bower_components/d3/d3.min.js"></script>
    <!-- metrics graphics (charts) -->
    <script src="bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>
    <!-- chartist (charts) -->
    <script src="bower_components/chartist/dist/chartist.min.js"></script>
    <!-- maplace (google maps) -->
    <!-- <script src="http://maps.google.com/maps/api/js"></script> -->
    <script src="bower_components/maplace-js/dist/maplace.min.js"></script>
    <!-- peity (small charts) -->
    <script src="bower_components/peity/jquery.peity.min.js"></script>
    <!-- easy-pie-chart (circular statistics) -->
    <script src="bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
    <!-- countUp -->
    <script src="bower_components/countUp.js/dist/countUp.min.js"></script>
    <!-- handlebars.js -->
    <script src="bower_components/handlebars/handlebars.min.js"></script>
    <script src="assets/js/custom/handlebars_helpers.min.js"></script>
    <!-- CLNDR -->
    <script src="bower_components/clndr/clndr.min.js"></script>

    <script src="js/custom.js"></script>
    <script type="text/javascript">
        $('.selectall').click(function() {
            if ($(this).is(':checked')) {
                $('.all').attr('checked', true);
            } else {
                $('.all').attr('checked', false);
            }
        });
        //All categories toggling
    </script>
    <script type="text/javascript" src="js/broadcast.js"></script>
    <script type="text/javascript" src="js/jspdf.js"></script>
    <script type="text/javascript" src="js/pdfFromHTML.js"></script>

    <script type="text/javascript" src="assets/js/uikit.min.js"></script>

    <!-- jqueryUI -->
    <script src="bower_components/x-editable/dist/jquery-editable/jquery-ui-datepicker/js/jquery-ui-1.10.3.custom.min.js"></script>
    <!-- poshytip -->
    <script src="assets/js/custom/xeditable/jquery.poshytip.min.js"></script>
    <!-- select2 -->
    <script src="assets/js/custom/xeditable/select2/select2.min.js"></script>
    <!-- xeditable -->
    <script src="bower_components/x-editable/dist/jquery-editable/js/jquery-editable-poshytip.js"></script>

    <!--  xeditable functions -->
    <!-- <script src="assets/js/pages/plugins_xeditable.min.js"></script> -->

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