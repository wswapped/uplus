<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php include("header.php");?>

    <div id="page_content">
        <div id="page_content_inner">

            <h4 class="heading_a uk-margin-bottom">Donations</h4>
           
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-3">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h4 class="heading_c uk-margin-bottom">Overall Donations</h4>
                            <div id="c3_chart_donut" class="c3chart"></div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-1-3">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Donation Source (Rwf)
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <table class="uk-table uk-table-hover">
                            <tbody>
                            <tr>
                                <td>MTN Mobile money</td>
                                <td>3,870,000</td>
                            </tr>
                            <tr>
                                <td>Tigo Cash</td>
                                <td>32,870,000</td>
                            </tr>
                            <tr>
                                <td>Visa Cards</td>
                                <td>742,600</td>
                            </tr>
                            <tr>
                                <td>Masert Cards</td>
                                <td>742,600</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td><b>Total</b></td>
                                <td><b>12,453,000</b></td>
                            </tr>
                            </tfoot>
                        </table>
                        <br>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-1-3">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Withdraw Account:
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <table width="100%">
                                <tr>
                                    <td>
                                        Holder Bank:
                                    </td> 
                                    <td>
                                        <select class="md-input" disabled>
                                            <option>Bank Of Kigali</option>
                                        </select> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Beneficialy:
                                    </td> 
                                    <td>
                                        <input type="text" class="md-input" name="wacc" value="New Life Gospel Church" disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Account Number:
                                    </td> 
                                    <td>
                                        <input type="text" class="md-input" name="wacc" value="04-344BG/789" disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       <button class="md-btn md-btn-success">Change</button>
                                    </td> 
                                    <td>
                                    </td>
                            </table>
                            <br> <br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-4-4">
                    <div class="md-card uk-margin-medium-bottom">
                        <div class="md-card-content">
                            <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date In</th>
                                        <th>Amount</th>
                                        <th>Branch</th>
                                        <th>For</th>
                                        <th>From/To</th>
                                        <th>Method</th>
                                        <th>Number</th>
                                        <th>Trabsaction ID</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Date In</th>
                                        <th>Amount</th>
                                        <th>Branch</th>
                                        <th>For</th>
                                        <th>From/To</th>
                                        <th>Method</th>
                                        <th>Number</th>
                                        <th>Trabsaction ID</th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>30/03/2017</td>
                                        <td>85,000</td>
                                        <td>Gitenga</td>
                                        <td>Tithe</td>
                                        <td>Muhirwa Clement</td>
                                        <td>MTN</td>
                                        <td>0784848236</td>
                                        <td>0000010217</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>30/03/2017</td>
                                        <td>85,000</td>
                                        <td>Gitenga</td>
                                        <td>Tithe</td>
                                        <td>Muhirwa Clement</td>
                                        <td>Cash</td>
                                        <td>0784848236</td>
                                        <td>0000010217</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>30/03/2017</td>
                                        <td>85,000</td>
                                        <td>Gitenga</td>
                                        <td>Tithe</td>
                                        <td>Muhirwa Clement</td>
                                        <td>Visa</td>
                                        <td>0784848236</td>
                                        <td>0000010217</td>
                                    </tr>
                                </tbody>
                            </table>
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
    
     <!-- page specific plugins -->
    <!-- d3 -->
    <script src="bower_components/d3/d3.min.js"></script>
    <!-- c3.js (charts) -->
    <script src="bower_components/c3js-chart/c3.min.js"></script>
    
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