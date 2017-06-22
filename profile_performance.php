<?php
if (isset($_POST['fullname'])) {
	$fullname = $_POST['fullname'];
	if ($_FILES['fileField']['tmp_name'] != "") {																	 										 
	$newname = ''.$thisid.'.jpg';
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../profiles/$newname");
	
	include"../db.php";
	$sql = $db->query("UPDATE `users` SET `name`= '$fullname' WHERE `id` ='$thisid'")or die (mysql_error());
	header("location: profile.php");
	exit();
}}
?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<?php include"header.php"?>

  <!-- Page -->
  <div class="page animsition">
    <div class="page-aside">
      <div class="page-aside-switch">
        <i class="icon wb-chevron-left" aria-hidden="true"></i>
        <i class="icon wb-chevron-right" aria-hidden="true"></i>
      </div>
      <div class="page-aside-inner">
        <section class="page-aside-section">
          <h5 class="page-aside-title">Main</h5>
          <div class="list-group">
            <a class="list-group-item" href="profile.php"><i class="icon wb-dashboard" aria-hidden="true"></i>About</a>
            <a class="list-group-item" href="privacy.php"><i class="icon wb-lock" aria-hidden="true"></i>Privacy</a>
          </div>
        </section>
        <section class="page-aside-section">
          <h5 class="page-aside-title">History</h5>
          <div class="list-group">
            <a class="list-group-item active" href="javascript:void(0)" onclick="performance()"><i class="icon wb-pie-chart" aria-hidden="true"></i>Performance</a>
            <a class="list-group-item" href="javascript:void(0)"><i class="icon wb-calendar" aria-hidden="true"></i>Timeline</a>
		  </div>
        </section>
      </div>
    </div>
    <div class="page-main">
      <div class="page-header">
        <h1 class="page-title">Your Performance</h1><h6 class="visible-xs">Slide on the side to check on your performance</h6>
      </div>
    <div class="page-content">
		<div class="row">
		<?php include"info.php"?>
		<div class="col-lg-8">
			<div class="panel panel-bordered">
				<div class="panel-heading">
				  <h3 class="panel-title">Performance
				  <span class="panel-desc">Your Historical Performance</span>
				  </h3>
				</div>
				<div class="panel-body">
					<div class="example-wrap">
							<div class="example">
								<div id="exampleC3Spline"></div> 
							</div>
					</div>
				</div>
			</div>
		</div>
	   </div>
      </div>
		</div>
    </div>
    </div>
  </div>
  <!-- End Page -->


  <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">© 2015 <a href="http://uPlus.rw">uPlus</a></div>
    <div class="site-footer-right">
      Invest for a better future with <i class="red-600 wb wb-globe"></i> uPlus
    </div>
  </footer>
  <!-- Core  -->
  <script src="../global/vendor/jquery/jquery.min.js"></script>
  <script src="../global/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="../global/vendor/animsition/animsition.min.js"></script>
  <script src="../global/vendor/asscroll/jquery-asScroll.min.js"></script>
  <script src="../global/vendor/mousewheel/jquery.mousewheel.min.js"></script>
  <script src="../global/vendor/asscrollable/jquery.asScrollable.all.min.js"></script>
  <script src="../global/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>

  <!-- Plugins -->
  <script src="../global/vendor/switchery/switchery.min.js"></script>
  <script src="../global/vendor/intro-js/intro.min.js"></script>
  <script src="../global/vendor/screenfull/screenfull.js"></script>
  <script src="../global/vendor/slidepanel/jquery-slidePanel.min.js"></script>

  <!-- Plugins For This Page -->
  <script src="../global/vendor/footable/footable.all.min.js"></script>
  
    <!-- Plugins For This Page -->
  <script src="../global/vendor/jquery-ui/jquery-ui.min.js"></script>
  <script src="../global/vendor/blueimp-tmpl/tmpl.min.js"></script>
  <script src="../global/vendor/blueimp-canvas-to-blob/canvas-to-blob.min.js"></script>
  <script src="../global/vendor/blueimp-load-image/load-image.all.min.js"></script>
  <script src="../global/vendor/blueimp-file-upload/jquery.fileupload.js"></script>
  <script src="../global/vendor/blueimp-file-upload/jquery.fileupload-process.js"></script>
  <script src="../global/vendor/blueimp-file-upload/jquery.fileupload-image.js"></script>
 <script src="../global/vendor/blueimp-file-upload/jquery.fileupload-validate.js"></script>
  <script src="../global/vendor/blueimp-file-upload/jquery.fileupload-ui.js"></script>
  <script src="../global/vendor/dropify/dropify.min.js"></script>


  <!-- Scripts -->
  <script src="../global/js/core.min.js"></script>
  <script src="../assets/js/site.min.js"></script>

  <script src="../assets/js/sections/menu.min.js"></script>
  <script src="../assets/js/sections/menubar.min.js"></script>
  <script src="../assets/js/sections/sidebar.min.js"></script>

  <script src="../global/js/configs/config-colors.min.js"></script>
  <script src="../assets/js/configs/config-tour.min.js"></script>

  <script src="../global/js/components/asscrollable.min.js"></script>
  <script src="../global/js/components/animsition.min.js"></script>
  <script src="../global/js/components/slidepanel.min.js"></script>
  <script src="../global/js/components/switchery.min.js"></script>


  <script src="../assets/examples/js/tables/footable.min.js"></script>
  
  <script src="../global/js/components/dropify.min.js"></script>


  <script src="../assets/examples/js/forms/uploads.min.js"></script>

<!-- Plugins For This Page -->
  <script src="../global/vendor/d3/d3.min.js"></script>
  <script src="../global/vendor/c3/c3.min.js"></script>
  <script src="../assets/examples/js/charts/c3.min.js"></script>

  
  
  
  <script>
function get_info(infoID){
	//var accInfo=$("#accID").val();
	//alert(infoID);
	$.ajax({
			type : "GET",
			url : "testlog.php",
			dataType : "html",
			cache : "false",
			data : {
				infoID : infoID,
			},
			success : function(html, textStatus){
				$("#account_name").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
</script>

</body>

</html>













