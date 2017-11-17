<?php

#Basic Line
require 'db.php';

$result = $con->query("SELECT COUNT( * ) AS JUMLAH,DATE(transaction_date) td BULAN
	FROM directtransfers WHERE (`id` % 2) = 1
	group by DATE(transaction_date) ");


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

?>

