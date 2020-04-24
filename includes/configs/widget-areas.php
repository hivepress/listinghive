<?php
/**
 * Widget areas configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'blog_sidebar'          => [
		'name'          => esc_html__( 'Blog', 'listinghive' ) . ' ' . sprintf( '(%s)', esc_html_x( 'sidebar', 'area', 'listinghive' ) ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	],

	'listings_view_sidebar' => [
		'name'          => hivetheme()->hivepress->get_string( 'listings' ) . ' ' . sprintf( '(%s)', esc_html_x( 'sidebar', 'area', 'listinghive' ) ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'hivepress',
	],

	'listing_view_sidebar'  => [
		'name'          => hivetheme()->hivepress->get_string( 'listing' ) . ' ' . sprintf( '(%s)', esc_html_x( 'sidebar', 'area', 'listinghive' ) ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'hivepress',
	],

	'vendors_view_sidebar'  => [
		'name'          => hivetheme()->hivepress->get_string( 'vendors' ) . ' ' . sprintf( '(%s)', esc_html_x( 'sidebar', 'area', 'listinghive' ) ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'hivepress',
	],

	'vendor_view_sidebar'   => [
		'name'          => hivetheme()->hivepress->get_string( 'vendor' ) . ' ' . sprintf( '(%s)', esc_html_x( 'sidebar', 'area', 'listinghive' ) ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'hivepress',
	],

	'user_account_sidebar'  => [
		'name'          => esc_html__( 'Account', 'listinghive' ) . ' ' . sprintf( '(%s)', esc_html_x( 'sidebar', 'area', 'listinghive' ) ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'hivepress',
	],

	'shop'                  => [
		'name'          => esc_html__( 'Shop', 'listinghive' ) . ' ' . sprintf( '(%s)', esc_html_x( 'sidebar', 'area', 'listinghive' ) ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'woocommerce',
	],

	'site_footer'           => [
		'name'          => esc_html__( 'Site', 'listinghive' ) . ' ' . sprintf( '(%s)', esc_html_x( 'footer', 'area', 'listinghive' ) ),
		'before_widget' => '<div class="col-sm col-xs-12"><div id="%1$s" class="widget widget--footer %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h5 class="widget__title">',
		'after_title'   => '</h5>',
	],
];
