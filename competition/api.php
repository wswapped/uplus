<?php
	include_once "../db.php";
	$request = $_POST;

	$action = $request['action']??"";
	$competion_start = "2018-03-01 00:00:00";
	$response = array();
	if($action ==  'get_groups'){
		$sql = "SELECT groups.groupName as name, groups.createdDate as createdDate, COUNT(adminId) as num FROM groups JOIN groupuser ON groupuser.groupId = groups.id WHERE groups.createdDate >= \"$competion_start\" GROUP BY groups.id ORDER BY num DESC";
		// echo $sql;
		$query = $db->query($sql);
		if($query){
			$groups = array();

			while($data = $query->fetch_assoc()){
				$groups[] = $data;
			};

			$response = $groups;			

		}else{
			$response = array('status'=>false, 'msg'=>$db->error);
		}
	}else if ($action == 'get_contributions'){
		//returns top contributing groups in time
		$sql = "SELECT COUNT(*) AS num, SUM(t.amount) as amount, g.groupName as group FROM rtgs.grouptransactions t JOIN uplus.groups g ON t.groupId = g.id WHERE t.status = 'Successfull' ";
		$sql = "SELECT COUNT(*) AS num, SUM(t.amount) as amount, g.groupName as name FROM rtgs.grouptransactions t JOIN uplus.groups g ON t.groupId = g.id WHERE t.status = 'Successfull' AND g.createdDate >= \"$competion_start\" GROUP BY g.id ORDER BY num DESC, t.transaction_date ASC LIMIT 10 ";
		// echo $sql;
		$query = $outCon->query($sql);
		if($query){
			$contr = array();
			while ($data = $query->fetch_assoc()) {
				$contr[] = $data;
			}
			$response = array('status'=>true, 'data'=>$contr);
		}else{
			$response = array('status'=>false, 'msg'=>$outCon->error);
		}
	}
	echo json_encode($response);
?>
