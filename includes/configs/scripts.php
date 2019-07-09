<?php
/**
 * Scripts configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'hoverintent' => [
		'handle' => 'hoverintent',
		'src'    => HT_THEME_URL . '/assets/js/jquery.hoverintent.min.js',
	],

	'frontend'    => [
		'handle' => 'ht-frontend',
		'src'    => HT_THEME_URL . '/assets/js/frontend.js',
		'deps'   => [ 'jquery', 'hoverintent', 'comment-reply' ],
	],
];
