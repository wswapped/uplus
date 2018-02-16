<?php 
$client = new GearmanClient();
$client->addServer();

echo $client->do('reverse', 'Hello Clement!');

?>