<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
if (isset($_GET['groupId'])){	
		$groupID = (int)$_GET['groupId'];
		require_once "parsedown/Parsedown.php";
		$parsedown = new parsedown();
		include "../db.php"; 
		$sql2 = $db->query("SELECT * FROM groups WHERE id='$groupID' "); 
		while($row = mysqli_fetch_array($sql2)){ 
			$groupName = $row["groupName"];
			$targetAmount = round($row['targetAmount']);
			$adminPhone = $row['adminPhone'];
			$adminId = $row['adminId'];
			$adminName = $row['adminName'];
			$groupDesc = $row["groupDesc"];
			$groupStory = $parsedown->text($row["groupStory"]);
			$createdDate = $row["createdDate"];
			$contributionDate = $row["expirationDate"];
			$visits = $row["visits"];
			$newVisit = $visits + 1;
			$sqlVisits = $db->query("UPDATE `groups` SET visits = '$newVisit' WHERE id ='$groupID'");
			
			
			$sqlbalance = $outCon->query("SELECT * FROM groupbalance WHERE groupId = '$groupID'");
			$rowbalance = mysqli_fetch_array($sqlbalance);
			$currentAmount = $rowbalance['Balance'];
			
			$prog = $currentAmount*100/$targetAmount;
			$progressing =$prog + (20*$prog/100);
			
		}
		$sqladminId = $db->query("SELECT id adminId, gender adminGender FROM users WHERE id = '$adminId'");
		$rowAdminId = mysqli_fetch_array($sqladminId);
		$adminGender = $rowAdminId["adminGender"];
		
		if($currentAmount == ''){
			$currentAmount = 0;
		}
	}
else{
	echo 'nothig isset';
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" id="indiegogo" style="overflow: visible;">
  <head>
	<title>Uplus: <?php echo $groupName;?></title>
    <meta name="description" content="<?php echo $groupName;?>" />
    <meta name="robots" content="noindex" />

    <link href="https://g0.iggcdn.com/assets/site/fonts-4bad5139ba2fa12a28f46d9939e3068dfb3f31f880ecd0945cb17ea08d6bc3ed.css" media="screen" rel="stylesheet" />
    <link href="https://g1.iggcdn.com/assets/site/common-da4f72d649e9f8692dea6fc0e9a128ac6ef212cd267b0b600fb0abdee2ee1aed.css" media="screen" rel="stylesheet" />
    <script src="https://g2.iggcdn.com/assets/jquery/jquery-f122fcda7b3d039af154bb8a06781aeabb46fd547d77aca154d9efd46a5f0e1f.js"></script>
    <script src="https://g0.iggcdn.com/assets/i18n_stack-91941ae0e804af556b6b52c5a6bc578f22b6f34aa18fac10f7ff90015053030c.js"></script>
    <script src="https://g1.iggcdn.com/assets/i18n/en-71f82d9e3a94d06fbc9de5c2158c8b3c68ccd62d24620d84d3609f5eb146233e.js"></script>
    <script src="https://g2.iggcdn.com/assets/boot-483835e95c92bc81c1890c201bcd2b354ebb0285290b7580dc98c9f83b250d65.js"></script>
    <script src="https://g0.iggcdn.com/assets/lite-7722b9527a5b54aaa6373807e5c921cbef7b96a3fe1d5a8a515df99b716e83e8.js"></script>

  <script type="text/javascript" src="/gogodstlbbcwbqxdbvsytxwqrz.js" defer></script><style type="text/css">
  .i-progress-bar .i-complete {
			    background-color: #007569;
		}
  #d__fFH{position:absolute;top:-5000px;left:-5000px}#d__fF{font-family:serif;font-size:200px;visibility:hidden}#dtqvqzvvwyrceswzzwevdycbabbfuevd{display:none!important}</style></head>
  <body ng-app="indiegogo.lite" ng-strict-di>
    <div>
 

<div igg-project-card class="i-project-card i-embedded">
  <a class="i-project" href="/f/i<?php echo $groupID;?>" target="_blank">
    <div class="i-img" data-src="https://www.uplus.rw/temp/group<?php echo $groupID;?>.jpeg">
    </div>
    <div class="i-content">
      <div class="i-title"> <?php echo $groupName;?></div>
      <div class="i-tagline "><?php echo $groupDesc;?></div>
    </div>

    <div class="i-stats">
      <span class="currency currency-medium"><span><?php echo number_format($targetAmount);?></span><em>Rwf</em></span>
      <div class="i-progress-bar">
        <div class="i-complete" style="width: <?php if($prog < 10){echo 10;} else{echo $prog;}?>%"></div>
      </div>
      <div class="i-bottom-row">
          <div class="i-percent">
            <?php echo number_format($prog);?>%
          </div>
          <div class="i-time-left">
            30 days left
          </div>
      </div>
    </div>
</a></div>

    </div>
  </body>
</html>

