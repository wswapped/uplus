
views = {
	index:{
		loc: 'broadcast-dash.php',
	},
	send:{
		loc: 'broadcast-send.php',		
	},
  shop:{
    loc: 'broad-shop.php',    
  }
};
//Getting page view to load
currentView = $(".pagesCont").attr('data-page');

if(views.hasOwnProperty(currentView)){
	//here the current view is defined
	//Cheecking if current view is included
	cpage = $("#page").attr('data-cont');
	if(cpage!=currentView){
		loadView(currentView);		
	}
}else{
	log('View not defined.. Loading send view');
	loadView('send');
}

function loadView(view){
	//Function to load a view in broadcast
	if(views.hasOwnProperty(view)){
	//here the view is defined
	log("Loading "+view);

	//Getting the view location
	loc = views[view].loc;

	//Changing attribute
	$(".pagesCont").attr('data-page', view)
				.load(loc);
	}else{
		log('View not defined.. Loading index view');
		return loadView('index');
	}
}
//Listemg
$(document).on('click', '.loadView', function() {
	log(this)
    targetView = $(this).attr('data-pagetoggle');
    log(targetView);	
    loadView(targetView);
});

function broadMoreModal(){
	//More broadcast modal

}

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

