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
		'src'    => HT_THEME_URL . '/assets/js/jquery.hoverIntent.min.js',
	],

	'fitvids'        => [
		'handle' => 'fitvids',
		'src'    => HT_THEME_URL . '/assets/js/jquery.fitvids.min.js',
	],

	'sticky_sidebar' => [
		'handle' => 'sticky-sidebar',
		'src'    => HT_THEME_URL . '/assets/js/jquery.sticky-sidebar.min.js',
	],

	'frontend'       => [
		'handle' => 'ht-frontend',
		'src'    => HT_THEME_URL . '/assets/js/frontend.js',
		'deps'   => [ 'jquery', 'hoverintent', 'fitvids', 'sticky-sidebar', 'comment-reply' ],
	],
];
