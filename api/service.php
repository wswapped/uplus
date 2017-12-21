<?php 
include 'db.php';
if (isset($_GET['contributions'])) 
{
	$sql = $outCon->query("SELECT id FROM grouptransactions WHERE status = 'Pending'") or die(mysql_error($outCon));
	echo"<ul>";
	$n=0;
	while($peniding = mysqli_fetch_array($sql))
	{
		$n++;
		$tobeup = $peniding['id'];
		$url = 'https://uplus.rw/api/';
						
		$data = array();
		
		$data["action"] 				= "checkcontributionstatus";
		$data["transactionId"] 			= $tobeup;

	    $options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result == false) 
		{ 
			echo 'There was a system error, of:'.$tobeup;
		}
		else
		{
			$result = json_decode($result);	
			var_dump($result);
			$status = $result[0]->{'status'};
			$transactionId = $result[0]->{'transactionId'};
			echo "<li>".$n." ".$status." of: ".$transactionId."</li>";		
		}
	}
	echo "</ul>";
}
elseif (isset($_GET['directtransfers'])) 
{
	$sql = $outCon->query("SELECT id FROM directtransfers WHERE status = 'Pending'") or die(mysql_error($outCon));
	echo"<ul>";
	$n=0;
	while($peniding = mysqli_fetch_array($sql))
	{
		$n++;
		$tobeup = $peniding['id'];
		$url = 'https://uplus.rw/api/';
						
		$data = array();
		
		$data["action"] 				= "checktransferstatus";
		$data["transactionId"] 			= $tobeup;

	    $options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result == false) 
		{ 
			echo 'There was a system error, of:'.$tobeup;
		}
		else
		{
			$result = json_decode($result);	
			$status = $result[0]->{'status'};
			$transactionId = $result[0]->{'transactionId'};
			echo "<li>".$n." ".$status." of: ".$transactionId."</li>";			
		}
	}
	echo "</ul>";
}
?>