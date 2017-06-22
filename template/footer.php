<button class="site-action btn-raised btn btn-success btn-floating" data-target="#addTopicForm" data-toggle="modal" type="button" id="add">
	<span style="
    position: absolute;
    background: #4caf50;
    border-bottom-left-radius: 20px;
    border-top-left-radius: 20px;
    top: 11px;
    font-size: 15px;
    left: -92px;
    padding-bottom: 5px;
    padding-top: 5px;
    padding-right: 13px;
    margin-left: 0px;
">&nbsp; Create Group 
</span>
  <i class="icon md-plus" aria-hidden="true" style="
    font-size: 32px;
    text-align: center;
    margin-left: 1px;
"></i>
</button>
  <!-- NEW GROUP POPUP -->
  <div class="modal fade" id="addTopicForm" aria-hidden="true" aria-labelledby="addTopicForm" role="dialog" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content" id="exampleWizardForm">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="exampleModalTabs">Create a Group</h4>
    </div>
 <!-- Steps -->
	<div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
	<div class="step col-md-4 current" data-target="#exampleAccount" role="tab">
	  <span class="step-number">1</span>
	  <div class="step-desc">
		<span class="step-title">Info</span>
	  </div>
	</div>

	<div class="step col-md-4" data-target="#exampleBilling" role="tab">
	  <span class="step-number">2</span>
	  <div class="step-desc">
		<span class="step-title">Finance</span>
	  </div>
	</div>

	<div class="step col-md-4" data-target="#exampleGetting" role="tab">
	  <span class="step-number">3</span>
	  <div class="step-desc">
		<span class="step-title">Invite</span>
	  </div>
	</div>
	</div>
	<!-- End Steps -->
    <div class="modal-body wizard-content">
	  <!-- Panel Wizard Form -->
		<div class="panel-body ">
		 <!-- Wizard Content -->
			<div class="wizard-pane active" id="exampleAccount" role="tabpanel">
			  <div id="exampleAccountForm">
					<div id="stepFill">
						<input hidden id="step" value="info">
					</div>
				<div class="form-group">
					<label class="control-label" for="groupType">Group Type:</label>
					<select class="form-control round" id="groupType" name="groupType" onchange="getContType()" required="required">
					  <option></option>
					  <option value="IKIMINA">IKIMINA</option>
					  <option value="CONTRIBUTOIN">CONTRIBUTIOIN</option>
					  <option value="INVESTMENT">INVESTMENT FUND</option>
					</select>
				</div>
				<div id="contributionType">
					<input id="contType" hidden name="contType" value="none">
				</div>
				<div class="form-group">
					<label class="control-label" for="groupName">Group Name:</label>
					<input type="text" class="form-control round" id="groupName" required name="groupName" placeholder=""/> 
					<input hidden type="text" id="thisId" name="thisId" value="<?php echo $thisid?>"/>
					<input hidden type="text" id="adminPhone" name="adminPhone" value="<?php echo$phone?>"/>
					<input hidden type="text" id="adminName" name="adminName" value="<?php echo$name?>"/>
				</div>
				<div class="form-group">
					<label class="control-label" for="groupDesc">Group Description:</label>
					<textarea class="form-control" style="height: 110px;" id="groupDesc" required name="groupDesc" placeholder="Something to describe your group..."></textarea>
				</div>
			  </div>
			</div>
			<div class="wizard-pane" id="exampleBilling" role="tabpanel">
			  <div id="exampleBillingForm">
				<div id="finance">
					First fill in the info
				</div>
			  </div>
			</div>
			<div class="wizard-pane" id="exampleGetting" role="tabpanel">
			  <div id="invite">
				First fill in the finance
			  </div>
			</div>
		 <!-- End Wizard Content -->
		</div>
	  <!-- End Panel Wizard One Form -->
	</div>
   </div>
</div>
</div>
  <!-- End NEW GROUP POPUP -->


    
