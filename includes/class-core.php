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
	protected static $instance;

	/**
	 * Array of HiveTheme extensions.
	 *
	 * @var array
	 */
	protected $extensions = [];

	/**
	 * Array of HiveTheme configurations.
	 *
	 * @var array
	 */
	protected $configs = [];

	/**
	 * Array of HiveTheme objects.
	 *
	 * @var array
	 */
	protected $objects = [];

	// Forbid cloning and duplicating instances.
	protected function __clone() {}
	protected function __wakeup() {}

	/**
	 * Class constructor.
	 */
	protected function __construct() {

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

			foreach ( $this->get_paths() as $dir ) {
				$filepath = rtrim( $dir . '/includes/' . implode( '/', $parts ), '/' ) . '/' . $filename;

				if ( file_exists( $filepath ) ) {
					require_once $filepath;

					if ( ! ( new \ReflectionClass( $class ) )->isAbstract() && method_exists( $class, 'init' ) && ( new \ReflectionMethod( $class, 'init' ) )->isStatic() ) {
						call_user_func( [ $class, 'init' ] );
					}

					break;
				}
			}
		}
	}

	/**
	 * Setups HiveTheme.
	 */
	public function setup() {
		$theme = wp_get_theme( get_template() );

		// Include helper functions.
		require_once hivetheme()->get_path() . '/includes/helpers.php';

		// Load textdomain.
		load_theme_textdomain( $theme->get( 'TextDomain' ), hivetheme()->get_path() . '/languages' );

		// Initialize components.
		$this->get_components();
	}

	/**
	 * Routes methods.
	 *
	 * @param string $name Method name.
	 * @param array  $args Method arguments.
	 * @throws \BadMethodCallException Invalid method.
	 * @return array
	 */
	public function __call( $name, $args ) {
		if ( strpos( $name, 'get_' ) === 0 ) {

			// Get property name.
			$property = substr( $name, strlen( 'get_' ) );

			if ( in_array( $property, [ 'name', 'version', 'path', 'url' ], true ) ) {

				// Get extension name.
				$extension = 'core';

				if ( $args ) {
					$extension = hp\get_first_array_value( $args );
				}

				// Get property value.
				$value = null;

				if ( isset( $this->extensions[ $extension ][ $property ] ) ) {
					$value = $this->extensions[ $extension ][ $property ];
				}

				return $value;
			} else {

				// Set object type.
				$object_type = $property;

				if ( ! isset( $this->objects[ $object_type ] ) ) {
					$this->objects[ $object_type ] = [];

					foreach ( $this->get_paths() as $dir ) {
						foreach ( glob( $dir . '/includes/' . $object_type . '/*.php' ) as $filepath ) {

							// Get object name.
							$object_name = str_replace( '-', '_', preg_replace( '/^class-/', '', basename( $filepath, '.php' ) ) );

							// Create object.
							$object = hp\create_class_instance( '\HiveTheme\\' . $object_type . '\\' . $object_name );

							if ( $object ) {
								$this->objects[ $object_type ][ $object_name ] = $object;
							}
						}
					}
				}

				return $this->objects[ $object_type ];
			}
		}

		throw new \BadMethodCallException();
	}

	/**
	 * Routes properties.
	 *
	 * @param string $name Property name.
	 * @return object
	 */
	public function __get( $name ) {
		return hp\get_array_value( $this->get_components(), $name );
	}

	/**
	 * Gets HiveTheme paths.
	 *
	 * @return array
	 */
	public function get_paths() {
		return array_column( $this->extensions, 'path' );
	}

	/**
	 * Gets HiveTheme configuration.
	 *
	 * @param string $type Configuration type.
	 * @return array
	 */
	public function get_config( $type ) {
		if ( ! isset( $this->configs[ $type ] ) ) {
			$this->configs[ $type ] = [];

			foreach ( $this->get_paths() as $dir ) {
				$filepath = $dir . '/includes/configs/' . hp\sanitize_slug( $type ) . '.php';

				if ( file_exists( $filepath ) ) {
					$this->configs[ $type ] = hp\merge_arrays( $this->configs[ $type ], include $filepath );
				}
			}

			// Filter configuration.
			$this->configs[ $type ] = apply_filters( 'hivetheme/v1/' . $type, $this->configs[ $type ] );
		}

		return $this->configs[ $type ];
	}
}
