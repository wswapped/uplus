<?php
if (isset($_POST['fullname'])) {
	$fullname = $_POST['fullname'];
	include"db.php";
	$sql = $db->query("UPDATE `users` SET `name`= '$fullname' WHERE `id` ='$thisid'")or die (mysql_error());
	
	echo'done';
	if ($_FILES['fileField']['tmp_name'] != "") {																	 										 
	$newname = ''.$thisid.'.jpg';
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../profiles/$newname");
	}
	header("location: profile.php");
	exit();
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<?php include"template/header.php"?>

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
            <a class="list-group-item" href="profile.php">
				<i class="icon md-account" aria-hidden="true"></i>About</a>
            <a class="list-group-item active" style="background-color: rgb(243, 244, 245);" href="javascript:void(0)">
				<i class="icon md-lock" aria-hidden="true"></i>Privacy</a>
          </div>
        </section>
        <!--<section class="page-aside-section">
          <h5 class="page-aside-title">History</h5>
          <div class="list-group">
            <a class="list-group-item" href="javascript:void(0)"><i class="icon md-time-interval" aria-hidden="true"></i>Performance</a>
            <a class="list-group-item" href="javascript:void(0)"><i class="icon md-calendar" aria-hidden="true"></i>Timeline</a>
		  </div>
        </section>-->
      </div>
    </div>
    <div class="page-main">
      <div class="page-header">
        <h1 class="page-title">Privacy</h1><h6 class="visible-xs">Slide on the side to check on your performance</h6>
      </div>
    <div class="page-content">
		<div class="row">
		<?php include"template/info.php"?>
		<div class="col-lg-8">
			<div class="panel panel-bordered"> 
				<div class="panel-heading">
				  <h3 class="panel-title">Setup your privacy on uPlus</h3>
				  <div class="panel-actions">
                <a class="panel-action icon md-floppy" style="font-size: 26px;" aria-hidden="true"></a>
              </div>
				</div>
				<div class="panel-body">
					<h4 class="example-title">Link your Groups with financial Accounts</h4>
					<table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Group</th>
                        <th class="text-nowrap">Account</th>
                        <th>Number</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
						$sql3 = $db->query("SELECT * FROM groups WHERE adminId = '$thisid'");
						$banklist = "";
						$sqlbanks = $outCon->query("SELECT * FROM banks");
						while($row =mysqli_fetch_array($sqlbanks))
						{
							$banklist.='<option value="'.$row['id'].'">'.$row['name'].'';
						}
						$n=0;
						while($row=mysqli_fetch_array($sql3))
						{
							$n++;
							$groupId = $row['id'];
							$sqlAccounts = $outCon->query("SELECT * FROM `transactionsview` WHERE `operation` = 'CREDIT' AND `forGroupId` = '$groupId' LIMIT 1");
							$rowGroup = mysqli_fetch_array($sqlAccounts);
							
							echo'<tr>
								<td>'.$row['groupName'].'</td>
								<td class="text-nowrap">
								  <div id="bankChose'.$n.'"><select class="form-control input-sm">
									<option>'.$rowGroup['bankName'].'</option>
									'.$banklist.'
								  </select></div>
								</td>
								<td>
									<div id="accNumber'.$n.'"><input class="form-control input-sm" value="'.$rowGroup['accountNumber'].'"/></div>
								</td>
								<td>
									<button
									
									class="btn btn-pure btn-success icon md-thumb-up waves-effect waves-circle waves-classic" aria-hidden="true"></button>
								</td>
							</tr>'; 
						}
					  ?>
				  
                    </tbody>
                  </table>
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
  <script src="assets/global/vendor/jquery/jquery.min.js"></script>
  <script src="assets/global/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/global/vendor/animsition/animsition.min.js"></script>
  <script src="assets/global/vendor/asscroll/jquery-asScroll.min.js"></script>
  <script src="assets/global/vendor/mousewheel/jquery.mousewheel.min.js"></script>
  <script src="assets/global/vendor/asscrollable/jquery.asScrollable.all.min.js"></script>
  <script src="assets/global/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>

  <!-- Plugins -->
  <script src="assets/global/vendor/switchery/switchery.min.js"></script>
  <script src="assets/global/vendor/intro-js/intro.min.js"></script>
  <script src="assets/global/vendor/slidepanel/jquery-slidePanel.min.js"></script>

  <!-- Plugins For This Page -->
  <script src="assets/global/vendor/footable/footable.all.min.js"></script>
  
    <!-- Plugins For This Page -->
  <script src="assets/global/vendor/jquery-ui/jquery-ui.min.js"></script>
  <script src="assets/global/vendor/blueimp-tmpl/tmpl.min.js"></script>
  <script src="assets/global/vendor/blueimp-canvas-to-blob/canvas-to-blob.min.js"></script>
  <script src="assets/global/vendor/blueimp-load-image/load-image.all.min.js"></script>
  <script src="assets/global/vendor/blueimp-file-upload/jquery.fileupload.js"></script>
  <script src="assets/global/vendor/blueimp-file-upload/jquery.fileupload-process.js"></script>
  <script src="assets/global/vendor/blueimp-file-upload/jquery.fileupload-image.js"></script>
 <script src="assets/global/vendor/blueimp-file-upload/jquery.fileupload-validate.js"></script>
  <script src="assets/global/vendor/blueimp-file-upload/jquery.fileupload-ui.js"></script>
  <script src="assets/global/vendor/dropify/dropify.min.js"></script>


  <!-- Scripts -->
  <script src="assets/global/js/core.min.js"></script>
  <script src="assets/js/site.min.js"></script>

  <script src="assets/js/sections/menu.min.js"></script>
  <script src="assets/js/sections/menubar.min.js"></script>
  <script src="assets/js/sections/sidebar.min.js"></script>

  <script src="assets/global/js/configs/config-colors.min.js"></script>
  <script src="assets/js/configs/config-tour.min.js"></script>

  <script src="assets/global/js/components/asscrollable.min.js"></script>
  <script src="assets/global/js/components/animsition.min.js"></script>
  <script src="assets/global/js/components/slidepanel.min.js"></script>
  <script src="assets/global/js/components/switchery.min.js"></script>


  <script src="assets/examples/js/tables/footable.min.js"></script>
  
  <script src="assets/global/js/components/dropify.min.js"></script>


  <script src="assets/examples/js/forms/uploads.min.js"></script>

<!-- Plugins For This Page -->
  <script src="assets/global/vendor/d3/d3.min.js"></script>
  <script src="assets/global/vendor/c3/c3.min.js"></script>
  <script src="assets/examples/js/charts/c3.min.js"></script>

  
  
  
  <script>
function brakelink(lineNumber){
	//alert(lineNumber);
	document.getElementById('accNumber'+lineNumber+'').innerHTML = '<input class="form-control input-sm"/>';
	document.getElementById('bankChose'+lineNumber+'').innerHTML = '<select class="form-control input-sm" ><option></option><option>MTN</option><option>BK</option></select>';
}
function get_info(infoID){
	//var accInfo=$("#accID").val();
	//alert(infoID);
	$.ajax({
			type : "GET",
			url : "scripts/testlog.php",
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













