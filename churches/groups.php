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

                    $group_types = group_types();


                    ?>
                        <div id="page_content_inner">
                            <div class="heading_a uk-grid uk-margin-bottom uk-grid-width-large-1-2">
                                <div class="uk-row-first"><h4 class=""><?php echo $churchname; ?> - Groups</h4></div>
                            </div>
                            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                                <div class="uk-width-large-4-4">
                                     <div class="md-card">
                                        <div class="md-card-toolbar">
                                            <h3 class="md-card-toolbar-heading-text">Edit Group</h3>
                                            
                                        </div>
                                        <div class="md-card-content">
                                            <form action="operations.php" method="POST">
                                                <div class="md-input-wrapper">
                                                    <select name="grouptype" data-md-selectize>
                                                        <option value="">Type...</option>
                                                        <?php
                                                            for($n=0; $n<count($group_types); $n++){
                                                                ?>
                                                                    <option value="<?php echo $member_types[$n]; ?>"><?php echo $group_types[$n]; ?><option>
                                                                <?php
                                                            }
                                                        ?>
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
                }if(!empty($_GET['group'])){
                	$group_id = $_GET['group'];
                	$group_data = group_details($group_id);
                	$groupname = $group_data['name'];
                    $grp_location = $group_data['maplocation']??$group_data['location'];
                	?>
                		<div id="page_content_inner">        	
    			        	<div class="heading_a uk-grid uk-margin-bottom uk-grid-width-large-1-2">
    			                <div class="uk-row-first"><h4 class=""><?php echo $churchname; ?> - Groups</h4></div>
    			            </div>
    			            <div class="md-card uk-margin-bottom">
    			            	<div class="md-card-toolbar">
                                    <h4 class="md-card-toolbar-heading-text"><?php echo $groupname; ?></h4>
                                    <div class="md-card-toolbar-actions">
                                    <!-- <i class="md-icon material-icons md-color-blue-grey-500"></i>
                                        <i class="md-icon material-icons md-color-light-blue-500"></i> -->
                                        <i class="md-icon material-icons md-color-green-500" title="Add a member" id="grp_add_member">person_add</i>
                                    </div>
                                </div>
    			            	<div class="md-card-content">
    			            		<div class="uk-grid uk-grid-width-medium-1-2">
                                        <div class="uk-row-first">
                                            <div class="uk-overflow-container">
                                                <table id="user" class="uk-table uk-table-striped uk-text-nowrap">
                                                    <tbody>
                                                        <tr>
                                                            <td class="uk-width-1-3">Group name</td>
                                                            <td class="uk-width-2-3"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username" class="editable editable-click"><?php echo $groupname; ?></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Group type</td>
                                                            <td><a href="#" id="gtype" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter group type" class="editable editable-click"><?php echo $group_data['type']; ?></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Location</td>
                                                            <td><a href="#" id="gloc" data-type="select" data-pk="1" data-value="" data-title="Select sex" class="editable editable-click"><?php echo $group_data['location']; ?></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Representative</td>
                                                            <td><a href="#" id="group" data-type="select" data-pk="1" data-value="5" data-source="/groups" data-title="Select group" class="editable editable-click">Admin</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="group_map" data-location="<?php echo $grp_location; ?>" data-group-id="<?php echo $group_id; ?>"></div>
                                        </div>
    			            		</div>	
    			            	    </div>
                                </div>
                                <div class="md-card uk-margin-medium-bottom">
                                    <div class="md-card-content">
                                        <?php
                                            //Showing group members
                                            $gmembers = group_members($group_id);
                                            if($gmembers){
                                            ?>
                                                <div class="uk-overflow-container" style="max-width: 1000px;">
                                                    <table id="dt_tableExport" class="uk-table memtable" data-group="1<?php echo $group_id; ?>" cellspacing="0" >
                                                        <thead>
                                                            <tr>
                                                                <th><input class="uk-checkbox checkall" type="checkbox"></th>
                                                                <th>#</th>
                                                                <th>Image</th>
                                                                <th>Name</th>
                                                                <th>Join date</th>
                                                                <th>Action</th>
                                                                <
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            
                                                            for($n=0; $n<count($gmembers); $n++ )
                                                                {
                                                                    $gmember = $gmembers[$n];
                                                                    $member = user_details($gmember['member']);
                                                                    $ppic=!empty($member['profile_picture'])?$member['profile_picture']:'gallery/members/default.png';                                                                    
                                                                    ?>
                                                                    <tr data-member="<?php echo $member['id']; ?>">
                                                                        <td><input class="uk-checkbox" type="checkbox"></td>
                                                                        <td><?php echo $n+1; ?></td>
                                                                        <td><img class="md-user-image" src="<?php echo $ppic; ?>" alt="img"></td>
                                                                        <td><?php echo $member['name']; ?></td>
                                                                        <td><?php echo $member['type']; ?></td>
                                                                        <td style="cursor: pointer;" class="removemember"><i class="material-icons">indeterminate_check_box</i></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            ?> 
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php
                                            }else{
                                                //No members
                                                ?>
                                                    No members in group yet. Start adding members
                                                <?php
                                            }
                                        ?>
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
                                                    <li data-uk-filter="cell"><a href="#">Cell groups</a></li>
                                                    <li data-uk-filter="prayer"><a href="#">Prayer groups</a></li>
                                                    <li data-uk-filter="youth"><a href="#">Youth groups</a></li>
                                                    <li data-uk-filter="other"><a href="#">Other groups</a></li>
                                                    <!-- <?php
                                                    	//looping through groups
                                                    	for($n=0; $n<count($groups); $n++){
                                                    		$groupname = $groups[$n]['name'];
                                                    		?>
                                                    			<li data-uk-filter="<?php echo $groupname; ?>"><a href="#"><?php echo $groupname; ?></a></li>
                                                    		<?php
                                                    	}
                                                    ?> -->
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
                            		$group_type = $group['type'];

                            		$repdata = user_details($group['representative']);
                            		$repemail = $repdata['email'];
                            		$repphone = $repdata['phone'];

                            		$searchabledata = array(strtolower($groupname), strtolower($branchname), strtolower($group_type));
                            		?>
                            			<div data-uk-filter="<?php echo implode(", ", $searchabledata); ?>" data-grid-prepared="true" style="position: absolute; box-sizing: border-box; padding-left: 20px; padding-bottom: 20px; top: 0px; opacity: 1; left: 0px;">
            			                    <div class="md-card md-card-hover md-card-horizontal">
            			                        <div class="md-card-head">
            			                            <div class="md-card-head-menu" data-uk-dropdown="{pos:'bottom-left'}">
            			                                <i class="md-icon material-icons"></i>
            			                                <div class="uk-dropdown uk-dropdown-small">
            			                                    <ul class="uk-nav">
            			                                        <li><a href="#">Edit</a></li>
            			                                        <li><a class="grp_remove" data-grp = <?php echo $group['id'] ?> href="#">Remove</a></li>
            			                                    </ul>
            			                                </div>
            			                            </div>
            			                            <div class="uk-text-center">
            			                                <img class="md-card-head-avatar" src="<?php echo $group_img;  ?>" alt="">
            			                            </div>
            			                            <h3 class="md-card-head-text uk-text-center">
            			                                <?php echo $groupname; ?>                                <span class="uk-text-truncate"><?php echo $branchname; ?> </span>
            			                            </h3>
            			                            <div class="md-card-head-footmenu">
            			                            	<div class="uk-grid">
            			                            		<div class="uk-width-medium-1-3">
            						                            <a class="md-btn md-btn-edit md-btn-wave-light waves-effect waves-button waves-light" href="groups.php?group=<?php echo $group['id']; ?>">GOTO</a>
            						                        </div>
            			                            	</div>
            			                            </div>
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
                            <button class="md-fab md-fab-warning d_inline" id="launch_group_create" href="javascript:void(0)" data-uk-modal="{target:'#modal_default'}"><i class="material-icons">group_add</i></button>
                        </div>             
                    </div>
            <?php } ?>
        </div>

        <!-- Add group modal -->
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
                                    <?php
                                        $group_types = group_types();
                                    ?>

                                        <div class="uk-form-row">
                                            <div class="md-input-wrapper md-input-filled">
                                                <select id="group_type_select" class="md-input">
                                                    <option value="" disabled="" selected="" hidden="">Select type...</option>
                                                    <?php
                                                        for($n=0; $n<count($group_types); $n++){
                                                            $group_name = $group_types[$n]['name'];
                                                            ?>
                                                                <option value="<?php echo $group_name; ?>"><?php echo $group_name; ?> group</option>
                                                            <?php
                                                        }
                                                    ?>
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
                                                    <div class="md-input-wrapper md-input-filled change_selectize">
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
                                        	<div class="dropify-wrapper">
                                        		<div class="dropify-message"><span class="file-icon"></span> <p>Drag and drop a profile picture here or click</p><p class="dropify-error">Ooops, something wrong appended.</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" id="input-fgroup-pic" class="dropify"><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace profile picture</p></div></div></div></div>
    			                        </div>
    			                        <div class="uk-form-row">
    			                        	<div class="group_create_status"></div>
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
                            <button id="member_add_submit1" class="md-btn md-btn-success pull-right">Create</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>

        <!-- Group created modal -->
        <div class="uk-modal" id="group_created_modal" aria-hidden="true" style="display: none; overflow-y: auto;">
            <div class="uk-modal-dialog" style="width:400px; top: 339.5px;">
                <div class="uk-modal-header uk-tile uk-tile-default">
                    <h3 class="d_inline">Group created!</h3><button type="button" class="uk-modal-close uk-close d_inline pull-right"></button>
                </div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="">
                            <i class="material-icons uk-text-success">done</i><p class="uk-text-success">Your group was successfully created, It's now functioning</p>
                        </div>  
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="md-btn md-btn-danger pull-left uk-modal-close">OK</button>
                    <div class="md-input-wrapper">
                        <button id="group_add_submit" class="md-btn md-btn-success pull-right">GOTO Group</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Adding members to group -->
        <div class="uk-modal" id="group_add_member" aria-hidden="true" style="display: none; overflow-y: auto;">
            <div class="uk-modal-dialog" style="max-width:800px;">
                <div class="uk-modal-header uk-tile uk-tile-default">
                    <h3 class="d_inline">Add members to group</h3><button type="button" class="uk-modal-close uk-close d_inline pull-right"></button>
                </div>
                        <?php
                            //Showing group members
                            // $gmembers = group_members($group_id);
                            $gmembers = group_non_members($group_id);
                            if($gmembers){
                            ?>
                                <div class="uk-overflow-container" style="max-width: 500px;">

                                    <table id="dt_tableExport" class="uk-table" data-group cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
                                                <th><input class="uk-checkbox checkall" type="checkbox"></th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            
                                            for($n=0; $n<count($gmembers); $n++ )
                                                {
                                                    $gmember = $gmembers[$n];
                                                    $ppic=!empty($gmember['profile_picture'])?$gmember['profile_picture']:'gallery/members/default.png';

                                                    ?>
                                                    <tr>
                                                        <td><input class="uk-checkbox checkbox_elem" data-member=<?php echo $gmember['id']; ?> type="checkbox"></td>
                                                        <td><img class="md-user-image" src="<?php echo $ppic; ?>" alt="img"></td>
                                                        <td><?php echo $gmember['name']; ?></td>
                                                        <td><?php echo $gmember['type']; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?> 
                                            
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                            }else{
                                //No members
                                ?>
                                    Amazing!:) It looks as all church members are in group.
                                <?php
                            }
                        ?>
                <div class="uk-modal-footer uk-text-right">
                    <button class="md-btn md-btn-danger pull-left uk-modal-close">CANCEL</button>
                    <div class="md-input-wrapper">
                        <button id="members_add_submit" class="md-btn md-btn-success pull-right">ADD <span id="add_member_num"></span></button>
                    </div>
                </div>
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

        <!-- Parsely -->
        <script src="bower_components/parsleyjs/dist/parsley.min.js"></script>
        

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

            $('#test1').parsley()



            

        </script>
        <script src="js/uploadFile.js"></script>
        <script async defer src="http://maps.google.com/maps/api/js?key=AIzaSyAlKttaE2WuI1xKpvt-f7dBOzcBEHRaUBA&libraries=places"></script>
        </script>
        <script type="text/javascript">
            function load_group_maps(){
                var load_maps = $(".group_map");

                log($(".group_map").attr('data-group-id'))

                // Getting group id, and data
                for(var n=0; n<load_maps.length; n++){
                    map_elem = load_maps[n];
                    map_loc = $(map_elem).attr('data-location');
                    mloc = map_loc.split(',')
                    group_location = {lat:parseFloat(mloc[0]), lng:parseFloat(mloc[1])};
                    log(group_location)
                    
                    var map = new google.maps.Map((map_elem), {
                        zoom: 17,
                        // center: {map_loc}
                        center: group_location
                    });
                    var marker = new google.maps.Marker({
                      position: group_location,
                      map: map
                    });
                }
            }; 
    		function log(data){
    			console.log(data);
    		}

    	
    </script>
    <script type="text/javascript" src="js/groups.js">
    </script>
    </body>
    </html>