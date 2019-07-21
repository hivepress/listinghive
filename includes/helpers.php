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
 * Gets page excerpt.
 *
 * @param int $page_id Page ID.
 * @return string
 */
function get_page_excerpt( $page_id ) {
	$parts = get_extended( get_post_field( 'post_content', $page_id ) );

	return '' !== $parts['extended'] ? apply_filters( 'the_content', $parts['main'] ) : '';
}
