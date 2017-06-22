<?php

#Basic Line
require '../db.php';

	$result = $outCon->query("SELECT COUNT( * ) AS JUMLAH,transaction_date BULAN
	FROM transactions
	group by transaction_date");


$bln = array();
$bln['name'] = 'Bulan';
$rows['name'] = 'Biders';
while ($r = mysqli_fetch_array($result)) {
    $bln['data'][] = $r['BULAN'];
    $rows['data'][] = $r['JUMLAH'];
}
$rslt = array();
array_push($rslt, $bln);
array_push($rslt, $rows);
print json_encode($rslt, JSON_NUMERIC_CHECK);



