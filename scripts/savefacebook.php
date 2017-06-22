
<?php
if (isset($_GET['fbId'])){
	$email 	= $_GET['email'];
	$rdpartyId 	= $_GET['fbId'];
	$savename 	= $_GET['savename'];
	$gender 	= $_GET['gender'];
	$picture 	= $_GET['picture'];
	$fundPhone 	= $rdpartyId;
	
	
	
	
	include("../db.php");
	$sqllastUser = $db->query("SELECT * FROM users WHERE 3rdpartyId = '$rdpartyId'");
	
	$countExist = mysqli_num_rows($sqllastUser);
	if(!$countExist > 0)
	{
		$sql = $db->query("INSERT INTO users
		(3rdpartyId, gender, phone, active, createdDate, last_visit,
		name, password, visits, email)
		VALUES
		('$rdpartyId', '$gender', '$fundPhone', '1', now(), now(),
		'$savename', '1234', '1', '$email')
		") or die (mysqli_error());
		//echo 'it was not in';
		$sqllastUser = $db->query("SELECT * FROM users ORDER BY id DESC limit 1");
		$rowUserLast = mysqli_fetch_array($sqllastUser);
			
		$phoneuser = $rowUserLast['phone'];
		$passworduser = $rowUserLast['password'];
		$iduser = $rowUserLast['id'];
		$lastvisit = $rowUserLast['visits'];
			 
		session_start();
		$_SESSION["id"] = $iduser;
		$_SESSION["phone1"] = $phoneuser;
		$_SESSION["password"] = $passworduser;
		$newvisit = $lastvisit + 1;
		$sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now(), active =1 WHERE id = $iduser")or die (mysqli_error());
		
		$contents	= file_get_contents($picture);
		$save_path="../proimg/".$iduser.".jpg";
		file_put_contents($save_path,$contents);
	}	
	else
	{
		$rowUserLast = mysqli_fetch_array($sqllastUser);
		$phoneuser = $rowUserLast['phone'];
		$passworduser = $rowUserLast['password'];
		$iduser = $rowUserLast['id'];
		$lastvisit = $rowUserLast['visits'];
		 
		session_start();
		$_SESSION["id"] = $iduser;
		$_SESSION["phone1"] = $phoneuser;
		$_SESSION["password"] = $passworduser;
		$newvisit = $lastvisit + 1;
		$sqlUpdateVisitation = $db->query("UPDATE users SET visits = $newvisit, last_visit=now(), active =1 WHERE id = $iduser")or die (mysqli_error());
	}
}
?>
loged in
