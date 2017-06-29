<?php
require_once('sms/AfricasTalkingGateway.php');
$username   = "cmuhirwa";
$apikey     = "7ffaed2780ff7d179d4ebe07ecabc8ba857dd04ab0c1cc406be7ca2596d3824a";
$recipients = "+250784848236";
$message    = "I'm a Clement and its ok, I sleep all night and I work all day";
$from = "uplus";

     
$gateway    = new AfricasTalkingGateway($username, $apikey);
try 
{ 
  $results = $gateway->sendMessage($recipients, $message, $from);

  foreach($results as $result) {
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}