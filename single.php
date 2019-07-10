<?php get_header(); ?>
<div class="columns">
	<main class="column is-8 is-offset-2">
		<?php
		// todo.
		//the_post();
		the_content();

		// todo.
		comments_template();
		?>
	</main>
</div>
<?php
get_footer();
