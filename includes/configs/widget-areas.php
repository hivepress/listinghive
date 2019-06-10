<?php
/**
 * Widget areas configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'footer' => [
		'name'          => esc_html__( 'Footer', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the site footer.', 'listinghive' ),
		'before_widget' => '<div class="column"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="widget__title">',
		'after_title'   => '</h4>',
	],
];
