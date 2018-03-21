var init_comode = ""; //This stores active communicatin mode user is using
$(document).ready(function(){
    init_comode = $("input[name='mode']").val();
});

$('textarea#broadcastMsg').keyup(function(event){
    clickedKey = event.keyCode;

    //Trigger key on copy, paste or delete or backspace
    if(clickedKey==88 || clickedKey==86 || clickedKey==8 || clickedKey==9)
        $('textarea#broadcastMsg').trigger('keypress');
})

//button group for contribute and sending
$(".messageActionButton").on('click', function(e){
	target = $(this).attr('id'); //getting the id of clicked button


	//Getting the message
	message = $("#broadcastMsg").val();
    if(message.length<1){
        logFormError("Please provide message")
        return false;
    }

    //Checking reciepients
    recps = $("#dt_tableExport input:checked");
    arr = {};
    recps.each(function(index, data){
        arr[index] = $(data).val();
    });

    comode = $("input[name='mode']").val(); //chose mode for communication

    if(recps.length<1){
        logFormError("Select people to broadcast a message");
        return false;
    }


    //Sending the logic to different function for sending and scheduling
    if(target == 'sendBtn'){
    	//Asking before sending messages
	    confmodal = UIkit.modal("#sendMessageModal");

	    
	    recpcount = checkNRecpts();
	    if(comode == "sms" || comode == "SMS")
	    {
	        smscount = checkSMSCount();
	        ttlSMScount = smscount.msg+""+(smscount.char!=0?1:0);
	        $(".transDet").html("Broadcasting to "+recpcount+" people in "+(smscount.msg == 0?"":smscount.msg)+" msg and "+smscount.char+' characters');
	        $(".transDet").append("<br />You will be charged for "+ttlSMScount+" SMS costing "+13*ttlSMScount*recpcount+"FRW");
	        oj = confmodal.show();
	        var me = 0;

	        $(".broadcastMsg").on('click', function(){
	            modal = UIkit.modal('#sendMessageModal');
	            modal.hide();
	            $.post('api/msg.php', {act:'save', mode:"sms", message:message, members:arr}, function(data){
	               //Parsing return data
	               try{
	                    ret = JSON.parse(data);
	                    if(ret.status){
	                        //Preparing the user to see more actions
	                        //Indicating the message send progress
	                        messageID = ret.messageID;
	                        indicateSendProgress();
	                    }else{  
	                        log(ret.data);
	                    }
	               }catch(err){
	                    log('Failed in parsing JSON');
	                    log(err);
	               }
	            })
	            return true;
	        }) 
	    }else if(comode == "app")
	    {
	        
	        $(".transDet").html("Broadcasting to "+recpcount+" App users<br />Free of Charge!");
	        oj = confmodal.show();
	        var me = 0;

	        $(".broadcastMsg").on('click', function(){
	            modal = UIkit.modal('#sendMessageModal');
	            modal.hide();
	            $.post('api/msg.php', {act:'save', mode:"app", message:message, members:arr}, function(data){
	               //Parsing return data
	               try{
	                    ret = JSON.parse(data);

	                    if(ret.status){
	                        //Preparing the user to see more actions
	                        //Indicating the message send progress
	                        messageID = ret.messageID;
	                        indicateSendProgress();
	                    }else{  
	                        log(ret.data);
	                    }
	               }catch(err){
	                    log('Failed in parsing JSON');
	                    log(err);
	               }
	            })
	            return true;
	        }) 
	    }else if(comode == "email")
	    {
	        subject = $("#broadcastSubj").val();
	        
	        $(".transDet").html("Broadcasting to "+recpcount+" emails<br />Free of Charge!");
	        oj = confmodal.show();
	        var me = 0;

	        $(".broadcastMsg").on('click', function(){
	            modal = UIkit.modal('#sendMessageModal');
	            modal.hide();
	            $.post('api/msg.php', {act:'save', mode:"email", subject:subject, message:message, members:arr}, function(data){
	               //Parsing return data
	               try{
	                    ret = JSON.parse(data);

	                    if(ret.status){
	                        //Preparing the user to see more actions
	                        //Indicating the message send progress
	                        messageID = ret.messageID;
	                        indicateSendProgress();
	                    }else{  
	                        log(ret.data);
	                    }
	               }catch(err){
	                    log('Failed in parsing JSON');
	                    log(err);
	               }
	            })
	            return true;
	        }) 
	    } 
    }else if(target == 'scheduleBtn'){
    	//scheduling a message

    	//Asking for time to send the message
    	confmodal = UIkit.modal("#scheduleMessageModal");
    	oj = confmodal.show();


    	//getting schedule details
    	 $("#scheduleMessage").on('submit', function(e){
    	 		e.preventDefault();
    	 		//Date and time when message will be sent
    	 		date = $("#schedDate").val();
    	 		time = $("#schedTime").val();
	            // modal.hide();
	            $.post('api/msg.php', {act:'save', mode:comode, message:message, members:arr, scheduleTime:date+" "+time}, function(data){
	               //Parsing return data
	               try{
	                    ret = JSON.parse(data);
	                    if(ret.status){
	                        //Preparing the user to see more actions
	                        //Indicating the message send progress
	                        messageID = ret.messageID;
	                    }else{  
	                        log(ret.data);
	                    }
	               }catch(err){
	                    log('Failed in parsing JSON');
	                    log(err);
	               }
	            })
	            return true;
	        }) 

    }else{
    	alert("This could be wrong"+target)
    }
})


