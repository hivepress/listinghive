<?php
/**
 * HiveTheme core.
 *
 * @package HiveTheme
 */

namespace HiveTheme;

use HiveTheme\Helpers as ht;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * HiveTheme core class.
 *
 * @class Core
 */
final class Core {

	/**
	 * The single instance of the class.
	 *
	 * @var Core
	 */
	private static $instance;

	/**
	 * Array of HiveTheme configuration.
	 *
	 * @var array
	 */
	private $configs = [];

	/**
	 * Array of HiveTheme objects.
	 *
	 * @var array
	 */
	private $objects = [];

	// Forbid cloning and duplicating instances.
	private function __clone() {}
	private function __wakeup() {}

	/**
	 * Class constructor.
	 */
	private function __construct() {

		// Autoload classes.
		spl_autoload_register( [ $this, 'autoload' ] );

		// Setup HiveTheme.
		$this->setup();
	}

	/**
	 * Ensures only one instance is loaded.
	 *
	 * @see hivetheme()
	 * @return Core
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Autoloads classes.
	 *
	 * @param string $class Class name.
	 */
	public function autoload( $class ) {
		$parts = explode( '\\', str_replace( '_', '-', strtolower( $class ) ) );

		if ( count( $parts ) > 1 && reset( $parts ) === 'hivetheme' ) {
			$filename = 'class-' . end( $parts ) . '.php';

			array_shift( $parts );
			array_pop( $parts );

			$filepath = rtrim( HT_THEME_DIR . '/includes/' . implode( '/', $parts ), '/' ) . '/' . $filename;

			if ( file_exists( $filepath ) ) {
				require_once $filepath;

				if ( ! ( new \ReflectionClass( $class ) )->isAbstract() && method_exists( $class, 'init' ) && ( new \ReflectionMethod( $class, 'init' ) )->isStatic() ) {
					call_user_func( [ $class, 'init' ] );
				}
			}
		}
	}

	/**
	 * Setups HiveTheme.
	 */
	public function setup() {
		$theme = wp_get_theme( get_template() );

		// Define constants.
		if ( ! defined( 'HT_THEME_NAME' ) ) {
			define( 'HT_THEME_NAME', $theme->get( 'Name' ) );
		}

		if ( ! defined( 'HT_THEME_VERSION' ) ) {
			define( 'HT_THEME_VERSION', $theme->get( 'Version' ) );
		}

		if ( ! defined( 'HT_THEME_DIR' ) ) {
			define( 'HT_THEME_DIR', get_template_directory() );
		}

		if ( ! defined( 'HT_THEME_URL' ) ) {
			define( 'HT_THEME_URL', get_template_directory_uri() );
		}

		// Include helper functions.
		require_once HT_THEME_DIR . '/includes/helpers.php';

		// Load textdomain.
		load_theme_textdomain( $theme->get( 'Text Domain' ), HT_THEME_DIR . '/languages' );

		// Set components.
		$this->objects['components'] = $this->get_components();

		// Set content width.
		if ( ! isset( $GLOBALS['content_width'] ) ) {
			$GLOBALS['content_width'] = 1152;
		}
	}

	/**
	 * Routes methods.
	 *
	 * @param string $name Method name.
	 * @param array  $args Method arguments.
	 */
	public function __call( $name, $args ) {
		if ( strpos( $name, 'get_' ) === 0 ) {
			$object_type = substr( $name, strlen( 'get' ) + 1 );

			if ( ! isset( $this->objects[ $object_type ] ) ) {
				$this->objects[ $object_type ] = [];

				foreach ( glob( HT_THEME_DIR . '/includes/' . $object_type . '/*.php' ) as $filepath ) {
					$object_name  = str_replace( '-', '_', str_replace( 'class-', '', str_replace( '.php', '', basename( $filepath ) ) ) );
					$object_class = '\HiveTheme\\' . $object_type . '\\' . $object_name;

					if ( ! ( new \ReflectionClass( $object_class ) )->isAbstract() ) {
						$this->objects[ $object_type ][ $object_name ] = new $object_class();
					}
				}
			}

			return $this->objects[ $object_type ];
		}
	}

	/**
	 * Routes properties.
	 *
	 * @param string $name Property name.
	 * @return mixed
	 */
	public function __get( $name ) {
		return ht\get_array_value( $this->get_components(), $name );
	}

	/**
	 * Gets configuration.
	 *
	 * @param string $name Configuration name.
	 * @return array
	 */
	public function get_config( $name ) {

		// Get existing configuration.
		$config = ht\get_array_value( $this->configs, $name );

		// Get new configuration.
		if ( is_null( $config ) ) {
			$filepath = HT_THEME_DIR . '/includes/configs/' . ht\sanitize_slug( $name ) . '.php';

			if ( file_exists( $filepath ) ) {
				$config = include $filepath;
			}

			// Filter configuration.
			$config = apply_filters( 'hivetheme/v1/' . $name, $config );

			// Set configuration.
			$this->configs[ $name ] = $config;
		}

		return $config;
	}
}
