<?php
    include 'db.php';
    include 'functions.php';
    include_once "class.user.php";
    include_once "class.sms.php";
?>
<div class="uk-grid uk-grid-medium" data-cont="send" id="page" data-uk-grid-margin>
    <div class="uk-width-large-2-4">
        <div class="md-card 1st-step">
            <div class="md-card-content">                        
                <form action="broadcast.php" method="post" id="comform" enctype="multipart/form-data">
                    <div id="sendProg-cont" class="display-none">
                        <p>We are sending your messages</p>
                        <!-- <div class = "progress progress-striped active">                                        
                            <div class = "progress-bar progress-bar-success" role = "progressbar" 
                              aria-valuenow = "60" aria-valuemin = "0" aria-valuemax = "100" id="sendProg" style = "width: 10%;">
                              <span class=""><span id="sendProgLabel">10%</span> Complete</span>
                            </div>                            
                        </div> -->
                        <div class="uk-progress uk-progress-striped uk-active">
                            <div class="uk-progress-bar" id="sendProg" style="width: 5%;">0%</div>
                        </div>
                        <p class="text-info">You can browse as normal, we'll handle it</p>
                        <div class="md-card-content" id="quantSendProg" style="display: none;">
                            <span class="nsent"></span> of <span class="ncount"></span> sent
                        </div>
                    </div>
                <div class="iforms">
                    <div class="md-input-wrapper">
                        <ul class="uk-tab uk-tab-grid comode" data-uk-tab="{connect:'#tabs_4'}">
                            <li class="uk-width-1-3 uk-active" data-mode = "sms" aria-expanded="true"><a href="#">SMS</a></li>
                            <li class="uk-width-1-3" data-mode ='email' aria-expanded="false"><a href="#">e-mail</a></li>
                            <li class="uk-width-1-3" data-mode ='app' aria-expanded="false"><a href="#">App</a></li>
                            <li class="uk-tab-responsive uk-active uk-hidden" aria-haspopup="true" aria-expanded="false"><a>Active</a><div class="uk-dropdown uk-dropdown-small" aria-hidden="true"><ul class="uk-nav uk-nav-dropdown"></ul><div></div></div></li>
                        </ul>
                    </div>
                    <div style="height: .3vh"></div>

                    <div class="md-input-wrapper uk-hidden email-elem" id="subjField">
                        <!-- <label class="fancy">Subject: </label> -->
                        <input type="text" placeholder="Subject" name="subject" id="broadcastSubj" class="md-input label-fixed" />
                        <span class="md-input-bar "></span>
                    </div>

                    <div class="md-input-wrapper">
                        <div><label class="fancy">Message: </label></div>
                        <textarea placeholder="Enter SMS to send - Limited to 160 characters" rows="3" cols="40" name="msg" id="broadcastMsg" class="md-input autosized"></textarea>
                        <span class="md-input-bar "></span>
                    </div>

                    <div class="uk-grid uk-margin-top">
                        <div class="uk-row-first">
                            <input type="hidden" name="mode" value="SMS">
                            <button type="submit" id="sendBtn" class="md-btn md-btn-success" value="Send">Send </button>
                            <button type="button" id="contributeBtn" class="md-btn md-btn-primary" value="Send"><i class="material-icons">schedule</i> </button>
                        </div>
                        <div class="">
                            <div class="pull-right">    
                                <div class="inlineb moreSMSview" style="display: none;">Message: &nbsp;<span id="msgcount" class = "badge pull-right"> 0</span></div>
                                <div class="inlineb">Length:<span id="charcount" class = "uk-badge pull-right"> 0</span></div>                                      
                                <div class="inlineb">Recipients:<span id="recvCount" class = "uk-badge pull-right"> 0</span></div>
                            </div>
                        </div>
                    </div>                            
                </div>
            </form>
            </div>
            <div class="md-card-content errorHandle"></div>
        </div>
            <div class="md-card 1st-step sms-elem">
                <div class="md-card-content">
                    Estimated SMS Cost <i class="uk-text-small">units</i>
                    <p class="estimCost"><span id="recCount">0</span> * <span id="msgCount">0</span> = <span id="totalEstim">0</span></p>
                </div>
            </div>

    </div>
    <div class="uk-width-large-2-4">
        <div class="md-card">
            <div class="md-card-content scrollbar gscrollbar" id="response">
                <div class="checkCont uk-overflow-auto">

                    <?php 
                        $sqlGetbra = $db->query("SELECT * FROM `branches`") or die (mysqli_error($conn));
                        // while ($thisinfo = mysqli_fetch_array($sqlGetbra)) {
                        //     $group.='
                        //         <input type="checkbox" data-target="'.$thisinfo['name'].'" id="check'.strtolower($thisinfo['name']).'" class="controlOption" value="'.$thisinfo['id'].'" name="group"> <label for="check'.strtolower($thisinfo['name']).'">'.$thisinfo['name'].'</label>&nbsp;';
                        // }
                        ?>

                        <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                            <div class="inlineb list-sep">
                                <input type="checkbox" value="all" class="selectall controlOption uk-checkbox" data-target="all" name="all"><label> All&nbsp;</label>
                            </div>
                            <div class="inlineb list-sep">
                                <input type="checkbox" class="controlOption uk-checkbox" id="checkrep" data-target="rep" value="rep" name="rep">
                                <label for="checkrep">Representative&nbsp;</label>
                            </div>
                             
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM `branches`") or die (mysqli_error($conn));

                            while ($data = mysqli_fetch_assoc($sql)) {
                                ?>
                                <div class="inlineb list-sep">
                                    <input type="checkbox" data-target="<?php echo $data['name']; ?>" id="check<?php echo strtolower($data['name']); ?>" class="controlOption uk-checkbox" value="<?php echo $data['id']; ?>" name="group"> 
                                    <label for="check<?php echo strtolower($data['name']); ?>"><?php echo $data['name']; ?>&nbsp;</label>
                                </div>

                                <?php } ?>    

                            <thead>
                                <tr>
                                    <th class="sorthead"># <span class="caret"> </span></th>
                                    <th></th>
                                    <th class="sorthead">Name<span class="caret"></span></th>
                                    <th class="sorthead">Branch<span class="caret"></span></th>
                                    <th class="sorthead">Phone<span class="caret"></span></th>
                                    <th class="sorthead">Email<span class="caret"></span></th>
                                </tr>
                            </thead>
                            <tbody id="membersCont">
                                <tr></tr>
                                <?php
                                    $mApp = $mPhone = $membersdata = array();
                                    $query = mysqli_query($conn, "SELECT DISTINCT(members.name) as t, members.*, branches.name as bname FROM members JOIN branches ON members.branchid = branches.id ORDER BY name ASC") or die(mysqli_error($conn));
                                    $n = 0;
                                    while($data = mysqli_fetch_assoc($query)){
                                        $n++;
                                        $membersdata[] = $data;

                                        //members with phone
                                        if( $data['phone']){
                                            $mPhone[] = $data;
                                        }

                                        //members with email
                                        if( $data['email']){
                                            $mEmail[] = $data;
                                        }
                                        if( $data['token']){
                                            $mApp[] = $data;
                                        }
                                        ?>
                                            <tr>
                                                <td><?php echo $n; ?></td>
                                                <td><input value="<?php echo $data['id']; ?>" class="all <?php echo $data['bname']; ?> uk-checkbox" type="checkbox"></td>
                                                <td><?php echo $data['name'] ?></td>
                                                <td><?php echo $data['bname'] ?></td>
                                                <td><?php echo $data['phone'] ?></td>
                                                <td><?php echo $data['email']; ?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                            
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
</div>
<script type="text/javascript">
    var members= {}
    members.email = <?php echo(json_encode($membersdata)); ?>;

    //members with phone
    memberWithPhone = <?php echo(json_encode($mPhone)); ?>;
    //members with email
    memberWithEmail = <?php echo(json_encode($mEmail)); ?>;
    //members with app
    memberWithApp   = <?php echo(json_encode($mApp)); ?>;

    members.sms     = memberWithPhone;
    members.email   = memberWithEmail;
    members.app     = memberWithApp;
</script>
<script type="text/javascript" src="js/broadcastsend.js"></script>