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
$selectevent = $db->query("SELECT * FROM Events") or die("error in selecting of the events");
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<!--stylesheet started here-->
 	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
 	 	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<!--End of the stylesheet-->
 	<title>Events</title>
 </head>
 <body>
  	<div class="nav-side-menu">
    	<div class="brand">Draft</div>
    	<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="events.php">
                  <i class="fa fa-dashboard fa-lg"></i> New event
                  </a>
                </li>

                <li  data-toggle="collapse" data-target="#products" class="active">
                  <a href="event_all.php"><i class="fa fa-bars fa-lg"></i> Posted event</a>
                </li>
                <li  data-toggle="collapse" data-target="#products" >
                  <a href="bought_ticket.php"><i class="fa fa-book fa-lg"></i> Bought</a>
                </li>

                 <li>
                  <a href="logout.php">
                  <i class="fa fa-sign-out fa-lg"></i> Logout
                  </a>
                </li>
            </ul>
     </div>
</div>
 <div  style="margin:0;padding:3%; max-width:100%;overflow:hidden;margin-left:17%;">

 	<?php 
 		while($fetchevent = mysqli_fetch_assoc($selectevent))
 		{
 			$eventid = $fetchevent['id_event'];
 			$ev_name = $fetchevent['Event_Name'];
 			$ev_profile = $fetchevent['Event_Cover'];
 	?>
 		<a href="event-details.php?id=<?php echo $eventid?>">
	 		<div style=" width:24%;height:358px; margin:2px;display:inline-block;float:left;border:1px solid #c0c0c0;">
	 			<div  style="height:300px; ">
	 				<img src="images/<?php echo $ev_profile;?>"  style="height:300px; width:100%;">
	 			</div>
	 			<div style="height:54px; background-color:#fff;max-width:100%; color:#fff;padding-top:15px; padding-left:5px;padding-right:5px;border-top:1px solid #333;">
	 				<?php
	 				$selectdetail = $db->query("SELECT * FROM eventing_pricing WHERE event_code LIKE '$eventid'") or die("error in selecting of the events");
	 				while($fetchdetail = mysqli_fetch_assoc($selectdetail))
	 				{
	 					//This is seats (ID)  for this event
	 					$seatnumber = $fetchdetail['pricing_code']; 
	 					// require of the selecting all from transaction  when event->property->ID (seats' place selected to sit ) 
	 					$selectrrrr = $db->query("SELECT * FROM transaction WHERE cust_event_seats = '$seatnumber'");
	 					// numbers of the rows that count event->property-> hs been purchased
	 					$bought = mysqli_num_rows($selectrrrr);
	 					// require for selecting event seats  from priving  when pricng id equal to seats ID
	 					$sqlpricing = $db->query("SELECT event_seats,event_property FROM pricing WHERE pricing_id ='$seatnumber'") or mysqli_error();
	 					// require for  fetching data from events above sqlquery
	 					$row = mysqli_fetch_array($sqlpricing);
	 					// This is number of the seats are provided for  this events and especial this property
	 					$seatprovided = $row['event_seats']; 
	 					//require for fetching event_property
	 					$seat_property = $row['event_property'];
	 					//calculating the seats remaining here
	 					$remaining = $seatprovided - $bought; // Total number of the seats are available Now
	 				?><button title="<?php echo $seat_property; ?>  Remaining seats -> <?php echo $remaining; ?>" type="button" class="btn btn-success btn-circle"><?php echo $remaining; ?></button>
	 				<?php
	 					}
	 				?>
	 			</div>
	 		</div>
	 	</a>
	<?php
		}
	?>
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