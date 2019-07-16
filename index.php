<?php get_header(); ?>
<div class="columns">
	<main class="column is-8 <?php if ( ! is_active_sidebar( 'sidebar' ) ) : ?>is-offset-2<?php endif; ?>">
		<?php if ( have_posts() ) : ?>
			<div class="posts">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'templates/post/content', 'archive' );
				endwhile;
				?>
			</div>
			<?php
			the_posts_pagination();

		else :
			?>
			<h2><?php esc_html_e( 'Nothing found', 'listinghive' ); ?></h2>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'listinghive' ); ?></p>
		<?php endif; ?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
