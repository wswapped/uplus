<style type="text/css">
    .sms {
        padding: 15px;
        display: block;
        width: 100%;
        border-bottom: 1px solid white;
        border-top: 1px solid white;
        border-left: 3px solid grey;
    }
    .sms > .sender {
        color: black;
        font-weight: bold;
        font-size: 120%;
    }
    .sms > .sender > .time {
        float:right;
        font-size:11px;
        color:grey;
        margin-left:10px
    }
    .sms > .msg {
        color: black;
        font-size: 100%;
    }
</style>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php
    include("header.php");

    //getting prayer requests of this churche's users
    $prayerquery = $conn->query("SELECT *, members.id as memberID, members.name as membername FROM prayer_requests JOIN members ON prayer_requests.member = members.id JOIN branches ON members.branchid = branches.id WHERE branches.church = $churchID ORDER BY sentTime ASC") or die ("can't get chats".$conn->error);

    $memberprayers = $prayers = array();
    while ($data = $prayerquery->fetch_assoc()) {
        $prayers[] = $data;
    }

    //Ordering member conversations
    foreach ($prayers as $prayer) {
        $memberprayers[$prayer['membername']][] = $prayer;
    }

?>

<div id="page_content">
    <div id="page_content_inner">
        <?php
            $first_user = $prayers[0];
            $fmessages = $memberprayers[$first_user['membername']];
        ?>
        <div class="uk-width-medium-8-10 uk-container-center">
            <div class="uk-grid uk-grid-collapse" data-uk-grid-margin="">
                <div class="uk-width-large-7-10 uk-row-first">
                    <div class="md-card md-card-single">
                        <div class="md-card-toolbar">
                            <!-- <div class="md-card-toolbar-actions hidden-print">
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown">
                                        <ul class="uk-nav" id="chat_colors">
                                            <li class="uk-nav-header">Message Colors</li>
                                            <li class="uk-active"><a href="#" data-chat-color="chat_box_colors_a">Grey/Green</a></li>
                                            <li><a href="#" data-chat-color="chat_box_colors_b">Blue/Dark Blue</a></li>
                                            <li><a href="#" data-chat-color="chat_box_colors_c">Orange/Light Gray</a></li>
                                            <li><a href="#" data-chat-color="chat_box_colors_d">Deep Purple/Light Grey</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <i class="md-icon  material-icons"></i>
                            </div> -->
                            <h3 class="md-card-toolbar-heading-text large">
                                <a href="#"><?php echo $first_user['membername']; ?></a> <span class="uk-text-muted">'s Requests</span>
                            </h3>
                        </div>
                        <div class="md-card-content padding-reset" style="height: 866px;">
                            <div class="chat_box_wrapper" id="mainchatbox">
                                <div class="chat_box touchscroll chat_box_colors_a" id="chat">
                                    <?php
                                        foreach ($fmessages as $message) {
                                            $dir = $message['sender'] == 'admin'?"right":"left";
                                    ?>
                                    <div class="chat_message_wrapper chat_message_<?php echo $dir; ?>">
                                        <div class="chat_user_avatar">
                                            <?php
                                                if($message['sender'] == "admin"){
                                                    ?>
                                                        <img class="md-user-image" src="<?php echo $adminImage; ?>" alt="Admin profile">
                                                    <?php
                                                }
                                            ?>                                            
                                        </div>
                                        <ul class="chat_message">
                                            <li><?php echo $message['message']; ?></li>                                            
                                        </ul>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="chat_submit_box" id="chat_submit_box">
                                    <div class="uk-input-group">
                                        <div class="md-input-wrapper"><input type="text" class="md-input" name="submit_message" id="messageCont" placeholder="Send message"><span class="md-input-bar "></span></div>
                                        <span class="uk-input-group-addon">
                                            <a href="#" id="submit_message"><i class="material-icons md-24"></i></a>
                                        </span>
                                        <input type="hidden" id="memberID" value="<?php echo $message['memberID'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-3-10 uk-visible-large">
                    <div class="md-card bit-right">
                        <div class="md-card-toolbar"><p class="md-card-toolbar-heading-text large">Prayer requests</p></div>
                    </div>
                    <div class="md-list-outside-wrapper" style="height: 868px;"><div class="scroll-wrapper scrollbar-inner" style="position: relative;"><div class="scrollbar-inner scroll-content" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 868px;">
                        <ul class="md-list md-list-addon md-list-outside" id="chat_user_list">

                            <?php
                            // var_dump($memberprayers);
                                $n=0;
                                foreach ($memberprayers as $membername => $requestData) {
                                    $requestData = $requestData[count($requestData)-1];
                            ?>

                            <li class="chatShortcut" data-messageid = "<?php  echo $membername; ?>">
                                <div class="md-card-dropdown md-list-action-dropdown" data-uk-dropdown="{pos:'bottom-right'}">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown uk-dropdown-small">
                                        <ul class="uk-nav">
                                            <li><a href="#">Add to chat</a></li>
                                            <li><a href="#" class="uk-text-danger">Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="md-list-addon-element">
                                    <!-- <span class="element-status element-status-danger"></span> -->
                                    <!-- <p><?php echo $requestData['phone']; ?></p> -->
                                    <!-- <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_02_tn.png" alt=""> -->
                                </div>
                                <div class="md-list-content">
                                    <div class="md-list-action-placeholder"></div>
                                    <span class="md-list-heading"><?php  echo $membername; ?></span>
                                    <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo substr($requestData['message'], 0, 80) ?>..</span>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="width: 96px;"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="height: 96px;"></div></div></div></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="chat_message_wrapper chat_message_right modelChatmessage">
    <div class="chat_user_avatar">
        <img class="md-user-image" src="<?php echo $adminImage; ?>" alt="">
    </div>
    <ul class="chat_message">
        <li></li>                                            
    </ul>
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
        <!-- d3 -->
        <script src="bower_components/d3/d3.min.js"></script>
        <!-- metrics graphics (charts) -->
        <script src="bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>
        <!-- chartist (charts) -->
        <script src="bower_components/chartist/dist/chartist.min.js"></script>
        <!-- maplace (google maps) -->
        <script src="http://maps.google.com/maps/api/js"></script>
        <script src="bower_components/maplace-js/dist/maplace.min.js"></script>
        <!-- peity (small charts) -->
        <script src="bower_components/peity/jquery.peity.min.js"></script>
        <!-- easy-pie-chart (circular statistics) -->
        <script src="bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        <!-- countUp -->
        <script src="bower_components/countUp.js/dist/countUp.min.js"></script>
        <!-- handlebars.js -->
        <script src="bower_components/handlebars/handlebars.min.js"></script>
        <script src="assets/js/custom/handlebars_helpers.min.js"></script>
        <!-- CLNDR -->
        <script src="bower_components/clndr/clndr.min.js"></script>

        <!--  dashbord functions -->
        <script src="assets/js/pages/dashboard.min.js"></script>
    
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
    <script type="text/javascript">

        var messages =<?php echo json_encode($memberprayers); ?>

        $("#submit_message").on("click", function(){
            message = $("#messageCont").val();

            if(message.length>1){
                chatelem = $(".modelChatmessage").clone().removeClass("modelChatmessage");
                chatelem.find("li").html(message)
                $("#chat").append(chatelem);
                $("#messageCont").val("");
                memberID = $("#memberID").val();

                $.post("api/index.php", {action:"prayer_request", admin:<?php echo $userId ?>, member:memberID, message:message, sender:"admin"})
            }
        })
        $(".chatShortcut").on('click', function(){
            //Here we want to activate and populate the chat box
            selectedMessage = $(this).attr("data-messageid");
            message = messages[selectedMessage];

            log(message)
            $("#chat").html("");
            for(var n=0; n<message.length; n++){
                addChatmessage($("#chat"), message[n]);
            }
        });
        function addChatmessage(elem, message, append=1){
            chatelem = $(".modelChatmessage").clone().removeClass("modelChatmessage");
            log(message)
            chatelem.find("li").html("okay"+message['message']);

            if(message['sender'] == 'admin'){
                chatelem.removeClass("chat_message_left").addClass("chat_message_right");
            }else{
                chatelem.removeClass("chat_message_right").addClass("chat_message_left");
                chatelem.find(".md-user-image").remove();
            }

            if(append == 1){
                elem.append(chatelem);
            }else{
                elem.html(chatelem);
            }
        }
        function log(data){
            console.log(data)
        }
    </script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-65191727-1', 'auto');
        ga('send', 'pageview');
    </script>

</body>
</html>
<!-- Localized -->