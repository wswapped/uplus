<?php // 1 Display Users
if (isset($_GET["accID"])) {
	//
	$accID = $_GET["accID"]; 
	include "../db.php";
	
	// Notifications
	$notification='';
	$sqlNotifyAction = $db->query("SELECT * FROM `action_agreement` WHERE `accountCode` ='$accID' and status='pending'");
	$countAction = mysqli_num_rows($sqlNotifyAction);
	if($countAction > 0)
	{
		while($row = mysqli_fetch_array($sqlNotifyAction))
		{
			$actionId= $row['id'];	
			$fromCode= $row['fromCode'];	
			$actionTitle= $row['actionTitle'];	
			$sqluser = $db->query("SELECT name FROM users WHERE id ='$fromCode'");
			while($row = mysqli_fetch_array($sqluser))
			{
				$fromName= $row['name'];	
			}	
			$notification.='<div class="alert alert-danger alert-dismissible" role="alert">
									'.$fromName.' is requesting to '.$actionTitle.' <a href="testlog.php?yesaction='.$actionId.'">Yes</a> Accept or <a href="testlog.php?noaction='.$actionId.'">no</a> reject</div>';
		}
	}else
	{
		$notification.='';
	}
	
	
	
	$sql = $db->query("SELECT * FROM joined_ua WHERE acceptance = 'yes'and groupId = '$accID' ");
	$results ="";
		$n= 0 ;
		
	$count_user = mysqli_num_rows($sql); // count the output amount
	if ($count_user > 0) 
	{
		while($row = mysqli_fetch_array($sql))
		{
			$n++;
			$name = rand(1,100);
				 $tel_phone= $row['userPhone'];	
				 $user_name= $row['userName'];	
				 $period= $row['periodes'];
				 $receiving_date = $period * ($n-1);
				 $time = date("Y-m-d", strtotime($row["transactionDate"]));
				 $date = new DateTime($time);
				 $date->add(new DateInterval('P'.$receiving_date.'D')); // P1D means a period of 1 day
				 $Date2 = $date->format('Y-m-d');
				 
				 $d= $row['periodes'];	
					$results.='
					  <tr>
						<td>'.$n.'</td>
						<td>'.$user_name.'</td>
						<td>'.$Date2.'</td>                    
						<td><button javascript:void()" onclick ="phone(phoneID= '.$tel_phone.')" class="btn btn-outline btn-danger btn-round btn-xs">Info</button></td>                    
					  </tr>
					
				  ';
		}
		echo 
		'
		'.$notification.'
		
		<div class="panel-body"> 
						
		<table class="table toggle-arrow-tiny" id="exampleFooAccordion">
					<thead>
					  <tr>
						<th>S/N</th>
						<th>Names</th>
						<th>Recieving Date</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
						'.$results.'
					</tbody></table>
					
					</div>';
				 
	} 
	else 
	{
		echo "<b>Sorry, currently no member has confirmed this uPlus invitation, including you start by accepting the request</b>";
	}
}
?>

