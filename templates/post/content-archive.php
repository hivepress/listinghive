<article <?php post_class( 'post--archive' ); ?>>
	<header class="post__header <?php if ( has_post_thumbnail() ) : ?>post__header--cover<?php endif; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post__image">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'ht_landscape_large' ); ?></a>
			</div>
			<?php
		endif;

		if ( has_category() ) :
			?>
			<div class="post__categories">
				<?php the_category( ' ' ); ?>
			</div>
			<?php
		endif;

		if ( '' !== get_the_title() ) :
			?>
			<h2 class="post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>
	</header>
	<div class="post__content">
		<?php
		if ( false === get_post_format() && '' !== get_the_content() ) :
			?>
			<div class="post__text"><?php the_excerpt(); ?></div>
			<?php
		endif;

		get_template_part( 'templates/post/details' );
		?>
	</div>
</article>
