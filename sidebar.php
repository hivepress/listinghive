<?php if ( is_active_sidebar( 'blog_sidebar' ) ) : ?>
	<aside class="col-sm-4 col-xs-12" data-component="sticky">
		<?php dynamic_sidebar( 'blog_sidebar' ); ?>
	</aside>
	<?php
endif;
