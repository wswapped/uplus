<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['user_id']))
{
	header('location:index.php');
}
else
{
 $userid = $_SESSION['user_id'];

	include("dbconnect.php");
	 $eventid = $_GET['id'];

	$selecteventd = mysql_query("SELECT * FROM events WHERE id_event = '$eventid'") or die("error please".mysql_error());
		$fetcheve = mysql_fetch_assoc($selecteventd);
		  $event_id = $fetcheve['id_event'];
		  $event_name = $fetcheve['Event_Name'];
		  $event_profile = $fetcheve['Event_Cover'];

		  $select_ev_pricing = mysql_query("SELECT * from eventing_pricing WHERE event_code LIKE '$event_id'");
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<!--stylesheet started here-->
 	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<!--End of the stylesheet-->

	<!--script start here-->
	<script src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript"  src="js/script.js"></script>
	<!--End of the script here-->
 	<title>Evennts</title>
 </head>
 <body>
 <div  style="margin:0;padding:0; max-width:100%; height:700px;overflow:hidden; background:rgba(62, 59, 59, 0.75)">
	 <div  class="col-lg-12">
	 	<div class="col-lg-3"></div>
	 	<div class="col-lg-6" style=" margin-:0;padding:0;background-color:#ffffff;  margin-top: 5%; height:600px;">
	 		<div  class="event-detail-head">
	 			<img src="images/<?php echo $event_profile;?>"  style="width:100%; height:299px;">
	 		</div>
	 		<div  class="event-detail-body">
	 			<div class="event-name">
	 				<label>Events Name:</label> <?php echo $event_name?>
	 				<input id="event_name" type="hidden" name="" value="<?php echo $event_id?>">
	 			</div>
	 			<div class="event-price">
	 				<label>Price:</label>  
	 				<select id="ibyiciro">
	 					<?php
	 						while($fetch_ev_code = mysql_fetch_assoc($select_ev_pricing))
	 						{
	 							$pricing_code = $fetch_ev_code['pricing_code'];
	 							$select_price = mysql_query("SELECT * FROM pricing WHERE pricing_id LIKE '$pricing_code'");
	 							$fetch_price = mysql_fetch_assoc($select_price);
	 							 $pricing_id = $fetch_price['pricing_id'];
	 							 $price = $fetch_price['price'];
	 							 $event_property = $fetch_price['event_property'];


	 					?>
	 					
	 					<option  value="<?php echo $pricing_id?>"><?php echo $pricing_id.' | '.$price.' Rwf';?></option>
	 					<?php
	 					}

	 					?>
	 						<script type="text/javascript">
	 						$(document).ready(function()
	 							{
		 							$("#Paying").click(function()
		 							{
		 								// events, phone's number for paying, property,
		 								var phone_client = $("#phones").val(); //got phone numbers
		 								var event =	$("#event_name").val(); // got an ID
		 								var property = $("#ibyiciro").val(); // got property ID
		 								var user_id = <?php echo $userid;?>;
		 								var data = 'event='+event+'&phone_client='+phone_client+'&property='+property+'&user_id='+user_id;
		 								alert(property);
		 								$.ajax
		 								({
		 									type:'POST',
		 									url:'customer_pay_process.php',
		 									data:data,
											success:function(data)
		 									{
		 										alert(data);
		 										$("#phones").val("");
		 										$("#event_name").val("");
		 										$("#ibyiciro").val("");
		 									}
		 								});
		 							});
	 							});

	 						</script>
	 					<?php

	 					?>
	 				</select>	
	 			</div>
	 			<div class="event-phone">
	 				<label>Phone:</label>  
	 				<input type="text" name=""  placeholder="Phone Number" id="phones">
	 			</div>
	 		</div>
	 		<div class="event-detail-bottom">
	 			<input id="Paying" type="submit" name="" value="Pay" >
	 		</div>
	 	</div>
	 	<div class="col-lg-3" style=""></div>
	 </div>
</div>
 <!--script start here-->
 <script src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript"  src="js/script.js"></script>
 <!--End of the script here-->
 </body>
 </html>
 <?php
}
 ?>