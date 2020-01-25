<section class="header-hero header-hero--large hp-listing-category hp-listing-category--view-page <?php if ( get_header_image() || get_term_meta( get_queried_object_id(), 'hp_image', true ) ) : ?>header-hero--cover<?php endif; ?>" data-component="parallax">
	<div class="header-hero__content">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12">
					<div class="hp-listing-category__header">
						<div class="hp-listing-category__count">
							<?php
							// translators: the number of listings.
							printf( esc_html( _n( '%d Listing', '%d Listings', get_queried_object()->count, 'listinghive' ) ), number_format_i18n( get_queried_object()->count ) );
							?>
						</div>
						<h1 class="hp-listing-category__name"><?php single_cat_title(); ?></h1>
						<?php if ( category_description() !== '' ) : ?>
							<div class="hp-listing-category__description"><?php echo category_description(); ?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
