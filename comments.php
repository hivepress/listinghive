<?php if ( ( have_comments() || comments_open() ) && ! post_password_required() ) : ?>
	<div id="comments" class="section">
		<h2 class="section__title section__title--center"><?php esc_html_e( 'Comments', 'listinghive' ); ?></h2>
		<?php if ( have_comments() ) : ?>
			<div class="comments">
				<ul>
					<?php
					wp_list_comments(
						[
							'callback' => function( $comment, $args, $depth ) {
								echo hivetheme()->template->render_part(
									'templates/comment',
									[
										'comment' => $comment,
										'args'    => $args,
										'depth'   => $depth,
									]
								);
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
					'cancel_reply_link' => '<i title="' . esc_attr__( 'Cancel Reply', 'listinghive' ) . '" class="fas fa-times"></i>',
				]
			);
		endif;
		?>
	</div>
	<?php
endif;
