<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") 
{
	$_POST['action']();
}
else
{
	echo 'UPLUS API V01';
}
function listGroups()
{
	include("../db.php");
	$sqlgroups = $db->query("SELECT * FROM groups WHERE archive is null ORDER BY id DESC");
	$groups = array();
	WHILE($group = mysqli_fetch_array($sqlgroups))
	{
		$groups[] = array(
		   "groupId"        => $group['id'],
		   "adminId"        => $group['adminId'],
		   "groupName"      => $group['groupName'],
		   "groupDesc"      => $group['groupDesc'],
		   "groupStory"     => $group['groupStory'],
		   "targetAmount"   => $group['targetAmount'],
		   "perPerson"      => $group['perPerson'],
		   "expirationDate" => $group['expirationDate'],
		   "likes"          => $group['likes'],
		   "groupImage"     => 'http://www.uplus.rw/temp/group'.$group['id'].'.jpeg'

		);

	}

	foreach ($groups as $i => $group) {
	$gAdminId = $groups[$i]['adminId'];
		$users = array();
		$sqlusers = $db->query("SELECT * FROM users WHERE id = '$gAdminId'");
		WHILE($user = mysqli_fetch_array($sqlusers))
		{
			$users[] = array(
				"adminName" => $user['name'],
				"adminPhone" => $user['phone']
				 );
		}
		$groups[$i]['groupAdmin'] = $users;
	}
	unset($groups[$i]['adminId']);

	header('Content-Type: application/json');

	$groups = json_encode($groups);

	echo '{ "groups" : '.$groups.' }';
}

function createGroup()
{
	require('../db.php');
	$groupName			= $_POST['groupName'];
	$groupTargetType	= $_POST['groupTargetType'];
	$targetAmount		= $_POST['targetAmount'];
	$perPersonType		= $_POST['perPersonType'];
	$perPerson			= $_POST['perPerson'];
	$adminId			= $_POST['adminId'];
	$adminPhone			= $_POST['adminPhone'];
	$accountNumber		= $_POST['accountNumber'];
	$bankId				= $_POST['bankId'];
	
	$db->query("INSERT INTO groups
		(groupName, adminId, adminPhone, 
		 targetAmount, perPerson, createdDate,
		 createdBy, state, groupTargetType, perPersonType)
		VALUES('$groupName',$adminId,'$adminPhone',
			$targetAmount,'$perPerson',now(),
			'$adminId','private','$groupTargetType','$perPersonType')") or die (mysqli_error());
	
	if($db)
	{
		$sqlid = $db->query("SELECT id FROM groups ORDER BY id DESC LIMIT 1") or die (mysqli_error());
		$rowid = mysqli_fetch_array($sqlid);
		$lastid = $rowid['id'];
		$outCon->query("INSERT INTO `groups`(`groupId`, `accountNumber`, `bankId`)
		VALUES('$lastid','$accountNumber','$bankId')")or die(mysqli_error());
		
		if($outCon)
		{
			$db->query("INSERT INTO groupuser
			(`joined`, `groupId`, `userId`,`createdBy`, `createdDate`)
			VALUES('yes','$lastid','$adminId','$adminId', now())")or die(mysqli_error());
			if($db)
			{
				listGroups();
			}
			else
			{
				echo 'The user not joined';
			}
		}
		else
		{
			echo 'money part not created';
		}
	}
	else
	{
		'group not added';
	}
}

function modifyGroup()
{
	require('../db.php');
	$groupName			= $_POST['groupName'];
	$groupTargetType	= $_POST['groupTargetType'];
	$targetAmount		= $_POST['targetAmount'];
	$perPersonType		= $_POST['perPersonType'];
	$perPerson			= $_POST['perPerson'];
	$adminId			= $_POST['adminId'];
	$adminPhone			= $_POST['adminPhone'];
	$accountNumber		= $_POST['accountNumber'];
	$bankId				= $_POST['bankId'];
	$groupId			= $_POST['groupId'];
	$state				= $_POST['state'];
	
	$db->query("UPDATE groups SET 
		groupName ='$groupName', adminId=$adminId, adminPhone='$adminPhone', 
		targetAmount=$targetAmount, perPerson='$perPerson', updatedDate= now(),
		updatedBy='$adminId', groupTargetType='$groupTargetType', perPersonType='$perPersonType'
		, state='$state' WHERE id= '$groupId'
		") or die (mysqli_error());
	
	if($db)
	{
		
		$outCon->query("UPDATE groups SET 
		 accountNumber='$accountNumber', bankId='$bankId'
		WHERE groupId = '$groupId'
		")or die(mysqli_error());
		
		if($outCon)
		{ 
			listGroups();
		}
		else
		{
			echo 'money part not UPDATED';
		}
	}
	else
	{
		'group not UPDATED';
	}
}

function deleteGroup()
{
	require('../db.php');
	$groupId			= $_POST['groupId'];
	$adminId			= $_POST['adminId'];
	$db->query("UPDATE groups SET 
		archive ='yes'
		WHERE id='$groupId' AND adminId=$adminId
	") or die (mysqli_error());
	
	if($db)
	{
		listGroups();
	}
	else
	{
		'you cant delete this group';
	}
		
	
}
?>