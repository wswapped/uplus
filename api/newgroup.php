<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"]=="POST") {
	createGroup();
}


function createGroup()
{
	require('../db.php');
	$groupName			$_POST['groupName'];
	$groupTargetType	$_POST['groupTargetType'];
	$targetAmount		$_POST['targetAmount'];
	$perPersonType		$_POST['perPersonType'];
	$perPerson			$_POST['perPerson'];
	$state				$_POST['state'];
	$adminId			$_POST['adminId'];
	$adminPhone			$_POST['adminPhone'];
	$accountNumber		$_POST['accountNumber'];
	$bankId				$_POST['bankId'];
					


INSERT INTO groups
		(groupName, adminId, adminPhone, 
		 targetAmount, perPerson, createdDate, createdBy, state,
		 groupTargetType, perPersonType)
		 VALUES
INSERT INTO `groups`(`groupId`, `accountNumber`, `bankId`) 
		
		 
INSERT INTO groupuser
		(`joined`, `groupId`, `userId`,`createdBy`, `createdDate`)