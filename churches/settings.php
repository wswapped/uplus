<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <?php
        $title = "Settings";
        //Including common head configuration
        include_once "head.php";
    ?>
</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <?php
        include_once "menu-header.php";
    ?>
    <!-- main sidebar -->
    <?php
        include_once "sidebar.php";
    ?>

    <div id="page_content">
        <div id="page_content_inner">
            <!-- circular charts -->
            <div class="heading_a uk-grid uk-margin-bottom uk-grid-width-large-1-2">
                <div class="uk-row-first"><h4 class=""><?php echo $churchname; ?>Settings</h4></div>
            </div>
            <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3 uk-text-center" >
                
                <div class="uk-row-first">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text"><i class="material-icons">group</i> &nbsp;Group settings</h3>
                        </div>
                        <div class="md-card-content">
                            <ul class="md-list">
                                <?php
                                    $group_types = group_types($churchID);
                                    for($n=0; $n<count($group_types); $n++){
                                        ?>
                                        <li><?php echo $group_types[$n]; ?></li>
                                        <?php
                                    }
                                ?>
                                <li>
                                    <form action="settings.php" method="POST">
                                        <div class="">
                                            <?php
                                                if(!empty($_POST['new_group_type'])){
                                                    $type = $_POST['new_group_type'];

                                                    $query = $conn->query("INSERT INTO group_types(name) VALUES (\"$type\") ");
                                                    if($query){
                                                        echo "Successfully added";
                                                    }else{
                                                        echo "Error adding group type $conn->error";
                                                    }

                                                }
                                            ?>
                                        </div>
                                        <div class="uk-grid">
                                            <div class="uk-row-first">
                                                <div class="md-input-wrapper md-input-filled"><label>Add group type</label><input type="text" name="new_group_type" class="md-input labelel-fixed"><span class="md-input-bar "></span></div>
                                            </div>
                                            <div class="">
                                                <button class="md-btn md-btn-success"><i class="material-icons">add</i></button>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.js"></script>

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>

    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>
    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "assets/js/custom/dense.min.js", function(data) {
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