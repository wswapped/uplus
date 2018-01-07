<?php include("template/header.php");?>
 <!-- Page -->
<div class="page animsition">
   	<div class="page-content container-fluid">
	    <div class="row">
	      	<div class="col-lg-12 col-sm-12">
		    	<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">
							Events Status 
							<span class="badge badge-info" style="background-color: #00897b;">
								<?php
								$sql = $eventDb->query("
SELECT SUM(P.event_seats) seats, SUM(P.price*P.event_seats) price, E.Event_Name, E.id_event
FROM pricing P 
INNER JOIN eventing_pricing EP
ON P.pricing_id = EP.pricing_code
INNER JOIN events E
ON E.id_event = EP.event_code
WHERE E.user_id ='$thisid' GROUP BY E.id_event");
								echo $countAll = mysqli_num_rows($sql);
								?>
							</span>
						</h3>
	            	</div>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<td>ID</td>
									<td>Event Name</td>
									<td>Total Tickets</td>
									<td>Sold Tickets</td>
									<td>Remaining Tickets</td>
									<td>Shares</td>
									<td>Clicks</td>
									<td>Action</td>
								</tr>
							</thead>
							<tbody>
								<?php
									$n=0;
									while($row = mysqli_fetch_array($sql))
									{
										$eventName 			= $row['Event_Name'];
										$eventId 			= $row['id_event'];
										$totalTickets 		= $row['seats'];
										$ticketPrice 		= $row['price'];
										$rowSold 			= mysqli_fetch_array($eventDb->query("SELECT SUM(amount) soldAmount, COUNT(amount) soldTickets FROM transaction WHERE cust_event_choose = '$eventId'"));
										$totalSoldTickets	= $rowSold['soldTickets'];
										$totalSoldAmount	= $rowSold['soldAmount'];
										$n++;
									echo'<tr>
										<td>'.$n.'</td>
										<td>'.$eventName.'</td>
										<td>'.number_format($totalTickets).' ('.number_format($ticketPrice).' Rwf)</td>
										<td>'.number_format($totalSoldTickets).' ('.number_format($totalSoldAmount).' Rwf)</td>
										<td>'.number_format($totalTickets-$totalSoldTickets).' ('.number_format($ticketPrice-$totalSoldAmount).' Rwf)</td>
										<td>0</td>
										<td>0</td>
										<td><a href="editCont'.$eventId.'" class="btn btn-dark btn-xs" style="text-decoration: none;">Manage</a></td>
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



<button class="site-action btn-raised btn btn-success btn-floating" data-target="#addTopicForm" data-toggle="modal" type="button" id="add">
	<span style="
    position: absolute;
    background: #4caf50;
    border-bottom-left-radius: 20px;
    border-top-left-radius: 20px;
    top: 11px;
    font-size: 15px;
    left: -108px;
    padding-bottom: 5px;
    padding-top: 5px;
    padding-right: 13px;
    margin-left: 0px;
">&nbsp; Create an Event 
</span>
  <i class="icon md-plus" aria-hidden="true" style="
    font-size: 32px;
    text-align: center;
    margin-left: 1px;
"></i>
</button>
  <!-- NEW EVENT POPUP -->
<div class="modal fade" id="addTopicForm" aria-hidden="true" aria-labelledby="addTopicForm" role="dialog" tabindex="-1">
    <div class="modal-dialog">
	    <div class="modal-content" id="exampleWizardForm">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true">×</span>
	      </button>
	      <h4 class="modal-title" id="exampleModalTabs">Create an Event</h4>
	    </div>
	 	<!-- Steps -->
		<div style="margin-bottom: unset;" class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
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
				<span class="step-title">Confirm</span>
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
							<label class="control-label" for="eventTitle">Event Title:</label>
							<input type="text" class="form-control" id="eventTitle" required name="eventTitle" placeholder="Event Title">
						</div>
						<div class="form-group">
							<label class="control-label" for="eventLocation">Lacation</label>
							<input type="text" class="form-control" id="eventLocation" required name="eventLocation" placeholder="Event Loacation">
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="control-label" for="eventStarting">Starting</label>
								<input type="date" class="form-control" required name="eventStarting" id="eventStarting">
							</div>
							<div class="col-md-6">
								<label class="control-label" for="eventEnding">Ending</label>
								<input type="date" class="form-control" required name="eventEnding" id="eventEnding">
							</div>
						</div>
						<!-- 
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="ticketName">Ticket</label>
									<input type="text" class="form-control" id="ticketName" required name="groupName" placeholder=""/> 
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="ticketPrice">Price</label>
									<input type="text" class="form-control" id="groupName" required name="groupName" placeholder=""/> 
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="ticketSeats">Seats</label>
									<input type="text" class="form-control" id="ticketSeats" required name="groupName" placeholder=""/> 
								</div>
							</div>
							<div class="col-md-2"><br/>Add</div>
						</div> -->
						<br>
					</div>
				</div>
			 <!-- End Wizard Content -->
			</div>
		  <!-- End Panel Wizard One Form -->
		</div>
	   </div>
	</div>
</div>
<!-- End NEW EVENT POPUP -->

  <!-- Footer -->
  <footer class="site-footer" style="text-align: center;">
    <div class="site-footer-legal">© 2017 uPlus Mutual Partners LTD</div>
	<a  href="apps/"><i class="icon md-android"></i></a> 
	<div class="site-footer-right">
      Digital Contribution <i class="red-600 wb wb-globe"></i> Platform
    </div>
  </footer>
 
   
<?php include('template/notifications.php');?>
 
  
	<script src="assets/js/ajax_call.js"></script>

  <!-- Core  -->
  <script src="assets/global/vendor/jquery/jquery.min.js"></script>
  <script src="assets/global/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/global/vendor/animsition/animsition.min.js"></script>
  <script src="assets/global/vendor/asscroll/jquery-asScroll.min.js"></script>
  <script src="assets/global/vendor/mousewheel/jquery.mousewheel.min.js"></script>
  <script src="assets/global/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>

  <!-- Plugins -->
  <script src="assets/global/vendor/switchery/switchery.min.js"></script>
  <script src="assets/global/vendor/slidepanel/jquery-slidePanel.min.js"></script>

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

  <script src="assets/global/js/components/asscrollable.min.js"></script>
  <script src="assets/global/js/components/animsition.min.js"></script>

  <script src="assets/global/js/components/jquery-wizard.min.js"></script>
  <script src="assets/global/js/components/matchheight.min.js"></script>

  <script src="assets/examples/js/forms/wizard.min.js"></script>
  <script src="assets/examples/js/forms/advanced.min.js"></script>
  
 <script>
function getContType(groupType)
{
	var groupType =$("#groupType").val();
	if (groupType == "CONTRIBUTOIN")
	{
		document.getElementById('contributionType').innerHTML = '<label class="control-label margin-bottom-15" for="contType">Contribution Type:</label><select class="form-control round" id="contType" name="contType" required="required"><option></option><option value="fixed">ONCE-OFF.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;eg: wedding, funerals...</option><option value="periodical">RECURRING.&nbsp;&nbsp;&nbsp;&nbsp;eg: Church tithe, Umutekano...</option></select><br/>';
	}
	else
	{
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
<script>
// VIDEOS TUTORIALS
function videoinfo(){
	document.getElementById('tutorials').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	
 document.getElementById('tutorials').innerHTML = '<iframe width="560" height="315" src="https://www.youtube.com/embed/_QoR_i0IIfY" frameborder="0" allowfullscreen></iframe>';
  }
function videosavings(){
	document.getElementById('tutorials').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	document.getElementById('tutorials').innerHTML = '<iframe width="559" height="315" src="https://www.youtube.com/embed/vj7XExwChwI" frameborder="0" allowfullscreen></iframe>';
  }
function videocontribution(){
	document.getElementById('tutorials').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';	
 document.getElementById('tutorials').innerHTML = '<iframe src="https://player.vimeo.com/video/72700224" width="559" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
  }
function videoloans(){
	document.getElementById('tutorials').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
 document.getElementById('tutorials').innerHTML = '<iframe width="559" height="315" src="https://www.youtube.com/embed/8b5-iEnW70k" frameborder="0" allowfullscreen></iframe>';
 
  }
</script>
</body>

</html>



                
