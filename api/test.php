<?php
$url = 'https://uplus.rw/api/';
$data = array(
   "action"       =>'c2b',
   "partnerId"    =>'1',
   "amount"       =>'100',
   "pushNumber"   =>'0784848236',
   "pushBank"     =>'1',
);

$options = array(
   'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
   )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) 
{ 
   echo "Network error";
}
else
{
   vardump($result);       
}
?>