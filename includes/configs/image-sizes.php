<?php
/**
 * Image sizes configuration.
 *
 * @package HiveTheme\Configs
 */

use HiveTheme\Helpers as ht;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'portrait_small'  => [
		'width'  => 400,
		'height' => 533,
		'crop'   => true,
	],

	'landscape_large' => [
		'width'  => 800,
		'height' => 600,
		'crop'   => true,
	],

	'cover_large'     => [
		'width'  => 1600,
		'height' => 800,
		'crop'   => true,
	],
];
