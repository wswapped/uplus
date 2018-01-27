<?php

    if (isset($_POST['msg'])) {
        $msg = $_POST['msg'];
        $receiver = $_POST['receiver'];
        include 'db.php';
        $insertmsg = $db ->query("INSERT INTO message(receiver, msg, sendtime)
            VALUES('$receiver', '$msg', now())");
        echo "sent";
        header("location: broadcast.php");
    }
    include_once "class.user.php";
    include_once "class.sms.php";
?>
<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php include("header.php"); ?>
<div id="page_content">
        <div id="page_content_inner">
        <div class="uk-column-1-2">
            <h4 class="heading_a uk-margin-bottom">Broad Casts</h4>
            <!-- <p>Message Balance: </p> -->
        </div>
        <div class="card ubox">
          <div class="card-block">
            <h3 class="card-title">SMS Balance</h3>
            <p class="card-text msgcountlabel"><?php echo (int)$Sms->churchBalance($User->church($userId) ); ?></p>
          </div>
        </div>
        <div class="pagesCont" data-page='send'>
            
        </div>
	</div>


    <div class="uk-modal" id="sendMessageModal">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header uk-tile uk-tile-default"><p class="btn btn-primary sendMessageModalTitle">Broadcast messages, sure?</p></div>
            <p class="transDet"></p>
            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="uk-button uk-modal-close">Cancel</button>
                <button type="button" class="uk-button uk-button-primary broadcastMsg">Save</button>
            </div>
        </div>
    </div>
    
    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
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

        <!--  dashbord functions -->
        <script src="assets/js/pages/dashboard.min.js"></script>
    
    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "bower_components/dense/src/dense.js", function() {
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
    <script type="text/javascript">
        function group() {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","whichgroup.php?group="+document.formgroup.togroup.value,false);
            xmlhttp.send(null);
            document.getElementById('response').innerHTML=xmlhttp.responseText;
        }
    </script>
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


</body>
</html>
<!-- Localized -->