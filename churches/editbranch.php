<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php include("header.php");?>
<?php 
    if(isset($_POST['bname'])){
    	$bname		=  $_POST['bname'];
    	$blocation	=  $_POST['blocation'];
    	$bweb     	=  $_POST['bweb'];
        $bmail      =  $_POST['bmail'];
    	$brep    	=  $_POST['brep'];
    	$bcontact 	=  $_POST['bcontact'];
    	$bbank    	=  $_POST['bbank'];
        $bdaf       =  $_POST['bdaf'];
    	$bid     	=  $_POST['bid'];
    	$sql = $db->query("UPDATE  branches SET name = '$bname', repId = '$brep', location = '$blocation', web = '$bweb', mail = '$bmail', phone = '$bcontact', bank = '$bbank', daf = '$bdaf' WHERE id='$bid'");
    	?>
    	<script type="text/javascript">
    		window.location.href="branche.php?brancId=<?php echo $bid;?>";
    	</script>
    	<?php
    }
?>
<?php
    if (isset($_GET['brancId'])) {
        $brancId = $_GET['brancId'];
        $selectbrancinfo = $db ->query("SELECT * FROM branches WHERE id = '$brancId'");
        while ($branchinfo = mysqli_fetch_array($selectbrancinfo)) {
            $oldbname      =  $branchinfo['name'];
            $oldblocation  =  $branchinfo['location'];
            $oldbweb       =  $branchinfo['web'];
            $oldbmail      =  $branchinfo['mail'];
            $oldbcontact   =  $branchinfo['phone'];
            $oldbbank      =  $branchinfo['bank'];
            $oldbdaf       =  $branchinfo['daf']; 
            $oldbid        =  $branchinfo['id']; 
        }
?>
	<div id="page_content">
        <div id="page_content_inner">
			<h4 class="heading_a uk-margin-bottom">Edit Branch <?php echo $oldbname; ?></h4>
			<div class="uk-grid uk-grid-medium" data-uk-grid-margin>
				<div class="uk-width-large-4-6">
					<div class="md-card">
						<div class="md-card-content">
							<form action="editbranch.php" method="post" enctype="multipart/form-data">
                                <div class="md-input-wrapper">
                                    Branch Name:<input type="text" name="bname" class="md-input" required value="<?php echo $oldbname; ?>">
									<input type="hidden" name="bid" class="md-input" required value="<?php echo $oldbid; ?>">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    Branch Location:<input type="text" name="blocation" class="md-input" required value="<?php echo $oldblocation; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    Branch Web:<input type="text" name="bweb" class="md-input" required value="<?php echo $oldbweb; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
									Branch Email:<input type="text" name="bmail" class="md-input" required value="<?php echo $oldbmail; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
									Branch Contact:<input type="text" name="bcontact" class="md-input" required value="<?php echo $oldbcontact; ?>">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <select name="brep" data-md-selectize>
                                        <option value="">Representative</option>
                                        <?php
                                            $selectrep = $db -> query("SELECT * FROM members WHERE type = 'FULL' ORDER BY name ASC");
                                            while ($repinfo = mysqli_fetch_array($selectrep)) {
                                                echo '
                                                    <option value="'.$repinfo['id'].'">'.$repinfo['name'].'</option>
                                                ';
                                            }
                                        ?>
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
									Branch Bank Account:<input type="text" name="bbank" class="md-input" required value="<?php echo $oldbbank; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
									Branch DAF:<input type="text" name="bdaf" class="md-input" required value="<?php echo $oldbdaf; ?>"/>
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