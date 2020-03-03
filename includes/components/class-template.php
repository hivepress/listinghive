<?php
/**
 * Template component.
 *
 * @package HiveTheme\Components
 */

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

		// Add theme supports.
		add_action( 'after_setup_theme', [ $this, 'add_theme_supports' ] );

		// Register menu locations.
		add_action( 'after_setup_theme', [ $this, 'register_menu_locations' ] );

		// Register widget areas.
		add_action( 'widgets_init', [ $this, 'register_widget_areas' ] );

		// Set hero background.
		add_action( 'wp_enqueue_scripts', [ $this, 'set_hero_background' ] );

		parent::__construct( $args );
	}

	/**
	 * Adds theme supports.
	 */
	public function add_theme_supports() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-header' );

		foreach ( hivetheme()->get_config( 'theme_supports' ) as $name => $args ) {
			if ( is_array( $args ) ) {
				add_theme_support( $name, $args );
			} else {
				add_theme_support( $args );
			}
		}
	}

	/**
	 * Registers menu locations.
	 */
	public function register_menu_locations() {
		foreach ( hivetheme()->get_config( 'menu_locations' ) as $name => $args ) {
			register_nav_menu( $name, ht\get_array_value( $args, 'description' ) );
		}
	}

	/**
	 * Registers widget areas.
	 */
	public function register_widget_areas() {
		foreach ( hivetheme()->get_config( 'widget_areas' ) as $name => $args ) {
			$plugin = ht\get_array_value( $args, 'plugin' );

			if ( 'hivepress' === $plugin ) {
				$name = 'hp_' . $name;
			}

			if ( empty( $plugin ) || ht\is_plugin_active( $plugin ) ) {
				register_sidebar( array_merge( $args, [ 'id' => $name ] ) );
			}
		}
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
	 * Renders template part.
	 *
	 * @param string $path File path.
	 * @param array  $context Template context.
	 * @return string
	 */
	public function render_part( $path, $context = [] ) {
		$output = '';

		// Extract context.
		unset( $context['path'] );
		unset( $context['output'] );

		extract( $context );

		// Render template.
		ob_start();

		include locate_template( $path . '.php' );
		$output = ob_get_contents();

		ob_end_clean();

		return $output;
	}

	/**
	 * Renders template.
	 *
	 * @param string $path Template path.
	 * @param array  $context Template context.
	 * @return string
	 * @deprecated Since version 1.1.0
	 */
	public function render_template( $path, $context = [] ) {
		return $this->render_part( $path, $context );
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

		// Get content.
		if ( is_page() ) {
			$content = '';

			if ( is_front_page() ) {
				$parts = get_extended( get_post_field( 'post_content' ) );

				if ( $parts['extended'] ) {
					$content = apply_filters( 'the_content', $parts['main'] );
				}

				$classes[] = 'header-hero--large';
			}

			if ( ! is_front_page() || $content ) {
				if ( is_front_page() ) {
					$output = $content;
				} else {
					$output = $this->render_part( 'templates/page/page-title' );
				}
			}
		} elseif ( is_singular( 'post' ) ) {
			$classes = array_merge(
				$classes,
				[
					'post',
					'post--single',
				]
			);

			$output = $this->render_part( 'templates/post/single/post-header' );
		} elseif ( ht\is_plugin_active( 'hivepress' ) && is_tax( 'hp_listing_category' ) ) {
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

			$output = $this->render_part(
				'hivepress/listing-category/view/page/listing-category-header',
				[
					'listing_category' => \HivePress\Models\Listing_Category::query()->get_by_id( get_queried_object() ),
				]
			);
		}

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
