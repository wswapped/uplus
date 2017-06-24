<?php 
ob_start();
if(isset($_POST['profileName']))
{
	echo $profileName = $_POST['profileName'];
	 $profileEmail = $_POST['profileEmail'];
	//echo $profilePhone = $_POST['profilePhone'];
	 $profileId = $_POST['profileId'];
	 $profileGender = $_POST['profileGender'];
	 $profileProfession = $_POST['profileProfession'];
	 echo '<br>'.$profileBio = $_POST['profileBio'];
	
	if ($_FILES['fileField']['tmp_name'] != "") {																	 										 
	$newname = ''.$profileId.'.jpg';
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../proimg/$newname");
	}
	
	include "../db.php";
	$sql = $db->query("
	UPDATE users SET
	gender='$profileGender', name='$profileName',
	email='$profileEmail', profession='$profileProfession', bio='$profileBio'
	WHERE id = 	'$profileId'
	")or die (mysqli_error());
	header("location: ../home");exit();}
	ob_end_flush();?>