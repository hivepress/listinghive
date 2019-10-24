<?php
/**
 * WooCommerce component.
 *
 * @package HiveTheme\Components
 */

namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * WooCommerce component class.
 *
 * @class WooCommerce
 */
final class WooCommerce {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		// Check WooCommerce status.
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		// Alter related products.
		add_filter( 'woocommerce_output_related_products_args', [ $this, 'alter_related_products' ], 20 );
	}

	/**
	 * Alters related products.
	 *
	 * @param array $args Query arguments.
	 * @return array
	 */
	public function alter_related_products( $args ) {
		return array_merge(
			$args,
			[
				'posts_per_page' => 3,
				'columns'        => 3,
			]
		);
	}
}
