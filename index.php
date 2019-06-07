<?php get_header(); ?>
<div class="columns">
	<main class="column is-8">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post__image">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a>
					</div>
				<?php endif; ?>
				<h3 class="post__title title is-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			</article>
			<?php
		endwhile;
		?>
	</main>
	<aside class="column is-4">
		<?php dynamic_sidebar(); ?>
	</aside>
</div>
<?php
get_footer();
