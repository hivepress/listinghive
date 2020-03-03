<?php
get_header();

if ( ! is_product() ) :
	?>
	<div class="row">
	<?php
	echo hivetheme()->template->render_part( 'sidebar', [ 'sidebar' => 'shop' ] );
endif;
?>
<main <?php if ( ! is_product() ) : ?>class="col-sm-8 col-xs-12 <?php if ( ! is_active_sidebar( 'shop' ) ) : ?>col-sm-offset-2<?php endif; ?>"<?php endif; ?>>
	<?php woocommerce_content(); ?>
</main>
<?php if ( ! is_product() ) : ?>
	</div>
	<?php
endif;

get_footer();
