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
 * Sanitizes slug.
 *
 * @param string $text Text to sanitize.
 * @return string
 */
function sanitize_slug( $text ) {
	return str_replace( '_', '-', strtolower( $text ) );
}

/**
 * Gets post excerpt.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function get_excerpt( $post_id ) {
	$excerpt = '';

	$parts = get_extended( get_post_field( 'post_content', $post_id ) );

	if ( '' !== $parts['extended'] ) {
		$excerpt = apply_filters( 'the_content', $parts['main'] );
	}

	return $excerpt;
}
