<?php the_post(); ?>
<section class="header-hero post post--single <?php if ( get_header_image() || has_post_thumbnail() ) : ?>header-hero--cover header-hero--large<?php endif; ?>" data-component="parallax">
	<div class="header-hero__content">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12">
					<div class="post__header <?php if ( get_header_image() || has_post_thumbnail() ) : ?>post__header--cover<?php endif; ?>">
						<?php if ( has_category() ) : ?>
							<div class="post__categories">
								<?php the_category( ' ' ); ?>
							</div>
							<?php
						endif;

						if ( '' !== get_the_title() ) :
							?>
							<h1 class="post__title"><?php the_title(); ?></h1>
							<?php
						endif;

						get_template_part( 'templates/post/details' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
