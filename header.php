<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>

		<!-- todo remove -->
		<link rel="stylesheet/less" type="text/css" href="<?php echo esc_url( HT_THEME_URL ); ?>/style.less" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
	</head>
	<body <?php body_class(); ?>>
		<div class="site-container">
			<header class="site-header">
				<div class="header-navbar">
					<div class="header-logo">
						<?php
						if ( has_custom_logo() ) :
							the_custom_logo();
						else :
							?>
							<a href="<?php echo esc_url( home_url() ); ?>" rel="home">
								<div class="header-logo__name"><?php bloginfo( 'name' ); ?></div>
								<?php if ( get_bloginfo( 'description' ) ) : ?>
									<div class="header-logo__description"><?php bloginfo( 'description' ); ?></div>
								<?php endif; ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</header>
			<div class="site-content">
				<div class="container">
