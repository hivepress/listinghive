<div class="site-loader" data-component="loader">
	<?php $color = get_theme_mod( 'primary_color', '#ffc107' ); ?>
	<svg width="38" height="38" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
		<defs>
			<linearGradient x1="8.042%" y1="0%" x2="65.682%" y2="23.865%" id="gradient">
				<stop stop-color="<?php echo esc_attr( $color ); ?>" stop-opacity="0" offset="0%"/>
				<stop stop-color="<?php echo esc_attr( $color ); ?>" stop-opacity=".631" offset="63.146%"/>
				<stop stop-color="<?php echo esc_attr( $color ); ?>" offset="100%"/>
			</linearGradient>
		</defs>
		<g fill="none" fill-rule="evenodd">
			<g transform="translate(1 1)">
				<path d="M36 18c0-9.94-8.06-18-18-18" stroke="url(#gradient)" stroke-width="3"></path>
				<circle fill="#fff" cx="36" cy="18" r="1"></circle>
			</g>
		</g>
	</svg>
</div>
