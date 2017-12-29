<?php
error_reporting(0);
session_start();
if(isset($_SESSION['user_id']))
{
	header('location:events.php');
}
else
{
$userid = $_SESSION['user_id'];

include("dbconnect.php");
$selectevent = mysql_query("SELECT * FROM events") or die("error in selecting of the events");
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<!--stylesheet started here-->
 	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<!--End of the stylesheet-->
 	<title>Evennts</title>
 </head>
 <body>
<div  style="margin:0;padding:3%; max-width:100%;overflow:hidden;">
	<div class="col-lg-4" style="background-color:#fff;padding:0;  border:1px solid #c0c0c0; max-width:40%; height:300px; margin-left:30%;margin-top:10%;">
		<div  class="col-lg-12" style=" height:60px; text-align:center; font-size:20px; background-color:#3f51b5; color:#fff;">Sign in</div>
		<div  class="col-lg-12" style=" height:240px;">
			<div style=" margin:5% 5px 5px 5px;">
				<form action="signin_process.php" method="POST">
					<div  style="margin-top:5px;">
						<label>Username</label>
						<input  class="form-control" type="text" name="username" placeholder="Username or Phone number">
					</div>
					<div  style="margin-top:5px;">
						<label>Password</label>
						<input  class="form-control" type="password" name="password" placeholder="Password">
					</div>
					<div class="event-detail-bottom"  style="margin-top:5px;">
			 			<input id="Paying" type="submit" name="" value="Sign in" >
			 		</div>
				</form>
			</div>
		</div>
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
