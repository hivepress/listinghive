<?php
/**
 * Template component.
 *
 * @package HiveTheme\Components
 */

namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Template component class.
 *
 * @class Template
 */
final class Template {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		// Add theme supports.
		add_action( 'after_setup_theme', [ $this, 'add_theme_supports' ] );

		// Register menu locations.
		add_action( 'after_setup_theme', [ $this, 'register_menu_locations' ] );

		// Register widget areas.
		add_action( 'widgets_init', [ $this, 'register_widget_areas' ] );

		if ( ! is_admin() ) {

			// Set hero background.
			add_action( 'wp_enqueue_scripts', [ $this, 'set_hero_background' ] );
		}
	}

	/**
	 * Adds theme supports.
	 */
	public function add_theme_supports() {
		foreach ( hivetheme()->get_config( 'theme_supports' ) as $name ) {
			add_theme_support( $name );
		}
	}

	/**
	 * Registers menu locations.
	 */
	public function register_menu_locations() {
		foreach ( hivetheme()->get_config( 'menu_locations' ) as $name => $args ) {
			register_nav_menu( $name, ht\get_array_value( $args, 'description' ) );
		}
	}

	/**
	 * Registers widget areas.
	 */
	public function register_widget_areas() {
		foreach ( hivetheme()->get_config( 'widget_areas' ) as $name => $args ) {
			register_sidebar( array_merge( $args, [ 'id' => $name ] ) );
		}
	}

	/**
	 * Sets hero background.
	 */
	public function set_hero_background() {

		// Get image URL.
		$image_url = '';

		if ( is_singular() && has_post_thumbnail() ) {
			$image_url = get_the_post_thumbnail_url( null, 'ht_cover_large' );
		}

		// Add inline style.
		if ( ! empty( $image_url ) ) {
			wp_add_inline_style( 'ht-frontend', '.header-hero { background-image: url(' . esc_url( $image_url ) . '); }' );
		}
	}
}