$("#comform").on('submit', function(e){ 
    e.preventDefault();

    message = $("#broadcastMsg").val();
    if(message.length<1){
        logFormError("Please provide message")
        return false;
    }

    

    //Asking before sending messages
    confmodal = UIkit.modal("#sendMessageModal");

    comode = $("input[name='mode']").val(); //chose mode for communication
    recpcount = checkNRecpts();
    if(comode == "sms" || comode == "SMS")
    {
        smscount = checkSMSCount();
        ttlSMScount = smscount.msg+""+(smscount.char!=0?1:0);
        $(".transDet").html("Broadcasting to "+recpcount+" people in "+(smscount.msg == 0?"":smscount.msg)+" msg and "+smscount.char+' characters');
        $(".transDet").append("<br />You will be charged for "+ttlSMScount+" SMS costing "+13*ttlSMScount*recpcount+"FRW");
        oj = confmodal.show();
        var me = 0;

        $(".broadcastMsg").on('click', function(){
            modal = UIkit.modal('#sendMessageModal');
            modal.hide();
            $.post('api/msg.php', {act:'save', mode:"sms", message:message, members:arr}, function(data){
               //Parsing return data
               try{
                    ret = JSON.parse(data);
                    if(ret.status){
                        //Preparing the user to see more actions
                        //Indicating the message send progress
                        messageID = ret.messageID;
                        indicateSendProgress();
                    }else{  
                        log(ret.data);
                    }
               }catch(err){
                    log('Failed in parsing JSON');
                    log(err);
               }
            })
            return true;
        }) 
    }else if(comode == "app")
    {
        
        $(".transDet").html("Broadcasting to "+recpcount+" App users<br />Free of Charge!");
        oj = confmodal.show();
        var me = 0;

        $(".broadcastMsg").on('click', function(){
            modal = UIkit.modal('#sendMessageModal');
            modal.hide();
            $.post('api/msg.php', {act:'save', mode:"app", message:message, members:arr}, function(data){
               //Parsing return data
               try{
                    ret = JSON.parse(data);

                    if(ret.status){
                        //Preparing the user to see more actions
                        //Indicating the message send progress
                        messageID = ret.messageID;
                        indicateSendProgress();
                    }else{  
                        log(ret.data);
                    }
               }catch(err){
                    log('Failed in parsing JSON');
                    log(err);
               }
            })
            return true;
        }) 
    }else if(comode == "email")
    {
        subject = $("#broadcastSubj").val();
        
        $(".transDet").html("Broadcasting to "+recpcount+" emails<br />Free of Charge!");
        oj = confmodal.show();
        var me = 0;

        $(".broadcastMsg").on('click', function(){
            modal = UIkit.modal('#sendMessageModal');
            modal.hide();
            $.post('api/msg.php', {act:'save', mode:"email", subject:subject, message:message, members:arr}, function(data){
               //Parsing return data
               try{
                    ret = JSON.parse(data);

                    if(ret.status){
                        //Preparing the user to see more actions
                        //Indicating the message send progress
                        messageID = ret.messageID;
                        indicateSendProgress();
                    }else{  
                        log(ret.data);
                    }
               }catch(err){
                    log('Failed in parsing JSON');
                    log(err);
               }
            })
            return true;
        }) 
    }   
          
});


