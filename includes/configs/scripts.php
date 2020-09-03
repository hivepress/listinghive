<?php
/**
 * Scripts configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'sticky_sidebar'  => [
		'handle' => 'sticky-sidebar',
		'src'    => hivetheme()->get_url( 'parent' ) . '/assets/js/jquery.sticky-sidebar.min.js',
	],

	'parent_frontend' => [
		'handle' => 'hivetheme-parent-frontend',
		'src'    => hivetheme()->get_url( 'parent' ) . '/assets/js/frontend.min.js',
		'deps'   => [ 'hivetheme-core-frontend', 'sticky-sidebar' ],
	],
];
