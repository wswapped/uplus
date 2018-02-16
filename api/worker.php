<?php

$worker = new GearmanWorker();
$worker->addServer('localhost');
$worker->addFunction('reverse', 'doReverse');

while($worker->work());

function doReverse($job)
{
	return strrev($job->workload());
}
?>
