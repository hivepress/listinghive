<?php
/**
 * Styles configuration.
 *
 * @package HiveTheme\Configs
 */
// todo.
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'parent_frontend' => [
		'handle' => 'hivetheme-parent-frontend',
		'src'    => hivetheme()->get_url( 'listinghive' ) . '/style.css',
		'scope'  => [ 'frontend', 'editor' ],
	],
];
