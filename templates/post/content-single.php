<div <?php post_class( 'post--single' ); ?>>
	<?php if ( '' !== get_the_content() ) : ?>
		<div class="post__text">
			<?php the_content(); ?>
		</div>
		<?php
	endif;

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
	<?php endif; ?>
</div>
