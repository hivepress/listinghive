<section class="header-hero <?php echo esc_attr( $class ); ?>" <?php if ( get_theme_mod( 'header_image_parallax' ) ) : ?>data-component="parallax"<?php endif; ?>>
	<div class="header-hero__content">
		<div class="container">
			<?php echo $content; ?>
		</div>
	</div>
</section>
