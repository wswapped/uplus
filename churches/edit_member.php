<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <?php

        include_once 'functions.php';
        $memberid = $_GET['id']??"";

        $user_data = user_details($memberid);
        if(!$user_data){
            //here member does not exist
            header("location:members.php");
        }

        $member_name = $user_data['name'];
        $member_phone = $user_data['phone'];
        $member_email = $user_data['email'];
        $member_address = $user_data['address'];
        $member_branch = $user_data['branchid'];
        $member_type = $user_data['type'];
        

        $title = "Editing $member_name";
        //Including common head configuration
        include_once "head.php";
    ?>
     <!-- dropify -->
    <link rel="stylesheet" href="assets/skins/dropify/css/dropify.css">
</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <?php
        include_once "menu-header.php";
    ?>
    <!-- main sidebar -->
    <?php
        include_once "sidebar.php";
        $church_services = church_services($churchID);
        $branches = church_branches($churchID);

        //Getting possible church types
        $types = member_types($churchID);
    ?>

    <div id="page_content">
        <div id="page_content_inner">
            <div class="heading_a uk-grid uk-margin-bottom uk-grid-width-large-1-2">
                <div class="uk-row-first">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="md-card-title">
                                <h4 class="">Member editing</h4>
                            </div>
                            <div class="draft">
                                <?php
                                    var_dump($_POST);
                                ?>
                            </div>

                            <form action="edit_member.php?id=<?php echo $memberid; ?>" method="post" enctype="multipart/form-data">
                                <div class="md-input-wrapper">
                                    Member Name:<input type="text" name="mname" class="md-input" required value="<?php echo $member_name; ?>">
                                    <input type="hidden" name="mid" class="md-input" required value="<?php echo $memberid; ?>">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <select name="mlocation" data-md-selectize>
                                        <option value="">Branch</option>
                                        <?php
                                            for ($n=0; $n<count($branches); $n++) {
                                                $branch = $branches[$n];
                                                if($branch['id'] == $member_branch){
                                                    echo '
                                                    <option value="'.$branch['id'].'" selected>'.$branch['name'].'</option>
                                                ';
                                                }else{
                                                    echo '
                                                    <option value="'.$branch['id'].'">'.$branch['name'].'</option>
                                                ';
                                                }
                                                
                                            }
                                        ?>
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    Member Phone:<input type="number" name="mcontact" class="md-input" required value="<?php echo $member_phone; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    Member Email:<input type="email" name="mmail" class="md-input" required value="<?php echo $member_email; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    Member Address:<input type="text" name="maddress" class="md-input" required value="<?php echo $member_address; ?>"/>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <select name="mtype" data-md-selectize required="required">
                                        <option>Member type ..</option>
                                        <?php
                                            for($n=0; $n<count($types); $n++){
                                                $type = $types[$n];
                                                if($member_type == $type['name']){
                                                    ?>
                                                       <option value="<?php echo $type['name'] ?>" selected><?php echo $type['name'] ?></option> 
                                                    <?php
                                                }else{
                                                    ?>
                                                       <option value="<?php echo $type['name'] ?>"><?php echo $type['name'] ?></option> 
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <button class="md-btn md-btn-danger">Cancel</button>
                                    <button type="submit" class="md-btn md-btn-success" value="UPDATE">UPDATE</button>
                                </div>
                            </form>
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


    <!-- Dropify -->
    <script src="bower_components/dropify/dist/js/dropify.min.js"></script>

    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script>
    var ctx = document.getElementById("mem_attendance").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_keys($chart_data)); ?>,
            datasets: [{
                label: '# of members(headcounts)',
                data: <?php echo json_encode(array_values($chart_data)); ?>,
                backgroundColor: [
                    'rgba(0, 150, 136, 0.2)',
                ],
                borderColor: [
                    'rgba(0,150,136,1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    </script>

    <script src="js/uploadFile.js"></script>
    <script type="text/javascript">
        var churchID  = <?php echo $churchID; ?>;
        $('.dropify').dropify();

        $("#memExport").on('submit', function(e){
            e.preventDefault();
            uploadFile();

        });

        $(".selectize").selectize();

        function log(data){
            console.log(data)
        }

        $("#head_counts_form").on('submit', function(e){
            e.preventDefault();

            //head counts modal on submission
            service = $("#service-input").val();
            date = $("#date-input").val();
            number = $("#number-input").val();
            branch = $("#branch-input").val();

            if(service && date && number){
                //sending the data
                $.post('api/index.php', {action:'record_headcount', church:<?php echo $churchID; ?>, branch:branch, service:service, date:date, number:number}, function(data){
                        try{
                            ret = JSON.parse(data);
                            if(ret.status){
                                //Saved
                                $("#head_counts_form").html("Saved successfully!");
                                setTimeout(function(){
                                    location.reload();
                                }, 700);
                            }else{
                                $("#head_counts_form").html("Error recording!<br />"+data.msg);
                            }
                        }catch(err){
                            log(err)
                        }
                })
            }            
        });

        $("#add_member_btn").on('click', function(e){
            e.preventDefault();
            //add individual user
            name = $("#name_input").val();
            phone = $("#phone_input").val();
            email = $("#email_input").val();
            branch = $("#branch_input").val();
            address = $("#address_input").val();
            type = $("#type_input").val();

            if(name && branch && type){

                //Marking the progress
                //Marking the sending process
                $("#add_member_modal .act-dialog[data-role=init]").hide();
                $("#add_member_modal .act-dialog[data-role=done]").removeClass('display-none');

                //USer can be submitted
                $.post('api/index.php', {action:'add_member', church:<?php echo $churchID; ?>, name:name, phone:phone, email:email, address:address, branch:branch, type:type}, function(data){
                    try{
                        ret = JSON.parse(data);
                        if(ret.status){
                            //User done
                            //create successfully(Giving notification and closing the modal);
                            $("#addStatus").html("<p class='uk-text-success'>Member added successfully!</p>");
                            
                            setTimeout(function(){
                                UIkit.modal($("#add_member_modal")).hide();
                                window.location = 'members.php';
                            }, 5000);
                        }
                    }catch(e){
                        alert("error"+e)
                    }
                })
            }else{
                alert("Provide user details")
            }

        })

    </script>

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