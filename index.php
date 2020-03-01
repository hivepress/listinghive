<?php get_header(); ?>
<div class="row">
	<main class="col-sm-8 col-xs-12 <?php if ( ! is_active_sidebar( 'blog_sidebar' ) ) : ?>col-sm-offset-2<?php endif; ?>">
		<?php if ( have_posts() ) : ?>
			<div class="posts">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'templates/post/archive/todo' );
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
