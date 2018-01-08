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
			<form id="eventForm" action="scripts/newevent.php" method="POST">
				<div class="wizard-pane active" id="exampleAccount" role="tabpanel">
					<div id="exampleAccountForm">
						<div id="stepFill">
							<input id="step" hidden value="info">
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
						<br>
					</div>
				</div>
				<div class="wizard-pane" id="exampleBilling" role="tabpanel">
					<div id="exampleBillingForm">
						<div class="row" id="moreTickets">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="ticketName1[]">Ticket</label>
									<input type="text" class="form-control" id="ticketName1[]" required name="ticketName1[]" placeholder="eg: VIP"/> 
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="ticketPrice1[]">Price</label>
									<input type="number" class="form-control" id="ticketPrice1[]" required name="ticketPrice1[]" placeholder="RWF"/> 
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="ticketSeats1[]">Seats</label>
									<input type="number" class="form-control" id="ticketSeats1[]" required name="ticketSeats1[]" placeholder="eg: 10"/> 
								</div>
							</div>
							<div class="col-md-2">
								<label class="control-label" for="addTicket">Action</label>
								<button class="btn btn-default btn-sm" id="addTicket">Add</button>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-6 col-sm-6">
							    <label class="control-label margin-bottom-15" for="withdrawAccount">Account Holder:</label>
							    <select class="form-control" id="withdrawAccount" required name="withdrawAccount">
							    	<option>--Select--</option>
							    	<?php 
							    		$sqlBank = $outCon->query("SELECT * FROM banks");
							    		while($rowBank = mysqli_fetch_array($sqlBank))
							    		{
							    			echo '<option>'.$rowBank['name'].'</option>';
							    		}
							    	?>
							    </select>
							    <br/>
							</div>
							<div class="col-lg-6 col-sm-6">
							    <label class="control-label margin-bottom-15" for="withdrawAccountNo">Account</label>
							    <input type="text" class="form-control" id="withdrawAccountNo" name="withdrawAccountNo"/><br/>
							</div>
						</div>
					</div>
				</div>
				<div class="wizard-pane" id="exampleGetting" role="tabpanel">
					<div id="invite">
						
					</div>
				</div>
			</form>
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
 //  GROUP CREATION

	//1 Pass Info Then Finance // 2 Pass Finance Then Invite
function nexttoaccounts(){
	var step = document.getElementById('step').value;
	alert (step);
	if(step == 'info')
	{
		var eventTitle = document.getElementById('eventTitle').value;
		  if (eventTitle == null || eventTitle == "") {
				//alert("groupType must be filled out");
				return false;
			}
		  var eventLocation = document.getElementById('eventLocation').value;
		  if (eventLocation == null || eventLocation == "") {
				//alert("contType must be filled out");
				return false;
			}
		  var eventStarting = document.getElementById('eventStarting').value;
		  
		  var eventEnding = document.getElementById('eventEnding').value;
		  document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="finance">'
		  
			document.getElementById('finance').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	
	}
	////////////////////////////////////////////////////////////////
	
	//2.a Pass IKIMINA Finance Then Invite people
	else if(step == 'finance')
	{
		
		  document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="confirm">';
		  document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
		  $.ajax({
			  type : "GET",
			  url : "scripts/newevent.php",
			  dataType : "html",
			  cache : "false",
			  data : {
				
				page : "finance"
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
function finishGroup(){
	alert("Submiting the form");
	document.forms["eventForm"].submit();
}
function backtoaccounts(){
	var step = document.getElementById('step').value;
	//alert (step);
	if(step == 'info')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="info">';
	}
	else if(step == 'finance')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="info">';
	}
	else if(step == 'confirm')
	{
		document.getElementById('stepFill').innerHTML = '<input id="step" hidden value="finance">';
	}
}
$(document).ready(function()
{

	$("#addTicket").click(function()
	{

		$("#moreTickets").append('<div class="col-md-4">'
									+'<div class="form-group">'
										+'<label class="control-label" for="ticketName1[]">Ticket</label>'
										+'<input type="text" class="form-control" id="ticketName1[]" required name="ticketName1[]" placeholder="eg: VIP"/>'
									+'</div>'
								+'</div>'
								+'<div class="col-md-3">'
									+'<div class="form-group">'
										+'<label class="control-label" for="ticketPrice1[]">Price</label>'
										+'<input type="number" class="form-control" id="ticketPrice1[]" required name="ticketPrice1[]" placeholder="RWF"/>'
									+'</div>'
								+'</div>'
								+'<div class="col-md-3">'
									+'<div class="form-group">'
										+'<label class="control-label" for="ticketSeats1[]">Seats</label>'
										+'<input type="number" class="form-control" id="ticketSeats1[]" required name="ticketSeats1[]" placeholder="eg: 10"/>'
									+'</div>'
								+'</div>'
								+'<div class="col-md-2">'
								+'</div>');
	});


});		
///////////////////////////////////////////////////////////////////////////
</script>

</body>

</html>



                
