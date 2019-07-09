<?php get_header(); ?>
<div class="columns">
	<main class="column is-8
	<?php
	if ( ! is_active_sidebar( 'sidebar' ) ) :

		?>
	is-offset-2<?php endif; ?>">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'post--archive' ); ?>>
				<header class="post__header">
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
					<?php endif; ?>
					<h3 class="post__title title is-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</header>
				<div class="post__content">
					<div class="post__text"><?php the_excerpt(); ?></div>
					<div class="post__details">
						<time datetime="<?php echo esc_attr( get_the_time( 'Y-m-d' ) ); ?>" class="post__date"><?php echo esc_html( get_the_date() ); ?></time>
						<div class="post__author"><?php printf( esc_html__( 'By %s', 'listinghive' ), get_the_author() ); ?></div>
						<div class="post__comments"><?php comments_number(); ?></div>
						<div class="post__readmore"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'listinghive'); ?></a></div>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
