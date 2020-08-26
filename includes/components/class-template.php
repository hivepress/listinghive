<?php
/**
 * Template component.
 *
 * @package HiveTheme\Components
 */
// todo.
namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Template component class.
 *
 * @class Template
 */
final class Template extends Component {

	/**
	 * Class constructor.
	 *
	 * @param array $args Component arguments.
	 */
	public function __construct( $args = [] ) {

		// Set hero background.
		add_action( 'wp_enqueue_scripts', [ $this, 'set_hero_background' ] );

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
	 * Renders header.
	 *
	 * @return string
	 */
	public function render_header() {
		$output = '';

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
					$output = $content;
				} elseif ( ! in_array( get_the_ID(), $page_ids, true ) ) {
					$output = $this->render_part( 'templates/page/page-title' );
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
			$output = $this->render_part( 'templates/post/single/post-header' );
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
			$output = $this->render_part(
				'hivepress/listing-category/view/page/listing-category-header',
				[
					'listing_category' => \HivePress\Models\Listing_Category::query()->get_by_id( get_queried_object() ),
				]
			);
		}

		// Filter output.
		$output = apply_filters( 'hivetheme/v1/areas/page_header', $output );

		// Add wrapper.
		if ( $output ) {
			$output = $this->render_part(
				'templates/page/page-header',
				[
					'class'   => implode( ' ', $classes ),
					'content' => $output,
				]
			);
		}

		return $output;
	}
}
