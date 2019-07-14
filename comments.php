<?php if ( ( have_comments() || comments_open() ) && ! post_password_required() ) : ?>
	<div id="comments">
		<h2 class="title is-2 has-text-centered"><?php esc_html_e( 'Comments', 'listinghive' ); ?></h2>
		<?php if ( have_comments() ) : ?>
			<div class="comments">
				<ul>
					<?php
					wp_list_comments(
						[
							'callback' => function( $comment, $args, $depth ) {
								include locate_template( 'templates/comment.php' );
							},
						]
					);
					?>
				</ul>
			</div>
			<?php if ( get_comment_pages_count() > 1 ) : ?>
				<nav class="pagination">
					<?php paginate_comments_links(); ?>
				</nav>
				<?php
			endif;
		endif;

		if ( comments_open() ) :
			comment_form(
				[
					'class_submit'      => 'submit button is-primary',
					'cancel_reply_link' => '<i title="' . esc_attr__( 'Cancel Reply', 'listinghive' ) . '" class="fas fa-times"></i>',
				]
			);
		endif;
		?>
	</div>
	<?php
endif;
