<?php
/**
 * Scripts configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'frontend' => [
		'handle' => 'ht-frontend',
		'src'    => HT_THEME_URL . '/assets/js/frontend.js',
		'deps'   => [ 'jquery', 'comment-reply' ],
	],
];
