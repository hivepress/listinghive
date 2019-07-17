<?php
use HiveTheme\Helpers as ht;

the_post();

if ( ! is_front_page() || ht\get_page_excerpt( get_the_ID() ) !== '' ) :
	?>
	<section class="header-hero hero <?php if ( is_front_page() ) : ?>is-medium<?php endif; ?> <?php if ( get_header_image() || has_post_thumbnail() ) : ?>is-dark<?php else : ?>is-light<?php endif; ?>" data-component="parallax">
		<div class="header-hero__content hero-body">
			<div class="container">
				<?php
				if ( is_front_page() ) :
					echo ht\get_page_excerpt( get_the_ID() );
				else :
					?>
					<div class="columns">
						<div class="column is-8 is-offset-2">
							<h1 class="has-text-centered"><?php the_title(); ?></h1>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;
