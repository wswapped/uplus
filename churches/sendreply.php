
<?php
    include("style.php");
    session_start();
    $userId ='';
    include 'db.php';
    if (isset($_SESSION['loginusername'])) {
        $loginusername = $_SESSION['loginusername'];
        $loginpassword = $_SESSION['loginpassword'];
        $selectid = $db ->query("SELECT * FROM users WHERE loginName='$loginusername' AND loginpsw='$loginpassword'");
        $fetchid = mysqli_fetch_array($selectid);
        $userId = $fetchid['Id'];
    }
    elseif (!isset($_SESSION['loginusername'])) {
        header("location: login.php");
    }
?>
<?php 
    if (isset($_POST['Msg'])) {
        $Msg = $_POST['Msg'];
        $Sender = $_POST['Sender'];
        include 'db.php';
        $reply = $db ->query("INSERT INTO reply(Body,ReplyId,ReplyedID,_Time,Type) VALUES('$Msg', '$userId', '$Sender', now(), 'App')");
        echo '
        ';
    }
?>