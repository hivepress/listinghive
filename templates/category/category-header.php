<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<div class="category__header">
			<div class="category__count">
				<?php
				echo esc_html(
					sprintf(
						/* translators: %s: posts number. */
						_n( '%s Post', '%s Posts', get_queried_object()->count, 'listinghive' ),
						number_format_i18n( get_queried_object()->count )
					)
				);
				?>
			</div>
			<h1 class="category__name"><?php single_term_title(); ?></h1>
			<?php if ( term_description() ) : ?>
				<div class="category__description"><?php echo wp_kses_post( term_description() ); ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>
