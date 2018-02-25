<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->


<!-- Mirrored from altair_html.tzdthemes.com/page_chat.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Feb 2018 11:14:37 GMT -->
<head>
    <?php
        $title = "Prayer requests";
        include_once "head.php";
    ?>
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
</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe header_double_height">
    <!-- main header -->
    <?php include 'menu-header.php'; ?>
    <!-- main sidebar -->
    <?php include 'sidebar.php'; ?>
    <!-- main sidebar end -->

    <div id="page_content">
        <div id="page_content_inner">
            <?php
                //getting prayer requests of this churche's users
                $prayerquery = $conn->query("SELECT *, members.id as memberID, members.name as membername, members.profile_picture as memberpic FROM prayer_requests JOIN members ON prayer_requests.member = members.id JOIN branches ON members.branchid = branches.id WHERE branches.church = $churchID ORDER BY sentTime DESC") or die ("can't get chats".$conn->error);

                $memberprayers = $prayers = array();
                while ($data = $prayerquery->fetch_assoc()) {
                    $prayers[] = $data;
                }

                //Ordering member conversations
                foreach ($prayers as $prayer) {
                    $memberprayers[$prayer['membername']][] = $prayer;
                }

                
            ?>
asiaO
            <div class="uk-width-medium-8-10 uk-container-center">
                <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
                    <div class="uk-width-large-7-10">
                        <div class="md-card md-card-single">
                            <div class="md-card-toolbar">
                                <!-- <div class="md-card-toolbar-actions hidden-print">
                                    <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}">
                                        <i class="md-icon material-icons">&#xE3B7;</i>
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
                                    <i class="md-icon  material-icons">&#xE5CD;</i>
                                </div> -->
                                <h3 class="md-card-toolbar-heading-text large">
                                    <?php
                                        if(empty($memberprayers)){
                                            echo "You have received no prayer request yet";
                                            die();
                                        }

                                        $first_user = $prayers[0];
                                        $fmessages = $memberprayers[$first_user['membername']];


                                    ?>
                                    <span class="uk-text-muted">Chat with</span> <a href="#" id="chat_user_name"><?php echo $first_user['membername']; ?></a>
                                </h3>
                            </div>
                            <div class="md-card-content padding-reset">
                                <div class="chat_box_wrapper">
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
                                            <input type="text" class="md-input" name="submit_message" id="messageCont" placeholder="Send message">
                                            <span class="uk-input-group-addon">
                                                <a href="#" id="submit_message"><i class="material-icons md-24">&#xE163;</i></a>
                                            </span>
                                            <input type="hidden" id="memberID" value="<?php echo $message['memberID'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-large-3-10 uk-visible-large">
                        <div class="md-list-outside-wrapper">
                            <ul class="md-list md-list-addon md-list-outside" id="chat_user_list">
                                <?php
                                    $n=0;
                                    foreach ($memberprayers as $membername => $requestData) {
                                        $requestData = $requestData[count($requestData)-1];
                                        $ppic=!empty($member['memberpic'])?$member['memberpic']:'gallery/members/default.png';
                                ?>

                                <li class="chatShortcut" data-messageid = "<?php  echo $membername; ?>">
                                    <div class="md-list-addon-element">
                                        <!-- <span class="element-status element-status-danger"></span> -->
                                        <!-- <p><?php echo $requestData['phone']; ?></p> -->
                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo $ppic; ?>" alt="">
                                    </div>
                                    <div class="md-list-content">
                                        <div class="md-list-action-placeholder"></div>
                                        <span class="md-list-heading"><?php  echo $membername; ?></span>
                                        <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo substr($requestData['message'], 0, 80) ?>..</span>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="sidebar_secondary">
        <div class="sidebar_secondary_wrapper uk-margin-remove"></div>
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

    <!--  chat functions -->
    <script src="assets/js/pages/page_chat.min.js"></script>
    
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
    <script type="text/javascript">

        var messages =<?php echo json_encode($memberprayers); ?>

        $("#submit_message").on("click", function(){
            message = $("#messageCont").val();
            if(message.length>1){
                log("going to send message")
                chatelem = $(".modelChatmessage").clone().removeClass("modelChatmessage");
                chatelem.find("li").html(message)
                $("#chat").append(chatelem);
                $("#messageCont").val("");
                memberID = $("#memberID").val();

                $.post("api/index.php", {action:"prayer_request", admin:<?php echo $userId ?>, member:memberID, message:message, sender:"admin"}, function(data){
                    log("message sent to server")
                })
            }
        });

        //When another user is activated
        $(".chatShortcut").on('click', function(){
            //Here we want to activate and populate the chat box
            selectedMessage = $(this).attr("data-messageid");
            message = messages[selectedMessage];


            //Changing message header
            $("#chat_user_name").html(message['membername']+" okay");

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
</body>
</html>