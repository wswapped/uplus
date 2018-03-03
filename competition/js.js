 
$(document).ready(function() {
	//When document loads. we have to query groups

	setInterval(function(){
		//group members
		$.post('api.php', {action:'get_groups'}, function(data){
			try{
				ret = JSON.parse(data)
				if(ret.length > 0){
					//Here we have got the  updates on groups
					member_groups_elem = $("#member_groups");
					member_groups_elem.html("");
					for(n=0; n<ret.length; n++){
						group = ret[n]
						member_groups_elem.append("<tr><td>"+(n+1)+"</td><td>"+group['name']+"</td><td>"+group['createdDate']+"</td><td>"+group['num']+"</td></tr>");
					}
				}
			}catch(e){
				console.log(e);
			}
		});

		//Contributing group
		$.post('api.php', {action:'get_contributions'}, function(data){
			try{
				ret = JSON.parse(data);
				ret = ret.data
				if(ret.length > 0){
					//Here we have got the  updates on groups
					member_groups_elem = $("#contribution_groups");
					member_groups_elem.html("");
					for(n=0; n<ret.length; n++){
						group = ret[n]
						member_groups_elem.append("<tr><td>"+(n+1)+"</td><td>"+group['name']+"</td><td>"+group['num']+"</td><td>"+group['amount']+"</td></tr>");
					}
				}
			}catch(e){
				console.log(e);
			}
		})	
	},4000)
	

});

	 
