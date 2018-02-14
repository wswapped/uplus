<!doctype html>
<?php $title = "Invoices " ?>
<html lang="en">
<?php

	include_once("db.php");
	include_once "header.php";
	include_once "class.user.php";
	include_once "class.message.php";

	$userId = $User->getUser();

	$church = $User->church($userId);

	//Getting broadcasts of user
	$cBroadcasts = $Broadcast->cBroadcast($userId, 105);
?>
	<div id="page_content">
		<div id="page_content_inner">
			<div class="card ubox">
				<div class="card-block">
					<div class="uk-grid">
						<div class="uk-modal" data-uk-modal="{center:true}" id="loadInvoice">
							<div class="md-card ubox invoicecont">
								<div class="md-card-heading">
									<img src="assets/img/logo.png" />
									<p>Uplus</p>
									<p>Kigali, Rwanda</p>
								</div>
								<div class="indet pull-right client-det">
									<p class="ifillin" data-req="name">Uwimana Monique</p>
									<p class="ifillin" data-req="church">CHRISTIAN LIFE ASSEMBLY</p>
								</div>
								<div class="clearfix"></div>
								<div class="">
									<p>Invoice NO: <span class="ifillin" data-req="invcode"></span></p>
									<p>Product: Communication Services<p>
									<p>Date: <b class="ifillin" data-req="time"></b><p>
								</div>
								<table class="uk-table invoice-table">
									<thead>
										<tr>
											<th>#</th>
											<th>Number</th>
											<th>Cost</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<div class="clearfix"></div>
								
								<div class="clearfix"></div>
							</div>
							<button class="btn btn-primary" id="invoiceprint">Print</button>
						</div>
						<div class="uk-modal" data-uk-modal="{center:true}" id="transInvoice">
							<div class="md-card ubox invoicecont">
								<div class="md-card-heading">
									<img src="assets/img/logo.png" />
									<p>Uplus, Churches</p>
									<p>Kigali, Rwanda</p>
								</div>
								<div class="indet pull-right client-det">
									<p class="ifillin" data-req="name"></p>
									<p class="ifillin" data-req="church"></p>
								</div>
								<div class="clearfix"></div>
								<div class="">
									<p>Invoice NO: <span class="ifillin" data-req="invcode"></span></p>
									<p>Product: SMS<p>
									<p>Date: <b class="ifillin" data-req="time"></b><p>
								</div>
								<!-- <table class="uk-table invoice-table">
									<thead>
										<tr>
											<th>#</th>
											<th>Number</th>
											<th>Cost</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table> -->
								<ul class="md-list">
	                                <li class="md-list-content">
	                                	<p><b class="md-list-heading">Number of SMS:</b><span class="ifillin" data-req="nsms"></span></p>
	                                </li>
	                                <li class="md-list-content">
	                                	<p><b class="md-list-heading">Cost:</b><span class="ifillin" data-req="cost"></span></p>
	                                </li>
	                                <li class="md-list-content">
	                                	<p><b class="md-list-heading">Payment mode:</b><span class="ifillin" data-req="mode"></span></p>
	                                </li>
	                                <li class="md-list-content">
	                                	<p><b class="md-list-heading">Account:</b><span class="ifillin" data-req="acc"></span></p>
	                                </li>
	                                <li class="md-list-content">
	                                	<p><b class="md-list-heading">Status:</b><span class="ifillin" data-req="status"></span></p>
	                                </li>
	                                <li class="md-list-content">
	                                	<p><b class="md-list-heading">Issue date:</b><span class="ifillin" data-req="idate"></span></p>
	                                </li>

	                                <li class="md-list-content">
	                                	<p><b class="md-list-heading">VAT:</b><span class="ifillin" data-req="vat"></span></p>
	                                </li>
	                            </ul>
								<div class="clearfix"></div>
								
								<div class="clearfix"></div>
							</div>
							<button class="btn btn-primary" id="transinvoiceprint">Print</button>
						</div>
						<div class="uk-width-medium-1-2 rdis">
							<div class="md-card">
								<div class="md-card-toolbar">
									<h4 class="card-title">Current Broadcasts</h4>
								</div>
								<div class="md-card-content">
									<?php 
										if(count($cBroadcasts)>1){ ?>
											<table class="uk-table" cellspacing=0 width="100%">
												<thead>
													<tr>
														<th class="sorthead"># <span class="caret"> </span></th>
														<th class="sorthead">Date<span class="caret"></span></th>
														<th class="sorthead">Target number <span class="caret"></span></th>
														<th class="sorthead">Message: <span class="caret"></span></th>
														<!-- <th class="sorthead">Channels<span class="caret"></span></th> -->
														<th class="sorthead">Cost(RWF) <span class="caret"></span></th>                
														<th class="sorthead">Actions <span class="caret"></span></th>
													</tr>
												</thead>
												<tbody class="mtable">
													<?php
															for($n=0; $n<count($cBroadcasts); $n++){
																$broad = $cBroadcasts[$n];
																$senttime = new dateTime($broad['time']);
																$senttime = $senttime->format('d M Y - H:i:s');
																$ntarget = $Broadcast->ntarget($broad['id']);
																$nchannels = $Broadcast->channels($broad['id']);
																$cost = $Broadcast->cost($broad['id']);

																//composing short message
																$maxchar = 30;
																if(!empty($broad['subject'])){
																	$smsg = strlen($broad['subject'])<$maxchar?$broad['subject']:substr($broad['subject'], 0, $maxchar);
																}else{
																	$smsg = strlen($broad['message'])<$maxchar?$broad['message']:substr($broad['message'], 0, $maxchar);
																}
																?>
																<tr class="broadMore" data-mid="<?php echo $broad['id']; ?>">
																	<td class="viewmore"><?php echo $n+1; ?></td>
																	<td><?php echo $senttime; ?></td>
																	<td><?php echo $ntarget; ?></td>
																	<td class="viewmore"><?php echo $smsg; ?></td>
																	<!-- <td><?php //echo implode(', ', array_keys($nchannels)); ?></td> -->
																	<td><?php echo $cost['total']; ?></td>
																	<td><button class="btn btn-primary pull-right md-btn-wave-light waves-effect waves-button waves-light showInvoice" data-mid="<?php echo $broad['id']; ?>">Invoice</button></td>
																</tr>
																<?php
															}
															?>
														
												</tbody>
											</table>
									<?php
									}else{
										 ?>
										<p class="card-text">It looks like you haven't sent any message.</p>
										<button href="#" class="btn btn-primary pull-right loadView" data-pagetoggle='send'>Send Messages</button>
										<div class="clearfix"></div>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="uk-width-medium-1-2">
							<div class="md-card">
								<div class="md-card-toolbar">
									<h4 class="card-title">Transactions <button class="loadView btn btn-default pull-right" data-pagetoggle="shop" id="buysms">Buy SMS</button></h4>
								</div>
								<div class="md-card-content">
									<div class="uk-overflow-container">
										<table id="dt_tableExport" class="uk-table dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="dt_tableExport_info" style="width: 100%;">
		                                <thead>
		                                    <tr role="row"><th class="sorting" tabindex="0" aria-controls="dt_tableExport" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 8px;">#</th><th class="sorting" tabindex="0" aria-controls="dt_tableExport" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 181px;">Account</th><th class="sorting" tabindex="0" aria-controls="dt_tableExport" rowspan="1" colspan="1" aria-label="Branche: activate to sort column ascending" style="width: 53px;">Mode</th><th class="sorting" tabindex="0" aria-controls="dt_tableExport" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending" style="width: 62px;">Number</th><th class="sorting" tabindex="0" aria-controls="dt_tableExport" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 164px;">Cost</th><th class="sorting" tabindex="0" aria-controls="dt_tableExport" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending" style="width: 52px;">Date</th><th class="sorting" tabindex="0" aria-controls="dt_tableExport" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 39px;">Action</th></tr>
		                                </thead>
		                                <tbody>
		                                	<?php
		                                		$trans = $db->query("SELECT * FROM transactions") or die("Cant get Transactions ".$db->error);
		                                		$transactions = array();
		                                		$n=1;
		                                		while ($data = $trans->fetch_assoc()) {
		                                			?>
		                                				<tr role="row" class="<?php echo $n%2==0?'even':'odd'; ?>">
		                                					<td><?php echo $n; ?></td>
		                                					<td><?php echo $data['phone']; ?></td>
		                                					<td><?php echo $data['mode']; ?></td>
		                                					<td><?php echo $data['nsms']; ?></td>
		                                					<td><?php echo number_format($data['cost']); ?>Frw</td>
		                                					<td><?php echo $data['date'];; ?></td>
		                                					<td><button data-tid = "<?php echo $data['id']; ?>" class="md-btn md-btn-default showTransactionInvoice"><i class="md-icon material-icons">print</i></button></td>
		                                				</tr>
		                                			<?php
		                                			$n++;
		                                		}
		                                	?>
		                                	
		                            	</tbody>
		                            	</table>
		                        	</div>
		                        </div>
	                        </div>
						</div>  
					</div>     
						
				</div>
			</div>
		</div>
	</div>

	<div>
		
	</div>

	<div class="uk-modal" id="moreBroad">
	    <div class="uk-modal-dialog">
	        <div class="uk-modal-header uk-tile uk-tile-default"><p class="btn btn-primary broad-date">Broadcast message details on <span class="fillin" data-req="time"></span></p></div>
	        <p class="broadSubject">Subject: <span class="fillin" data-req='subject'></span></p>
	        <p class="broadMessage">Message: <p class="fillin" data-req='message'></p></p>
	        <p>Time: <span class="fillin" data-req='time'></span></p>
	        <p class="ntarget">Number of recipients: <span class="fillin" data-req="ntarget"></span></p>
	        <p class="channels"></p>
	        <p class="delivery"></p>        
	        <div class="uk-modal-footer uk-text-right">
	            <button type="button" class="uk-button uk-modal-close">Cancel</button>
	            <button class="md-btn md-btn-wave waves-effect waves-button showInvoice">Invoice</button>
	        </div>
	    </div>
	</div>

	<?php include_once "broad-shop.php"; ?>

	
	<!-- google web fonts -->
	<script>
		WebFontConfig = {
			google: {
				families: [
					'Source+Code+Pro:400,700:latin',
					'Roboto:400,300,500,700,400italic:latin'
				]
			}
		};
		(function() {
			var wf = document.createElement('script');
			wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
			'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		})();
	</script>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jspdf.js"></script>
	<script type="text/javascript" src="js/pdfFromHTML.js"></script>

	<!-- common functions -->
	<script src="assets/js/common.min.js"></script>
	<!-- uikit functions -->
	<script src="assets/js/uikit_custom.min.js"></script>
	<!-- altair common functions/helpers -->
	<script src="assets/js/altair_admin_common.min.js"></script>

	<!-- page specific plugins -->
	<!-- d3 -->
	<script src="bower_components/d3/d3.min.js"></script>
	<!-- metrics graphics (charts) -->
	<script src="bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>
	<!-- chartist (charts) -->
	<script src="bower_components/chartist/dist/chartist.min.js"></script>
	<script src="bower_components/maplace-js/dist/maplace.min.js"></script>
	<!-- peity (small charts) -->
	<script src="bower_components/peity/jquery.peity.min.js"></script>
	<!-- easy-pie-chart (circular statistics) -->
	<script src="bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
	<!-- countUp -->
	<script src="bower_components/countUp.js/dist/countUp.min.js"></script>
	<!-- handlebars.js -->
	<script src="bower_components/handlebars/handlebars.min.js"></script>
	<script src="assets/js/custom/handlebars_helpers.min.js"></script>
	<!-- CLNDR -->
	<script src="bower_components/clndr/clndr.min.js"></script>

	<!--  dashbord functions -->
	<script src="assets/js/pages/dashboard.min.js"></script>
	
	<script>
		$(function() {
			if(isHighDensity()) {
				$.getScript( "bower_components/dense/src/dense.js", function() {
					// enable hires images
					altair_helpers.retina_images();
				});
			}
			if(Modernizr.touch) {
				// fastClick (touch devices)
				FastClick.attach(document.body);
			}
		});
		$window.load(function() {
			// ie fixes
			altair_helpers.ie_fix();
		});
	</script>
	<script type="text/javascript">
		var churchID=<?php echo $churchID; ?>;
		$(".broadMore .viewmore").on('click', function(){
	        broadID = $(this).parent().attr('data-mid');
	        log("Loading more for "+broadID);
	        $.post('api/msg.php', {act:'det', id:broadID}, function(data){
	            try{
	                ret  = JSON.parse(data);
	                if(ret.status == 1){
	                    //Successfully fetched data
	                    moreBroad = UIkit.modal("#moreBroad");
	                    moreBroad.show();
	                    ret  = ret.data;
	                    log(ret);

	                    timefill = $(".fillin[data-req='time']");
	                    for(n=0; n<timefill.length; n++){
	                        $(timefill[n]).html(ret.date)
	                    }

	                    subfill = $(".fillin[data-req='sub']");
	                    for(n=0; n<timefill.length; n++){
	                        $(subfill[n]).html(ret.sub)
	                    }

	                    msgfill = $(".fillin[data-req='message']");
	                    for(n=0; n<timefill.length; n++){
	                        $(msgfill[n]).html(ret.message)
	                    }

	                    ntfill = $(".fillin[data-req='ntarget']");
	                    for(n=0; n<timefill.length; n++){
	                        $(ntfill[n]).html(ret.ntarget)
	                    }

	                    $(".channels").html("Channels:");
	                    for(channelDet in ret.channels){
	                        log(channelDet)
	                        $(".channels").append("<li>"+channelDet+" : <b>"+ret.channels[channelDet]+"</b></li>");
	                    }
	                                    

	                }else{
	                    log("Error fetching data");
	                    log(ret.data);
	                }
	            }catch(err){
	                log("Error parsing JSON");
	                log(err)
	            }
	        })
	    });

	    $("#invoiceprint").on('click', function(){
	    	alert()
	        btnText = $(this).html()
	        $("#loadInvoice .client-det").append("<li></li><li></li><li></li>")
	                        .prepend("<b>Client:<b><li></li><li></li><li></li>")
	                        $(this).html('')
	        HTMLtoPDF(".invoicecont");
	        return $(this).html(btnText);
	    })

	     $("#transinvoiceprint").on('click', function(){
	     	$("#transinvoiceprint .invoicecont").print();
	    	// alert()
	     //    btnText = $(this).html()
	     //    $("#loadInvoice .client-det").append("<li></li><li></li><li></li>")
	     //                    .prepend("<b>Client:<b><li></li><li></li><li></li>")
	     //                    $(this).html('')
	     //    HTMLtoPDF("#transinvoiceprint .invoicecont");
	        // return $(this).html(btnText);
	    })

	    $(".showTransactionInvoice").on('click', function(){
	        transId = $(this).attr('data-tid');

	        mod = UIkit.modal("#transInvoice");
	        mod.show();

	        //Getting current use details
	        <?php
	            $userID = $User->getUser();
	            $churchDet = $User->churchDet($userID);
	        ?>
	        usernames = "<?php echo implode(' ', $User->id2name($userID) ); ?>";
	        church = "<?php echo $churchDet['church']?>";

	        fillindata('ifillin', 'name', usernames);
	        fillindata('ifillin', 'church', church);
	        fillindata('ifillin', 'time', new Date());

	        $.post('api/index.php', {action:'invoice', id:transId}, function(data){
	            try{
	                // ret  = JSON.parse(data);
	                ret  = JSON.parse(data);
	                if(ret.status == 1){
	                    // Successfully fetched data
	                    
	                    fillindata('ifillin', 'nsms', ret.nsms);
	                    fillindata('ifillin', 'cost', ret.cost+" Frw");
	                    fillindata('ifillin', 'mode', ret.mode);
	                    fillindata('ifillin', 'acc', ret.phone);
	                    fillindata('ifillin', 'status', ret.transaction_status);
	                    fillindata('ifillin', 'idate', ret.date);
	                    fillindata('ifillin', 'vat', (ret.cost*.08)+" Frw");

	                }else{
	                    log("Error fetching data");
	                    log(ret.data);
	                }
	            }catch(err){
	                log("Error parsing Transactions JSON");
	                log(err)
	            }
	        })
	    });

	    $(".showInvoice").on('click', function(){
	        messageID = $(this).attr('data-mid');

	        mod = UIkit.modal("#loadInvoice");
	        mod.show();

	        //Getting current use details
	        <?php
	            $userID = $User->getUser();
	            $churchDet = $User->churchDet($userID);
	        ?>
	        usernames = "<?php echo implode(' ', $User->id2name($userID) ); ?>";
	        church = "<?php echo $churchDet['church']." - ".$churchDet['branch'] ?>";

	        fillindata('ifillin', 'name', usernames);
	        fillindata('ifillin', 'church', church);

	        $.post('api/msg.php', {act:'det', id:messageID}, function(data){
	            try{
	                ret  = JSON.parse(data);
	                if(ret.status == 1){
	                    //Successfully fetched data
	                    ret  = ret.data;
	                    fillindata('ifillin', 'time', ret.time);
	                    channels = ret.channels;

	                    log(ret);
	                    productselem = $(".invoice-table tbody").html("");
	                    for(chan in channels){
	                        productselem.prepend("<tr><td>"+chan+"</td><td>"+channels[chan]+"</td><td>"+ret.cost[chan]+"</td></tr>");
	                    }
	                    productselem.append("<tr class='uk-text-bold'><td>Total</td><td>"+Object.values(ret.channels).reduce((a, b) => parseInt(a) + parseInt(b), 0)+"</td><td>"+ret.cost.total+"</td></tr>");

	                }else{
	                    log("Error fetching data");
	                    log(ret.data);
	                }
	            }catch(err){
	                log("Error parsing JSON");
	                log(err)
	            }
	        })
	    });

	    function fillindata(elem,  tagname, data){
	    	selector = "."+elem+"[data-req='"+tagname+"']";
	    	log(selector);
	        fillelem = $(selector);
	        for(n=0; n<fillelem.length; n++){
	            $(fillelem[n]).html(data);
	        }
	    }
</script>
<script type="text/javascript" src="js/custom.js"></script>


<script type="text/javascript">
	$("#buysms").on('click', function(){
		buyModal = UIkit.modal('#buymodal');
		log(buymodal)
		buyModal.show();
	});
	$("#phone-number").on("keypress", function(){
		if($(this).val().length == '9'){
			return false;
		}
	})
	$("#nsms").on("keyup", function(e){
		smsprice = $("#smsunitprice span").html();
		console.log(e)
		$("#smscost span").html(smsprice*$(this).val());
	})
</script>

</body>
</html>
<!-- Localized -->