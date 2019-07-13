<?php get_header(); ?>
<div class="columns">
	<main class="column is-8 <?php if ( ! is_active_sidebar( 'sidebar' ) ) : ?>is-offset-2<?php endif; ?>">
		<div class="todo">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'templates/post/content', 'archive' );
			endwhile;
			?>
		</div>
		<?php the_posts_pagination(); ?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
