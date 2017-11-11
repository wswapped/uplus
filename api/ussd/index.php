<?php
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];


if ( $text == "" ) {

  //USER DATA
  require('../db.php');
    //CLEAN PHONE
    $phoneNumber  = preg_replace( '/[^0-9]/', '', $phoneNumber );
    $phoneNumber  = substr($phoneNumber, -10); 
    $sql  = $db->query("SELECT * FROM users WHERE phone = '$phoneNumber' LIMIT 1");
  if($db){
    $userData = mysqli_fetch_array($sql);
    $userName = $userData['name'];
    $userId = $userData['id'];
  $response  = "CON Murakazaneza Kukimina Cya Uplus ".$userName." \n";
    $n = 0;
    $sqlgroups  = $db->query("SELECT groupName FROM members WHERE memberId = '$userId' LIMIT 1");
    WHILE($group  = mysqli_fetch_array($sqlgroups))
    {
      $n++;
      $response .= $n.". ".$group['groupName']." \n";
    }
     // This is the first request. Note how we start the response with CON
    
     $response .= "00. Sohoka";
   }
}
else if ( $text == "1" ) {
  // Business logic for first level response
  $response = "CON Ibimina Urimo \n";
  $response .= "1. Ubumwe \n";
  $response .= "2. Umurava \n";
  $response .= "3. Subira Inyuma";
  
 }
 else if($text == "2") {
  // Business logic for first level response
  // This is a terminal request. Note how we start the response with END
  $response = "CON Shiramo code yikimina";
 }
 else if($text == "1*1") {
  // This is a second level response where the user selected 1 in the first instance
  $response   = "CON Ikimina Ubumwe \n";
  $response  .= "1. Tanga Umusanzu \n";
  $response  .= "2. Saba Inguzanyo \n";
  $response  .= "3. Ishyura Inguzanyo \n";
  $response  .= "4. Konti Yawe ";
  // This is a terminal request. Note how we start the response with END
 }
    
 else if ( $text == "1*2" ) {
  
     // This is a second level response where the user selected 1 in the first instance
     $balance  = "RWF 10,000";
     // This is a terminal request. Note how we start the response with END
     $response = "CON END Your balance is $balance";
}
else if ( $text == "1*1*1" ) {
  // This is a second level response where the user selected 1 in the first instance
  $accountNumber  = "CON 1. Tanga Umusanzu \n";
  $accountNumber  = "2. Saba Inguzanyo \n";
  $accountNumber  = "3. Ishyura Inguzanyo \n";
  $accountNumber  = "4. Konti Yawe ";
  // This is a terminal request. Note how we start the response with END
  $response = "END Your account number is $accountNumber";
 }
else if ( $text == "1*1*4" ) {
  // This is a second level response where the user selected 1 in the first instance
  $accountNumber  = "CON Nashoye: \n";
  $accountNumber  .= "Inguzanyo: \n";
  $accountNumber  .= "1. Ubone Ubutumwa burambuye bwa konti yawe, nb: urishyura 10Rwf ya SMS ";
  // This is a terminal request. Note how we start the response with END
  $response = "END Your account number is $accountNumber";
 }
// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
// DONE!!!
?>
