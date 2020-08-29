<?php
/**
 * Theme component.
 *
 * @package HiveTheme\Components
 */

namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;
use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Theme component class.
 *
 * @class Theme
 */
final class Theme extends Component {

	/**
	 * Class constructor.
	 *
	 * @param array $args Component arguments.
	 */
	public function __construct( $args = [] ) {

		// Set hero background.
		add_action( 'wp_enqueue_scripts', [ $this, 'set_hero_background' ] );

		// Render hero content.
		add_filter( 'hivetheme/v1/areas/site_hero', [ $this, 'render_hero_content' ] );

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
	 * Sets hero background.
	 */
	public function set_hero_background() {

		// Get image URL.
		$image_url = get_header_image();

		if ( is_singular() && has_post_thumbnail() ) {
			$image_url = get_the_post_thumbnail_url( null, 'ht_cover_large' );
		} elseif ( ht\is_plugin_active( 'hivepress' ) && is_tax( 'hp_listing_category' ) ) {
			$image_id = get_term_meta( get_queried_object_id(), 'hp_image', true );

			if ( $image_id ) {
				$image = wp_get_attachment_image_src( $image_id, 'ht_cover_large' );

				if ( $image ) {
					$image_url = ht\get_first_array_value( $image );
				}
			}
		}

		// Add inline style.
		if ( $image_url ) {
			$style = '.header-hero { background-image: url(' . esc_url( $image_url ) . '); }';

			if ( get_header_textcolor() ) {
				$style .= '.header-hero { color: #' . esc_attr( get_header_textcolor() ) . '; }';
			}

			wp_add_inline_style( 'hivetheme-core-frontend', $style );
		}
	}

	/**
	 * Renders hero content.
	 *
	 * @param string $output Hero content.
	 * @return string
	 */
	public function render_hero_content( $output ) {

		// Get classes.
		$classes = [];

		if ( is_page() || is_singular( 'post' ) ) {
			the_post();

			if ( get_header_image() || has_post_thumbnail() ) {
				$classes[] = 'header-hero--cover';

				if ( is_single() ) {
					$classes[] = 'header-hero--large';
				}
			}
		}

		// Render header.
		if ( is_page() ) {

			// Get content.
			$content = '';

			if ( is_front_page() ) {
				$parts = get_extended( get_post_field( 'post_content' ) );

				if ( $parts['extended'] ) {
					$content = apply_filters( 'the_content', $parts['main'] );
				}

				$classes[] = 'header-hero--large';
			} else {
				$classes[] = 'header-hero--title';
			}

			// Get page IDs.
			$page_ids = [];

			if ( ht\is_plugin_active( 'hivepress' ) ) {
				$page_ids = array_map(
					'absint',
					[
						get_option( 'hp_page_listings' ),
						get_option( 'hp_page_vendors' ),
					]
				);
			}

			// Render part.
			if ( ! is_front_page() || $content ) {
				if ( is_front_page() ) {
					$output .= $content;
				} elseif ( ! in_array( get_the_ID(), $page_ids, true ) ) {
					$output .= hivetheme()->template->render_part( 'templates/page/page-title' );
				}
			}
		} elseif ( is_singular( 'post' ) ) {

			// Add classes.
			$classes = array_merge(
				$classes,
				[
					'post',
					'post--single',
				]
			);

			// Render part.
			$output .= hivetheme()->template->render_part( 'templates/post/single/post-header' );
		} elseif ( ht\is_plugin_active( 'hivepress' ) && is_tax( 'hp_listing_category' ) ) {

			// Add classes.
			$classes = array_merge(
				$classes,
				[
					'hp-listing-category',
					'hp-listing-category--view-page',
					'header-hero--large',
				]
			);

			if ( get_header_image() || get_term_meta( get_queried_object_id(), 'hp_image', true ) ) {
				$classes[] = 'header-hero--cover';
			}

			// Render part.
			$output .= hivetheme()->template->render_part(
				'hivepress/listing-category/view/page/listing-category-header',
				[
					'listing_category' => \HivePress\Models\Listing_Category::query()->get_by_id( get_queried_object() ),
				]
			);
		}

		// Add wrapper.
		if ( $output ) {
			$output = hivetheme()->template->render_part(
				'templates/page/page-header',
				[
					'class'   => implode( ' ', $classes ),
					'content' => $output,
				]
			);
		}

		return $output;
	}

	/**
	 * Alters listing view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listing_view_block( $template ) {
		$category = hp\search_array_value( $template, [ 'blocks', 'listing_category' ] );

		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'listing_content' => [
						'blocks' => [
							'listing_category' => array_merge(
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
		$category = hp\search_array_value( $template, [ 'blocks', 'listing_category' ] );

		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'page_content' => [
						'blocks' => [
							'listing_category' => array_merge(
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

					'listing_category_name'   => [
						'tag' => 'h3',
					],
				],
			]
		);
	}
}
