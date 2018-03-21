
// $('.checkbox').change(function(){ //".checkbox" change 
//     //uncheck "select all", if one of the listed checkbox item is unchecked
//     if(this.checked == false){ //if this item is unchecked
//         $("#select_all")[0].checked = false; //change "select all" checked status to false
//     }
    
//     //check "select all" if all checkbox items are checked
//     if ($('.checkbox:checked').length == $('.checkbox').length ){ 
//         $("#select_all")[0].checked = true; //change "select all" checked status to true
//     }
// });

    // $('textarea#broadcastMsg').keyup(function(event){
    //     if(event.keyCode == 8){
    //         charcount = $(this).val().length;
    //         // /++charcount;
    //         $("#charcount").html(charcount);
    //     }
    //     estimCost();
    // });


jQuery(function () {

        var animate = setInterval(function () {

            window.progressbar && (progressbar.value += 10);

            if (!window.progressbar || progressbar.value >= progressbar.max) {
                clearInterval(animate);
            }

        }, 1000);

});

$("#number-input").on("keypress", function(e){
    log(e)
})
function indicateSendProgress(){
    //Function to just indicate that the message is sending
    $("#sendBtn").html("Sending <i class='fa fa-circle-o-notch fa-spin'></i>");

    log("Monitor ID "+messageID);
    $(".sendProg-cont").removeClass('display-none');
    $(".iforms").hide(600);

    ncount = checkNRecpts(); //People the message is to be sent

    $(".ncount").html(ncount);

    var source = new EventSource("api/mon.php?act=cont&id="+messageID);

    source.onmessage = function(event) {
        ///Indicating progress
        data = event.data;
        data = JSON.parse(data)
        if(data.not_sent != undefined){
            nsent = ncount - data.not_sent;
            percSent = (nsent*100)/ncount;

            $(".nsent").html(nsent);                                             

            $("#sendProg").css('width', percSent.toFixed()+'%');
            $("#sendProg").text(percSent.toFixed()+'%');
            $("#sendProgLabel").text(percSent.toFixed()+'%');
            $("#quantSendProg").show(200);
            $("#sendProg-cont").show(900)
            


            //closing session when 100% msgs are sent
            if(percSent == 100){
                log("Closing SSE connection")
                source.close();
            }
        }
        
    };

}
    

    // var msgMon = new EventSource('api/msg.php?act=mon');
    // msgMon.onmessage(function(){
    //     alert();
    // });

function logFormError(error){
    $(".md-card-content.errorHandle").append("<li class='uk-alert uk-alert-warning' data-uk-alert>"+error+"<a href='#' class='uk-alert-close uk-close'></a></li>");
}
$("#buyform").on('submit', function(e){
    e.preventDefault(); 
    phone = "0"+$("#phone-number").val();
    if(phone.length != 10 ){
        $(".phone-error").append("<p class='uk-text-danger'>Enter nine digits phone number as indicated below:</p>");
        return false;
    }
    nsms = $("#nsms").val(); //Number of desired SMS
    if(!parseInt(nsms)){
        $("#nsms").append("<p class='uk-text-danger'>Enter number of messages to buy :)</p>");
        return false;
    }
    churchID = $("#sendchurch").val();

    $.post("api/index.php", {action:'buy', phone:phone, count:nsms, church:churchID}, function(data){
        try{
            retdata = JSON.parse(data);
            if(retdata.status == true){
                balance = retdata.balance;
                $("#sendStatus").append("<div class=''><i class='material-icons md-bg-green-A400'>sentiment_very_satisfied</i>Transaction initiated successfully!<br /></div>");
                 setTimeout(function(){
                    alert("Closing modal as buying is done");
                    var modal = UIkit.modal("#buymodal");
                    modal.hide();
                }, 2000);
            }
        }catch(e){
            log("Error with returned data, server problem ".e);
        }
    });
});
smsInputElem = $("#nsms");

smsInputElem.on('keypress', function(){
    //Incrementing the SMS cost
    $("#smscost span")
});

smsInputElem.keyup(function(event){
    clickedKey = event.keyCode;
    //Trigger key on copy, paste or delete or backspace
    if(clickedKey==88 || clickedKey==86 || clickedKey==8 || clickedKey==9)
        smsInputElem.trigger('keypress');
});


function estimCost(){
    textLen = checkSMSCount();
    nRecv = checkNRecpts();
    log(textLen)

    $("#recCount").text(nRecv);
    msgcount = parseInt(textLen.msg) +parseInt( (textLen.char!=0?1:0) );
    $("#msgCount").text(msgcount);

    $("#totalEstim").text(msgcount*nRecv);
}
function checkNRecpts(){
    count = $("#recvCount").text();
    return count;
}
function checkSMSCount(){
    charcount = $("#charcount").text();
    msgcount = $("#msgcount").text();
    return {char: charcount, msg:msgcount};
}

function logRecCount(){
    //Calculating all checked elements --should come after
    selCount = $("#dt_tableExport input:checked").length;

    $("#recvCount").text(selCount);
    estimCost();
}
function log(data){
    console.log(data)
}
$(".nolink").on('click', function(){    
    return false;
});