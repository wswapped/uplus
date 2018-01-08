<?php
echo'<form enctype="multipart/form-data" name="myForm" id="myform" >
   <div class="form-group">
		   
		<div class="row">
			<div class="col-lg-6 col-sm-6">
			    <label class="control-label margin-bottom-15" for="contributionAmount">Contribution Amount:</label>
			    <input type="number" required class="form-control round" id="contributionAmount" required name="contributionAmount" placeholder=".00 Rwf"/><br/>
			</div>
			<div class="col-lg-6 col-sm-6">
			    <label class="control-label margin-bottom-15" for="Saving">Saving Amount</label>
			    <input type="number" class="form-control round" id="Saving" required name="Saving" placeholder=".00 Rwf"/><br/>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-sm-6">
			    <label class="control-label margin-bottom-15" for="transactionDays">Rotation Days Of Transaction:</label>
			    <input type="number" class="form-control round" id="transactionDays" required name="transactionDays" placeholder=""/><br/>
			</div>
			<div class="col-lg-6 col-sm-6">
			    <label class="control-label margin-bottom-15" for="startingDate">Starting Date</label>
			    <input type="date" class="form-control round" id="startingDate" name="startingDate"/><br/>
			</div>
		</div>
	</div>
 </form>' ;