/*global Router */

$('document').ready(function() {

	// director.js settings and configurations
	var home = function() {};
	var solutions = function() {};
  var aboutus = function() {};
  var careers = function() {};
  var contact = function() {};

	var allroutes = function() {
		var route = window.location.hash.slice(2);
		var sections = $('section');
		var section;

		section = sections.filter('[data-route=' + route + ']');

		if (section.length) {
			//sections.hide(250);
			//section.show(250);
			var sectionid = section.attr('id');
			$('html, body').animate({
				scrollTop: $('#'+sectionid).offset().top -54
			}, 500);

		}
	};

	var routes = {
		'/home': home,
		'/solutions': solutions,
		'/aboutus': aboutus,
		'/careers': careers,
		'/contact': contact
	};

	var router = Router(routes);

	router.configure({
		on: allroutes
	});

	router.init();

});

