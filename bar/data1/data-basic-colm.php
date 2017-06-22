<?php

#Basic Line
require '../../conn/connection.php';

$result = $con->query("SELECT COUNT( * ) AS JUMLAH, qty, doneOn BULAN
FROM bids
group by doneOn");


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

mysql_close($con);


