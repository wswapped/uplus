
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

    log("Monitor ID "+messageID)
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
            $("#sendProgLabel").text(percSent.toFixed()+'%');
            $("#quantSendProg").show(200);
            $("#sendProg-cont").show(900)
            $(".iforms").hide(600);


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
    $(".md-card-content.errorHandle").append("<li>"+error+"</li>");
}

//Includede in individual pages
// $(document).ready(function() {
//   $('th').each(function(col) {
//     $(this).hover(
//     function() { $(this).addClass('focus'); },
//     function() { $(this).removeClass('focus'); }
//   );
//     $(this).click(function() {
//       if ($(this).is('.asc')) {
//         $(this).removeClass('asc');
//         $(this).addClass('desc selected');
//         sortOrder = -1;
//       }
//       else {
//         $(this).addClass('asc selected');
//         $(this).removeClass('desc');
//         sortOrder = 1;
//       }
//       $(this).siblings().removeClass('asc selected');
//       $(this).siblings().removeClass('desc selected');
//       var arrData = $('table').find('tbody >tr:has(td)').get();
//       arrData.sort(function(a, b) {
//         var val1 = $(a).children('td').eq(col).text().toUpperCase();
//         var val2 = $(b).children('td').eq(col).text().toUpperCase();
//         if($.isNumeric(val1) && $.isNumeric(val2))
//         return sortOrder == 1 ? val1-val2 : val2-val1;
//         else
//            return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
//       });
//       $.each(arrData, function(index, row) {
//         $('tbody').append(row);
//       });
//     });
//   });
// });


$("#buyform").on('submit', function(e){
    e.preventDefault(); 
    phone = $("#phone-number").val();
    if(phone.length != 9 ){
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
            
        }catch(e){

        }
    })

})
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