<!-- PENDINGS Alert -->
  </div>
  </div>
  <!-- End Page -->


  <!-- Footer -->
  <footer class="site-footer" style="text-align: center;">
    <div class="site-footer-legal">© 2015 <a href="http://uplus.rw">uPlus</a></div>
	<a  href="apps/"><i class="icon md-android"></i></a>&nbsp;&nbsp;/&nbsp;&nbsp; 
	<a  href="javascript:void()"><i class="icon md-apple"></i></a>&nbsp;&nbsp;/&nbsp;&nbsp;
	<a  href="javascript:void()"><i class="icon md-windows"></i></a>
    <div class="site-footer-right">
      Collect money from friends and family<i class="red-600 wb wb-globe"></i> uPlus
    </div>
  </footer>
  
  
	<script src="assets/js/ajax_call.js"></script>
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/uploadFile.js"></script>
	
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

  <!-- Plugins For Tables -->
  <script src="assets/global/vendor/footable/footable.all.min.js"></script>
 <!-- Plugins For This Page -->
  <script src="assets/global/vendor/formvalidation/formValidation.min.js"></script>
  <script src="assets/global/vendor/formvalidation/framework/bootstrap.min.js"></script>
  <script src="assets/global/vendor/matchheight/jquery.matchHeight-min.js"></script>
  <script src="assets/global/vendor/jquery-wizard/jquery-wizard.min.js"></script>

  <!-- Scripts -->
  <script src="assets/global/js/core.min.js"></script>
  <script src="assets/js/site.min.js"></script>

  <script src="assets/js/sections/menu.min.js"></script>
  <script src="assets/js/sections/menubar.min.js"></script>
  <script src="assets/js/sections/sidebar.min.js"></script>

  <script src="assets/js/configs/config-tour.min.js"></script>
  <script src="assets/global/vendor/alertify-js/alertify.js"></script>

  <script src="assets/global/js/components/asscrollable.min.js"></script>
  <script src="assets/global/js/components/animsition.min.js"></script>
  <script src="assets/global/js/components/slidepanel.min.js"></script>
  <script src="assets/global/js/components/switchery.min.js"></script>


  <script src="assets/examples/js/tables/footable.min.js"></script>
  <script src="assets/global/js/components/alertify-js.min.js"></script>
  <script src="assets/examples/js/advanced/bootbox-sweetalert.min.js"></script>
  
  <script src="assets/global/js/components/jquery-wizard.min.js"></script>
  <script src="assets/global/js/components/matchheight.min.js"></script>


  <script src="assets/examples/js/forms/wizard.min.js"></script>
  
  
  
  
  
  
  
   <!-- Plugins For This Page -->
  <script src="assets/global/vendor/select2/select2.min.js"></script>
  <script src="assets/global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.js"></script>
  <script src="assets/global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
  <script src="assets/global/vendor/bootstrap-select/bootstrap-select.min.js"></script>
  <script src="assets/global/vendor/icheck/icheck.min.js"></script>
  <script src="assets/global/vendor/switchery/switchery.min.js"></script>
  <script src="assets/global/vendor/asrange/jquery-asRange.min.js"></script>
  <script src="assets/global/vendor/asspinner/jquery-asSpinner.min.js"></script>
  <script src="assets/global/vendor/clockpicker/bootstrap-clockpicker.min.js"></script>
  <script src="assets/global/vendor/ascolor/jquery-asColor.min.js"></script>
  <script src="assets/global/vendor/asgradient/jquery-asGradient.min.js"></script>
  <script src="assets/global/vendor/ascolorpicker/jquery-asColorPicker.min.js"></script>
  <script src="assets/global/vendor/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
  <script src="assets/global/vendor/jquery-knob/jquery.knob.min.js"></script>
  <script src="assets/global/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
  <script src="assets/global/vendor/card/jquery.card.js"></script>
  <script src="assets/global/vendor/jquery-labelauty/jquery-labelauty.js"></script>
  <script src="assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="assets/global/vendor/jt-timepicker/jquery.timepicker.min.js"></script>
  <script src="assets/global/vendor/datepair-js/datepair.min.js"></script>
  <script src="assets/global/vendor/datepair-js/jquery.datepair.min.js"></script>
  <script src="assets/global/vendor/jquery-strength/jquery-strength.min.js"></script>
  <script src="assets/global/vendor/multi-select/jquery.multi-select.js"></script>
  <script src="assets/global/vendor/typeahead-js/bloodhound.min.js"></script>
  <script src="assets/global/vendor/typeahead-js/typeahead.jquery.min.js"></script>
  <script src="assets/global/vendor/jquery-placeholder/jquery.placeholder.min.js"></script>
