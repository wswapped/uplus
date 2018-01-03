 <?php
error_reporting(0);
session_start();
require_once("dbconnect.php");
if(!isset($_SESSION['user_id']))
{
	header('location:index.php');
}
else
{
$userid = $_SESSION['user_id'];
$select_user = $eventDb->query("SELECT * FROM users WHERE user_id LIKE $userid") or die("error please in user selection".mysqli_error());
$fetchuser = mysqli_fetch_assoc($select_user);
	$status = $fetchuser['status'];
	$phone = $fetchuser['phone'];
	
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<!--stylesheet started here-->
 	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
 	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
 	<!--End of the stylesheet-->
 	<title>Events</title>
 </head>
 <body>

 <div  style="margin:0;padding:0; max-width:100%;overflow:hidden;">

	 <div  class="col-lg-12"  style="padding:0;">
	 	<div class="nav-side-menu">
    	<div class="brand"><?php echo $phone ?></div>
    	<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
          <ul id="menu-content" class="menu-content collapse out">
                <li   class="active">
                  <a href="events.php">
                  <i class="fa fa-dashboard fa-lg"></i> New event
                  </a>
                </li>

                <li  data-toggle="collapse" data-target="#products">
                  <a href="event_all.php"><i class="fa fa-bars fa-lg"></i> Posted event</a>
                </li>
                <li  data-toggle="collapse" data-target="#products" >
                  <a href="bought_ticket.php"><i class="fa fa-book fa-lg"></i> Bought</a>
                </li>
                <li  data-toggle="collapse" data-target="#products">
                  <a href="wallet.php"><i class="fa fa-book fa-lg"></i> Wallet</a>
                </li>
                 <li>
                  <a href="logout.php">
                  <i class="fa fa-sign-out fa-lg"></i> Logout
                  </a>
                </li>
            </ul>
     </div>
</div>
	 	<div class="col-lg-2"  style="overflow:hidden;"></div>
	 	<div class="col-lg-8" style=" background-color:#ffffff;  margin-top: 5%; border:1px solid #c0c0c0; overflow:hidden; padding-bottom:10px;  margin-left:100px; height:550px;">
	 		<div class="col-lg-12"  style="overflow:auto;height:550px;">
	 			<div  class="event-head"></div>
	 			<div  class="event-body"  style="overflow:auto;  height:550px;">
	 			<?php //echo $status_id;?>
	 			<form action="events_process.php" method="post" enctype="multipart/form-data">
	 				<div class="event-body-in">
	 				<?php //echo $status_id;?>
	 					<div class="events-rows">
	 						<label>Name:</label>
	 						<input   type="text" name="names" placeholder="Names">
	 						<input type="hidden" name="session_id"  value="<?php echo $userid?>">
	 						<div  class="event-error"><i class="glyphicon glyphicon-remove"></i></div>
	 					</div>
	 					<div id="cover-more-product">
		 					<div class="events-rows" style="overflow:hidden">
		 						<div  class="event-product">
			 						<label>Product:</label>
			 						<input type="text" name="product1[]" placeholder="Product Name">
			 						<div  class="event-error"><i class="glyphicon glyphicon-remove"></i></div>
			 					</div>
			 					<div class="event-product">
			 						<label>Price:</label>
			 						<input type="text" name="price1[]" placeholder="Prices">
			 						<div  class="event-error"><i class="glyphicon glyphicon-remove"></i></div>
			 					</div>
			 					<div class="event-product">
			 						<label>N<sup><u>0</u></sup>'s seats:</label>
			 						<input type="text" name="seats1[]" placeholder="Number of seats">
			 						<div  class="event-error"><i class="glyphicon glyphicon-remove"></i></div>
			 					</div>
		 					</div>
		 				</div>
	 					<div style="overflow:hidden;margin-left:86%;margin-top:2px;">
	 						<button id="btn-plus" type="button" class="btn btn-danger btn-circle"><i class="glyphicon glyphicon-plus"></i></button>
	 					</div>


		 					<div class="events-rows"    style="border-bottom:1px solid #e0dddd;">
		 						<label>Photo</label>
		 						<input type="file" name="images">
		 					</div>
		 				<div class="events-rows">
	 						<label>Phone:</label>
	 						<input   type="text" name="phone" placeholder="Number's phone">
	 						<div  class="event-error"><i class="glyphicon glyphicon-remove"></i></div>
	 					</div>

	 					<div class="events-rows">
	 						<label>Date:</label>
	 						<input id="datepicker"   type="text" name="date" placeholder="Date">
	 						<div  class="event-error"><i class="glyphicon glyphicon-remove"></i></div>
	 					</div>
		 				
	 				</div>

		 					<div  class="event-bottom">
		 						<div class="event-botton">
										<input type="submit" value="Submit" name="">
		 						</div>
		 						<div class="event-add-fiels"></div>
		 					</div>
		 			</form>
	 			</div>
	 		</div>.....
	 	</div>
	 	<div class="col-lg-2"></div>
	 </div>
</div>
 <!--script start here-->
  <script src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript"  src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function()
{
	$("#datepicker").datepicker({
		dateFormat: 'yy-mm-dd',
		minDate:0,
		maxDate:'1y',
	});
})
</script>
 <!--End of the script here-->
 </body>
 </html>
 <?php
}
?>