

$.fn.revolver = function(options) {

	var plugin = this,
		addObj = $(this),
		defaults = {
			year : 0,
			month : 0,
			day : 0,
			daysDel : ' Days Remaining',
			hourDel : ':',
			minDel : ':',
			secDel : '',
			terminationMessage : 'Finish'
		},
		hit = false,
		target, bullet, distance, interval, d, h, m, s;

	plugin.settings = {};
	
	plugin.init = function(){
		
		plugin.settings = $.extend( {}, defaults, options);	// Overwrite the same name
		plugin.settings.month = plugin.settings.month - 1;	// Must be adjusted

		target = new Date(plugin.settings.year, plugin.settings.month, plugin.settings.day);

		tick();
		interval = window.setInterval('tick()', 1000);

	}
	
	tick = function(){

		bullet = new Date();
		distance = target - bullet;
		
		d = Math.floor(distance/(24*60*60*1000));
		h = Math.floor((distance%(24*60*60*1000))/(60*60*1000));
		m = Math.floor((distance%(24*60*60*1000))/(60*1000))%60;
		s = Math.floor((distance%(24*60*60*1000))/1000)%60%60;
		
		if(h < 10) h = "0" + h;
		if(m < 10) m = "0" + m;
		if(s < 10) s = "0" + s;
		
		if(distance > 0) hit = true;

		if(hit){
			addObj.html(d + plugin.settings.daysDel);
		}else{
			addObj.html(plugin.settings.terminationMessage);
		}

	}

	plugin.init();

};