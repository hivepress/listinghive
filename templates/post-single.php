<div <?php post_class( 'post--single' ); ?>>
	<div class="post__text">
		<?php the_content(); ?>
	</div>
	<?php
	wp_link_pages(
		[
			'before'      => '<nav class="pagination"><div class="nav-links">',
			'after'       => '</div></nav>',
			'link_before' => '<span class="page-numbers">',
			'link_after'  => '</span>',
		]
	);

	if ( has_tag() ) :
		?>
		<div class="post__tags">
			<div class="tagcloud">
				<?php the_tags( '', '' ); ?>
			</div>
		</div>
		<?php
	endif;

	get_template_part( 'templates/post/single/post-navigation' );
	?>
</div>
