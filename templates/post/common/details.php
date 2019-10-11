<div class="post__details">
	<?php if ( ! is_single() && is_sticky() ) : ?>
		<div class="post__sticky"><i class="fas fa-thumbtack"></i><span><?php esc_html_e( 'Pinned', 'listinghive' ); ?></span></div>
	<?php else : ?>
		<time datetime="<?php echo esc_attr( get_the_time( 'Y-m-d' ) ); ?>" class="post__date"><?php echo esc_html( get_the_date() ); ?></time>
	<?php endif; ?>
	<div class="post__author">
		<?php
		// translators: the post author.
		printf( esc_html__( 'By %s', 'listinghive' ), get_the_author() );
		?>
	</div>
	<?php if ( comments_open() && ! post_password_required() ) : ?>
		<a href="<?php comments_link(); ?>" class="post__comments"><?php comments_number(); ?></a>
		<?php
	endif;

	if ( ! is_single() ) :
		?>
		<a href="<?php the_permalink(); ?>" class="post__readmore"><span><?php esc_html_e( 'Read More', 'listinghive' ); ?></span><i class="fas fa-chevron-right"></i></a>
	<?php endif; ?>
</div>
