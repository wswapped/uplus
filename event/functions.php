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
function addAgent($user, $event, $tickets){
	//Adding event agent
	global $eventDb, $db;

	//checking if the agent exists
	$check = $eventDb->query("SELECT * FROM event_agents as agent WHERE agent.event = \"$event\" ") or die("Error checking agent $eventDb->error");

	if(!$chech->num_rows){
		$query = $eventDb->query("INSERT INTO event_agent(user, event) VALUES(\"$user\", \"$event\") ") or die("Cant insert $eventDb->error");
		$agentId = $eventDb->insert_id;
	}else{
		//getting agent id
		$agent = $check->fetch_assoc();
		$agentId = $agent['id'];
	}

	
}
?>