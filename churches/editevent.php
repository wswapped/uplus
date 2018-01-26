<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php include("header.php");?>
<?php 
    if(isset($_POST['ename'])){
        $ename      =  $_POST['ename'];
        $elocation  =  $_POST['elocation'];
        $evip       =  $_POST['evip'];
        $evvip       =  $_POST['evvip'];
        $eother       =  $_POST['eother'];
        $etime      =  $_POST['etime'];
        $edate       =  $_POST['edate'];
        $eid        =  $_POST['eid'];
        $sql = $db->query("UPDATE  event SET eventName = '$ename', eventLocation = '$elocation', eventVip = '$evip', eventV_Vip = '$evvip', eventOthers = '$eother', eventDate = '$edate', eventTime = '$etime', eventStatus = 'Unreached' WHERE eventId='$eid'");
        ?>
        <script type="text/javascript">
            window.location.href="selfevent.php?eventId=<?php echo $eid;?>";
        </script>
        <?php
    }
?>
<?php
    if (isset($_GET['eventId'])) {
        $eventId = $_GET['eventId'];
        $selecteventinfo = $db ->query("SELECT * FROM event WHERE eventId = '$eventId'");
        while ($eventinfo = mysqli_fetch_array($selecteventinfo)) {
            $oldename      =  $eventinfo['eventName'];
            $oldelocation  =  $eventinfo['eventLocation'];
            $oldetime       =  $eventinfo['eventTime'];
            $oldedate      =  $eventinfo['eventDate'];
            $oldevip  =  $eventinfo['eventVip']; 
            $oldevvip  =  $eventinfo['eventV_Vip']; 
            $oldeother   =  $eventinfo['eventOthers']; 
            $oldeid        =  $eventinfo['eventId']; 
        }
?>
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Edit event <?php echo $oldename; ?></h4>
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-4-6">
                    <div class="md-card">
                        <div class="md-card-content">
                            <form action="editevent.php" method="post" enctype="multipart/form-data">
                                <div class="md-input-wrapper">
                                    Event Name: <input type="text" name="ename" class="md-input" value="<?php echo $oldename; ?>">
                                    <input type="hidden" name="eid" class="md-input" value="<?php echo $oldeid; ?>">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    Event Location: <input type="text" name="elocation" class="md-input" value="<?php echo $oldelocation; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    Vip Price: <input type="text" name="evip" class="md-input" value="<?php echo $oldevip; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    V-Vip Price: <input type="text" name="evvip" class="md-input" value="<?php echo $oldevvip; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    Other Price: <input type="text" name="eother" class="md-input" value="<?php echo $oldeother; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    Event Date: <input type="date" name="edate" class="md-input" value="<?php echo $oldedate; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    Event Time<input type="time" name="etime" class="md-input" value="<?php echo $oldetime; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <input type="submit" class="md-btn md-btn-success" value="UPDATE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
    }
?>
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
        <script src="http://maps.google.com/maps/api/js"></script>
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

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-65191727-1', 'auto');
        ga('send', 'pageview');
    </script>

</body>
</html>
<!-- Localized -->