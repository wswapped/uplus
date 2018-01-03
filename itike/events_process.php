<?php
require_once("dbconnect.php");
$names = $_POST['names'];
$pro1 = $_POST['product1'];
$pric1 = $_POST['price1'];
$seat1 = $_POST['seats1'];
$images_cover = $_FILES['images']['name'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$user_id = $_POST['session_id'];

$error = array();
	$allow_ext = array('jpg','jpeg','png');
	$file_name = $_FILES['images']['name'];
	$file_ext = strtolower(end(explode('.', $file_name)));
	$file_tmp = $_FILES['images']['tmp_name'];

		if(in_array($file_ext, $allow_ext) === false)
		{
			$error[] = 'Extension not allowed';
		}

		if (empty($error)) 
		{
				move_uploaded_file($file_tmp, 'images/'.$file_name);

				//mysql_query for inserting of the events
				$insert_events = $eventDb->query("INSERT INTO events (id_event, Event_Name, Event_Cover, phone, date_happ, user_id) VALUES('','$names','$images_cover','$phone','$date','$user_id')");
				 $event_last_id =mysqli_insert_id($insert_events);

				for($i = 0; $i < count($pro1); $i++)
				{
					// mysql_query for inserting of the pricing 
					$insert_pricing = $eventDb->query("INSERT INTO pricing (pricing_id, price, event_property, event_seats)
					 			VALUES('','$pric1[$i]','$pro1[$i]','$seat1[$i]')")	or die("error please in pricing insert".mysqli_error());

					 $pricing_last_id =mysqli_insert_id($insert_pricing);

					$eventDb->query("INSERT INTO eventing_pricing (event_code, pricing_code) VALUES($event_last_id,$pricing_last_id)") or die("error please".mysqli_error());
				} 


		header('location:events.php');
		}	
		else
		{
			foreach ($error as $errors) 
			{
				echo $errors ."<br>";
			}
		}
?>