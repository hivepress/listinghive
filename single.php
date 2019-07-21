<?php get_header(); ?>
<div class="row">
	<main class="col-sm-8 col-sm-offset-2 col-xs-12">
		<?php
		get_template_part( 'templates/post/content-single' );

		comments_template();
		?>
	</main>
</div>
<?php
get_footer();
