<section class="header-hero hero is-medium is-primary" data-component="parallax">
	<div class="header-hero__content hero-body">
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
					<?php endif; ?>
					<div class="post__details">
						<time datetime="<?php echo esc_attr( get_the_time( 'Y-m-d' ) ); ?>" class="post__date"><?php echo esc_html( get_the_date() ); ?></time>
						<div class="post__author"><?php printf( esc_html__( 'By %s', 'listinghive' ), get_the_author() ); ?></div>
						<div class="post__comments"><?php comments_number(); ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
