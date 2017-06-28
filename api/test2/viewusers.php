<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		div.refresh{
			margin-top: 10px;
			width: 5%;
			margin-left: auto;
			margin-right: auto;
		}
		div#norecord{
			margin-top: 10px;
			width: 15%;
			margin-left: auto;
			margin-right: auto;
		}
	</style>
	<script type="text/javascript">
		function refreshPage(){
			location.reload();
		}
	</script>
</head>
<body>
<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

	include_once 'db_functions.php';
	$db = new DB_Functions();
	$users = $db->getAllUsers();
	if($users != false)
		$no_of_users = mysqli_num_rows($users);
	else
		$no_of_users = 0;
?>
<?php
 if($no_of_users > 0){
 	?>
 <table>
	<tr>
		<td>Username</td>
	</tr>
	<?php
		while($row = mysqli_fetch_array($users)){
			?>
	<tr>
		<td><?php echo $row["Id"];?></td>
		<td><?php echo $row["Name"];?></td>
	</tr>
	<?php } ?>
 </table>
 <?php }
 else{ ?>
 	<div class="norecord"> 
 	No records in MySQL DB
 	</div>
 <?php } ?>
 	<div class="refresh">
 	<button onclick="refreshPage()">Refresh</button>
 	</div>
</body>
</html>