<!--
  <script src="assets/global/js/components/select2.min.js"></script>
  <script src="assets/global/js/components/bootstrap-tokenfield.min.js"></script>
  <script src="assets/global/js/components/bootstrap-tagsinput.min.js"></script>
  <script src="assets/global/js/components/bootstrap-select.min.js"></script>
  <script src="assets/global/js/components/icheck.min.js"></script>
  <script src="assets/global/js/components/switchery.min.js"></script>
  <script src="assets/global/js/components/asrange.min.js"></script>
  <script src="assets/global/js/components/asspinner.min.js"></script>
  <script src="assets/global/js/components/clockpicker.min.js"></script>
  <script src="assets/global/js/components/ascolorpicker.min.js"></script>
  <script src="assets/global/js/components/bootstrap-maxlength.min.js"></script>
  <script src="assets/global/js/components/jquery-knob.min.js"></script>
  <script src="assets/global/js/components/bootstrap-touchspin.min.js"></script>
  <script src="assets/global/js/components/card.min.js"></script>
  <script src="assets/global/js/components/jquery-labelauty.min.js"></script>
  <script src="assets/global/js/components/bootstrap-datepicker.min.js"></script>
  <script src="assets/global/js/components/jt-timepicker.min.js"></script>
  <script src="assets/global/js/components/datepair-js.min.js"></script>
  <script src="assets/global/js/components/jquery-strength.min.js"></script>
  <script src="assets/global/js/components/multi-select.min.js"></script>
  <script src="assets/global/js/components/jquery-placeholder.min.js"></script>
-->

  <script src="assets/examples/js/forms/advanced.min.js"></script>


  
  
  
  
  
  
  
 <script>
 function clear_info()
 {
document.getElementById('transactions').innerHTML = '';
}

function getContType(groupType){
	var groupType =$("#groupType").val();
	if (groupType == "CONTRIBUTOIN"){
		document.getElementById('contributionType').innerHTML = '<label class="control-label margin-bottom-15" for="contType">Contribution Type:</label><select class="form-control round" id="contType" name="contType" required="required"><option></option><option value="fixed">ONCE-OFF.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;eg: wedding, funerals...</option><option value="periodical">RECURRING.&nbsp;&nbsp;&nbsp;&nbsp;eg: Church tithe, Umutekano...</option></select><br/>';
	
	}
	else{
		document.getElementById('contributionType').innerHTML = '<input id="contType" hidden name="contType" value="none">';
	
	};
}
 </script>
 <script>
 //  GROUP CREATION

	//1 Pass Info Then Finance // 2 Pass Finance Then Invite
function nexttoaccounts(){
	var step = document.getElementById('step').value;
	//alert (step);
	if(step == 'info')
	{
		var groupType = document.getElementById('groupType').value;
		  if (groupType == null || groupType == "") {
				//alert("groupType must be filled out");
				return false;
			}
		  var contType = document.getElementById('contType').value;
		  if (contType == null || contType == "") {
				//alert("contType must be filled out");
				return false;
			}
		  var groupName = document.getElementById('groupName').value;
		  if (groupName == null || groupName == "") {
				//alert("groupName must be filled out");
				return false;
			}
		  var groupDesc = document.getElementById('groupDesc').value;
		  if (groupDesc == null || groupDesc == "") {
				//alert("groupDesc must be filled out");
				return false;
			}
		  var thisId = document.getElementById('thisId').value;
		  var adminName = document.getElementById('adminName').value;
		  var adminPhone = document.getElementById('adminPhone').value;
		  if(groupType == 'IKIMINA'){
		  document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="2aIkiminaFinance">'
		  }
		  else if(groupType == 'CONTRIBUTOIN' && contType == 'periodical'){
			document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="2bContributionTitheFinance">'
		  }
		  else if(groupType == 'CONTRIBUTOIN' && contType == 'fixed'){
			document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="2cContributionWedding">'
		  }
		  else if(groupType == 'INVESTMENT'){
			document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="2dInvestmentFinance">'
		  }
		document.getElementById('finance').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	
		  //alert (groupType);
			$.ajax({
			  type : "GET",
			  url : "scripts/newgroup.php",
			  dataType : "html",
			  cache : "false",
			  data : {
				
				groupType : groupType,
				contType : contType,
				groupName : groupName,
				groupDesc : groupDesc,
				thisId : thisId,
				adminName : adminName,
				adminPhone : adminPhone
			  },
			  success : function(html, textStatus){
				$("#finance").html(html);
			  },
			  error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			  }
		  });
	}
