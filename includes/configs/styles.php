<?php
/**
 * Styles configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'minireset'         => [
		'handle' => 'minireset',
		'src'    => HT_THEME_URL . '/assets/css/minireset.min.css',
	],

	'flexboxgrid'       => [
		'handle' => 'flexboxgrid',
		'src'    => HT_THEME_URL . '/assets/css/flexboxgrid.min.css',
	],

	'fontawesome'       => [
		'handle' => 'fontawesome',
		'src'    => HT_THEME_URL . '/assets/css/fontawesome.min.css',
	],

	'fontawesome_solid' => [
		'handle' => 'fontawesome-solid',
		'src'    => HT_THEME_URL . '/assets/css/fontawesome-solid.min.css',
	],

	'frontend'          => [
		'handle' => 'ht-frontend',
		'src'    => HT_THEME_URL . '/style.css',
		'editor' => true,
	],
];
