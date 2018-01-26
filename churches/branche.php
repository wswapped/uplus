<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php include("header.php");?>
<?php 
    if(isset($_GET['brancId'])){
    	$brancId = $_GET['brancId'];
    	$sqlGetBranch = $db->query("SELECT * FROM `branches` WHERE id = '$brancId'")or die (mysqli_error());
        $Branchmember = $db->query("SELECT * FROM `members` WHERE locationId = '$brancId'")or die (mysqli_error());
        $numberofmember = mysqli_num_rows($Branchmember);
    	$rowBranch = mysqli_fetch_array($sqlGetBranch);
        $Bname = $rowBranch['name'];
    }
?>
<style>
a{
	color: #00897b;
}
</style>
	<div id="page_content">
        <div id="page_content_inner">
			<div class="uk-grid uk-grid-medium" data-uk-grid-margin>
				<div class="uk-width-large-4-6">
					<div class="md-card">
						<div style="background-size: cover;
							background-repeat: no-repeat;
							background-position: center center;
							background-image: url(gallery/branches/<?php echo $rowBranch['profile'];?>); height: 370px;">
                            <button class="md-btn md-btn-info">
                                <a href="updateprofile.php?brancId=<?php echo $brancId;?>">Update Profile</a>
                            </button>
							<div style="background: linear-gradient(to bottom,transparent 0,rgba(0,0,0,.82) 100%);
								text-shadow: 2px 2px 14px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
								margin: 0 auto;
								position: relative;
								width: 100%;
								height: inherit;">
								<h3 style="padding: 215px 15px;color:#fff;"><span><?php echo $rowBranch['name'];?> Branch</span><span style="float: right;"><?php echo $numberofmember; ?></span></h3>
							</div>
						</div>
						<div class="after-marg md-card-content uk-grid uk-grid-medium" data-uk-grid-margin">
							<div class="uk-width-large-1-2">
                                <?php 
                                    $repBranch = $rowBranch['repId'];
                                    $sql = $db -> query("SELECT name FROM members WHERE id = '$repBranch' LIMIT 1");
                                    $get = mysqli_fetch_array($sql);
                                    echo '
                                        <strong>Representative:</strong> '.$get['name'].'<br>
                                        <strong>Tel:</strong> '.$rowBranch['phone'].'<br>
                                        <strong>Email:</strong> <a href="#">'.$rowBranch['mail'].'</a><br>
                                        <strong>Web:</strong> <a href="#">'.$rowBranch['web'].'</a><br>
                                    ';
                                ?>
							</div>
                            <div class="uk-width-large-1-2">
                                <strong>Accounts</strong><br>
                                <strong>Bank1:</strong> <?php echo $rowBranch['bank']?><br>
                                <strong>Trasulor:</strong> Mr. Jenny Duo<br>
                                <strong>Contacts:</strong> 0787785543<br>
                            </div>
                            <div class="uk-width-large-1-2">
                                <button class="md-btn md-btn-success md-fab"><a href="editbranch.php?brancId=<?php echo $brancId;?>">Edit</a></button>
                            </div>
						</div>
						<div class="md-card-footer" style="min-height: 250px;">
						
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.5131133701275!2d30.10321761446213!3d-1.9477667372540528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca6e4f2e1ec51%3A0x74c833cc1f7b5dab!2sChristian+Life+Assembly!5e0!3m2!1sen!2srw!4v1494090536376" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					</div>
				</div>
				<div class="uk-width-large-2-6">
					<div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Groups (5)
                            </h3>
                        </div>
                        <div class="md-card-content">
						<table class="uk-table dataTable no-footer">
							<thead>
								<tr>
									<th>Name</th>
									<th>Members</th>
								<tr>
							</thead>
							<tbody>
								<tr>
									<td>Choire</td>
									<td>23</td>
								</tr>
								<tr>
									<td>Cell Sample</td>
									<td>15</td>
								</tr>
							</tbody>
						</table>
                       </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                New Member
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <form action="operations.php" method="POST">
                                <div class="md-input-wrapper">
                                    <label>Full Name</label>
                                    <input type="text" name="membername" class="md-input">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <label>Phone</label>
                                    <input type="text" name="memberphone" class="md-input">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <label>E-mail</label>
                                    <input type="text" name="memberemail" class="md-input">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <label>Address</label>
                                    <input type="text" name="memberaddress" class="md-input">
                                    <input type="hidden" name="memberlocation" value="<?php echo $brancId; ?>" class="md-input">
                                    <span class="md-input-bar "></span>
                                </div>
                                </div>
                                <div class="md-input-wrapper">
                                    <select name="membertype" data-md-selectize>
                                        <option value="">Type...</option>
                                        <option value="VISITOR">VISITOR<option>
                                        <option value="FULL">FULL</option>
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <button class="md-btn md-btn-success">Save</button>
                                </div>
                            </form>
                        </div>
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