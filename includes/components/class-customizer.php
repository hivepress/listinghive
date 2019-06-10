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
}
