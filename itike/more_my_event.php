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

$eventis_selected = $_GET['event'];
$select_detail_eve = $eventDb->query("SELECT * FROM transaction WHERE cust_event_choose LIKE '$eventis_selected' ") or die("error please in selecting transaction".mysqli_error());

$select_event = $eventDb->query("SELECT * FROM events WHERE id_event LIKE '$eventis_selected'");
$fetch_event = mysqli_fetch_assoc($select_event);
$event_cover = $fetch_event['Event_Cover'];

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
                <li  data-toggle="collapse" data-target="#products" >
                  <a href="bought_ticket.php"><i class="fa fa-book fa-lg"></i> Bought</a>
                </li>
                <li  data-toggle="collapse" data-target="#products" class="active">
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
        <?php
          $sum = 0;
          while($fetch_detail_eve = mysqli_fetch_assoc($select_detail_eve))
          {
           $event_id = $fetch_detail_eve['cust_event_choose'];
           $amount_paid = $fetch_detail_eve['amount'];
           $sum = $sum + $amount_paid. '<br>';
          }
        ?>
        <div style="max-width:100%;  height:41px; border:1px solid #444">
          <div style="width:50%; display:inline-block;float:left;height:40px;font-weight:bold;">Earned Money:</div>
          <div style="border-left:1px solid #444;height:40px;width:50%; display:inline-block; float:left; "><?php echo $sum?> Frw</div>
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