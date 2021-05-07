<?php
/**
 * Scripts configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'parent_frontend' => [
		'handle'  => 'hivetheme-parent-frontend',
		'version' => hivetheme()->get_version( 'parent' ),
		'src'     => hivetheme()->get_url( 'parent' ) . '/assets/js/frontend.min.js',
		'deps'    => [ 'hivetheme-core-frontend' ],
	],
];
