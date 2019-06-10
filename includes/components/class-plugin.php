<?php
/**
 * Plugin component.
 *
 * @package HiveTheme\Components
 */

namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Plugin component class.
 *
 * @class Plugin
 */
final class Plugin {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		if ( is_admin() ) {

			// Include TGMPA class.
			require_once HT_THEME_DIR . '/includes/vendor/tgmpa/class-tgm-plugin-activation.php';

			// Register plugins.
			add_action( 'tgmpa_register', [ $this, 'register_plugins' ] );
		}
	}

	/**
	 * Registers plugins.
	 */
	public function register_plugins() {
		tgmpa( hivetheme()->get_config( 'plugins' ) );
	}
}
