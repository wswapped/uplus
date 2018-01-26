<?php
session_start();
unset($_SESSION['loginusername']);
unset($_SESSION['loginpassword']);
header("location: login.php");

?>
