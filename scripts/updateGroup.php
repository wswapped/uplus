<?php
error_reporting(E_ALL);
    ini_set('display_errors', 0);
include "../db.php";
	
if (isset($_GET['groupName']))
{	
	$groupName 	= mysqli_real_escape_string($db, $_GET['groupName']);
	$groupStory = mysqli_real_escape_string($db, $_GET['groupStory']);
	$groupDesc 	= mysqli_real_escape_string($db, $_GET['groupDesc']);
	$groupID 	= mysqli_real_escape_string($db, $_GET['groupID']);
	$sql = $db->query("UPDATE groups 
		SET groupName='$groupName', groupStory = '$groupStory', groupDesc = '$groupDesc' WHERE id = '$groupID'"); 
	 echo $groupName.' is up to date <a href="editCont'.$groupID.'">Click Here!</a>';
}
if (isset($_GET['state'])){
	$state = $_GET['state'];
	$groupId = $_GET['groupId'];
	$sql = $db->query("UPDATE groups SET state='$state' WHERE id = '$groupId'");
}
if (isset($_GET['expirationDate'])){
	$expirationDate = $_GET['expirationDate'];
	$groupId = $_GET['groupId'];
	$sql = $db->query("UPDATE groups SET expirationDate='$expirationDate' WHERE id = '$groupId'");
}
if (isset($_GET['targetAmount'])){
	$targetAmount = $_GET['targetAmount'];
	$groupId = $_GET['groupId'];
	$sql = $db->query("UPDATE groups SET targetAmount='$targetAmount' WHERE id = '$groupId'");
}
if (isset($_GET['accountNumberStand'])){
	$accountNumberStand = $_GET['accountNumberStand'];
	$bankIdstand 		= $_GET['bankIdstand'];
	$groupId = $_GET['groupId'];
	$sql = $outCon->query("SELECT * FROM groups WHERE groupId = $groupId");
	$countGroups = mysqli_num_rows($sql);
	if($countGroups > 0)
	{
		$sql = $outCon->query("UPDATE groups SET accountNumber='$accountNumberStand', bankId='$bankIdstand' WHERE groupId = '$groupId'");
	}
	else
	{
		$sql = $outCon->query("INSERT INTO `groups`(`groupId`, `accountNumber`, `bankId`)
		VALUES ('$groupId','$accountNumberStand','$bankIdstand')");
	}
	
		$sqlgAccount = $outCon->query("SELECT g.accountNumber, b.name bank, b.id bankId  FROM `groups` g INNER JOIN banks b ON b.id = g.bankId WHERE g.`groupId` = '$groupId'");
		$rowgAcc = mysqli_fetch_array($sqlgAccount);
		$bankaccount = $rowgAcc['accountNumber'];		
		$bank = $rowgAcc['bank'];
		
		$bankingId = $rowgAcc['bankId'];	
		$bankslist="";
		$sqlListBanks = $outCon->query("SELECT * FROM banks");
		while($rowBanks = mysqli_fetch_array($sqlListBanks))
		{
			$bankslist.='<option value="'.$rowBanks['id'].'">'.$rowBanks['name'].'</option>';
		}
	?>
	
	<div class="col-md-12">
	WITHDRAW ACCOUNT: <a href="javascript:void()" onclick="anableChangeAccountBack()"><i class="fa fa-wrench"></i> Change </a>
	<br/>
	</div>
	<div class="col-md-6">
		<input class="form-control" disabled value="<?php echo $bankaccount;?>">
	</div>
	<div class="col-md-6">
		<select class="form-control" disabled><option><?php echo $bank;?></option></select>
	</div>
	
<?php
}
if (isset($_POST['newupdate'])){
	$newupdate = $_POST['newupdate'];
	$groupId = $_POST['groupId'];
	$adminId = $_POST['adminId'];
	include "../db.php"; 
	$sql = $db->query("INSERT INTO updatestransaction(body, picture, video, groupId, byId) 
	VALUES ('$newupdate', 'no', 'no', '$groupId','$adminId')")or die (mysqli_error());
	header('location: ../editCont'.$groupId);
}
?>
<script>
function anableChangeAccountBack()
{
	document.getElementById('anableDisableAccount').innerHTML = '<div class="col-md-12">'
		+'Make this your withdraw account for this group: <a href="javascript:void()" onclick="changeWithdrawAccount()"><i class="fa fa-save"></i> SAVE </a>'
		+'</div>'
		+'<div class="col-md-6">'
			+'<input id="accountNumberStand" class="form-control" value="<?php echo $bankaccount;?>">'
		+'</div>'
		+'<div class="col-md-6">'
			+'<select id="bankIdstand" class="form-control" ><option value="<?php echo $bankingId;?>"><?php echo $bank;?></option><?php echo $bankslist;?></select>'
		+'</div>';
}
</script>