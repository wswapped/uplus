<?php ob_start(); include('../db.php');?>
<?php 
 
if(isset($_GET['page'])){
	$_GET['page']();
	}
?>

<?php
	function finance()
	{ 
		
?>
You are going to recieve a call from our team 
for manual check so that the event can go public
<?php
	}
?>
<?php
if (isset($_POST['eventTitle'])) {
	$eventTitle 		= $_POST['eventTitle'];
	$eventLocation 		= $_POST['eventLocation'];
	$eventStarting 		= $_POST['eventStarting'];
	$eventEnding 		= $_POST['eventEnding'];

	$ticketName1 		= $_POST['ticketName1'];
	$ticketPrice1 		= $_POST['ticketPrice1'];
	$ticketSeats1 		= $_POST['ticketSeats1'];

	$withdrawAccount 	= $_POST['withdrawAccount'];
	$withdrawAccountNo 	= $_POST['withdrawAccountNo'];

	//mysql_query for inserting of the events
	$eventDb->query("INSERT INTO 
		events (Event_Name, Event_Cover, Event_Desc, Event_Location, phone, Event_Start, Event_End, user_id, createdBy) 
		VALUES('$eventTitle','test.jpg', 'testDesc', '$eventLocation', '0788556677', '$eventStarting', '$eventEnding', '1', '1')")or die(mysqli_error($eventDb));
	if($eventDb){
	 $event_last_id =mysqli_insert_id($eventDb);
	}
	for($i = 0; $i < count($ticketName1); $i++)
	{
		// mysql_query for inserting of the pricing 
		$eventDb->query("INSERT INTO pricing (price, event_property, event_seats)
		 			VALUES('$ticketPrice1[$i]','$ticketName1[$i]','$ticketSeats1[$i]')")or die(mysqli_error($eventDb));
		if($eventDb){
			$pricing_last_id 	=mysqli_insert_id($eventDb);
		}
		
		$eventDb->query("INSERT INTO eventing_pricing (event_code, pricing_code) VALUES($event_last_id,$pricing_last_id)") or die("error please".mysqli_error());
	} 
	header('location:../events');	
}
?>
