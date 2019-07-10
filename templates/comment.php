<li id="comment-<?php comment_ID(); ?>">
	<div <?php comment_class(); ?>>
		<?php if ( 'comment' === get_comment_type() ) : ?>
			<div class="comment__image">
				<?php echo get_avatar( $comment, 150 ); ?>
			</div>
		<?php endif; ?>
		<div class="comment__content">
			<h6 class="comment__author"><?php comment_author(); ?></h6>
			<div class="comment__details">
				<time datetime="<?php comment_time( 'Y-m-d' ); ?>" class="comment__date"><?php printf( esc_html__( '%s ago', 'listinghive' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
				<?php
				comment_reply_link(
					[
						'reply_text' => '<i class="fas fa-reply"></i><span>' . esc_html__( 'Reply', 'listinghive' ) . '</span>',
						'depth'      => $depth,
						'max_depth'  => $args['max_depth'],
					]
				);
				?>
			</div>
			<div class="comment__text">
				<?php comment_text(); ?>
			</div>
		</div>
	</div>
