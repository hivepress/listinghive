<div class="post__details">
	<time datetime="<?php echo esc_attr( get_the_time( 'Y-m-d' ) ); ?>" class="post__date"><?php echo esc_html( get_the_date() ); ?></time>
	<div class="post__author"><?php printf( esc_html__( 'By %s', 'listinghive' ), get_the_author() ); ?></div>
	<a href="<?php comments_link(); ?>" class="post__comments"><?php comments_number(); ?></a>
	<?php if ( ! is_single() ) : ?>
	<a href="<?php the_permalink(); ?>" class="post__readmore"><span><?php esc_html_e( 'Read More', 'listinghive' ); ?></span><i class="fas fa-chevron-right"></i></a>
	<?php endif; ?>
</div>
