<?php
use HiveTheme\Helpers as ht;

the_post();

if ( ! is_front_page() || ht\get_excerpt( get_the_ID() ) !== '' ) :
	?>
	<section class="header-hero hero is-medium is-primary" data-component="parallax">
		<div class="header-hero__content hero-body">
			<div class="container">
				<?php
				if ( is_front_page() ) :
					echo ht\get_excerpt( get_the_ID() );
				else :
					?>
					<div class="columns">
						<div class="column is-8 is-offset-2">
							<h1 class="title is-1 has-text-centered"><?php the_title(); ?></h1>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;
