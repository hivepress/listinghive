<?php the_post(); ?>
<section class="header-hero post post--single hero <?php if ( has_post_thumbnail() ) : ?>is-medium is-dark<?php else : ?>is-light<?php endif; ?>" data-component="parallax">
	<div class="header-hero__content post__header hero-body <?php if ( has_post_thumbnail() ) : ?>post__header--cover<?php endif; ?>">
		<div class="container">
			<div class="columns">
				<div class="column is-8 is-offset-2">
					<?php if ( has_category() ) : ?>
						<div class="post__categories">
							<?php the_category( ' ' ); ?>
						</div>
						<?php
					endif;

					if ( '' !== get_the_title() ) :
						?>
						<h1 class="post__title title is-1 has-text-centered"><?php the_title(); ?></h1>
						<?php
					endif;

					get_template_part( 'templates/post/details' );
					?>
				</div>
			</div>
		</div>
	</div>
</section>
