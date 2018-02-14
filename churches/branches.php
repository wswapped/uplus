<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php 
    include("header.php");
    include("functions.php");
?>

    <div id="page_content">
        <div id="page_content_inner">
            <!-- circular charts -->

            <div class="uk-grid uk-grid-width-medium-1-2" data-uk-grid-margin="">
                <?php
                    //Getting branches
                    $branches = churchbranches($churchID);
                    for($n=0; $n<count($branches); $n++){
                        $branch = $branches[$n];

                        //getting representative
                        $rep = user_details($branch['repId']);
                ?>
                <div class="uk-row-first">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions">
                                <i class="md-icon material-icons md-color-blue-grey-500"></i>
                                <i class="md-icon material-icons md-color-light-blue-500"></i>
                                <i class="md-icon material-icons md-color-green-500">people</i>
                            </div>
                            <h3 class="md-card-toolbar-heading-text">
                                <?php echo $branch['name']; ?>
                            </h3>
                        </div>
                        <img src="<?php echo $branch['profile']; ?>">
                        <div class="md-card-content">
                            <p>Representative:<span><?php echo $rep['name'] ?></span></p> 
                            <p>Phone:<span><?php echo $branch['phone']; ?></span></p>
                            <p>Email:<span><?php echo $branch['mail']; ?></span></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

            <!-- div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3 uk-text-center" >
                <?php echo $banchesCards;?>
                <div>
                    <div style="padding-top: 77px;">
                        <div class="uk-flex uk-flex-center uk-flex-middle">
                            <button onclick="window.location.replace('addBranche.php')" class="md-btn md-btn-success md-fab">Add</button>
                        </div>
                    </div>
                </div>
            </div> -->
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

</body>
</html>
<!-- Localized -->