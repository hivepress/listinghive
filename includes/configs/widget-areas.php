<?php
/**
 * Widget areas configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'sidebar' => [
		'name'          => esc_html__( 'Sidebar', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the site sidebar.', 'listinghive' ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget__title">',
		'after_title'   => '</h4>',
	],

	'footer'  => [
		'name'          => esc_html__( 'Footer', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the site footer.', 'listinghive' ),
		'before_widget' => '<div class="column"><div id="%1$s" class="widget widget--footer %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h5 class="widget__title">',
		'after_title'   => '</h5>',
	],
];
