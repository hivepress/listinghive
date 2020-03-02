<?php
/**
 * Helper functions.
 *
 * @package HiveTheme
 */

namespace HiveTheme\Helpers;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Adds HiveTheme prefix.
 *
 * @param mixed $names Names to prefix.
 * @return mixed
 */
function prefix( $names ) {
	$prefixed = '';

	if ( is_array( $names ) ) {
		$prefixed = array_map(
			function( $name ) {
				return 'ht_' . $name;
			},
			$names
		);
	} else {
		$prefixed = 'ht_' . $names;
	}

	return $prefixed;
}

/**
 * Sanitizes slug.
 *
 * @param string $text Text to sanitize.
 * @return string
 */
function sanitize_slug( $text ) {
	return str_replace( '_', '-', \sanitize_key( $text ) );
}

/**
 * Gets array item value by key.
 *
 * @param array  $array Source array.
 * @param string $key Key to search.
 * @param mixed  $default Default value.
 * @return mixed
 */
function get_array_value( $array, $key, $default = null ) {
	$value = $default;

	if ( is_array( $array ) && isset( $array[ $key ] ) ) {
		$value = $array[ $key ];
	}

	return $value;
}

/**
 * Gets first array item value.
 *
 * @param array $array Source array.
 * @param mixed $default Default value.
 * @return mixed
 */
function get_first_array_value( $array, $default = null ) {
	$value = $default;

	if ( is_array( $array ) && $array ) {
		$value = reset( $array );
	}

	return $value;
}

/**
 * Merges arrays with mixed values.
 *
 * @return array
 */
function merge_arrays() {
	$merged = [];

	foreach ( func_get_args() as $array ) {
		foreach ( $array as $key => $value ) {
			if ( ! isset( $merged[ $key ] ) || ( ! is_array( $merged[ $key ] ) || ! is_array( $value ) ) ) {
				if ( is_numeric( $key ) ) {
					$merged[] = $value;
				} else {
					$merged[ $key ] = $value;
				}
			} else {
				$merged[ $key ] = merge_arrays( $merged[ $key ], $value );
			}
		}
	}

	return $merged;
}

/**
 * Creates class instance.
 *
 * @param string $class Class name.
 * @param array  $args Instance arguments.
 * @return mixed
 */
function create_class_instance( $class, $args = [] ) {
	if ( class_exists( $class ) && ! ( new \ReflectionClass( $class ) )->isAbstract() ) {
		$instance = null;

		if ( empty( $args ) ) {
			$instance = new $class();
		} else {
			$instance = new $class( ...$args );
		}

		return $instance;
	}
}

/**
 * Checks plugin status.
 *
 * @param string $name Plugin name.
 * @return bool
 */
function is_plugin_active( $name ) {
	return class_exists( $name ) || function_exists( $name );
}
