<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<button type="button" class="hp-menu__item button button--secondary" data-component="link" data-url="<?php echo esc_url( hivepress()->router->get_url( 'listing/submit_listing' ) ); ?>"><i class="hp-icon fas fa-plus"></i><span><?php esc_html_e( 'Add Listing', 'listinghive' ); ?></span></button>
