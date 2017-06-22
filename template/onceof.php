<?php include "template/header.php"?>

<link rel="stylesheet" href="assets/examples/css/widgets/weather.min3f0d.css?v2.2.0">
  <!-- Page -->
  <div class="page animsition">
   <div class="page-header">
      <h1 class="page-title">uPlus</h1>
      <ol class="breadcrumb">
        <li>
			<a href="home">Home</a></li>
				<li class="active">CONTRIBUTOINS</li>
				<li><a href="adminonce.php"><i class="icon md-accounts-list-alt"></i>Admin
			</a>
		</li>
      </ol>
      <div class="page-header-actions">
        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-outline btn-round site-tour-trigger">
            <i class="icon md-info" aria-hidden="true"></i>
			<span class="hidden-xs"> I need Help </span>
        </a>
      </div>
    </div>
	
  <div class="page-content container-fluid">
    <div class="row">
    	<div class="col-lg-6">	
			<div class="panel panel-bordered panel-dark" id="accounts">
				<header class="panel-heading">
				  <h3 class="panel-title">
					<i class="icon wb-folder" aria-hidden="true"></i>Following
				  </h3> 
				</header> 
				<div class="tab-content">
					<div class="tab-pane active">
						<ul class="list-group bg-inherit list-group-full">
							<?php
								$sql2 = $db->query("SELECT * FROM `joined_ua` where phone ='0784848236' and acceptance = 'yes'"); 
								while($row = mysqli_fetch_array($sql2)){ 
									$groupName = $row["accName"];
									$saving = round($row['saving']);
									$adminPhone = $row['adminPhone'];
									$adminName = $row['adminName'];
									$currentAmount = round($row['currentAmount']);
									$contributionDate = $row["opening"];
									$prog = $currentAmount*100/$saving;
									$progressing=''.$prog.'%';
										$sqladminID = $db->query("SELECT id adminID FROM users WHERE phone = '$adminPhone'");
										$fetchAdminID = $rowAdminID = mysqli_fetch_array($sqladminID);
										$adminID = $rowAdminID["adminID"];
									if($prog < 30 || $prog == 30){echo'<li class="list-group-item waves-effect waves-classic" style="padding-left: 10px;">
																		<div class="media">
																		  <div class="media-left">
																			<a class="avatar" href="cont1">
																			  <img class="img-responsive" src="proimg/'.$adminID.'.jpg" alt="...">
																			</a>
																		  </div>
																		  <div class="media-body">
																		   <h4 class="media-heading">'.$groupName.' <small> Organised by:'.$adminName.': </small><span class="pull-right" id="countDown">12 Days</span></h4>
																			<div class="progress progress-xs" style="margin-bottom: 0px;">
																			  <div class="progress-bar progress-bar-warning progress-bar-indicating active" style="width: '.$progressing.';" role="progressbar">
																				<span class="sr-only">'.$progressing.' Complete</span>
																			  </div>
																			</div>
																			<div>
																				<h4><small>400/</small>1,000 Rwf
																					<span class="pull-right" id="countDown"></span>
																				</h4>
																			</div>
																		  </div>
																		  <div class="media-right">
																		  </div>
																		</div>
																	</li>
																';}
									elseif($prog > 30 || $prog <50 || $prog == 50){echo'<li class="list-group-item waves-effect waves-classic" style="padding-left: 10px;">
																								<div class="media">
																								  <div class="media-left">
																									<a class="avatar" href="cont1">
																									  <img class="img-responsive" src="proimg/2.jpg" alt="...">
																									</a>
																								  </div>
																								  <div class="media-body">
																								   <h4 class="media-heading">Newtimes <small> Organised by:Clement: </small><span class="pull-right" id="countDown">12 Days</span></h4>
																									<div class="progress progress-xs" style="margin-bottom: 0px;">
																									  <div class="progress-bar progress-bar-warning progress-bar-indicating active" style="width: 40%;" role="progressbar">
																										<span class="sr-only">40% Complete</span>
																									  </div>
																									</div>
																									<div>
																										<h4><small>400/</small>1,000 Rwf
																											<span class="pull-right" id="countDown"></span>
																										</h4>
																									</div>
																								  </div>
																								  <div class="media-right">
																								  </div>
																								</div>
																							</li>
																						';}
									elseif($prog > 50 || $prog <80 || $prog == 80){echo'<li class="list-group-item waves-effect waves-classic" style="padding-left: 10px;">
																						<div class="media">
																						  <div class="media-left">
																							<a class="avatar" href="cont1">
																							  <img class="img-responsive" src="proimg/2.jpg" alt="...">
																							</a>
																						  </div>
																						  <div class="media-body">
																						   <h4 class="media-heading">Newtimes <small> Organised by:Clement: </small><span class="pull-right" id="countDown">12 Days</span></h4>
																							<div class="progress progress-xs" style="margin-bottom: 0px;">
																							  <div class="progress-bar progress-bar-warning progress-bar-indicating active" style="width: 40%;" role="progressbar">
																								<span class="sr-only">40% Complete</span>
																							  </div>
																							</div>
																							<div>
																								<h4><small>400/</small>1,000 Rwf
																									<span class="pull-right" id="countDown"></span>
																								</h4>
																							</div>
																						  </div>
																						  <div class="media-right">
																						  </div>
																						</div>
																					</li>
																				';}
									elseif($prog > 80){echo'<li class="list-group-item waves-effect waves-classic" style="padding-left: 10px;">
																<div class="media">
																  <div class="media-left">
																	<a class="avatar" href="cont1">
																	  <img class="img-responsive" src="proimg/2.jpg" alt="...">
																	</a>
																  </div>
																  <div class="media-body">
																   <h4 class="media-heading">Newtimes <small> Organised by:Clement: </small><span class="pull-right" id="countDown">12 Days</span></h4>
																	<div class="progress progress-xs" style="margin-bottom: 0px;">
																	  <div class="progress-bar progress-bar-success progress-bar-indicating active" style="width: 40%;" role="progressbar">
																		<span class="sr-only">40% Complete</span>
																	  </div>
																	</div>
																	<div>
																		<h4><small>400/</small>1,000 Rwf
																			<span class="pull-right" id="countDown"></span>
																		</h4>
																	</div>
																  </div>
																  <div class="media-right">
																  </div>
																</div>
															</li>
														';}
								}
							?>
							
							<li class="list-group-item waves-effect waves-classic" style="padding-left: 10px;">
								<div class="media">
								  <div class="media-left">
									<a class="avatar" href="cont1">
									  <img class="img-responsive" src="proimg/2.jpg" alt="...">
									</a>
								  </div>
								  <div class="media-body">
								   <h4 class="media-heading">Newtimes <small> Organised by:Clement: </small><span class="pull-right" id="countDown">12 Days</span></h4>
									<div class="progress progress-xs" style="margin-bottom: 0px;">
									  <div class="progress-bar progress-bar-warning progress-bar-indicating active" style="width: 40%;" role="progressbar">
										<span class="sr-only">40% Complete</span>
									  </div>
									</div>
									<div>
										<h4><small>400/</small>1,000 Rwf
											<span class="pull-right" id="countDown"></span>
										</h4>
									</div>
								  </div>
								  <div class="media-right">
								  </div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			  </div>
			</div>
		
		
		
		<div class="col-lg-6">
          <!-- Panel Row Toggler -->
          <div class="panel panel-bordered panel-success"  id="accounts">
		  
            <header class="panel-heading">
              <h3 class="panel-title">
				<i class="icon wb-folder" aria-hidden="true"></i>My Contributions
				
			  </h3>
			  
            </header> 
			<?php 
				$n=0;
				$sql1 = $db->query("SELECT * FROM `joined_ua` WHERE (`phone` = '$phone' and acceptance='no' ) AND (groupType = 'WEDDING' or groupType = 'TIGHT')");
				$count_alerts = mysqli_num_rows($sql1);
				if($count_alerts > 0){
					while($row = mysqli_fetch_array($sql1)){
						$n++;
						$invid = $row['accountID'];
						$approve="";
						$account_name = $row['accName'];
						$acceptance = $row['acceptance'];
						if ($acceptance == 'no'){
							echo ' <div class="alert alert-danger alert-dismissible" role="alert">
									You have an invitation to join
									<a data-target="#exampleFillIn" data-toggle="modal" href="javascript:void()" onclick ="group_info(group_id= '.$invid.', G_personalID='.$thisid.')">
									'.$account_name.'
									</a>
								   </div>' ;
						}
					}
				}
			?>

			<div class="panel-body">
				<div id="anouncement">
					<?php
						// GET ACCEPTED ACCOUNTS THAT I AM IN
						$sql1 = $db->query("SELECT * FROM `joined_ua` WHERE (groupType = 'WEDDING' or groupType = 'TIGHT') AND (`phone` = '$phone' AND acceptance = 'yes') ");
						$count_groups = mysqli_num_rows($sql1);
						$groupBody="";
						if($count_groups > 0)
							{
								while($row = mysqli_fetch_array($sql1))
								{
									$uesrId = $row['id'];
									$accountID = $row['accountID'];
									$contribution = $row['contribution'];
									$adminName = $row['adminName'];
									$currentAmount = $row['currentAmount'];
									$approve="";
									$account_name = $row['accName'];
									$starting = $row['transactionDate'];
									// COUNT MEMBERS WE ARE IN THE SAME GROUP
									$sqlGroupMember = $db->query("SELECT * FROM account_user 
																	WHERE accountID = 3 
																	AND acceptance = 'yes' ");
									$countGroupMember = mysqli_num_rows ($sqlGroupMember);
									$savings = $contribution*$countGroupMember;
									$date = Rand(1,31);
									$groupBody.= '
										<tr href="javascript:void()" onclick ="ContPage(pageID= '.$accountID.'); get_info(infoID= '.$accountID.', myID='.$uesrId.'); count_u(groupID= '.$accountID.', myID='.$uesrId.'); clear_info()">
											<td>'.$account_name.' </td>
											<td>Church</td>
											<td>15,500 Rwf</td>
											<td>1</td>
											<td>50,000 Rwf</td>
											<td>08 Dec 2016</td>
											<td>11 Feb 2016</td>
										</tr>';
								}
								echo '
									<table class="table toggle-circle" id="exampleFooAccordion">
										<thead>
											<tr>
												<th>Groups</th>
												<th>Type</th>
												<th data-hide="all">My Comitiment</th>
												<th data-hide="all">Subscriptions</th>
												<th data-hide="all">Total Contributed</th>
												<th data-hide="all">Date to Cuntribut</th>
												<th data-hide="all">Started Since</th>
											</tr>
										</thead>
										<tbody>
											'.$groupBody.'
											<tr href="javascript:void()" onclick ="ContPage(pageID= '.$accountID.'); get_info(infoID= '.$accountID.', myID='.$uesrId.'); count_u(groupID= '.$accountID.', myID='.$uesrId.'); clear_info()">
												<td>INTWALI</td>
												<td>Umudugudu</td>
												<td>'.$contribution.' Rwf</td>
												<td>'.$savings.' Rwf</td>
												<td>'.$currentAmount.' Rwf</td>
												<td>$date Feb 2016</td>
												<td>'.$starting.'</td>
											</tr>
										</tbody>
									</table>';
							}else
								{
									echo'
										You have no group, create one by clicking on <i class="icon wb-plus" aria-hidden="true"></i>';
								}
					?>
				</div>
			</div>
          	<div class="panel-footer">
				<?php echo $count_groups;?> Groups
			</div>
		  </div>
          <!-- End Panel Row Toggler -->
        </div>
      
        </div>

    </div>


<?php include ("template/footer.php");?>
</body>

</html>