<?php
/**
 * Scripts configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'hoverintent'    => [
		'handle' => 'hoverintent',
		'src'    => HT_THEME_URL . '/assets/js/jquery.hoverintent.min.js',
	],

	'sticky_sidebar' => [
		'handle' => 'sticky-sidebar',
		'src'    => HT_THEME_URL . '/assets/js/jquery.sticky-sidebar.min.js',
	],

	'frontend'       => [
		'handle' => 'ht-frontend',
		'src'    => HT_THEME_URL . '/assets/js/frontend.js',
		'deps'   => [ 'jquery', 'hoverintent', 'sticky-sidebar', 'comment-reply' ],
	],
];
