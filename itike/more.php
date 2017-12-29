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
include("dbconnect.php");
$selectransact = mysql_query("SELECT * FROM transaction  WHERE user_id LIKE '$userid'") or die("error in selecting of the events");
$eventis_selected = $_GET['event'];
$select_detail_eve = mysql_query("SELECT * FROM transaction WHERE cust_event_choose LIKE '$eventis_selected' AND user_id LIKE '$userid'") or die("error please in selecting transaction".mysql_error());

$fetch_detail_eve = mysql_fetch_assoc($select_detail_eve);
$event_id = $fetch_detail_eve['cust_event_choose'];
$custom_pay_phone = $fetch_detail_eve['cust_pay_phone'];
$amount = $fetch_detail_eve['amount'];
$cust_event_seatid = $fetch_detail_eve['cust_event_seats'];
  $select_pricing = mysql_query("SELECT * FROM pricing WHERE pricing_id LIKE '$cust_event_seatid'");
  $fetch_pricing = mysql_fetch_assoc($select_pricing);
  $event_property = $fetch_pricing['event_property'];

  $selectevent = mysql_query("SELECT * FROM events WHERE id_event LIKE '$event_id'");
  $fetchevent = mysql_fetch_assoc($selectevent);
  $event_cover = $fetchevent['Event_Cover'];
  $event_name = $fetchevent['Event_Name'];
  $event_date = $fetchevent['date_happ'];
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<!--stylesheet started here-->
 	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
 	 	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery-3.1.1.min.js"></script>
 	<!--End of the stylesheet-->
 	<title>Evennts</title>
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

                <li  data-toggle="collapse" data-target="#products">
                  <a href="event_all.php"><i class="fa fa-bars fa-lg"></i> Posted event</a>
                </li>
                <li  data-toggle="collapse" data-target="#products"   class="active" >
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
 <div  style="margin:0;padding:3% 3% 3% 10%; max-width:100%;overflow:hidden;margin-left:17%;  ">
<div style=" max-width:100%; overflow: hidden;">
  <div class="col-lg-10" style="border:1px solid #c0c0c0; height:650px; padding:0; background-color:#fff;">
    <div class="col-lg-12" style=" height:230px;padding:0;">
      <img class="img-thumbnail img-responsive" style="height:227px;width:100%;" src="images/<?php echo $event_cover; ?>">
    </div>
    <div  class="col-lg-12">
      <div style="border:1px solid #444; max-width:100%;overflow:hidden;padding:10%;">
        <div  class="col-lg-12"  style="border:1px solid #444;max-width:100%; height:250px;">
          <!--ceremony  names-->
          <div style="border-bottom:1px solid #333; max-width:100%; height:40px;">
            <div  style=" width:50%;display:inline-block; float:left;font-size:17px;font-weight:bold;">Ceremony: </div>
            <div  style=" width:50%; display:inline-block; float:left;font-size:17px;text-align:center;"><?php echo $event_name; ?></div>
          </div>
           <!--amount consumes-->
          <div style="border-bottom:1px solid #333; max-width:100%; height:40px;">
            <div  style=" width:50%;display:inline-block; float:left;font-size:17px;font-weight:bold;">Amount: </div>
            <div  style=" width:50%; display:inline-block; float:left;font-size:17px;text-align:center;"><?php echo $amount; ?> / <b><?php echo $event_property; ?></b></div>
          </div>
           <!--Valid date-->
          <div style="border-bottom:1px solid #333; max-width:100%; height:40px;">
            <div  style="width:50%;display:inline-block; float:left;font-size:17px;font-weight:bold;">Date: </div>
            <div  style="width:50%; display:inline-block; float:left;font-size:17px;text-align:center;"><?php echo $event_date; ?></div>
          </div>
          <div style="max-width:100%;height:100px;">
              <img style="float:right;height:100px; width:100px;" src="images/qr.png">
          </div>
        </div>
      </div>
    </div>
  </div>;
</div>
 </div>
 <!--script start here-->

<script type="text/javascript"  src="js/script.js"></script>
 <!--End of the script here-->
 </body>
 </html>
 <?php
}
 ?>