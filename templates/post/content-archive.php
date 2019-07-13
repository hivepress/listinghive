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
			<h3 class="post__title title is-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php endif; ?>
	</header>
	<div class="post__content">
		<?php if ( false === get_post_format() && '' !== get_the_content() ) : ?>
		<div class="post__text"><?php the_excerpt(); ?></div>
		<?php endif; ?>
		<div class="post__details">
			<time datetime="<?php echo esc_attr( get_the_time( 'Y-m-d' ) ); ?>" class="post__date"><?php echo esc_html( get_the_date() ); ?></time>
			<div class="post__author"><?php printf( esc_html__( 'By %s', 'listinghive' ), get_the_author() ); ?></div>
			<a href="<?php comments_link(); ?>" class="post__comments"><?php comments_number(); ?></a>
			<a href="<?php the_permalink(); ?>" class="post__readmore"><span><?php esc_html_e( 'Read More', 'listinghive' ); ?></span><i class="fas fa-chevron-right"></i></a>
		</div>
	</div>
</article>
