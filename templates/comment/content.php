<li id="comment-<?php comment_ID(); ?>">
	<div <?php comment_class( 'comment' ); ?>>
		<header class="comment__header">
			<?php if ( 'comment' === get_comment_type() ) : ?>
				<div class="comment__image">
					<?php echo get_avatar( $comment, 150 ); ?>
				</div>
			<?php endif; ?>
			<div class="comment__summary">
				<div class="comment__author"><?php comment_author(); ?></div>
				<div class="comment__details">
					<time datetime="<?php comment_time( 'Y-m-d' ); ?>" class="comment__date"><?php comment_date(); ?></time>
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
			</div>
		</header>
		<div class="comment__text content">
			<?php comment_text(); ?>
		</div>
	</div>
