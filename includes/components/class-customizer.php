<?php
/**
 * Customizer component.
 *
 * @package HiveTheme\Components
 */

namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Customizer component class.
 *
 * @class Customizer
 */
final class Customizer {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		// Register theme mods.
		add_action( 'customize_register', [ $this, 'register_theme_mods' ] );

		if ( is_admin() ) {

			// Add editor fonts.
			add_action( 'admin_init', [ $this, 'add_editor_fonts' ] );
		} else {

			// Add theme styles.
			add_action( 'wp_enqueue_scripts', [ $this, 'add_theme_styles' ] );

			// Enqueue fonts.
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_fonts' ] );
		}
	}

	/**
	 * Registers theme mods.
	 *
	 * @param WP_Customize_Manager $wp_customize Manager object.
	 */
	public function register_theme_mods( $wp_customize ) {
		foreach ( hivetheme()->get_config( 'theme_mods' ) as $section_name => $section ) {

			// Add custom section.
			if ( ! in_array( $section_name, array_keys( $wp_customize->sections() ), true ) ) {
				$wp_customize->add_section(
					$section_name,
					[
						'title'       => $section['title'],
						'description' => ht\get_array_value( $section, 'description' ),
						'priority'    => ht\get_array_value( $section, 'priority' ),
					]
				);
			}

			foreach ( $section['fields'] as $field_name => $field ) {

				// Set sanitization callback.
				$sanitize_callback = 'sanitize_text_field';

				switch ( $field['type'] ) {

					// Color field.
					case 'color':
						$sanitize_callback = 'sanitize_hex_color';

						break;

					// Font field.
					case 'font':
						$sanitize_callback = [ $this, 'sanitize_select_field' ];

						break;
				}

				// Add mod setting.
				$wp_customize->add_setting(
					$field_name,
					[
						'default'           => ht\get_array_value( $field, 'default' ),
						'sanitize_callback' => $sanitize_callback,
					]
				);

				// Add mod control.
				$control = array_merge(
					$field,
					[
						'section'  => $section_name,
						'settings' => $field_name,
					]
				);

				unset( $control['type'] );

				switch ( $field['type'] ) {

					// Color field.
					case 'color':
						$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, $field_name, $control ) );

						break;

					// Default field.
					default:
						$control['type'] = $field['type'];

						if ( 'font' === $control['type'] ) {
							$control['type']    = 'select';
							$control['choices'] = hivetheme()->get_config( 'fonts' );
						}

						$wp_customize->add_control( $field_name, $control );

						break;
				}
			}
		}
	}

	/**
	 * Sanitizes select field.
	 *
	 * @param string               $input Input value.
	 * @param WP_Customize_Setting $setting Setting object.
	 * @return string
	 */
	public function sanitize_select_field( $input, $setting ) {
		$output = $setting->default;

		if ( array_key_exists( $input, $setting->manager->get_control( $setting->id )->choices ) ) {
			$output = $input;
		}

		return $output;
	}

	/**
	 * Adds theme styles.
	 */
	public function add_theme_styles() {
		$output = '';

		foreach ( hivetheme()->get_config( 'theme_styles' ) as $style ) {

			// Add selector.
			$output .= $style['selector'] . '{';

			// Add properties.
			foreach ( $style['properties'] as $property ) {

				// Get theme mod.
				$value = get_theme_mod( $property['theme_mod'] );

				if ( '' !== $value ) {
					switch ( $property['name'] ) {

						// Background image.
						case 'background-image':
							$value = 'url(' . esc_url( $value ) . ')';

							break;

						// Font family.
						case 'font-family':
							$value = ht\get_array_value( explode( ':', $value ), 0 ) . ', sans-serif';

							break;
					}

					$output .= $property['name'] . ':' . $value . ';';
				}
			}

			$output .= '}';
		}

		// Add styles.
		wp_add_inline_style( 'ht-frontend', $output );
	}

	/**
	 * Gets fonts.
	 *
	 * @return array
	 */
	private function get_fonts() {

		// Get theme mods.
		$theme_mods = [];

		foreach ( hivetheme()->get_config( 'theme_styles' ) as $style ) {
			foreach ( $style['properties'] as $property ) {
				if ( 'font-family' === $property['name'] && ! in_array( $property['theme_mod'], $theme_mods, true ) ) {
					$theme_mods[] = $property['theme_mod'];
				}
			}
		}

		// Get fonts.
		$fonts = [];

		foreach ( hivetheme()->get_config( 'theme_mods' ) as $section ) {
			foreach ( $section['fields'] as $field_name => $field ) {
				if ( in_array( $field_name, $theme_mods, true ) ) {
					$font = get_theme_mod( $field_name, ht\get_array_value( $field, 'default', false ) );

					if ( '' !== $font ) {
						$fonts[] = $font;
					}
				}
			}
		}

		return $fonts;
	}

	/**
	 * Enqueues fonts.
	 */
	public function enqueue_fonts() {

		// Get fonts.
		$fonts = $this->get_fonts();

		// Enqueue fonts.
		if ( ! empty( $fonts ) ) {
			wp_enqueue_style( 'google-fonts', esc_url( 'https://fonts.googleapis.com/css?family=' . rawurlencode( implode( '|', $fonts ) ) ), [], null );
		}
	}

	/**
	 * Adds editor fonts.
	 */
	public function add_editor_fonts() {

		// Get fonts.
		$fonts = $this->get_fonts();

		// Enqueue fonts.
		if ( ! empty( $fonts ) ) {
			add_editor_style( esc_url( 'https://fonts.googleapis.com/css?family=' . rawurlencode( implode( '|', $fonts ) ) ) );
		}
	}
}
