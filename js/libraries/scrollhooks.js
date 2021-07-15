$( document ).ready(function() {
	$("html").addClass("notscrolled");
	var waypoint = new Waypoint({
		element: document.getElementsByClassName('u-lFooter'),
		handler: function(direction) {
			var header = $('html');
			if(direction=='down') {
				header.removeClass("notfinished").addClass("finished")
			}
			else {
				header.addClass("notfinished").removeClass("finished")				
			}
		},
		offset: '100%'
	})


	var waypoint = new Waypoint({
		element: document.getElementsByClassName('js'),
		handler: function(direction) {
			var header = $('html');
			if(direction=='down') {
				header.removeClass("notscrolled").addClass("scrolled")
			}
			else {
				header.addClass("notscrolled").removeClass("scrolled")				
			}
		},
		offset: '-1%'
	})
});