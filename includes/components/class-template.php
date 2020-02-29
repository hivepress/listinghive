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
}
