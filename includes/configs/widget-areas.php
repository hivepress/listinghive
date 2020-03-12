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
		'name'          => esc_html__( 'Blog Sidebar', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the blog sidebar.', 'listinghive' ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	],

	'listings_view_sidebar' => [
		'name'          => esc_html__( 'Listings Sidebar', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the listings sidebar.', 'listinghive' ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'hivepress',
	],

	'listing_view_sidebar'  => [
		'name'          => esc_html__( 'Listing Sidebar', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the listing sidebar.', 'listinghive' ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'hivepress',
	],

	'vendors_view_sidebar'  => [
		'name'          => esc_html__( 'Vendors Sidebar', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the vendors sidebar.', 'listinghive' ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'hivepress',
	],

	'vendor_view_sidebar'   => [
		'name'          => esc_html__( 'Vendor Sidebar', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the vendor sidebar.', 'listinghive' ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'hivepress',
	],

	'user_account_sidebar'  => [
		'name'          => esc_html__( 'Account Sidebar', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the account sidebar.', 'listinghive' ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'hivepress',
	],

	'shop'                  => [
		'name'          => esc_html__( 'Shop Sidebar', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the shop sidebar.', 'listinghive' ),
		'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
		'plugin'        => 'woocommerce',
	],

	'site_footer'           => [
		'name'          => esc_html__( 'Site Footer', 'listinghive' ),
		'description'   => esc_html__( 'Add widgets here to appear in the site footer.', 'listinghive' ),
		'before_widget' => '<div class="col-sm col-xs-12"><div id="%1$s" class="widget widget--footer %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h5 class="widget__title">',
		'after_title'   => '</h5>',
	],
];
