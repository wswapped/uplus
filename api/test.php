<?php 
$time = time();
$code = rand(1,1000);
$newCode = $time."".$code;
echo "time: ".$time."<br>";
echo "code: ".$code."<br>";
echo "newCode: ".$newCode."<br>";
echo md5($time)."<br>";
echo md5("1".$time)."<br>";
echo $str = md5($newCode)."<br>";
function String2Stars($string='',$first=0,$last=0,$rep='8'){
  $begin  = substr($string,0,$first);
  $stars  = $begin;
  return $stars;
}
echo "Best Code: ".$str2 = String2Stars($str, 4, -4);
?>