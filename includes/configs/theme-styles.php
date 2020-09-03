<?php
/**
 * Theme styles configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	[
		'selector'   => '
			.button,
			button,
			input[type=submit],
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.wp-block-button__link,
			.header-navbar__burger > ul > li > a,
			.pagination > span,
			.pagination .nav-links > a,
			.pagination .nav-links > span,
			.pagination > a,
			.woocommerce nav.woocommerce-pagination ul li a,
			.woocommerce nav.woocommerce-pagination ul li span
		',

		'properties' => [
			[
				'name'      => 'font-family',
				'theme_mod' => 'heading_font',
			],

			[
				'name'      => 'font-weight',
				'theme_mod' => 'heading_font_weight',
			],
		],
	],

	[
		'selector'   => '
			.title::before,
			.footer-widgets .widget__title::before,
			.hp-page__title::before,
			.hp-section__title::before,
			.hp-listing--view-block .hp-listing__featured-badge
		',

		'properties' => [
			[
				'name'      => 'background-color',
				'theme_mod' => 'primary_color',
			],
		],
	],

	[
		'selector'   => '
			.tagcloud a:hover,
			.wp-block-tag-cloud a:hover,
			.hp-listing__images-carousel .slick-current img,
			.hp-listing--view-block.hp-listing--featured
		',

		'properties' => [
			[
				'name'      => 'border-color',
				'theme_mod' => 'primary_color',
			],
		],
	],

	[
		'selector'   => '
			.post__categories a:hover,
			.hp-listing--view-block .hp-listing__categories a:hover,
			.hp-listing--view-page .hp-listing__categories a:hover
		',

		'properties' => [
			[
				'name'      => 'background-color',
				'theme_mod' => 'secondary_color',
			],
		],
	],
];
