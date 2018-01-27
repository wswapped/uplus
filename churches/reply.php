<!doctype html>
<style type="text/css">
    .reply {
        margin: auto;
        margin-left: 25px;
    }
    .reply > .sender-info {
        min-height: 40px;
        font-size: 100%;
        border-bottom: white 2px solid;
        border-top: white 2px solid;
        padding-top: 15px;
    }
    .reply > .sms {
        font-size: 95%;
        border-bottom: white 2px solid;
        margin-top: 25px;
    }
    .reply > .footer {
        font-weight: bold;
        margin-top: 25px;
    }
</style>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php include("header.php");?>
<div id="page_content">
    <div id="page_content_inner" >
        <h4 class="heading_a uk-margin-bottom">Player Request</h4>
        <div class="uk-width-large-2-4">
            <div class="reply">
                <div class="sender-info">
                    <b>KANAMUGIRE Emmy</b>
                </div>
                <div class="sms">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br> Cras vel auctor nisi, vel auctor orci. 
                    Aenean in pretium odio, ut lacinia tellus. Nam sed sem ac enim porttitor vestibulum <br>vitae at erat.<br>

                    Curabitur auctor non orci a molestie. Nunc non justo quis orci viverra pretium id ut est. <br>
                    Nullam vitae dolor id enim consequat <br>
                    fermentum. Ut vel nibh tellus. 
                    Duis finibus ante et augue fringilla, vitae scelerisque tortor pretium.<br> 
                    Phasellus quis eros erat. Nam sed justo libero.<br>

                    Class aptent taciti sociosqu ad litora torquent per conubia nostra,<br> per inceptos himenaeos.
                    Sed tempus dapibus libero ac commodo.<br>



                    Best Regards,<br>
                    Sean.<br>

                    Information Technology Department,<br>
                    Senior Front End Designer<br>
                </div>
                <div class="footer">
                    <button class="md-btn md-btn-success" onclick="window.location.replace('write.php')">Reply</button>
                </div>
            </div>
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