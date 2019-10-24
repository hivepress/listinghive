<?php
get_header();

if ( ! is_singular( 'product' ) ) :
	?>
	<div class="row">
<?php endif; ?>
	<main <?php if ( ! is_singular( 'product' ) ) : ?>class="col-sm-8 col-xs-12 <?php if ( ! is_active_sidebar( 'wc_shop_sidebar' ) ) : ?>col-sm-offset-2<?php endif; ?>"<?php endif; ?>>
		<?php woocommerce_content(); ?>
	</main>
	<?php
	if ( ! is_singular( 'product' ) ) :
		get_sidebar( 'wc_shop_sidebar' );
		?>
		</div>
		<?php
	endif;

get_footer();
