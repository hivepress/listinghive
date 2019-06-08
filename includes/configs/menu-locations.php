<?php
/**
 * Menu locations configuration.
 *
 * @package HivePress\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'header' => [
		'description' => esc_html__( 'Header', 'listinghive' ),
	],

	'footer' => [
		'description' => esc_html__( 'Footer', 'listinghive' ),
	],
];
