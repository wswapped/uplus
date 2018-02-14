<div class="uk-modal" id="buymodal">
	<div class="uk-modal-dialog">
		<div class="uk-modal-header uk-tile uk-tile-default"><h3 class="">Buy SMS</h3></div>
		
		<form id="buyform" enctype="multipart/form-data">
			<div class="md-card">
				<div class="md-card-content">				
					<div class="md-input-wrapper">
						<div class="phin">
							<span class="input-like">+250</span><input type="number" min="72000000" max="789999999" name="phone" id="phone-number" class="md-input number-input" placeholder="Phone number">
							<div class="phone-error"></div>
						</div>                     
						
						<span class="md-input-bar "></span>
					</div>
					<div class="md-input-wrapper">
						<input type="number" min="1" id="nsms" name="nsms" class="md-input" placeholder="Number of SMS"/>
						<span class="md-input-bar "></span>
					</div>
					<input type="hidden" value="<?php echo $churchID; ?>" id='sendchurch'>

					<div class="ubox">
						<div id="smsunitprice">Price Per SMS: <span><?php echo SMS_PRICE; ?></span></div>
						<div id="smscost">Total cost: <span>0</span></div>
					</div>
					<div class="clearfix"></div>
					<div id="sendStatus"></div>				
				</div>
			</div>
			<div class="uk-modal-footer uk-text-right">
				<button class="md-btn md-btn-danger pull-left uk-modal-close">Cancel</button>
				<input type="submit" class="md-btn md-btn-success pull-right" value="Buy">
			</div>
		</form>
	</div>
</div>