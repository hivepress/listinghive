<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php
		if ( function_exists( 'wp_body_open' ) ) :
			wp_body_open();
		endif;
		?>
		<div class="site-container">
			<header class="site-header">
				<div class="header-navbar">
					<div class="header-navbar__start">
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
					<div class="header-navbar__end">
						<div class="header-navbar__burger" data-component="burger">
							<a href="#"><i class="fas fa-bars"></i></a>
							<?php
							wp_nav_menu(
								[
									'theme_location' => 'header',
									'container'      => 'ul',
								]
							);
							?>
						</div>
						<nav class="header-navbar__menu" data-component="menu">
							<?php
							wp_nav_menu(
								[
									'theme_location' => 'header',
									'container'      => 'ul',
								]
							);
							?>
						</nav>
						<?php if ( has_filter( 'hivetheme/v1/areas/site_header' ) ) : ?>
							<div class="header-navbar__actions">
								<?php echo apply_filters( 'hivetheme/v1/areas/site_header', '' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php echo apply_filters( 'hivetheme/v1/areas/site_hero', '' ); ?>
			</header>
			<div class="site-content" id="content">
				<div class="container">
