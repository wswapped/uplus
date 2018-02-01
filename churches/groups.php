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
        ?>
        <div id="page_content_inner">

            <div class="heading_a uk-grid uk-margin-bottom uk-grid-width-large-1-2">
                <div class="uk-row-first"><h4 class=""><?php echo $churchname; ?> - Groups</h4></div>
            </div>
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-4-4">
    				<div class="md-card">
                        <div class="md-card-content">
                            <h4 class="heading_c uk-margin-bottom">Groups</h4>
                            <div id="chartist_line_area" class="chartist"></div>
                        </div>
                    </div>
                    <!-- <div class="md-card">
                        <div class="md-card-content">
                            <div class="dt_colVis_buttons"></div>
                            <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Branche</th>
                                        <th>Members</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
    								<?php 
    								$n=0;
                                    while ($data = $query->fetch_assoc()) {
                                            $n++;
                                            $groups[] = $data;
                                            $sqlGetMembers = $db->query("SELECT * FROM `group_members` WHERE groupid = '$data[id]'")or die (mysqli_error());
    										echo '<tr>
    										<td>'.$n.'</td>
    										<td>'.$data['name'].'</td>
                                            <td>'.$data['type'].'</td>
    										<td>'.$data['branchname'].'</td>
                                            <td>'.count($sqlGetMembers).'</td>
    										<td><a href="groups.php?act=edit&group='.$data['id'].'"><i class="material-icons"></i></a></td>
    										</tr>';
    									}
    								?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                    
                </div>
                <?php
                    $branches = list_groups($churchID);
                    
                    for ($n=0; $n<count($branches);$n++) {
                        $bdata = $branches[$n]; //Branch data
                        $sqlGetMembers = $db->query("SELECT * FROM `group_members` WHERE groupid = '$data[id]'")or die (mysqli_error());

                        ?>
                            <div class="uk-width-large-2-4">
                                <div class="md-card">
                                    <div class="">
                                        <img src="<?php echo $bdata['profile_picture']; ?>" alt="">
                                        <div class="md-card-content">
                                            <strong><?php echo $bdata['name']; ?></strong><br>
                                            <span class="uk-text-muted"><?php echo $bdata['type']." at ".$bdata['branchname']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?> 
                <div class="md-fab-wrapper ">
                    <!-- <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">add</i></a> -->
                    <button class="md-fab md-fab-small md-fab-warning d_inline" href="javascript:void(0)" data-uk-modal="{target:'#modal_default'}"><i class="material-icons">group_add</i></button>
                </div>
    		</div>              
        </div>
        <?php } ?>
    </div>


    <div class="uk-modal" id="modal_default" aria-hidden="true" style="display: none; overflow-y: auto;">
        <div class="uk-modal-dialog" style="top: 339.5px;">
            <button type="button" class="uk-modal-close uk-close"></button>

            <div class="md-card">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text">New Group</h3>
                </div>
                <div class="md-card-content">                    
                    <div class="uk-width-medium-1-2 uk-row-first">
                        <form action="operations.php" method="POST">
                            <div class="uk-form-row">
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div class="uk-width-medium-2-2 uk-row-first">
                                        <div class="md-input-wrapper"><label>Group name</label><input type="text" class="md-input"><span class="md-input-bar "></span></div>                                       
                                    </div>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="md-input-wrapper"><label>Location</label><input type="text" class="md-input"><span class="md-input-bar "></span></div>     
                            </div>
                            <div class="uk-form-row">
                                <div class="md-input-wrapper md-input-filled"><select id="select_demo_1" class="md-input">
                                <option value="" disabled="" selected="" hidden="">Select type...</option>
                                    <option value="a1">Cell</option>
                                    <option value="b1">Prayer</option>
                                    <option value="c1">Other</option>
                            </select><span class="md-input-bar "></span></div>
                            </div>
                        </form>
                    </div>
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
    <script src="bower_components/chartist/dist/chartist.min.js"></script>

    <!--  charts functions -->
    <script src="assets/js/pages/plugins_charts.min.js"></script>
    
    

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
<script src="js/uploadFile.js"></script>
</body>
</html>
<!-- Localized -->