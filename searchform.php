<form method="GET" action="<?php echo esc_url( home_url() ); ?>" class="search-form">
	<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Search', 'noun', 'listinghive' ); ?>" class="search-field">
	<input type="hidden" name="post_type" value="post">
	<input type="submit" class="search-submit">
</form>
