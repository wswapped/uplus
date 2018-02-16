<?php
// Reverse Worker Code
$worker = new GearmanWorker();
$worker->addServer();
$worker->addFunction("reverse", function ($job) {
  return strrev($job->workload());
});
while ($worker->work());