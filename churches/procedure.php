
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
include("style.php");
if (isset($_POST['msgId'])) {
$msgId = $_POST['msgId'];
include("db.php");
$updatestatus = $db ->query("UPDATE request SET Status = 'read' WHERE Id = '$msgId'");
$selectmsg = $db -> query("SELECT * FROM request WHERE Id = '$msgId'");
while ($row = mysqli_fetch_array($selectmsg)) {
    $SenderID = $row['SenderID'];
    $selectSenderID = $db -> query("SELECT * FROM members WHERE id = '$SenderID'");
    $senderInfo = mysqli_fetch_array($selectSenderID);
    $senderName = $senderInfo['name'];
	$selectreply = $db -> query("SELECT * FROM reply WHERE ReplyedID = '$SenderID'");
	echo '
        <div class="md-card">
            <div class="sender-info">
                <b style="color: #00897b;">'.$senderName.'</b>
                <input type="hidden" value="'.$SenderID.'" id="msgSender">
            </div>
            <div class="request">
                <p>'.$row['Msg'].'</p>
            </div> 
        </div>
	';
	while ($reply = mysqli_fetch_array($selectreply)) {
        echo'
        <div class="md-card">
            <div class="reply">
                <b style="color: #00897b;">App</b><br>
            	<p>'.$reply['Body'].'</p>
            </div>
        </div>';
	}
}
echo'
	<div class="md-input-wrapper">
		<input type="text" id="Msg" class="md-input" placeholder="Reply here...."/>
    </div>
	<span class="md-input-bar "><input type="submit" class="md-btn uk-position-small uk-position-bottom-right" style="background-color:#00897b;" value="send" id="send"></span>';
}
if (isset($_POST['action'])){
	$_POST['action']();
}

function unread()
{ 
	//sleep(1);
    include("db.php");
    $selectRequest = $db -> query("SELECT * FROM request WHERE Status = 'unread' ORDER BY Id DESC");
    $numRequest = mysqli_num_rows($selectRequest);
    if (!$numRequest == 0) 
    {
    	while ($row = mysqli_fetch_array($selectRequest)) 
    	{
            $SenderID = $row['SenderID'];
            $selectSenderID = $db -> query("SELECT * FROM members WHERE id = '$SenderID'");
            $senderInfo = mysqli_fetch_array($selectSenderID);
            $senderName = $senderInfo['name'];
         	echo'
                <div class="md-card-content" onclick="getSms(smsid='.$row['Id'].')">
                    <div class="sms">
                        <input type="hidden" value="'.$row['Id'].'" id="msgId">
                        <input type="hidden" value="'.$row['SenderID'].'" id="SenderID">
                        <div class="sender">'.$senderName.'<span class="time">few second ago</span></div>
                        <div class="msg">'.$row['Msg'].'</div>
                    </div>
	                <i id="response"></i>
                </div>
            ';
       	}
	}
}

function read()
{
	include("db.php");
	$selectRequest = $db -> query("SELECT * FROM request WHERE Status = 'read' ORDER BY Id DESC");
	$numRequest = mysqli_num_rows($selectRequest);
	if (!$numRequest == 0) 
	{
		while ($row = mysqli_fetch_array($selectRequest))
		{
        $SenderID = $row['SenderID'];
        $selectSenderID = $db -> query("SELECT * FROM members WHERE id = '$SenderID'");
        $senderInfo = mysqli_fetch_array($selectSenderID);
        $senderName = $senderInfo['name'];
	    echo'
            <div class="md-card-content"  style="background-color: #f1f7f6;" onclick="getSms(smsid='.$row['Id'].')">
                  <div class="sms">
                        <input type="hidden" value="'.$row['Id'].'" id="msgId">
                        <input type="hidden" value="'.$row['SenderID'].'" id="SenderID">
                        <div class="sender">'.$senderName.'<span class="time">few second ago</span></div>
                        <div class="msg">'.$row['Msg'].'</div>
                    </div>
                <i id="response"></i>
            </div>
        ';
	   
		}
	}
}

function all()
{ 
	include("db.php");
	$selectRequest = $db -> query("SELECT * FROM request ORDER BY Id DESC");
	$numRequest = mysqli_num_rows($selectRequest);
	if (!$numRequest == 0) 
	{
		while ($row = mysqli_fetch_array($selectRequest)) 
		{
	        $SenderID = $row['SenderID'];
	        $selectSenderID = $db -> query("SELECT * FROM members WHERE id = '$SenderID'");
	        $senderInfo = mysqli_fetch_array($selectSenderID);
	        $senderName = $senderInfo['name'];
            $status = $row['Status'];
            if ($status == 'unread') {
                echo'
                    <div class="md-card-content" onclick="getSms(smsid='.$row['Id'].')">
                        <a href="javascript:void();">
                            <div class="sms">
                                <input type="hidden" value="'.$row['Id'].'" id="msgId">
                        		<input type="hidden" value="'.$row['SenderID'].'" id="SenderID">
                                <div class="sender">'.$senderName.'<span class="time">few second ago</span></div>
                                <div class="msg">'.$row['Msg'].'</div>
                            </div>
                        </a>
                        <i id="response"></i>
                    </div>
                ';
            }
            else {
                echo'
                    <div class="md-card-content" onclick="getSms(smsid='.$row['Id'].')" style="background-color: #f1f7f6;">
                        <a href="javascript:void();">
                            <div class="sms">
                                <input type="hidden" value="'.$row['Id'].'" id="msgId">
                        		<input type="hidden" value="'.$row['SenderID'].'" id="SenderID">
                                <div class="sender">'.$senderName.'<span class="time">few second ago</span></div>
                                <div class="msg">'.$row['Msg'].'</div>
                            </div>
                        </a>
                    </div>
                '; 
            }
	   
		}
	}
                   
}

?>
<?php 
    if (isset($_POST['Msg'])) {
        $Msg = $_POST['Msg'];
        $Sender = $_POST['Sender'];
        include 'db.php';
        $reply = $db ->query("INSERT INTO reply(Body,ReplyId,ReplyedID,_Time,Type) VALUES('$Msg', '$userId', '$Sender', now(), 'App')");
	}
?>
<script type="text/javascript"> 
	$(document).ready(function() {
	    $("#send").click(function() {
	        var Msg = $("#Msg").val();
	        var Sender = $("#msgSender").val();
	        $.ajax ({
	        url: "procedure.php",
	        type: "POST",
	        async: false,
	        data: {
	            "Msg" : Msg,
	            "Sender" : Sender
	        },
	        success: function(data) {
	            $("#messages").html(data);
	        }
	        })
	    });
	});
</script>