<?php
if ( ! isset( $sidebar ) ) :
	$sidebar = 'blog_sidebar';
endif;

if ( is_active_sidebar( $sidebar ) ) :
	?>
	<aside class="site-sidebar col-sm-4 col-xs-12" data-component="sticky">
		<?php dynamic_sidebar( $sidebar ); ?>
	</aside>
	<?php
endif;
