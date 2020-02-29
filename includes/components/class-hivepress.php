<?php
/**
 * HivePress component.
 *
 * @package HiveTheme\Components
 */

namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;
use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * HivePress component class.
 *
 * @class HivePress
 */
final class HivePress extends Component {

	/**
	 * Class constructor.
	 *
	 * @param array $args Component arguments.
	 */
	public function __construct( $args = [] ) {

		// Check HivePress status.
		if ( ! ht\is_plugin_active( 'hivepress' ) ) {
			return;
		}

		if ( ! is_admin() ) {

			// Alter templates.
			add_filter( 'hivepress/v1/templates/listing_view_block', [ $this, 'alter_listing_view_block' ] );
			add_filter( 'hivepress/v1/templates/listing_view_page', [ $this, 'alter_listing_view_page' ] );
			add_filter( 'hivepress/v1/templates/listing_category_view_block', [ $this, 'alter_listing_category_view_block' ] );
		}

		parent::__construct( $args );
	}

	/**
	 * Alters listing view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listing_view_block( $template ) {
		$category = hp\search_array_value( $template, [ 'blocks', 'listing_categories' ] );

		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'listing_content' => [
						'blocks' => [
							'listing_categories' => array_merge(
								$category,
								[
									'_order' => 5,
								]
							),
						],
					],
				],
			]
		);
	}

	/**
	 * Alters listing view page.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listing_view_page( $template ) {
		$category = hp\search_array_value( $template, [ 'blocks', 'listing_categories' ] );

		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'page_content' => [
						'blocks' => [
							'listing_categories' => array_merge(
								$category,
								[
									'_order' => 5,
								]
							),
						],
					],
				],
			]
		);
	}

	/**
	 * Alters listing category view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listing_category_view_block( $template ) {
		$count = hp\search_array_value( $template, [ 'blocks', 'listing_category_item_count' ] );

		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'listing_category_header' => [
						'blocks' => [
							'listing_category_item_count' => $count,
						],
					],
				],
			]
		);
	}
}
