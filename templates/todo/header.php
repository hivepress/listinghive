<section class="header-hero hero is-medium <?php if ( get_header_image() || get_term_meta( get_queried_object_id(), 'hp_image_id', true ) ) : ?>is-dark<?php else : ?>is-light<?php endif; ?>" data-component="parallax">
	<div class="header-hero__content hero-body">
		<div class="container">
			<div class="columns">
				<div class="column is-8 is-offset-2">
					<div class="hp-listing-category__count"><?php printf( esc_html( _n( '%d Listing', '%d Listings', get_queried_object()->count, 'listinghive' ) ), number_format_i18n( get_queried_object()->count ) ); ?></div>
					<h1 class="hp-listing-category__title title is-1 has-text-centered"><?php single_cat_title(); ?></h1>
					<div class="hp-listing-category__description has-text-centered"><?php echo category_description(); ?></div>
				</div>
			</div>
		</div>
	</div>
</section>
