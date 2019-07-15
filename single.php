<?php get_header(); ?>
<div class="columns">
	<main class="column is-8 is-offset-2">
		<?php
		get_template_part( 'templates/post/content', 'single' );

		comments_template();
		?>
	</main>
</div>
<?php
get_footer();
