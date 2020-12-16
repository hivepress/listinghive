(function($) {
	'use strict';

	$(window).on('load', function() {

		// Sticky
		if (typeof hivepress === 'undefined' && $(window).width() >= 768) {
			hivetheme.getComponent('sticky').each(function() {
				var container = $(this),
					spacing = 32;

				if ($('#wpadminbar').length) {
					spacing = spacing + $('#wpadminbar').height();
				}

				container.wrapInner('<div />');

				container.children('div').stickySidebar({
					topSpacing: spacing,
					bottomSpacing: spacing,
				});
			});
		}

		// Parallax
		hivetheme.getComponent('parallax').each(function() {
			var container = $(this),
				background = container.css('background-image'),
				offset = container.offset().top,
				speed = 0.25;

			if ($('#wpadminbar').length) {
				offset = offset - $('#wpadminbar').height();
			}

			if ($(window).width() >= 1024 && background.indexOf('url') === 0) {
				container.css('background-position-y', ($(window).scrollTop() - offset) * speed);

				$(window).on('scroll', function() {
					container.css('background-position-y', ($(window).scrollTop() - offset) * speed);
				});
			}
		});
	});
})(jQuery);