<?php // 2 Count Users and desplay the invitation button
if (isset($_GET["groupID"])) {
	//
	$groupID = $_GET["groupID"]; 
	$myID = $_GET["myID"]; 
	include "../db.php";
	$sql = $db->query("
		SELECT u.id, u.phone, a.opening, a.periodes
		FROM accounts a 
		INNER JOIN account_user au ON a.id=au.accountID
		INNER JOIN users u ON u.id=au.userID
		AND a.id ='$groupID' WHERE au.acceptance = 'yes'");
	$results ="";
		$n= 0 ;
		
	$count_user = mysqli_num_rows($sql); // count the output amount
	if ($count_user > 0) {
	echo 
	'<form action="scripts/testlog.php" method="post" class="form-gourp">
	<table cellpadding="3">
		<tr>
			<td width="30%">
				'.$count_user.' Members
			</td>
			<td width="70%">
				  <div class="input-group">
					<input type="number" id="groupID" name="groupID" value="'.$groupID.'" hidden/>
					<input type="number" id="byname" name="byname" value="'.$myID.'" hidden/>
					<input type="number" class="form-control round" placeholder="Add members..." id="invite" name="invite" min="078999999" required />
			
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-primary btn-outline btn-round">
						<i class="icon md-plus" aria-hidden="true"></i>
					  </button>
                    </span>
                  </div>
                
				
				
			</td>
		</tr>
	</table>
	</form>';

	} else {
		echo "<b>Sorry, currently no member has confirmed this uPlus invitation, including you start by accepting the request</b>";
	}
}
?>

<?php // 3 Dumy member information
if (isset($_GET["phoneID"])) {
	//
	$num = rand(7, 30);
	$num1 = rand(100, 300);
	$num2 = rand(20, 58);
	$num3 = rand(30, 70);
	$num5 = rand(10, 70);
	$num6 = rand(10, 70);
	$num7 = rand(10, 70);
	$num8 = rand(10, 70);
	$num9 = rand(10, 70);
	$num10 = rand(10, 70);
	$num11 = rand(10, 70);
	$num12 = rand(10, 70);
	$amount = rand(3200, 7800);
	$num4 = rand(1000, 5000);
		echo '	<div  style="height: 432px;">
          <!-- Panel Line Pie -->
          <div class="widget widget-shadow" id="chartLinePie">
            <div class="widget-content">
              <div class="bg-red-600 white padding-30">
                <div class="font-size-20 clearfix">
                  Trust
                  <span class="pull-right">
                    <i class="icon wb-triangle-up" aria-hidden="true"></i> '.$num1.'
                  </span>
                </div>
                <div class="font-size-14 red-200 clearfix">
                  '.date('Y-m-d').'
                  <span class="pull-right">+12.5 Point</span>
                </div>
                <div class="ct-chart chart-line height-100">
				<svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;">
				<g class="ct-grids">
				</g>
				<g>
				<g class="ct-series ct-series-a">
				<path d="M4,'.$num6.'.714L46.143,'.$num7.'.143L88.286,'.$num8.'.286L130.429,'.$num9.'.571L172.571,'.$num10.'L214.714,'.$num11.'.857L256.857,'.$num12.'.886L299,'.$num5.'.771" class="ct-line">
				</path>
				<line x1="4" y1="'.$num6.'.71428571428571" x2="4.01" y2="'.$num6.'.71428571428571" class="ct-point" value="4">
				</line>
				<line x1="46.142857142857146" y1="'.$num7.'.14285714285714" x2="46.152857142857144" y2="'.$num7.'.14285714285714" class="ct-point" value="5">
				</line>
				<line x1="88.28571428571429" y1="'.$num8.'.28571428571428" x2="88.2957142857143" y2="'.$num8.'.28571428571428" class="ct-point" value="3">
				</line>
				<line x1="130.42857142857144" y1="'.$num9.'.57142857142857" x2="130.43857142857144" y2="'.$num9.'.57142857142857" class="ct-point" value="6">
				</line>
				<line x1="172.57142857142858" y1="'.$num10.'" x2="172.58142857142857" y2="'.$num10.'" class="ct-point" value="7">
				</line>
				<line x1="214.71428571428572" y1="'.$num11.'.85714285714286" x2="214.7242857142857" y2="'.$num11.'.85714285714286" class="ct-point" value="5.5">
				</line>
				<line x1="256.8571428571429" y1="'.$num12.'.885714285714286" x2="256.8671428571429" y2="'.$num12.'.885714285714286" class="ct-point" value="5.8">
				</line>
				<line x1="299" y1="'.$num5.'.77142857142859" x2="299.01" y2="'.$num5.'.77142857142859" class="ct-point" value="'.$num5.'">
				</line>
				</g>
				</g>
				<g class="ct-labels">
				</g>
				</svg>
				</div>
              </div>
              <div class="padding-30">
                <div class="row no-space">
                  <div class="col-xs-7">
                    <p>
                      <span class="icon wb-medium-point cyan-600 margin-right-5"></span>'.$num2.'% Ontime</p>
                    <p class="margin-bottom-20">
                      <span class="icon wb-medium-point red-600 margin-right-5"></span>'.$num3.'% Delay </p>
                    <p>TOTAL AMOUNT</p>
                    <p class="font-size-20 margin-bottom-0" style="line-height:1;">Rwf '.number_format($amount)."<br>".'</p>
                  </div>
                  <div class="col-xs-5">
                    <div class="ct-chart chart-pie" style="height: 129px;">
                      <div class="vertical-align text-center" style="height:100%; width:100%; position:absolute; left:0; top:0;">
                        <div class="font-size-20  vertical-align-middle" style="line-height:1.1 ">
                          <div>'.$num.'</div>
                          <div>Turns</div>
                        </div>
                      </div>
                    <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-donut" style="width: 100%; height: 100%;">
					<g class="ct-series ct-series-b">
					<path d="M63,11.5A53,53,0,1,0,105.986,95.503" class="ct-slice-donut" value="65" style="stroke-width: 10px">
					</path>
					</g>
					<g class="ct-series ct-series-a">
					<path d="M105.878,95.653A53,53,0,0,0,63,11.5" class="ct-slice-donut" value="35" style="stroke-width: 10px">
					</path>
					</g>
					</svg>
					</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Panel Line Pie -->
        </div>
    ';
	}
?>

<?php // 5 Members uPlus Title
if (isset($_GET["infoID"])) {
	//
	$accInfo = $_GET["infoID"]; 
	$myID = $_GET["myID"]; 
	
	include "../db.php";
	$sql2 = $db->query("SELECT * FROM accounts WHERE id ='$accInfo'");
	
	$count_info = mysqli_num_rows($sql2); // count the output amount
	if ($count_info > 0) {
	while($row = mysqli_fetch_array($sql2)){
		
		$contribution = $row['contribution'];
		$accID = $row['id'];
		$accName = $row['accName'];
				
		$sql = $db->query("
		SELECT u.id, u.phone
		FROM accounts a
		INNER JOIN account_user au ON a.id=au.accountID
		INNER JOIN users u ON u.id=au.userID
		AND a.id ='$accInfo' WHERE au.acceptance = 'yes'");
		$count_me = mysqli_num_rows($sql);
		
		$results =$contribution * $count_me;
		//echo ''.$results.' Rwf';
		echo '<i class="icon md-user" aria-hidden="true"></i>Members of '.$accName.' <a href="transact.php?accID='.$accID.'">...</a>
		 
		<div class="panel-actions">
                <div class="dropdown">
                  <a class="dropdown-toggle panel-action" data-toggle="dropdown" href="#" aria-expanded="false">
				  <i class="icon md-settings" aria-hidden="true"></i></a>
                  <ul class="dropdown-menu bullet" role="menu">
				  
                    <li role="presentation">
						<a href="group'.$accID.'" role="menuitem">
							<i class="icon md-stats-bars" aria-hidden="true"></i> 
								Historic</a>
							</li>
                    <li role="presentation"><a href="#" role="menuitem"><i class="icon md-wrench" aria-hidden="true"></i> Modify </a></li>
                    <li role="presentation"><a href="testlog.php?actionCodes='.$accID.'-'.$myID.'-'.$count_me.'" role="menuitem"><i class="icon md-trash" aria-hidden="true"></i> Leave '.$accName.'</a></li>
                  
				  </ul>
                </div>
            </div>
		';
	}
	}else{
		echo "0";
	}
}
?>

<?php // 7 Reject the invitation
if (isset($_GET['idtodelete'])){
	$idtodelet = $_GET['idtodelete'];
	include "../db.php";
	
	$sql = $db->query("DELETE FROM `account_user` WHERE id = '$idtodelet'");
	header ('location: ../home');
	exit();
	//echo 'You have succesfurly rejected the uPlus invitation,<br/> Please <a href="test.php">click here</a>';
}
?>

<?php // 9 IKIMINA Invitation information
if (isset($_GET['group_id'])){
	$group_id = $_GET['group_id'];
	$disp_bank ="";
	$G_personalID = $_GET['G_personalID'];
	include("../db.php");
	$sql_banks = $db->query("SELECT name FROM financial_inst");
	$sql_personel = $db->query("SELECT `name` FROM `users` WHERE `id` = '$G_personalID'");
	while($row = mysqli_fetch_array($sql_personel))
	{
		$personel_names = $row['name'];
	}
	while($row = mysqli_fetch_array($sql_banks)){
		$bank_names = $row['name'];
		$disp_bank.='

<option>'.$bank_names.'</option>';
		
	}
	$sql = $db->query("SELECT * FROM accounts WHERE ID = '$group_id'")or die (mysqli_error());
	$sql2 = $db->query("SELECT * FROM account_user WHERE accountID = '$group_id' AND acceptance = 'yes'")or die (mysqli_error());
	$sql3 = $db->query("SELECT id FROM account_user WHERE accountID = '$group_id' AND userID = '$G_personalID'")or die (mysqli_error());
	while($row = mysqli_fetch_array($sql3)){
		$idtodelete = $row['id'];
	}
	$n = mysqli_num_rows($sql2);
	while($row = mysqli_fetch_array($sql)){
		$account_name = $row['accName'];
		$G_contribution = $row['contribution'];
		$G_period = $row['periodes'];
		$G_ad_name = $row['adminName'];
		$time = date("d-m", strtotime($row["opening"]));
	}
	$amount_to_recieve = $G_contribution * $n;
	$amount_to_recieve2 = $amount_to_recieve + $G_contribution;
	$iminsi = $G_period * $n;
	$iminsi2 = $iminsi + $G_period;
	echo '  <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" ><b>AGREEMENT of '.$account_name.'</b></h4>
						</div>
						<div class="modal-body" id="G_info">
						<p>
							Your have been invited by '.$G_ad_name.' in '.$account_name.' uPlus, having '.$n.' members.<br/>
							<u>Terms and condition of '.$account_name.' uPlus:</u><br/>
							- Currently each member should contribute '.number_format($G_contribution).' Rwf each '.$G_period.' days, starting from '.$time.' and
							 recieves '.number_format($amount_to_recieve).' Rwf after '.$iminsi.' Days.<br/>
							- Once you are in the uPlus you shall be contributing '.number_format($G_contribution).' Rwf each '.$G_period.' Days, and receive '.number_format($amount_to_recieve2).' Rwf, each '.$iminsi2.' Days.<br/>

							- In case you would like to leave the uPlus, you have to follow this steps:<br/>
							1. Click on leave the uPlus with typing your password.<br/>
							2. After paying back the uPlus money, you shall immediately leave the uPlus<br/>
							<form method="post" action="scripts/testlog.php">
							<div class="row">
							<div class="col-md-6">Chose your Account of operation
							<select class="form-control" name="bank_account_name">
						<option></option>
						'.$disp_bank.'
						</select> 
						</div>
						<div class="col-md-6">Account 
						<input name="uPlus_to_conf" value="'.$group_id.'" hidden />
						<input name="person_to_conf" value="'.$G_personalID.'" hidden />
						<input name="personel_names" value="'.$personel_names.'" hidden />
						<input class="form-control" name="bank_account_number"/>
						</div>
						</div>
						</p>
						<input type="submit" name="accept_invitation" value="Accept" class="btn btn-primary" id="exampleWarningCancel"/>
						
						<a href="scripts/testlog.php?idtodelete='.$idtodelete.'" class="btn btn-danger">Reject</a>
						</form></div>
                      ';
}
?>

<?php // 10 IKIMINA Accept invitation
if (isset($_POST['accept_invitation'])){
	$uPlus_to_conf = $_POST['uPlus_to_conf'];
	$person_to_conf = $_POST['person_to_conf'];
	$personel_names = $_POST['personel_names']; // done
	$bank_account_number = $_POST['bank_account_number'];
	include "../db.php";
	
	// Bring User's bank information to be attached on the account
	$sql = $db->query("SELECT * FROM `banks_telecoms` WHERE	`holder_name` like '%$personel_names%' AND acc_number like '%$bank_account_number%'")or die (mysqli_error());
	$count_holder = mysqli_num_rows($sql);
	if($count_holder > 0)
	{
		while($row = mysqli_fetch_array($sql))
		{
			$bankId = $row ['id'];
		}
		$sql2 = $db->query("SELECT listing FROM `account_user` WHERE accountID = '$uPlus_to_conf' ORDER BY listing DESC LIMIT 1");
		while($row = mysqli_fetch_array($sql2))
		{
			$lastlisting = $row ['listing'];
		}
		$newlisting = $lastlisting + 1;
		// Link the Bank details with the uPlus users
		$sql3 = $db->query("UPDATE `account_user` SET bank_account_id = '$bankId', acceptance = 'yes', listing= '$newlisting' WHERE accountID = '$uPlus_to_conf' AND userID = '$person_to_conf'")or die (mysqli_error());
		
		
		
		
		
		header("location: ../home");
	}
	else
	{
		echo'we did not find any account of '.$bank_account_number.', haven"t you made a mistake?';
	}
	
}
?>

<?php // 12 IKIMINA invite someone
if (isset($_POST['invite']))
{
	$invite = $_POST['invite'];
	$groupID = $_POST['groupID'];
	$byID = $_POST['byname'];
	
	include ("../db.php");
	$sqluserName = $db->query("SELECT `name` FROM `users` WHERE `id` ='$byID'");
	WHILE($row = mysqli_fetch_array($sqluserName))
		{
			$byname = $row['name'];
		}
	// Check if the invited is not already in the group
	$sqlcheckexist = $db->query("select groupId, userPhone from joined_ua where userPhone = '$invite' and groupId = '$groupID'")or (mysqli_error());
	$countExist = mysqli_num_rows($sqlcheckexist);
	// IF the user is already in this group stop here
	if($countExist > 0)
		{
			echo 'this person already exist in this uPlus <a href="../home"> Click Here</a>';
		}
	// IF the user is not already in the group
	else{
			// Check if the invited is new on Uplus
			$sql = $db->query("SELECT * FROM `users` WHERE `phone` = '$invite'")or (mysqli_error());
			$bara = mysqli_num_rows($sql);
			while($row = mysqli_fetch_array($sql))
				{
					$exsistingUser = $row['id'];
					$existingUserName = $row['name'];
				}
			// Create a user if he does not exist then add him to the group
			if (!$bara > 0)
				{
					$sql2 = $db->query("INSERT INTO `users`(`phone`) VALUES ('$invite')")or (mysqli_error());
					$sql3 = $db->query("SELECT * FROM users order by id desc limit 1")or die (mysqli_error());
					while($row = mysqli_fetch_array($sql3))
						{
							$newUser = $row['id'];
						}
					// Creat an invitation connection Btn User and Group
					$sql4 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`) VALUES ('$groupID','$newUser')")or (mysqli_error());
					//echo "The new member is invited ";
			}
			// Just connect the user to the group Because he exist in the uplus 
			else
				{
					$sql5 = $db->query("INSERT INTO `account_user`(`accountID`, `userID`, invitedbyId) VALUES ('$groupID','$exsistingUser', '$byID')")or (mysqli_error());
					//echo "The exisiting member :".$invite." is invited <a href='ikimina.php'> Click Here</a>";
			}
			// Get the account Name
			$sqlaccountname = $db->query("SELECT accName FROM `accounts` WHERE `id` = '$groupID'")or (mysqli_error());
			$RowAccName = mysqli_fetch_array($sqlaccountname);
			$groupName = $RowAccName['accName'];	
					
				
			
			//// START SMS ////
		require_once('../classes/sms/AfricasTalkingGateway.php');
		$username   = "cmuhirwa";
		$apikey     = "17700797afea22a08117262181f93ac84cdcd5e43a268e84b94ac873a4f97404";
		$recipients = '+25'.$invite;
		$message    = 'Hello! You have been invited by '.$byname.' to join Ikimina called: '.$groupName.' on U+. To Join/Reject or more info visit: http://www.uplus.rw';
		// Specify your AfricasTalking shortCode or sender id
		$from = "uplus";

		$gateway    = new AfricasTalkingGateway($username, $apikey);
		$nsms;
		try
		{

		   $results = $gateway->sendMessage($recipients, $message, $from);

		  foreach($results as $result) {
		   // echo " Number: " .$result->number;
		   // echo " Status: " .$result->status;
		   // echo " MessageId: " .$result->messageId;
		   // echo " Cost: "   .$result->cost."\n";
		  }
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		  echo "Encountered an error while sending invitation to ".$invite."<br> ".$e->getMessage();
		}
		echo'Invitation was successfully Sent <a href="../ikimina">Click Here</a>';
		//// END SMS ////
		}
}
?>

<?php // 13 transaction page
if (isset($_GET["transID"])) {
	//
	$tra = $_GET["transID"]; 
	$transID = '0'.$tra.''; 
	include "../db.php";
	$sql = $db->query("SELECT * FROM savings WHERE userID='$transID'")or die(mysql_error());
	$trans="";
	$n=0;
	 $out3 =""; 
		 $in3 = ""; 
	    
	while($row = mysqli_fetch_array($sql)){
		$n++;
		$userID = $row['userID'];
		$amountIn = $row['amountIn'];
		$amountOut = $row['amountOut'];
		$doneOn = $row['doneOn'];
		
		 $out3 = $amountOut + $out3; 
		 $in3 = $amountIn + $in3; 
	     $amounts = $in3 - $out3;
	     $balance = $amountIn - $amountOut;
		
		$trans.='<tr>
                    <td>'.$n.'</td>
                    <td>'.$amountIn.' Rwf</td>
                    <td>'.$amountOut.' Rwf</td>
                    <td>'.$balance.' Rwf</td>
                    <td>'.$doneOn.'</td>
                 </tr>';
	}
	echo 
	'  <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="icon wb-loop"></i>Transactions On Klab</h3>
            </div>
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>N/S #</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Balance</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
				  
				  '.$trans.'
                </tbody>
              </table>
            </div>
            <div class="panel-footer">
              <a  href="javascript:void(0)">
				<i class="icon wb-info-circle blue-600 margin-right-10" aria-hidden="true"></i>Show more details.
			  </a>
			  <div class="blue-grey-500" style="float: right;">
			  Total Balance: <b>'.$amounts.' Rwf</b></div>
            </div>
          </div>
        ';
}
?>

<?php // 14 display performance
if (isset($_GET['performanceID'])){
	$performanceID = $_GET['performanceID'];
	echo '<div class="panel">
        <div class="panel-body">
        <!-- Example C3 Spline -->
              <div class="example-wrap">
                <h4 class="example-title">Performance</h4>
                <p>Your Historical Performance</p>
                <div class="example">
                  <div id="exampleC3Spline"></div>
                </div>
              </div>
              <!-- End Example C3 Spline -->
        </div>
          </div>
			';
}
?>

<?php // 15 action leave
if (isset($_GET['actionCodes'])){
	$actionCodes = $_GET['actionCodes'];
	list($account, $me, $numberofusers) = explode("-", $actionCodes, 3);
	
	$actionQuery ='DELETE FROM account_user WHERE accountID ='.$account.' and userID ='.$me.'';
	
	require "../db.php";
	$sql = $db->query("INSERT INTO `action_agreement`
	(`accountCode`, `fromCode`, `actionTitle`, `actionQuery`, `voteYes`, `voteNo`, `voteTotal`, `status`) 
	VALUES 
	('$account','$me','leave the uPlus','$actionQuery','1','0','$numberofusers','pending')")or die(mysql_error());
	header("location: home");
	
}
?>

<?php // 16 action accept
if (isset($_GET['yesaction'])){
	$yesaction = $_GET['yesaction'];
	
	require "../db.php";
	$getTheaction = $db->query("SELECT * FROM `action_agreement` WHERE id='$yesaction'")or die(mysql_error());
	while($row = mysqli_fetch_array($getTheaction))
		{
			$referto = $row ['id'];
			$voteYes = $row ['voteYes'];
			$voteTotal = $row ['voteTotal'];
			$newVote = $voteYes + 1;
			$halfTotal = $voteTotal / 2;
		}
		if($newVote >= $halfTotal)
			{
				$finishVoteQuery = $db->query("UPDATE `action_agreement` SET `voteYes`='$newVote', status='approved' WHERE id='$referto'")or die(mysql_error());
			}else
			{
				$voteYesQuery = $db->query("UPDATE `action_agreement` SET `voteYes`='$newVote' WHERE id='$referto'")or die(mysql_error());
				$voteYesQuery = $db->query("UPDATE `action_agreement` SET `voteYes`='$newVote' WHERE id='$referto'")or die(mysql_error());
			}	
	header("location: home");	
}
?>

<?php // 17 action reject
if (isset($_GET['noaction'])){
	$noaction = $_GET['noaction'];
	
	require "../db.php";
	$getTheaction = $db->query("SELECT * FROM `action_agreement` WHERE id='$noaction'")or die(mysql_error());
	while($row = mysqli_fetch_array($getTheaction))
		{
			$referto = $row ['id'];
			$voteNo = $row ['voteNo'];
			$voteTotal = $row ['voteTotal'];
			$newVote = $voteNo + 1;
			$halfTotal = $voteTotal / 2;
		}
		if($newVote >= $halfTotal)
			{
				$finishVoteQuery = $db->query("UPDATE `action_agreement` SET `voteNo`='$newVote', status='rejected' WHERE id='$referto'")or die(mysql_error());
			}else
			{
				$voteYesQuery = $db->query("UPDATE `action_agreement` SET `voteNo`='$newVote' WHERE id='$referto'")or die(mysql_error());
			}	
	header("location: home");	
}
?>