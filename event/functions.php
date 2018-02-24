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
	$eventData['agents'] = get_agents($event);
	return $eventData;
}
function get_agents($event){
	//returns the agents of the event
	global $eventDb, $db;
	$agents = array();

	//get event agents
	$query = $eventDb->query("SELECT * FROM agent_tickets JOIN event_agents ON agent_tickets.agent = event_agents.id WHERE event_agents.event = \"$event\" ") or die("Error with agents retrieval $eventDb->error");
	while ($data = $query->fetch_assoc()) {
		//getting details on user table
		$userid = $data['agent'];
		$userq = $db->query("SELECT name as agentName, phone as agentPhone FROM users WHERE id = \"$userid\" LIMIT 1 ") or die("Error with the userss $db->error");
		$user_data = $userq->fetch_assoc();

		$agents[] = array_merge($data, $user_data);		
	}
	return $agents;
}
?>