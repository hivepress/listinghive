<?php
/**
 * Styles configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'bulma'    => [
		'handle' => 'bulma',
		'src'    => HT_THEME_URL . '/assets/css/bulma.min.css',
		'editor' => true,
	],

	'frontend' => [
		'handle' => 'ht-frontend',
		'src'    => HT_THEME_URL . '/style.css',
		'editor' => true,
	],
];
