<?php
/**
 * Styles configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'minireset'         => [
		'handle' => 'minireset',
		'src'    => hivetheme()->get_url() . '/assets/css/minireset.min.css',
	],

	'flexboxgrid'       => [
		'handle' => 'flexboxgrid',
		'src'    => hivetheme()->get_url() . '/assets/css/flexboxgrid.min.css',
	],

	'fontawesome'       => [
		'handle' => 'fontawesome',
		'src'    => hivetheme()->get_url() . '/assets/css/fontawesome/fontawesome.min.css',
	],

	'fontawesome_solid' => [
		'handle' => 'fontawesome-solid',
		'src'    => hivetheme()->get_url() . '/assets/css/fontawesome/solid.min.css',
	],

	'core_frontend'     => [
		'handle' => 'hivetheme-core-frontend',
		'src'    => hivetheme()->get_url() . '/style.css',
		'scope'  => [ 'frontend', 'editor' ],
	],
];
