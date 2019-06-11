var hivetheme = {

	/**
	 * Gets component selector.
	 */
	getSelector: function(name) {
		return '[data-component=' + name + ']';
	},

	/**
	 * Gets component object.
	 */
	getComponent: function(name) {
		return jQuery(this.getSelector(name));
	},
};

(function($) {
	'use strict';

	$(document).ready(function() {

		// Parallax
		hivetheme.getComponent('parallax').each(function() {
			var container = $(this),
				offset = container.offset().top - $('#wpadminbar').height(),
				speed = 0.25;

			if ($(window).width() > 1024) {
				container.css('background-position-y', ($(window).scrollTop() - offset) * speed);

				$(window).on('scroll', function() {
					container.css('background-position-y', ($(window).scrollTop() - offset) * speed);
				});
			}
		});
	});
})(jQuery);
