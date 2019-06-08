<?php get_header(); ?>
<div class="columns">
	<main class="column is-8 is-offset-2">
		<?php
		the_post();
		the_content();
		?>
	</main>
</div>
<?php
get_footer();
