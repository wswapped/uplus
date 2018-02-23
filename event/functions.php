<?php
function get_event($event){
	//returns details of event
	global $eventDb;
	$query = $eventDb->query("SELECT * FROM events WHERE id_event = \"$event\" ") or die("Can't get event $eventDb->error");
	$eventData =  $query->fetch_assoc();
	if($eventData)
	{
		//getting tickets
		$tic = $eventDb->query("SELECT * FROM ticket WHERE event = \"$event\" ");
		$eventData['tickets'] = array();
		while ($ticket = $tic->fetch_assoc()) {
			# code...
			$eventData['tickets'][] = $ticket;
		}
	}
	return $eventData;
}
?>