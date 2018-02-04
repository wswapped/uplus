<!doctype html>
<html lang="en">
<?php
    $title = "Groups";
    include("header.php");
    include_once("functions.php");

    //Getting groups in church
    $query = $conn->query("SELECT groups.*, branches.name as branchname FROM groups JOIN branches ON groups.branchid = branches.id WHERE branches.church = \"$churchID\" ") or die("Cant get groups ".$conn->error);

    $groups = array();
?>
    <div id="page_content">
        <?php
            if(!empty($_GET['act']) && $_GET['act'] == 'edit'){
                $group = $_GET['group'];

                $groupData = $conn->query("SELECT groups.*, members.name as representative FROM groups JOIN members ON groups.representative = members.id WHERE groups.id = \"$group\" ") or die("error getting group data ".$conn->error);
                $groupData = $groupData->fetch_assoc();


                ?>
                    <div id="page_content_inner">
                        <div class="heading_a uk-grid uk-margin-bottom uk-grid-width-large-1-2">
                            <div class="uk-row-first"><h4 class=""><?php echo $churchname; ?> - Groups</h4></div>
                        </div>

                        
                        <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                            <div class="uk-width-large-4-4">
                                 <div class="md-card">
                                    <div class="md-card-toolbar"><h3 class="md-card-toolbar-heading-text">Edit Group</h3>
                                    </div>
                                    <div class="md-card-content">
                                        <form action="operations.php" method="POST">
                                            <div class="md-input-wrapper">
                                                <select name="membertype" data-md-selectize>
                                                    <option value="">Type...</option>
                                                    <option value="VISITOR">VISITOR<option>
                                                    <option value="FULL">FULL</option>
                                                </select>
                                                <span class="md-input-bar "></span>
                                            </div>
                                            <select name="membertype" data-md-selectize="" tabindex="-1" style="display: none;" class="selectized"><option value="FULL" selected="selected">FULL</option></select>
                                            <div class="md-input-wrapper md-input-filled">
                                                <label>Group Name</label>
                                                <input type="text" name="membername" value="<?php echo $groupData['name']; ?>" class="md-input">
                                                <span class="md-input-bar "></span>
                                            </div>
                                            <div class="parsley-row md-input-success">
                                                <label for="val_select" class="uk-form-label">Operation Branch*</label>
                                                <select id="val_select" data-md-selectize="" tabindex="-1" style="display: none;" class="selectized" required="" data-parsley-id="29">
                                                    <?php
                                                        $branches = churchbranches($churchID);
                                                        foreach ($branches as $key => $branch) {
                                                            # code...
                                                            ?>
                                                                <option value="<?php echo $branch['id']; ?>"><?php echo $branch['name']; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                                <div class="selectize_fix"></div>
                                            </div>
                                            <!-- <div class="md-input-wrapper md-input-filled">
                                                <label>Operation Branch</label>
                                                <select class="selectized">
                                                    <?php
                                                        $branches = churchbranches($churchID);
                                                        foreach ($branches as $key => $branch) {
                                                            # code...
                                                            ?>
                                                                <option value="<?php echo $branch['id']; ?>"><?php echo $branch['name']; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div> -->
                                            <div class="md-input-wrapper md-input-filled">
                                                <label>Type</label>
                                                <input type="text" name="memberemail" class="md-input" value="<?php echo $groupData['type'] ?>">
                                                <span class="md-input-bar "></span>
                                            </div>
                                            <div class="md-input-wrapper md-input-filled">
                                                <label>Representative</label>
                                                <input type="text" name="memberlocation" value="ok" class="md-input">
                                                    <span class="md-input-bar "></span>
                                            </div>

                                            <div class="selectize_fix"></div>
                                            <div class="uk-grid">
                                                <div class="uk-width-1-1">
                                                    <button class="md-btn md-btn-success">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>              
                    </div>
                <?php

            }else{

            	//getting groups in church
                $groups = list_groups($churchID);
        ?>
        <div id="page_content_inner">        	
        	<div class="heading_a uk-grid uk-margin-bottom uk-grid-width-large-1-2">
                <div class="uk-row-first"><h4 class=""><?php echo $churchname; ?> - Groups</h4></div>
            </div>
        	<div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-1-2 uk-row-first">
                            <div class="uk-vertical-align">
                                <div class="uk-vertical-align-middle">
                                    <ul id="contact_list_filter" class="uk-subnav uk-subnav-pill uk-margin-remove">
                                        <li class="uk-active" data-uk-filter=""><a href="#">All</a></li>
                                        <?php
                                        	//looping through groups
                                        	for($n=0; $n<count($groups); $n++){
                                        		$groupname = $groups[$n]['name'];
                                        		?>
                                        			<li data-uk-filter="<?php echo $groupname; ?>"><a href="#"><?php echo $groupname; ?></a></li>
                                        		<?php
                                        	}
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="md-input-wrapper"><label for="contact_list_search">Search... (min 3 char.)</label><input class="md-input" type="text" id="contact_list_search"><span class="md-input-bar "></span></div>
                            
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="uk-grid-width-medium-1-2 uk-grid-width-large-1-3" id="contact_list" style="position: relative; margin-left: -20px; height: 2852px;">
            	<?php
            		//looping through groups
                	for($n=0; $n<count($groups); $n++){
                		$group = $groups[$n]; //current group
                		$groupname = $group['name'];
                		$branchname = $group['branchname'];
                		$group_img = $group['profile_picture'];

                		$repdata = user_details($group['representative']);
                		$repemail = $repdata['email'];
                		$repphone = $repdata['phone'];
                		?>
                			<div data-uk-filter="<?php echo $groupname.", $branchname"; ?>" data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 20px; padding-bottom: 20px; top: 0px; opacity: 1; left: 0px;">
			                    <div class="md-card md-card-hover md-card-horizontal">
			                        <div class="md-card-head">
			                            <div class="md-card-head-menu" data-uk-dropdown="{pos:'bottom-left'}">
			                                <i class="md-icon material-icons"></i>
			                                <div class="uk-dropdown uk-dropdown-small">
			                                    <ul class="uk-nav">
			                                        <li><a href="#">Edit</a></li>
			                                        <li><a href="#">Remove</a></li>
			                                    </ul>
			                                </div>
			                            </div>
			                            <div class="uk-text-center">
			                                <img class="md-card-head-avatar" src="<?php echo $group_img;  ?>" alt="">
			                            </div>
			                            <h3 class="md-card-head-text uk-text-center">
			                                <?php echo $groupname; ?>                                <span class="uk-text-truncate"><?php echo $branchname; ?> </span>
			                            </h3>
			                        </div>
			                        <div class="md-card-content">
			                            <ul class="md-list">
			                                <li>
			                                    <div class="md-list-content">
			                                        <span class="md-list-heading">Info</span>
			                                        <span class="uk-text-small uk-text-muted">Type: <?php echo ucfirst($group['type']); ?></span>
			                                        <span class="uk-text-small uk-text-muted">Location: <?php echo $group['location']; ?></span>
			                                    </div>
			                                </li>
			                                <li>
			                                    <div class="md-list-content">
			                                        <span class="md-list-heading">Email</span>
			                                        <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo $repemail; ?></span>
			                                    </div>
			                                </li>
			                                <li>
			                                    <div class="md-list-content">
			                                        <span class="md-list-heading">Phone</span>
			                                        <span class="uk-text-small uk-text-muted"><?php echo $repphone; ?></span>
			                                    </div>
			                                </li>
			                            </ul>
			                        </div>
			                    </div>
			                </div>
                		<?php
                	}
            	?>
            </div>
            <div class="md-fab-wrapper ">
                <!-- <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">add</i></a> -->
                <button class="md-fab md-fab-small md-fab-warning d_inline" id="launch_group_create" href="javascript:void(0)" data-uk-modal="{target:'#modal_default'}"><i class="material-icons">group_add</i></button>
            </div>             
        </div>
        <?php } ?>
    </div>
    <div class="container">
    	<div class="md-input-wrapper">
    		<input type="text" id="loctest1" class="md-input"><span class="md-input-bar "></span>
    	</div>
    </div>


    <div class="uk-modal" id="modal_default" aria-hidden="true" style="display: none; overflow-y: auto;">
        <div class="uk-modal-dialog" style="width:900px; top: 339.5px;">
            <div class="uk-modal-header uk-tile uk-tile-default">
                <h3 class="d_inline">New Group</h3><button type="button" class="uk-modal-close uk-close d_inline pull-right"></button>
            </div>

            <form action="operations.php" method="POST">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">                  
                            <div class="uk-width-medium-1-2 uk-row-first">

                                    <div class="uk-form-row">
                                        <div class="md-input-wrapper md-input-filled">
                                            <select id="group_type_select" class="md-input">
                                                <option value="" disabled="" selected="" hidden="">Select type...</option>
                                                <option value="cell">Cell group</option>
                                                <option value="prayer">Prayer group</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <span class="md-input-bar "></span>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="uk-grid" data-uk-grid-margin="">
                                            <div class="uk-width-medium-2-2 uk-row-first">
                                                <div class="md-input-wrapper" id="group_name-cont"><label>Group name</label><input type="text" id="group_name" class="md-input"><span class="md-input-bar "></span></div>                                       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="md-input-wrapper"><label>Enter location</label><input type="text" id="group_location" class="md-input"><span class="md-input-bar "></span></div>     
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="uk-grid" data-uk-grid-margin="">
                                            <div class="uk-width-medium-2-2 uk-row-first">
                                                <div class="md-input-wrapper md-input-filled">
	                                                <select id="group_rep" class="md-input">
												      <option value="">Choose a representative</option>
												      <?php
												      	//Going tp add members of the churches
												      	$members = church_members($churchID);
												      	foreach ($members as $key => $member) {
												      		?>
												      			<option value="<?php echo $member['id']; ?>"><?php echo $member['name']; ?></option>
												      		<?php
												      	}
												      ?>
												    </select>
												</div>                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                    	<div class="dropify-wrapper"><div class="dropify-message"><span class="file-icon"></span> <p>Drag and drop a file here or click</p><p class="dropify-error">Ooops, something wrong appended.</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" id="input-fgroup-pic" class="dropify"><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
			                        </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div id="group_map"></div>
                            </div>
                        </div>
                    </div>	
                </div>

                <div class="uk-modal-footer uk-text-right">
                    <button class="md-btn md-btn-danger pull-left uk-modal-close">Cancel</button>
                    <div class="md-input-wrapper">
                        <button id="group_add_submit" class="md-btn md-btn-success pull-right">Save</button>
                    </div>
                </div>
            </form> 
        </div>
    </div>

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

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!-- page specific plugins -->
    <!-- datatables -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <!-- datatables buttons-->
    <script src="bower_components/datatables-buttons/js/dataTables.buttons.js"></script>
    <script src="assets/js/custom/datatables/buttons.uikit.js"></script>
    <script src="bower_components/jszip/dist/jszip.min.js"></script>
    <script src="bower_components/pdfmake/build/pdfmake.min.js"></script>
    <script src="bower_components/pdfmake/build/vfs_fonts.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.colVis.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.html5.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.print.js"></script>
    <script src="bower_components/select2/select2.min.js"></script>
    
      <!-- datatables custom integration -->
    <script src="assets/js/custom/datatables/datatables.uikit.min.js"></script>

    <!--  datatables functions -->
    <script src="assets/js/pages/plugins_datatables.min.js"></script>
    
    <!-- d3 -->
    <script src="bower_components/d3/d3.min.js"></script>
    <!-- metrics graphics (charts) -->
    <script src="bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>
    <!-- c3.js (charts) -->
    <script src="bower_components/c3js-chart/c3.min.js"></script>
    <!-- chartist -->
    <!-- <script src="bower_components/chartist/dist/chartist.min.js"></script> -->

    <!--  charts functions -->
    <!-- <script src="assets/js/pages/plugins_charts.min.js"></script> -->
    

    <script src="bower_components/dropify/dist/js/dropify.min.js"></script>

    <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>

    <!-- <script src="bower_components/selectize/selectize.min.js"></script> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/standalone/selectize.min.js'></script>
    

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

        $("#group_type_select").on('change', function(){
            type = $(this).val();
            //todo: handle naming
        });



        $("#group_add_submit").on('click', function(e){
            e.preventDefault();
            //when the group is to be created

            //getting values
            grouptype = $("#group_type_select").val();
            groupname = $("#group_name").val();
            grouplocation = $("#group_location").val();
            rep = $("#group_rep").val();
            file = _("input-fgroup-pic").files[0];

            if(grouptype && groupname && grouplocation && rep){
                fields = {action:'create_group', name:groupname, type:grouptype, location:grouplocation, profile_picture:file, rep:rep, church:<?php echo $churchID; ?>};

                var file = _("input-fgroup-pic").files[0];
                var formdata = new FormData();

                for (var prop in fields) {
                    formdata.append(prop, fields[prop]);
                }
                formdata.append("action", 'create_group');
                var ajax = new XMLHttpRequest();
                // ajax.upload.addEventListener("progress", progressHandler, false);
                ajax.addEventListener("load", function(status, data){
                	log(data);
                }, false);
                // ajax.addEventListener("error", errorHandler, false);
                // ajax.addEventListener("abort", abortHandler, false);
                ajax.open("POST", "api/index.php");
                ajax.send(formdata);

                console.log("Submitted")
            }else{
                //He should filin everythin
                alert("Please fill in all the details to create group");
                return 0;
            }
        });

        // $("#group_rep").keypress(function(e){
        //     key = e.key;
        //     if(isNaN(key)){
        //         alert("Only numbers allowed")
        //         return false;
        //     }
        // });

        $("#input-fgroup-pic").dropify();

        

    </script>
    <script src="js/uploadFile.js"></script>
    <script async defer src="http://maps.google.com/maps/api/js?key=AIzaSyAlKttaE2WuI1xKpvt-f7dBOzcBEHRaUBA&libraries=places&callback=initMap"></script>
    </script>
    <script type="text/javascript">
        var google;
        function initMap() {
        var kigali = {lat:-1.991019, lng:30.096819};
        var map = new google.maps.Map(document.getElementById('group_map'), {
          zoom: 10,
          center: kigali
        });
        var marker = new google.maps.Marker({
          position: kigali,
          map: map
        });

        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('loctest1'));
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
        	alert(0)
			var place = autocomplete.getPlace();
			placename = place.name;
			lat = place.geometry.location.lat();
			lng = place.geometry.location.lng();
			log(placename)
        });
      };

    $("#launch_group_create").on('click', function(){
    	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('loctestF'));
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
        	alert(0)
			var place = autocomplete.getPlace();
			placename = place.name;
			lat = place.geometry.location.lat();
			lng = place.geometry.location.lng();
			log(placename)
        });
    })
      function log(data){
        console.log(data)
      }

 //      $("#cgroup").selectize({
	//     options: [
	//         {id: 'avenger', make: 'dodge', model: 'Avenger'},
	//         {id: 'caliber', make: 'dodge', model: 'Caliber'},
	//         {id: 'caravan-grand-passenger', make: 'dodge', model: 'Caravan Grand Passenger'},
	//         {id: 'challenger', make: 'dodge', model: 'Challenger'},
	//         {id: 'ram-1500', make: 'dodge', model: 'Ram 1500'},
	//         {id: 'viper', make: 'dodge', model: 'Viper'},
	//         {id: 'a3', make: 'audi', model: 'A3'},
	//         {id: 'a6', make: 'audi', model: 'A6'},
	//         {id: 'r8', make: 'audi', model: 'R8'},
	//         {id: 'rs-4', make: 'audi', model: 'RS 4'},
	//         {id: 's4', make: 'audi', model: 'S4'},
	//         {id: 's8', make: 'audi', model: 'S8'},
	//         {id: 'tt', make: 'audi', model: 'TT'},
	//         {id: 'avalanche', make: 'chevrolet', model: 'Avalanche'},
	//         {id: 'aveo', make: 'chevrolet', model: 'Aveo'},
	//         {id: 'cobalt', make: 'chevrolet', model: 'Cobalt'},
	//         {id: 'silverado', make: 'chevrolet', model: 'Silverado'},
	//         {id: 'suburban', make: 'chevrolet', model: 'Suburban'},
	//         {id: 'tahoe', make: 'chevrolet', model: 'Tahoe'},
	//         {id: 'trail-blazer', make: 'chevrolet', model: 'TrailBlazer'},
	//     ],
	//     optgroups: [
	//         {id: 'dodge', name: 'Dodge'},
	//         {id: 'audi', name: 'Audi'},
	//         {id: 'chevrolet', name: 'Chevrolet'}
	//     ],
	//     labelField: 'model',
	//     valueField: 'id',
	//     optgroupField: 'make',
	//     optgroupLabelField: 'name',
	//     optgroupValueField: 'id',
	//     optgroupOrder: ['chevrolet', 'dodge', 'audi'],
	//     searchField: ['model'],
	//     plugins: ['optgroup_columns']
	// });


      $(function() {
		  $('#group_rep').selectize();
		});
</script>
<script type="text/javascript" src="js/groups.js">
</script>
</body>
</html>