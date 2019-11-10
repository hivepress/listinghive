<?php
/**
 * Asset component.
 *
 * @package HiveTheme\Components
 */

namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Asset component class.
 *
 * @class Asset
 */
final class Asset {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		// Add image sizes.
		add_action( 'after_setup_theme', [ $this, 'add_image_sizes' ] );

		// Enqueue styles.
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'admin_init', [ $this, 'enqueue_editor_styles' ] );

		// Enqueue scripts.
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		// Filter scripts.
		add_filter( 'script_loader_tag', [ $this, 'filter_script' ], 10, 2 );
	}

	/**
	 * Adds image sizes.
	 */
	public function add_image_sizes() {
		foreach ( hivetheme()->get_config( 'image_sizes' ) as $image_size => $image_size_args ) {
			add_image_size( ht\prefix( $image_size ), $image_size_args['width'], ht\get_array_value( $image_size_args, 'height', 9999 ), ht\get_array_value( $image_size_args, 'crop', false ) );
		}
	}

	/**
	 * Enqueues styles.
	 */
	public function enqueue_styles() {

		// Get styles.
		$styles = hivetheme()->get_config( 'styles' );

		// Filter styles.
		$styles = array_filter(
			$styles,
			function( $style ) {
				$scope = (array) ht\get_array_value( $style, 'scope' );

				return ! array_diff( [ 'frontend', 'backend' ], $scope ) || ( ! is_admin() xor in_array( 'backend', $scope, true ) );
			}
		);

		// Enqueue styles.
		foreach ( $styles as $style ) {
			wp_enqueue_style( $style['handle'], $style['src'], ht\get_array_value( $style, 'deps', [] ), ht\get_array_value( $style, 'version', HT_THEME_VERSION ) );
		}
	}

	/**
	 * Enqueues editor styles.
	 */
	public function enqueue_editor_styles() {
		foreach ( hivetheme()->get_config( 'styles' ) as $style ) {
			if ( in_array( 'editor', (array) ht\get_array_value( $style, 'scope' ), true ) ) {
				add_editor_style( $style['src'] );
			}
		}
	}

	/**
	 * Enqueues scripts.
	 */
	public function enqueue_scripts() {

		// Get scripts.
		$scripts = hivetheme()->get_config( 'scripts' );

		// Filter scripts.
		$scripts = array_filter(
			$scripts,
			function( $script ) {
				$scope = (array) ht\get_array_value( $script, 'scope' );

				return ! array_diff( [ 'frontend', 'backend' ], $scope ) || ( ! is_admin() xor in_array( 'backend', $scope, true ) );
			}
		);

		// Enqueue scripts.
		foreach ( $scripts as $script ) {
			wp_enqueue_script( $script['handle'], $script['src'], ht\get_array_value( $script, 'deps', [] ), ht\get_array_value( $script, 'version', HT_THEME_VERSION ), ht\get_array_value( $script, 'in_footer', true ) );
		}
	}

	/**
	 * Filters script HTML.
	 *
	 * @param string $tag Script tag.
	 * @param string $handle Script handle.
	 * @return string
	 */
	public function filter_script( $tag, $handle ) {

		// Set attributes.
		$attributes = [ 'async', 'defer', 'crossorigin' ];

		// Filter HTML.
		foreach ( $attributes as $attribute ) {
			$value = wp_scripts()->get_data( $handle, $attribute );

			if ( false !== $value ) {
				$output = ' ' . $attribute;

				if ( strpos( $tag, $output . '>' ) === false && strpos( $tag, $output . ' ' ) === false && strpos( $tag, $output . '="' ) === false ) {
					if ( true !== $value ) {
						$output .= '="' . esc_attr( $value ) . '"';
					}

					$tag = str_replace( '></', $output . '></', $tag );
				}
			}
		}

		return $tag;
	}
}
