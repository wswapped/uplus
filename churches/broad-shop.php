<div class="uk-modal" id="buymodal">
	<div class="uk-modal-dialog">
		<div class="uk-modal-header uk-tile uk-tile-default"><h3 class="">Buy SMS</h3></div>
		
		<div class="md-card">
			<div class="md-card-content">
				<form id="buyform" enctype="multipart/form-data">
					<div class="md-input-wrapper">
						<div class="phin">
							<span class="input-like">+250</span><input type="number" min="72000000" max="789999999" name="phone" id="phone-number" class="md-input number-input" placeholder="Phone number">
							<div class="phone-error"></div>
						</div>                     
						
						<span class="md-input-bar "></span>

					</div>
					<span class="fex uk-text-mute">ex. 726396285</span>
					<div class="md-input-wrapper">
						<input type="number" min="1" id="nsms" name="nsms" class="md-input" placeholder="Number of SMS"/>
						<span class="md-input-bar "></span>
					</div>
					<input type="hidden" value="<?php echo $churchID; ?>" id='sendchurch'>

					<div class="ubox">
						<div id="smsunitprice">Price Per SMS: <span><?php echo SMS_PRICE; ?></span></div>
						<div id="smscost">Total cost: <span></span></div>
					</div>

					<p class="uk-text-small uk-text-muted">A prompt will be sent to ask for comfirmation on phone provided</p>
					<input type="submit" class="md-btn md-btn-success pull-right" value="Buy">
					<!-- <button type="submit" class="md-btn md-btn-success pull-right" value=""></button> -->
					<div class="clearfix"></div>
					<div id="sendStatus"></div>
				</form>
			</div>
		</div>
		<div class="uk-modal-footer uk-text-right">
			<button type="submit" class="uk-button uk-modal-close">Cancel</button>
			<!-- <button class="btn btn-primary pull-right md-btn-wave-light waves-effect waves-button waves-light showInvoice">Invoice</button> -->
		</div>
	</div>
</div>