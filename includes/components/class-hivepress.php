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
final class HivePress {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		// Check HivePress status.
		if ( ! function_exists( 'hivepress' ) ) {
			return;
		}

		if ( ! is_admin() ) {

			// Alter templates.
			add_filter( 'hivepress/v1/templates/listing_view_block', [ $this, 'alter_listing_view_block' ] );
			add_filter( 'hivepress/v1/templates/listing_view_page', [ $this, 'alter_listing_view_page' ] );
			add_filter( 'hivepress/v1/templates/listing_category_view_block', [ $this, 'alter_listing_category_view_block' ] );
		}
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
		$count = hp\search_array_value( $template, [ 'blocks', 'listing_category_count' ] );

		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'listing_category_header' => [
						'blocks' => [
							'listing_category_count' => $count,
						],
					],
				],
			]
		);
	}
}
