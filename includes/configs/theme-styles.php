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
			h1,
			h2,
			h3,
			h4,
			h5,
			h6
		',

		'properties' => [
			[
				'name'      => 'font-family',
				'theme_mod' => 'heading_font',
			],
		],
	],

	[
		'selector'   => 'body',

		'properties' => [
			[
				'name'      => 'font-family',
				'theme_mod' => 'body_font',
			],
		],
	],
];
