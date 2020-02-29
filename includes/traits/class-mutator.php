<?php
/**
 * Mutator.
 *
 * @package HiveTheme\Traits
 */

namespace HiveTheme\Traits;

use HiveTheme\Helpers as ht;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Mutator trait.
 *
 * @trait Mutator
 */
trait Mutator {

	/**
	 * Sets property.
	 *
	 * @param string $name Property name.
	 * @param mixed  $value Property value.
	 * @param string $prefix Method prefix.
	 */
	final protected function set_property( $name, $value, $prefix = '' ) {
		$method = $prefix . 'set_' . $name;

		if ( method_exists( $this, $method ) ) {
			call_user_func( [ $this, $method ], $value );
		} elseif ( property_exists( $this, $name ) ) {
			$this->$name = $value;
		}
	}
}
