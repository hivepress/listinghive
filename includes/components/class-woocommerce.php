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
final class WooCommerce extends Component {

	/**
	 * Class constructor.
	 *
	 * @param array $args Component arguments.
	 */
	public function __construct( $args = [] ) {

		// Check WooCommerce status.
		if ( ! ht\is_plugin_active( 'woocommerce' ) ) {
			return;
		}

		// Alter related products.
		add_filter( 'woocommerce_output_related_products_args', [ $this, 'alter_related_products' ], 20 );

		parent::__construct( $args );
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
