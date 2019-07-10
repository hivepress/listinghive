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

		// Menu
		hivetheme.getComponent('menu').each(function() {
			$(this).find('li').each(function() {
				var item = $(this);

				if (item.children('ul').length) {
					item.addClass('parent');

					item.hoverIntent(
						function() {
							if (item.parent('ul').parent('li').hasClass('parent')) {
								var menu = item.parent(),
									offset = menu.offset().left + menu.outerWidth() * 2;

								item.children('ul').removeClass('left').removeClass('right');

								if (offset > $(window).width()) {
									item.children('ul').addClass('left').css('left', -menu.outerWidth());
								} else {
									item.children('ul').addClass('right');
								}
							}

							item.addClass('active');
							item.children('ul').slideDown(150);
						},
						function() {
							item.children('ul').slideUp(150, function() {
								item.removeClass('active');
							});
						}
					);
				}

				item.children('a').on('click', function(e) {
					if ($(this).attr('href') === '#') {
						e.preventDefault();
					}
				});
			});
		});

		// Burger
		hivetheme.getComponent('burger').each(function() {
			var menu = $(this);

			menu.css('top', $('#wpadminbar').height());

			$('a[href="#' + menu.attr('id') + '"]').on('click', function(e) {
				$('body').css('overflow-y', 'hidden');

				menu.fadeIn(150);

				e.preventDefault();
			});

			menu.on('click', function(e) {
				if (!$(e.target).is('a') && !$(e.target).is('li.parent')) {
					$('body').css('overflow-y', 'auto');

					menu.fadeOut(150);
				}
			});

			menu.find('li').each(function() {
				var item = $(this);

				if (item.children('ul').length) {
					item.addClass('parent');

					item.on('click', function(e) {
						if ($(e.target).is(item)) {
							item.toggleClass('active');
							item.children('ul').slideToggle(150);
						}
					});
				}

				item.children('a').on('click', function(e) {
					if ($(this).attr('href') === '#') {
						e.preventDefault();
					}
				});
			});
		});

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

		// Sticky
		if (typeof hivepress === 'undefined') {
			$(window).on('load', function() {
				hivetheme.getComponent('sticky').each(function() {
					var container = $(this),
						spacing = 32 + $('#wpadminbar').height();

					container.wrapInner('<div />');

					container.children('div').stickySidebar({
						topSpacing: spacing,
						bottomSpacing: spacing,
					});
				});
			});
		}
	});
})(jQuery);
