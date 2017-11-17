<?php
if (isset($_GET['datapage'])) 
{
    $_GET['datapage']();
}

function transactions()
{
	#Basic Line
	require 'db.php';

	$result = $con->query(" SELECT COUNT( id ) AS JUMLAH,DATE(transaction_date) BULAN
		FROM directtransfers 
	    WHERE (`id` % 2) = 1
	    AND transaction_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
	    group by DATE(transaction_date)");


	$bln = array();
	$bln['name'] = 'Dates';
	$rows['name'] = 'Transfers';
	while ($r = mysqli_fetch_array($result)) {
	    $bln['data'][] = strftime("%d %b", strtotime($r['BULAN']));
	    $rows['data'][] = $r['JUMLAH'];
	}
	$rslt = array();
	array_push($rslt, $bln);
	array_push($rslt, $rows);
	print json_encode($rslt, JSON_NUMERIC_CHECK);
}
function users()
{
	#Basic Line
	require 'db.php';

	$result = $db->query(" SELECT COUNT( id ) AS JUMLAH,DATE(createdDate) BULAN
		FROM users 
	    WHERE (`id` % 2) = 1
	    AND createdDate BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
	    group by DATE(createdDate)");


	$bln = array();
	$bln['name'] = 'Dates';
	$rows['name'] = 'Transfers';
	while ($r = mysqli_fetch_array($result)) {
	    $bln['data'][] = strftime("%d %b", strtotime($r['BULAN']));
	    $rows['data'][] = $r['JUMLAH'];
	}
	$rslt = array();
	array_push($rslt, $bln);
	array_push($rslt, $rows);
	print json_encode($rslt, JSON_NUMERIC_CHECK);
}
function groups()
{
	#Basic Line
	require 'db.php';

	$result = $db->query(" SELECT COUNT( id ) AS JUMLAH,DATE(createdDate) BULAN
		FROM groups 
	    WHERE (`id` % 2) = 1
	    AND createdDate BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
	    group by DATE(createdDate)");


	$bln = array();
	$bln['name'] = 'Dates';
	$rows['name'] = 'Transfers';
	while ($r = mysqli_fetch_array($result)) {
	    $bln['data'][] = strftime("%d %b", strtotime($r['BULAN']));
	    $rows['data'][] = $r['JUMLAH'];
	}
	$rslt = array();
	array_push($rslt, $bln);
	array_push($rslt, $rows);
	print json_encode($rslt, JSON_NUMERIC_CHECK);
}
function money()
{
	#Basic Line
	require 'db.php';

	$result = $con->query(" SELECT COUNT( id ) AS JUMLAH,DATE(transaction_date) BULAN
		FROM directtransfers 
	    WHERE (`id` % 2) = 1
	    AND transaction_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
	    group by DATE(transaction_date)");


	$bln = array();
	$bln['name'] = 'Dates';
	$rows['name'] = 'Transfers';
	while ($r = mysqli_fetch_array($result)) {
	    $bln['data'][] = strftime("%d %b", strtotime($r['BULAN']));
	    $rows['data'][] = $r['JUMLAH'];
	}
	$rslt = array();
	array_push($rslt, $bln);
	array_push($rslt, $rows);
	print json_encode($rslt, JSON_NUMERIC_CHECK);
}
?>

