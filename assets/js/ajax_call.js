// Display Users
function page(pageID){
	var accID = pageID;
	document.getElementById('users').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/testlog.php",
			dataType : "html",
			cache : "false",
			data : {
				
				accID : accID,
			},
			success : function(html, textStatus){
				$("#users").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}

//Add bank account
function check_account(){
	alert('hey');
	var catId =$("#catId").val();
	//document.getElementById('anouncement').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/testlog.php",
			dataType : "html",
			cache : "false",
			data : {
				account_to_conf : account_to_conf,
				personalID : personalID,
			},
			success : function(html, textStatus){
				$("#anouncement").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
 }
 
// Reject invitation of my account
 function rejectance(account_to_reg, personalID_to_reg){
	document.getElementById('group_infromation').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/testlog.php",
			dataType : "html",
			cache : "false",
			data : {
				account_to_reg : account_to_reg,
				personalID_to_reg : personalID_to_reg,
			},
			success : function(html, textStatus){
				$("#anouncement").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
 }

// Group invitation of my account
 function group_info(group_id, G_personalID){
	document.getElementById('group_infromation').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/testlog.php",
			dataType : "html",
			cache : "false",
			data : {
				group_id : group_id,
				G_personalID : G_personalID,
			},
			success : function(html, textStatus){
				$("#group_infromation").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
 }
 
// Load users
function activate(activateID){
	
	var actID = activateID;
	alert('do you what to remove 0'+ actID +' from your account');
	
	document.getElementById('users').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/testlog.php",
			dataType : "html",
			cache : "false",
			data : {
				
				actID : actID,
			},
			success : function(html, textStatus){
				$("#users").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}

// Account Name 
function get_info(infoID, myID){
	//document.getElementById('account_name').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/testlog.php",
			dataType : "html",
			cache : "false",
			data : {
				infoID : infoID,
				myID : myID
			},
			success : function(html, textStatus){
				$("#account_name").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}

// Load the personal information Chart
function phone(phoneID){
	document.getElementById('transactions').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/testlog.php",
			dataType : "html",
			cache : "false",
			data : {
				
				phoneID : phoneID,
			},
			success : function(html, textStatus){
				$("#transactions").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
	
}

//Count the users in a group
function count_u(groupID, myID){
	//document.getElementById('counted').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/testlog.php",
			dataType : "html",
			cache : "false",
			data : {
				
				groupID : groupID,
				myID : myID,
			},
			success : function(html, textStatus){
				$("#counted").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
	
}


// Load notifications at the strat
  function codeAddress() 
  {
	document.getElementById('tutorials').innerHTML = '<iframe width="560" height="315" src="https://www.youtube.com/embed/_QoR_i0IIfY" frameborder="0" allowfullscreen></iframe>';
	$("#examplePositionCenter").modal();
	
  }
window.onload = codeAddress;


// Display Onceoff
function getonceof(grouID){
	//alert(grouID);
	document.getElementById('onceofInfo').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/contributions.php",
			dataType : "html",
			cache : "false",
			data : {
				
				groupID : grouID,
			},
			success : function(html, textStatus){
				$("#onceofInfo").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}

// Display Payements
function payementOptions(){
	document.getElementById('contBody').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	var contribut = 'yes';
	$.ajax({
			type : "GET",
			url : "scripts/behinde.php",
			dataType : "html",
			cache : "false",
			data : {
				
				contribut : contribut,
			},
			success : function(html, textStatus){
				$("#contBody").html(html);
				document.getElementById('contributNow').innerHTML = '</br>';
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}

// Give me a payement input
function payement2(method){
	var contributedAmount = document.getElementById('contributedAmount').value;
		  if (contributedAmount == null || contributedAmount == "") 
		  {
				document.getElementById('amountError').innerHTML = 'Contributed Amount must be filled out';
				return false;
			}document.getElementById('contBody').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	var banks = 'yes';
	
	var method = method;
	$.ajax({
			type : "GET",
			url : "scripts/behinde.php",
			dataType : "html",
			cache : "false",
			data : {
				
				contributedAmount : contributedAmount,
				method : method,
			},
			success : function(html, textStatus){
				$("#contBody").html(html);
				document.getElementById('contributNow').innerHTML = '</br>';
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}


