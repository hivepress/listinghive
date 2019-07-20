<?php
/**
 * Template component.
 *
 * @package HiveTheme\Components
 */

namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;
use HivePress\Helpers as hp;

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

			// Alter templates.
			add_filter( 'hivepress/v1/templates/listing_view_block', [ $this, 'alter_listing_view_block' ] );
			add_filter( 'hivepress/v1/templates/listing_view_page', [ $this, 'alter_listing_view_page' ] );
			add_filter( 'hivepress/v1/templates/listing_category_view_block', [ $this, 'alter_listing_category_view_block' ] );
		}
	}

	/**
	 * Adds theme supports.
	 */
	public function add_theme_supports() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );

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
			if ( strpos( $name, 'hp_' ) !== 0 || function_exists( 'hivepress' ) ) {
				register_sidebar( array_merge( $args, [ 'id' => $name ] ) );
			}
		}
	}

	/**
	 * Sets hero background.
	 */
	public function set_hero_background() {

		// Get image URL.
		$image_url = get_header_image();

		if ( is_singular() && has_post_thumbnail() ) {
			$image_url = get_the_post_thumbnail_url( null, 'ht_cover_large' );
		} elseif ( is_tax( 'hp_listing_category' ) ) {
			$image_id = get_term_meta( get_queried_object_id(), 'hp_image_id', true );

			if ( ! empty( $image_id ) ) {
				$image = wp_get_attachment_image_src( $image_id, 'ht_cover_large' );

				if ( is_array( $image ) ) {
					$image_url = reset( $image );
				}
			}
		}

		// Add inline style.
		if ( ! empty( $image_url ) ) {
			$style = '.header-hero { background-image: url(' . esc_url( $image_url ) . '); }';

			if ( get_header_textcolor() ) {
				$style .= '.header-hero.is-dark { color: #' . esc_html( get_header_textcolor() ) . '; }';
			}

			wp_add_inline_style( 'ht-frontend', $style );
		}
	}

	/**
	 * Alters listing view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listing_view_block( $template ) {
		$category = hp\search_array_value( $template, [ 'blocks', 'listing_category' ] );

		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'listing_content' => [
						'blocks' => [
							'listing_category' => array_merge(
								$category,
								[
									'order' => 5,
								]
							),
						],
					],
				],
			],
			'blocks'
		);
	}

	/**
	 * Alters listing view page.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listing_view_page( $template ) {
		$category = hp\search_array_value( $template, [ 'blocks', 'listing_category' ] );

		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'page_content' => [
						'blocks' => [
							'listing_category' => array_merge(
								$category,
								[
									'order' => 5,
								]
							),
						],
					],
				],
			],
			'blocks'
		);
	}

	/**
	 * Alters listing category view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listing_category_view_block( $template ) {
		$count = hp\search_array_value( $template, [ 'blocks', 'listing_category_count' ] );

		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'listing_category_header' => [
						'blocks' => [
							'listing_category_count' => $count,
						],
					],
				],
			],
			'blocks'
		);
	}
}
