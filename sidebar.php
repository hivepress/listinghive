<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
	<aside class="column is-4" data-component="sticky">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside>
	<?php
endif;
