<?php
    include_once("db.php");
    include_once "class.user.php";
    include_once "class.message.php";

    $userId = $User->getUser();

    $church = $User->church($userId);
    //Getting broadcasts of user
    $cBroadcasts = $Broadcast->cBroadcast($userId, 105);
?>
<div class="card ubox">
  <div class="card-block">
    <div class="uk-grid">
        <div class="uk-modal" data-uk-modal="{center:true}" id="loadInvoice">
            <div class="md-card ubox invoicecont">
                <div class="md-card-heading">
                    <img src="assets/img/logo.png" />
                    <p>Uplus</p>
                    <p>Kigali, Rwanda</p>
                </div>
                <div class="indet pull-right client-det">
                    <p class="ifillin" data-req="name">Uwimana Monique</p>
                    <p class="ifillin" data-req="church">CHRISTIAN LIFE ASSEMBLY</p>
                </div>
                <div class="clearfix"></div>
                <div class="">
                    <p>Invoice NO: <span class="ifillin" data-req="invcode"></span></p>
                    <p>Product: Communication Services<p>
                    <p>Date: <b class="ifillin" data-req="time"></b><p>
                </div>
                <table class="uk-table invoice-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Number</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="clearfix"></div>
                <button class="btn btn-primary pull-right" id="invoiceprint">Print</button>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="uk-width-medium-2-3 rdis">
            <h1 class="card-title">Current Broadcasts <button class="loadView btn btn-default pull-right" data-pagetoggle="send">Broadcast</button></h1>
            <?php 
                if(count($cBroadcasts)>1){ ?>
                    <table class="uk-table" cellspacing=0 width="100%">
                        <thead>
                            <tr>
                                <th class="sorthead"># <span class="caret"> </span></th>
                                <th class="sorthead">Date<span class="caret"></span></th>
                                <th class="sorthead">Target number <span class="caret"></span></th>
                                <th class="sorthead">Message: <span class="caret"></span></th>
                                <!-- <th class="sorthead">Channels<span class="caret"></span></th> -->
                                <th class="sorthead">Cost(RWF) <span class="caret"></span></th>                
                                <th class="sorthead">Actions <span class="caret"></span></th>
                            </tr>
                        </thead>
                        <tbody class="mtable">
                            <?php
                                    for($n=0; $n<count($cBroadcasts); $n++){
                                        $broad = $cBroadcasts[$n];
                                        $senttime = new dateTime($broad['time']);
                                        $senttime = $senttime->format('d M Y - H:i:s');
                                        $ntarget = $Broadcast->ntarget($broad['id']);
                                        $nchannels = $Broadcast->channels($broad['id']);
                                        $cost = $Broadcast->cost($broad['id']);

                                        //composing short message
                                        $maxchar = 30;
                                        if(!empty($broad['subject'])){
                                            $smsg = strlen($broad['subject'])<$maxchar?$broad['subject']:substr($broad['subject'], 0, $maxchar);
                                        }else{
                                            $smsg = strlen($broad['message'])<$maxchar?$broad['message']:substr($broad['message'], 0, $maxchar);
                                        }
                                        ?>
                                        <tr class="broadMore" data-mid="<?php echo $broad['id']; ?>">
                                            <td class="viewmore"><?php echo $n; ?></td>
                                            <td><?php echo $senttime; ?></td>
                                            <td><?php echo $ntarget; ?></td>
                                            <td class="viewmore"><?php echo $smsg; ?></td>
                                            <!-- <td><?php //echo implode(', ', array_keys($nchannels)); ?></td> -->
                                            <td><?php echo $cost['total']; ?></td>
                                            <td><button class="btn btn-primary pull-right md-btn-wave-light waves-effect waves-button waves-light showInvoice" data-mid="<?php echo $broad['id']; ?>">Invoice</button></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                
                        </tbody>
                    </table>
            <?php
            }else{
                 ?>
                <p class="card-text">It looks like you haven't sent any message.</p>
                <button href="#" class="btn btn-primary pull-right loadView" data-pagetoggle='send'>Send Messages</button>
                <div class="clearfix"></div>
            <?php } ?>
        </div>
        <div class="uk-width-medium-1-3">
            <h1 class="card-title">Transactions <button class="loadView btn btn-default pull-right" data-pagetoggle="shop">Buy SMS</button></h1>
        </div>  
    </div>     
        
  </div>
</div>



<div class="uk-modal" id="moreBroad">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header uk-tile uk-tile-default"><p class="btn btn-primary broad-date">Broadcast message details on <span class="fillin" data-req="time"></span></p></div>
        <p class="broadSubject">Subject: <span class="fillin" data-req='subject'></span></p>
        <p class="broadMessage">Message: <p class="fillin" data-req='message'></p></p>
        <p>Time: <span class="fillin" data-req='time'></span></p>
        <p class="ntarget">Number of recipients: <span class="fillin" data-req="ntarget"></span></p>
        <p class="channels"></p>
        <p class="delivery"></p>        
        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="uk-button uk-modal-close">Cancel</button>
            <button class="btn btn-primary pull-right md-btn-wave-light waves-effect waves-button waves-light showInvoice">Invoice</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".broadMore .viewmore").on('click', function(){
        broadID = $(this).parent().attr('data-mid');
        log("Loading more for "+broadID);
        $.post('api/msg.php', {act:'det', id:broadID}, function(data){
            try{
                ret  = JSON.parse(data);
                if(ret.status == 1){
                    //Successfully fetched data
                    moreBroad = UIkit.modal("#moreBroad");
                    moreBroad.show();
                    ret  = ret.data;
                    log(ret);

                    timefill = $(".fillin[data-req='time']");
                    for(n=0; n<timefill.length; n++){
                        $(timefill[n]).html(ret.time)
                    }

                    subfill = $(".fillin[data-req='sub']");
                    for(n=0; n<timefill.length; n++){
                        $(subfill[n]).html(ret.sub)
                    }

                    msgfill = $(".fillin[data-req='message']");
                    for(n=0; n<timefill.length; n++){
                        $(msgfill[n]).html(ret.message)
                    }

                    ntfill = $(".fillin[data-req='ntarget']");
                    for(n=0; n<timefill.length; n++){
                        $(ntfill[n]).html(ret.ntarget)
                    }

                    $(".channels").html("Channels:");
                    for(channelDet in ret.channels){
                        log(channelDet)
                        $(".channels").append("<li>"+channelDet+" : <b>"+ret.channels[channelDet]+"</b></li>");
                    }
                                    

                }else{
                    log("Error fetching data");
                    log(ret.data);
                }
            }catch(err){
                log("Error parsing JSON");
                log(err)
            }
        })
    });

    $("#invoiceprint").on('click', function(){
        btnText = $(this).html()
        $("#loadInvoice .client-det").append("<li></li><li></li><li></li>")
                        .prepend("<b>Client:<b><li></li><li></li><li></li>")
                        $(this).html('')
        HTMLtoPDF("#loadInvoice");
        // /setTimeout( $(this).html(btnText), 1000000)
        //
    })

    $(".showInvoice").on('click', function(){
        messageID = $(this).attr('data-mid');

        mod = UIkit.modal("#loadInvoice");
        mod.show();

        //Getting current use details
        <?php
            $userID = $User->getUser();
            $churchDet = $User->churchDet($userID);
        ?>
        usernames = "<?php echo implode(' ', $User->id2name($userID) ); ?>";
        church = "<?php echo $churchDet['church']." - ".$churchDet['branch'] ?>";

        fillindata('ifillin', 'name', usernames);
        fillindata('ifillin', 'church', church);

        $.post('api/msg.php', {act:'det', id:messageID}, function(data){
            try{
                ret  = JSON.parse(data);
                if(ret.status == 1){
                    //Successfully fetched data
                    ret  = ret.data;
                    fillindata('ifillin', 'time', ret.time);
                    channels = ret.channels;

                    log(ret);
                    productselem = $(".invoice-table tbody").html("");
                    for(chan in channels){
                        productselem.prepend("<tr><td>"+chan+"</td><td>"+channels[chan]+"</td><td>"+ret.cost[chan]+"</td></tr>");
                    }
                    productselem.append("<tr class='uk-text-bold'><td>Total</td><td>"+Object.values(ret.channels).reduce((a, b) => parseInt(a) + parseInt(b), 0)+"</td><td>"+ret.cost.total+"</td></tr>");

                }else{
                    log("Error fetching data");
                    log(ret.data);
                }
            }catch(err){
                log("Error parsing JSON");
                log(err)
            }
        })
    });

    function fillindata(elem,  tagname, data){
        fillelem = $("."+elem+"[data-req='"+tagname+"']");
        for(n=0; n<fillelem.length; n++){
            $(fillelem[n]).html(data);
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
  $('th').each(function(col) {
    $(this).hover(
    function() { $(this).addClass('focus'); },
    function() { $(this).removeClass('focus'); }
  );
    $(this).click(function() {
      if ($(this).is('.asc')) {
        $(this).removeClass('asc');
        $(this).addClass('desc selected');
        sortOrder = -1;
      }
      else {
        $(this).addClass('asc selected');
        $(this).removeClass('desc');
        sortOrder = 1;
      }
      $(this).siblings().removeClass('asc selected');
      $(this).siblings().removeClass('desc selected');
      var arrData = $('table').find('tbody >tr:has(td)').get();
      arrData.sort(function(a, b) {
        var val1 = $(a).children('td').eq(col).text().toUpperCase();
        var val2 = $(b).children('td').eq(col).text().toUpperCase();
        if($.isNumeric(val1) && $.isNumeric(val2))
        return sortOrder == 1 ? val1-val2 : val2-val1;
        else
           return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
      });
      $.each(arrData, function(index, row) {
        $('tbody').append(row);
      });
    });
  });
});
</script>

