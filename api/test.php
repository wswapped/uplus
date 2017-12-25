<?php
$timezone = date_default_timezone_get();
date_default_timezone_set($timezone);
$date = date('Y-m-d h:i:s', time());
echo "The current server timezone is: " .$date  ;

?>
