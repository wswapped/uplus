<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php include("header.php");?>

    <div id="page_content">
        <div id="page_content_inner">

            <h4 class="heading_a uk-margin-bottom">Manage Visitors</h4>
             <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-3-4">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h4 class="heading_c uk-margin-bottom">Visitors</h4>
                            <div id="chartist_line_area" class="chartist"></div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="dt_colVis_buttons"></div>
                            <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Branche</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Date In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        include 'db.php';
                                        $fetchvisitor = $db ->query("SELECT * FROM members WHERE type = 'VISITOR' ORDER BY id DESC");
                                        $n = 0;
                                        while ($visitorinfo = mysqli_fetch_array($fetchvisitor)) {
                                            $locationId = $visitorinfo['locationId'];
                                            $fetchbranch = $db ->query("SELECT * FROM branches WHERE id = '$locationId'");
                                            $branch = mysqli_fetch_array($fetchbranch);
                                            echo '
                                                <tr>
                                                    <td>'.$n++.'</td>
                                                    <td>'.$visitorinfo['name'].'</td>
                                                    <td>'.$branch['name'].'</td>
                                                    <td>'.$visitorinfo['address'].'</td>
                                                    <td>'.$visitorinfo['phone'].'</td>
                                                    <td>'.$visitorinfo['createdDate'].'</td>
                                                </tr>
                                            ';
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-1-4">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                New Member
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <form >
                                <div class="md-input-wrapper">
                                    <label>Full Name</label>
                                    <input type="text" class="md-input">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <label>Phone</label>
                                    <input type="text" class="md-input">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <label>Location</label>
                                    <input type="text" class="md-input">
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

</body>
</html>
<!-- Localized -->