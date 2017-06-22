
<div class="col-lg-4">
  <form action="profile.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
   <ul class="blocks blocks-100 blocks-xlg-12 blocks-md-12 blocks-sm-12" data-plugin="masonry">
	<li class="masonry-item">
	  <div class="widget widget-article widget-shadow">
		<div class="widget-header cover">
			<img class="cover-image" src="proimg/<?php echo $thisid;?>.jpg" alt="...">
			<!--<input type="file" name="fileField" id="fileField" data-plugin="dropify" data-default-file="../profiles/<?php echo $thisid;?>.jpg"/>-->
		</div>
		<div class="widget-body" style="padding: 0px 15px 15px 15px;">
		  <h3 class="widget-title">
			<div class="form-group form-material floating">
			  <input type="text" class="form-control input-lg empty" name="fullname" required value="<?php echo $name;?>" id="fullname">
			  <label class="floating-label"><?php echo $label;?></label>
			</div>
		  </h3>
		  <p class="widget-metas ">
			Joined uPlus on
			<?php echo $dateJoin;?>
		  </p>
		  <i class="icon fa-phone" aria-hidden="true"></i> +25<?php echo $phone;?>
		  <div class="widget-body-footer">
			<input type="submit" value="Change" class="btn btn-outline btn-success"/>
		  </div>
		</div>
	  </div>
	</li>
   </ul>  
  </form>
</div>
		