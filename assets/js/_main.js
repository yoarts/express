(function($) {
  "use strict";
	$('ul.nav li.dropdown').hover(function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(30).fadeIn();
	}, function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
	});
})(jQuery);
