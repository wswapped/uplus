<?php
function get_event($event){
	//returns details of event
	global $eventDb;
	$query = $eventDb->query("SELECT * FROM events WHERE id_event = \"$event\" ") or die("Can't get event $eventDb->error");
	$eventData =  $query->fetch_assoc();
	if($eventData)
	{
		//getting tickets
		// $tic = $eventDb->query("SELECT * FROM ticket WHERE event = \"$event\" ");
		// $eventData['tickets'] = array();
		// while ($ticket = $tic->fetch_assoc()) {
		// 	# code...
		// 	$eventData['tickets'][] = $ticket;
		// }

		$tic = $eventDb->query("SELECT * FROM pricing JOIN eventing_pricing ON pricing.pricing_id =  eventing_pricing.pricing_code WHERE event_code = \"$event\" ");
		$eventData['tickets'] = array();
		// $eventData['tickets']['number'] = $eventData['tickets']['price'] = 0;
		while ($ticket = $tic->fetch_assoc()) {
			//Adding event details
			// $eventData['tickets']['number']+=$ticket['event_seats'];
			// $eventData['tickets']['price']+=$ticket['price'];

			$eventData['tickets'][] = $ticket;
		}

		//Organizer
		$org_id = $eventData['Event_organizer'];
		$org = $eventDb->query("SELECT * FROM event_organizer WHERE id = $org_id ") or die("Can't get organizer $eventDb->error");
		$eventData['organizer'] = $org->fetch_assoc();

	}
	$eventData['agents'] = get_agents($event);
	return $eventData;
}
function get_agents($eventId){
	//returns the agents of the event
	require "db.php";
	// global $eventDb, $db;
	$sqlAgents = $eventDb->query("SELECT `agentName`, sum(`givenTickets`) givenTickets FROM `ticketsview` WHERE eventId =  '$eventId' GROUP BY `agentId` ") or die(mysqli_error($eventDb));
		$ticketsPerAgent 	= array();
		$NumOfAgents 		= mysqli_num_rows($sqlAgents);
		$n=0;
		while($agent = mysqli_fetch_array($sqlAgents))
		{
			   
			$ticketsPerAgent[] = array(
			   "agentName"		=> $agent['agentName'],
			   "givenTickets"	=> $agent['givenTickets']
			);
		}
		return $ticketsPerAgent;
}

?>