////////////////////////////////////////////////////////////////
	
	//2.a Pass IKIMINA Finance Then Invite people
	else if(step == '2aIkiminaFinance')
	{
		//alert("INVITE FOR IKIMINA");
		 var contributionAmount = document.getElementById('contributionAmount').value;
		  if (contributionAmount == null || contributionAmount == "") 
		  {
				alert("contributionAmount must be filled out");
				return false;
			}
		  var transactionDays = document.getElementById('transactionDays').value;
		  if (transactionDays == null || transactionDays == "") {
				alert("transactionDays must be filled out");
				return false;
			}
		  var startingDate = document.getElementById('startingDate').value;
		  if (startingDate == null || startingDate == "") {
				alert("startingDate must be filled out");
				return false;
			}
		  var Saving = document.getElementById('Saving').value;
		  if (Saving == null || Saving == "") {
				alert("Saving must be filled out");
				return false;
			}
		  
		  document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="3aIkiminaInvite">';
		  document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
		  $.ajax({
			  type : "GET",
			  url : "scripts/newgroup.php",
			  dataType : "html",
			  cache : "false",
			  data : {
				
				contributionAmount : contributionAmount,
				transactionDays : transactionDays,
				startingDate : startingDate,
				Saving : Saving
			  },
			  success : function(html, textStatus){
				$("#invite").html(html);
			  },
			  error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			  }
		  });

	}
	
	//2.b Pass TIGHT Finance Then Invite people
	else if(step == '2bContributionTitheFinance')
	{
		var bank = document.getElementById('bank').value;
		if (bank == null || bank == "") 
		{
			alert("bank must be filled out");
			return false;
		}
		var bankaccount = document.getElementById('bankaccount').value;
		if (bankaccount == null || bankaccount == "") 
		{
			alert("bankaccount must be filled out");
			return false;
		}
		 alert(bank);
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="3bTitheInvite">';
		document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
		$.ajax({
			type : "GET",
			url : "scripts/newgroup.php",
			dataType : "html",
			cache : "false",
			data : {
				
				tightbank : bank,
				bankaccount : bankaccount
			},
			success : function(html, textStatus){
			$("#invite").html(html);
			},
			error : function(xht, textStatus, errorThrown){
			alert("Error : " + errorThrown);
			}
		});
	}

	//2.c Pass Wedding Finance Then Invite people
	else if(step == '2cContributionWedding')
	{
	 var bank = document.getElementById('bank').value;
	  if (bank == null || bank == "") 
	  {
			alert("bank must be filled out");
			return false;
		}
	  var bankaccount = document.getElementById('bankaccount').value;
	  if (bankaccount == null || bankaccount == "") {
			alert("bankaccount must be filled out");
			return false;
		}
	 var WeedingAmount = document.getElementById('WeedingAmount').value;
	  if (WeedingAmount == null || WeedingAmount == "") 
	  {
			alert("WeedingAmount must be filled out");
			return false;
		}
	  var WeddingDate = document.getElementById('WeddingDate').value;
	  if (WeddingDate == null || WeddingDate == "") {
			alert("WeddingDate must be filled out");
			return false;
		}
	
	document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="3cWeedingInvite">';
	document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	  $.ajax({
		  type : "GET",
		  url : "scripts/newgroup.php",
		  dataType : "html",
		  cache : "false",
		  data : {
			
			WeedingAmount : WeedingAmount,
			WeddingDate : WeddingDate,
			Weddingbank : bank,
			Weddingbankaccount : bankaccount
		  },
		  success : function(html, textStatus){
			$("#invite").html(html);
		  },
		  error : function(xht, textStatus, errorThrown){
			alert("Error : " + errorThrown);
		  }
	  });
	}

	//2.d Pass INVESTMENT Finance Then Invite people
	else if(step == '2dInvestmentFinance')
	{
	    var investmentAmount = document.getElementById('investmentAmount').value;
	    if (investmentAmount == null || investmentAmount == "") 
		  {
				alert("investmentAmount must be filled out");
				return false;
			}
		  var offerDate = document.getElementById('offerDate').value;
		  if (offerDate == null || offerDate == "") {
				alert("offerDate must be filled out");
				return false;
			}
		 var totalShares = document.getElementById('totalShares').value;
		  if (totalShares == null || totalShares == "") 
		  {
				alert("totalShares must be filled out");
				return false;
			}
		  var ashare = document.getElementById('ashare').value;
		  if (ashare == null || ashare == "") {
				alert("ashare must be filled out");
				return false;
			}
		 var bankaccount = document.getElementById('bankaccount').value;
		  if (bankaccount == null || bankaccount == "") {
				alert("bankaccount must be filled out");
				return false;
			}
		
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="3dInvestmentInvite">';
		document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
		$.ajax({
		    type : "GET",
		    url : "scripts/newgroup.php",
		    dataType : "html",
		    cache : "false",
		    data : {
				
				investmentAmount  : investmentAmount,
				offerDate         : offerDate,
				totalShares       : totalShares,
				ashare            : ashare,
				bankaccount       : bankaccount
			  },
			  success : function(html, textStatus){
				$("#invite").html(html);
			  },
			  error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
		    }
	    });
	}

/////////////////////////////////////////////////////////////////

}	
///////////////////////////////////////////////////////////////////////////

 </script>
 