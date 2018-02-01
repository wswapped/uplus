<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php include("header.php");?>

    <div id="page_content">
        <div id="page_content_inner">

            <div class="heading_a uk-grid uk-margin-bottom uk-grid-width-large-1-2">
                <div class="uk-row-first">
                    <h4 class="">All members </h4>
                    <h3 class="status" id="status"></h3>
                    <!-- <input type="file" name="file1" id="file1" onchange="uploadFile()" class="md-btn"> -->
                </div>
                <div class="align-head-ad">

                    <div class="md-fab-wrapper md-fab-in-card md-fab-speed-dial-horizontal">
                        <!-- <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">add</i><i class="material-icons md-fab-action-close" style="display:none"></i></a> -->
                        <div class="md-fab-wrapper-small">
                            <button class="md-fab md-fab-small md-fab-warning" href="javascript:void(0)" data-uk-modal="{target:'#modal_default'}"><i class="material-icons">person_add</i></button>
                            <a class="md-fab md-fab-small md-fab-danger" href="javascript:void(0)" data-uk-modal="{target:'#modal_upload_members'}"><i class="material-icons">file_upload</i></a>
                        </div>
                        <div class="uk-modal" id="modal_default" aria-hidden="true" style="display: none; overflow-y: auto;">
                            <div class="uk-modal-dialog" style="top: 339.5px;">
                                <button type="button" class="uk-modal-close uk-close"></button>

                                <div class="md-card">
                                    <div class="md-card-toolbar">
                                        <h3 class="md-card-toolbar-heading-text">
                                            New Member
                                        </h3>
                                    </div>
                                    <div class="md-card-content">
                                        <form action="operations.php" method="POST">
                                            <div class="md-input-wrapper">
                                                <label>Full Name</label>
                                                <input type="text" name="membername" class="md-input" required="required">
                                                <span class="md-input-bar "></span>
                                            </div>
                                            <div class="md-input-wrapper">
                                                <label>Phone</label>
                                                <input type="text" name="memberphone" class="md-input">
                                                <span class="md-input-bar "></span>
                                            </div>
                                            <div class="md-input-wrapper">
                                                <label>E-mail</label>
                                                <input type="email" name="memberemail" class="md-input">
                                                <span class="md-input-bar "></span>
                                            </div>
                                            <div class="md-input-wrapper">
                                                <label>Address</label>
                                                <input type="text" name="memberaddress" class="md-input">
                                                <select name="memberlocation" data-md-selectize required="required">
                                                    <option value="">Branch...</option>
                                                    <?php
                                                        //Getting branches
                                                        $branchesQuery = $conn->query(  "SELECT * FROM branches WHERE church = $churchID ") or die("Can't get branches ".$conn->error);
                                                        $branches = array();
                                                        while ($data = $branchesQuery->fetch_assoc()) {
                                                            $branches[] = $data;
                                                            ?>
                                                                <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                                <span class="md-input-bar "></span>
                                            </div>
                                            </div>
                                            <div class="md-input-wrapper">
                                                <select name="membertype" data-md-selectize required="required">
                                                    <option value="">Type...</option>
                                                    <option value="VISITOR">VISITOR<option>
                                                    <option value="FULL">FULL</option>
                                                </select>
                                                <span class="md-input-bar "></span>
                                            </div>
                                            <div class="md-input-wrapper">
                                                <button class="md-btn md-btn-success">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-modal" id="modal_upload_members" aria-hidden="true" style="display: none; overflow-y: auto;">
                            <div class="uk-modal-dialog" style="top: 339.5px;">
                                <button type="button" class="uk-modal-close uk-close"></button>

                                <div class="md-card">
                                    <div class="md-card-toolbar">
                                        <h3 class="md-card-toolbar-heading-text">Batch members upload</h3>
                                    </div>
                                    <div class="md-card-content">
                                        <form id="memExport" method="POST" enctype="multipart/form-data">
                                            <div class="md-input-wrapper">
                                                <label>Choose Excel file of members you want to export</label>
                                                <div class="dropify-wrapper">
                                                    <div class="dropify-message">
                                                        <span class="file-icon"></span> <p>Drag and drop a file here or click</p>
                                                        <p class="dropify-error">Ooops, something wrong appended.</p>
                                                    </div>
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div>
                                                    <input data-default-file="file:///C:/xampp/htdocs/uplus/churches/Church%20members.xlsx" name = "file1" type="file" data-allowed-file-extensions="xls xlsx" id="file1" class="dropify">
                                                    <button type="button" class="dropify-clear">Remove</button>
                                                    <div class="dropify-preview">
                                                        <span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="md-input-bar "></span>
                                            </div>                                            
                                            <input type="hidden" name="action" value="export_members">
                                            <input type="hidden" name="church" value="<?php echo $churchID; ?>">
                                            <input type="hidden" name="user" value="<?php echo $userId; ?>">
                                            <div class="md-input-wrapper">
                                                <button class="md-btn md-btn-success" type="submit">Save</button>
                                            </div>
                                        </form
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-medium-2-5">
                    <!-- <button class="md-btn uk-margin-bottom" data-uk-modal="{target:'#modal_default'}">Dynamic Form in Modal</button> -->
                    <div class="uk-modal" id="modal_default" aria-hidden="true" style="display: none; overflow-y: auto;">
                        <div class="uk-modal-dialog" style="top: 339.5px;">
                            <button type="button" class="uk-modal-close uk-close"></button>
                            <div data-dynamic-fields="field_template_modal" dynamic-fields-counter="0">
                                <div class="uk-grid form_section">
                                    <div class="uk-width-1-1">
                                        <div class="uk-input-group">
                                            <div class="md-input-wrapper"><label for="d_form_address__0">Address</label><input type="text" class="md-input" name="d_form_address__0" id="d_form_address__0"><span class="md-input-bar "></span></div>
                                            
                                            <span class="uk-input-group-addon">
                                                <a href="#" class="btnSectionClone"><i class="material-icons md-24"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script id="field_template_modal" type="text/x-handlebars-template">
                                <div class="uk-grid form_section">
                                    <div class="uk-width-1-1">
                                        <div class="uk-input-group">
                                            <label for="d_form_address{{counter}}">Address</label>
                                            <input type="text" class="md-input" name="d_form_address{{counter}}" id="d_form_address{{counter}}">
                                            <span class="uk-input-group-addon">
                                                <a href="#" class="btnSectionClone"><i class="material-icons md-24">&#xE146;</i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </script>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-4-4">
					<div class="md-card">
                        <div class="md-card-content">
                            <h4 class="heading_c uk-margin-bottom">Visitors</h4>
                            <div id="chartist_line_area" class="chartist"></div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="dt_colVis_buttons">
                            </div>
                            <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Branche</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Type</th>
                                        <th>Date In</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
									$n=0;
                                    $sqlGetMembers = $db->query("SELECT * FROM `members` ORDER BY id DESC")or die (mysqli_error());
									while($rowMember = mysqli_fetch_array($sqlGetMembers))
										{
                                            $locationId = $rowMember['locationId'];
                                            $sqlGetMembersloc = $db->query("SELECT * FROM `branches` WHERE id = '$locationId'")or die (mysqli_error());
                                            $branches = mysqli_fetch_array($sqlGetMembersloc);
											$n++;
											echo '<tr>
											<td>'.$n.'</td>
											<td>'.$rowMember['name'].'</td>
											<td>'.$branches['name'].'</td>
                                            <td>'.$rowMember['phone'].'</td>
                                            <td>'.$rowMember['email'].'</td>
											<td>'.$rowMember['address'].'</td>
											<td>'.$rowMember['type'].'</td>
                                            <td>'.$rowMember['createdDate'].'</td>
											<td><a href="editmember.php?memberid='.$rowMember['id'].'"><i class="material-icons">mode_edit</i></a></td>
											</tr>';
										}
									?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
        <div class="md-fab-wrapper ">
            <!-- <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">add</i></a> -->
            <button class="md-fab md-fab-small md-fab-warning d_inline" href="javascript:void(0)" data-uk-modal="{target:'#modal_default'}"><i class="material-icons">person_add</i></button>
            <a class="md-fab md-fab-small md-fab-danger d_inline" href="javascript:void(0)" data-uk-modal="{target:'#modal_upload_members'}"><i class="material-icons">file_upload</i></a>
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

<!--  dropify -->
<script src="bower_components/dropify/dist/js/dropify.min.js"></script>
<script src="js/uploadFile.js"></script>
<script type="text/javascript">
    var churchID  = <?php echo $churchID; ?>;
    $('.dropify').dropify();

    $("#memExport").on('submit', function(e){
        e.preventDefault();
        uploadFile();

    })
    function log(data){
        console.log(data)
    }
</script>
</body>
</html>
<!-- Localized -->