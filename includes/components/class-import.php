<?php
/**
 * Import component.
 *
 * @package HiveTheme\Components
 */

namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Import component class.
 *
 * @class Import
 */
final class Import {

	/**
	 * Class constructor.
	 */
	public function __construct() {
		if ( is_admin() ) {

			// Add theme demos.
			add_filter( 'pt-ocdi/import_files', [ $this, 'add_demos' ] );

			// Import settings.
			add_action( 'pt-ocdi/after_all_import_execution', [ $this, 'import_settings' ] );
		}
	}

	/**
	 * Adds theme demos.
	 *
	 * @return array
	 */
	public function add_demos() {
		return hivetheme()->get_config( 'demos' );
	}

	/**
	 * Imports theme settings.
	 */
	public function import_settings() {

		// Get demos.
		$demos = hivetheme()->get_config( 'demos' );

		if ( ! empty( $demos ) ) {
			$demo = reset( $demos );

			// Get settings.
			$response = wp_remote_get( esc_url_raw( $demo['import_settings_file_url'] ) );

			if ( ! is_wp_error( $response ) ) {
				$settings = json_decode( wp_remote_retrieve_body( $response ), true );

				if ( ! empty( $settings ) ) {

					// Set theme options.
					if ( isset( $settings['theme_options'] ) ) {
						foreach ( $settings['theme_options'] as $option_name => $option_value ) {
							if ( strpos( $option_name, 'page_' ) !== false ) {
								if ( 'page_on_front' === $option_name ) {
									if ( class_exists( 'WP_Block_Type' ) && ! class_exists( 'Classic_Editor' ) ) {
										$option_value .= '-blocks';
									} else {
										$option_value .= '-shortcodes';
									}
								}

								$page = get_page_by_path( $option_value );

								if ( ! is_null( $page ) ) {
									update_option( $option_name, $page->ID );
								}
							} else {
								update_option( $option_name, $option_value );
							}
						}
					}

					// Set theme mods.
					if ( isset( $settings['theme_mods'] ) ) {
						foreach ( $settings['theme_mods'] as $mod_name => $mod_value ) {
							set_theme_mod( $mod_name, $mod_value );
						}
					}

					// Set menu locations.
					if ( isset( $settings['menu_locations'] ) ) {
						$menu_locations = get_theme_mod( 'nav_menu_locations' );

						foreach ( $settings['menu_locations'] as $location_name => $menu_name ) {
							$menu = wp_get_nav_menu_object( $menu_name );

							if ( false !== $menu ) {
								$menu_locations[ $location_name ] = $menu->term_id;
							}
						}

						set_theme_mod( 'nav_menu_locations', $menu_locations );
					}

					// Set term meta.
					if ( isset( $settings['term_meta'] ) ) {
						foreach ( $settings['term_meta'] as $meta ) {
							$term = get_term_by( 'slug', $meta['term_slug'], $meta['taxonomy'] );

							if ( false !== $term ) {
								if ( strpos( $meta['meta_value'], '/' ) === 0 ) {
									$attachment_id = attachment_url_to_postid( site_url( $meta['meta_value'] ) );

									if ( 0 !== $attachment_id ) {
										$meta['meta_value'] = $attachment_id;
									}
								}

								update_term_meta( $term->term_id, $meta['meta_key'], $meta['meta_value'] );
							}
						}
					}
				}
			}
		}
	}
}