$("th.sorthead").on('click', function(){
    selectedText = this.innerText.trim();


    allSortHeads = [];
    $("thead th").each(function(){
        temp = this.innerText.trim();
        allSortHeads.push(temp);
    });

    sortIndex = allSortHeads.indexOf(selectedText);

    //Sorting table according to sortindex
    $("#dt_tableExport tr").sort(function(index, value){
    });
    // var elemIndex = $('.sorthead').indexOf(this)
    // log(elemIndex)
});

$('textarea#broadcastMsg').keypress(function(){
    charcount = $(this).val().length;
    ++charcount;
    messages = charcount%160;
    if(messages < charcount){
        $(".moreSMSview").show();

        $("#msgcount").html(parseInt(charcount /160));
        $("#charcount").html(parseInt(charcount % 160));
    }else{
        $("#msgcount").html(0);
         $(".moreSMSview").hide();
        $("#charcount").html(charcount);
    }
    estimCost();
});

//select all checkboxes
$(".checkCont input[type='checkbox'].controlOption").change(function(){
    var status = this.checked; // "select all" checked status
    clickedElem = $(this).attr('data-target');
    elems = $('.'+clickedElem);
    log(clickedElem)
    

    elems.each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });

    //Changing the receiver count on display --updating
    logRecCount();    
});
//Trigerring counter when checkbox changes
$("#dt_tableExport input").on('change', function(){
    logRecCount();
})
$("#membersCont").on("change", function(){
    logRecCount();
})
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

$("#dt_tableExport tbody tr").on('click', function(){
    highlight  = $(this).find("input[type='checkbox']");
    log(highlight)
    highlight.attr('checked', !highlight.attr('checked')); 
});

$(".comode li").on("click", function(){
    //Handling communication mode switching
    
    //Checking if commode is changed    
    mode = $(this).attr('data-mode');

    prevmode = $("input[name='mode']").val();
    $("input[name='mode']").val(mode);

    //if communication mode is changed
    if(mode != prevmode){


        switchMode(mode);
        loadUsers(mode);
        logRecCount();
    }
   
})


comModes = ['sms', 'app', 'email'];

function switchMode(mode){
    for (var i = comModes.length - 1; i >= 0; i--) {
        cmode = comModes[i];
        cmode_elems = "."+cmode+"-elem";
        // alert(cmode+"  == "+ mode);
        if(cmode != mode){
            
            $(cmode_elems).addClass("uk-hidden"); //Hiding elements
            $("."+mode+"-elem").removeClass("uk-hidden");
        }else
            continue;
    }
    return false;

}
function loadUsers(modeUsers){
    //Function to load the users of a specifi mode
    log(members[modeUsers]);
    if(members[modeUsers])
    {
        // $("#membersCont")
        addMembers = members[modeUsers]; //members to add to table
        $("#membersCont").html("<tr></tr>");
        for(var n=0; n<addMembers.length; n++){
            mem = addMembers[n];
            $("#membersCont").append("<tr><td>"+(n+1)+"</td><td><input value=\""+mem['id']+"\" class=\"all "+mem['bname']+"\" type='checkbox'/></td><td>"+mem['name']+"</td><td>"+mem['bname']+"</td><td>"+mem['phone']+"</td><td>"+mem['email']+"</td></tr>");
        }
        log(addMembers);

    }
    else
    {
        alert("Can't find your members with "+modeUsers);
    }
}
function log(data){
    console.log(data)
}