<?php
use HiveTheme\Helpers as ht;

the_post();

if ( ! is_front_page() || ht\get_page_excerpt( get_the_ID() ) !== '' ) :
	?>
	<section class="header-hero <?php if ( is_front_page() ) : ?>header-hero--large<?php endif; ?> <?php if ( get_header_image() || has_post_thumbnail() ) : ?>header-hero--cover<?php endif; ?>" data-component="parallax">
		<div class="header-hero__content">
			<div class="container">
				<?php
				if ( is_front_page() ) :
					echo ht\get_page_excerpt( get_the_ID() );
				else :
					?>
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2 col-xs-12">
							<h1 class="page__title"><?php the_title(); ?></h1>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;
