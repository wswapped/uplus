<!-- PENDINGS Alert -->
<?php 
	$n=0;
	$sql4 = $db->query("SELECT * FROM users WHERE name ='' OR name IS NULL AND id ='$thisid'");
	$count_profile_alerts = mysqli_num_rows($sql4);
  
	if($count_profile_alerts >0){
		echo'<div class="modal fade" id="examplePositionCenter" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1" style="display: none;">
			  <div class="modal-dialog modal-center">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">NOTIFICATION</h4>
				  </div>
				  <div class="modal-body">';
		if($count_profile_alerts > 0){
				while($row = mysqli_fetch_array($sql4))
				{
				  echo ' <div class="alert alert-danger alert-dismissible" role="alert">
						You have not completed your profile
						<a data-target="#exampleFillIn" data-toggle="modal" href="javascript:void()" onclick ="profileFaceBook(personalID='.$thisid.')" data-dismiss="modal">
							Complete it
						</a>
					
						</a>
						 </div>' ;
				}
			}
		
   echo'</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning waves-effect waves-light" data-dismiss="modal">Ignore</button>
      </div>
    </div>
  </div>
</div>';
  }
?>

<!-- INVITATION POPUP DISPLAY -->
	<div class="modal fade modal-fill-in" id="exampleFillIn" aria-hidden="false" aria-labelledby="exampleFillIn" role="dialog" tabindex="-1" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" ><b>Profile Information</b></h4>
						</div>
						<div class="modal-body" id="G_info">
						<p>
							<form method="post" action="scripts/testlog.php" enctype="multipart/form-data" >
							<div class="row">
								<div class="col-md-12">Full Name 
									<input class="form-control" value="<?php echo $name;?>" name="profileName"/>
								</div>
								<div class="col-md-12">Email
									<input class="form-control" value="<?php echo $email;?>" name="profileEmail"/>
								</div>
								<div class="col-md-12">Phone
									<input class="form-control" disabled value="<?php echo $phone;?>"/>
									<input  hidden value="<?php echo $phone;?>" name="profilePhone"/>
									<input  hidden value="<?php echo $thisid;?>" name="profileId"/>
								</div>
								<div class="col-md-12">Gender
									<select class="form-control" name="profileGender">
										<option><?php echo $gender;?></option>
										<option>Male</option>
										<option>Female</option>
									</select>
								</div>
								<div class="col-md-12">Profession
									<input class="form-control" value="<?php echo $profession;?>" name="profileProfession"/>
								</div>
								<div class="col-md-12">Bio 
									<textarea class="form-control" name="profileBio"><?php echo $bio;?></textarea>
								</div>
								<div class="col-md-12">Profile Picture 
									<input class="form-control" type="file" name="fileField"/>
								</div>
							</div>
						</p>
						<input type="submit" name="accept_invitation" value="updateProfile" class="btn btn-primary" id="exampleWarningCancel"/>
						</form></div>
                      
			</div>
		</div>
	</div>
	<!-- End INVITATIONS POPUP DISPLAY -->