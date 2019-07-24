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

			// Import configuration.
			add_action( 'pt-ocdi/after_all_import_execution', [ $this, 'import_config' ] );
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
	 * Imports theme configuration.
	 */
	public function import_config() {

		// Get demos.
		$demos = hivetheme()->get_config( 'demos' );

		if ( ! empty( $demos ) ) {
			$demo = reset( $demos );

			// Get configuration.
			$response = wp_remote_get( esc_url_raw( $demo['import_config_file_url'] ) );

			if ( ! is_wp_error( $response ) ) {
				$config = json_decode( wp_remote_retrieve_body( $response ), true );

				if ( ! empty( $config ) ) {

					// Set theme options.
					if ( isset( $config['options'] ) ) {
						foreach ( $config['options'] as $option_name => $option_value ) {
							if ( strpos( $option_name, 'page_' ) !== false ) {
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
					if ( isset( $config['theme_mods'] ) ) {
						foreach ( $config['theme_mods'] as $mod_name => $mod_value ) {
							if ( strpos( $mod_value, '/' ) === 0 ) {
								$mod_value = site_url( $mod_value );

								if ( 'header_image' !== $mod_name ) {
									$mod_value = attachment_url_to_postid( $mod_value );
								}
							}

							if ( ! empty( $mod_value ) ) {
								set_theme_mod( $mod_name, $mod_value );
							}
						}
					}

					// Set menu locations.
					if ( isset( $config['menu_locations'] ) ) {
						$menu_locations = get_theme_mod( 'nav_menu_locations' );

						foreach ( $config['menu_locations'] as $location_name => $menu_name ) {
							$menu = wp_get_nav_menu_object( $menu_name );

							if ( false !== $menu ) {
								$menu_locations[ $location_name ] = $menu->term_id;
							}
						}

						set_theme_mod( 'nav_menu_locations', $menu_locations );
					}

					// Set term meta.
					if ( isset( $config['term_meta'] ) ) {
						foreach ( $config['term_meta'] as $meta ) {
							$term = get_term_by( 'slug', $meta['term_slug'], $meta['taxonomy'] );

							if ( false !== $term ) {
								if ( strpos( $meta['meta_value'], '/' ) === 0 ) {
									$meta['meta_value'] = attachment_url_to_postid( site_url( $meta['meta_value'] ) );
								}

								if ( ! empty( $meta['meta_value'] ) ) {
									update_term_meta( $term->term_id, $meta['meta_key'], $meta['meta_value'] );
								}
							}
						}
					}
				}
			}
		}
	}
}
