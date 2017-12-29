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
                <li  data-toggle="collapse" data-target="#products">
                  <a href="bought_ticket.php"><i class="fa fa-book fa-lg"></i> Bought</a>
                </li>
                <li  data-toggle="collapse" data-target="#products" class="active" >
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
 <?php
    $select_event = mysql_query("SELECT * FROM events WHERE user_id LIKE $userid");
      while($fetch_event = mysql_fetch_assoc($select_event))
      {
        $event_id = $fetch_event['id_event'];
        $event_name = $fetch_event['Event_Name'];
        $event_cover = $fetch_event['Event_Cover'];
        $event_py_phone = $fetch_event['phone'];
        $event_date_happ = $fetch_event['date_happ'];
?>
 	<div style=" background-size:300px 200px; width:300px;  height:200px;display:inline-block; float:left;  margin-right:3px;  margin-bottom:3px; border:1px solid #c0c0c0;background-image:url('images/<?php echo $event_cover; ?>'); ">
 		<div style="background:rgba(0,0,0,0.5); font-size:25px;  font-weight:bold;border:1px solid #333; max-width:100%; height:50px; border:1px solid;text-align:center;  color:#fff;"><?php echo $event_name;?></div>
 		<div style="max-width:100%;max-height:100%;min-width:100%; height:100px;">
 				
 		</div>
 		<a  style="text-decoration:none;" href="more_my_event.php?event=<?php echo $event_id; ?>"><div style="background:rgba(255,255,255,0.8);color:#000;  font-size:15px;border-top:1px solid #333; max-width:100%; height:50px;text-align:center;cursor:pointer;  font-weight:bold;" " >More</div></a>
 	</div>
<?php
}
 ?>
 </div>
 <!--script start here-->

<script type="text/javascript"  src="js/script.js"></script>
 <!--End of the script here-->
 </body>
 </html>
 <?php
}
 ?>