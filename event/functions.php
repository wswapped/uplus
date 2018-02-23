<?php
function get_event($event){
	//returns details of event
	global $eventDb;
	$query = $eventDb->query("SELECT * FROM events WHERE id_event = \"$event\" ") or die("Can't get event $eventDb->error");
	return $query->fetch_assoc();
}
?>