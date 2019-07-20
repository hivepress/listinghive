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
		<?php get_template_part( 'templates/loader' ); ?>
		<div class="site-container">
			<div class="site-header">
				<nav class="header-navbar navbar">
					<div class="header-navbar__logo navbar-brand">
						<a href="<?php echo esc_url( home_url() ); ?>" class="header-logo navbar-item">
							<?php
							if ( has_custom_logo() ) :
								the_custom_logo();
							else :
								?>
								<div class="header-logo__name"><?php bloginfo( 'name' ); ?></div>
								<?php if ( get_bloginfo( 'description' ) ) : ?>
									<div class="header-logo__description"><?php bloginfo( 'description' ); ?></div>
									<?php
								endif;
							endif;
							?>
						</a>
						<div id="mobile_menu" class="header-navbar__burger" data-component="burger">
							<?php
							wp_nav_menu(
								[
									'theme_location' => 'header',
									'container'      => 'ul',
									'menu_class'     => '',
								]
							);
							?>
						</div>
						<a href="#mobile_menu" class="navbar-burger">
							<span></span>
							<span></span>
							<span></span>
						</a>
					</div>
					<div class="navbar-menu">
						<div class="navbar-end">
							<div class="header-navbar__menu navbar-item" data-component="menu">
								<?php
								wp_nav_menu(
									[
										'theme_location' => 'header',
										'container'      => 'ul',
										'menu_class'     => '',
									]
								);
								?>
							</div>
							<?php if ( has_action( 'hivetheme/v1/render/site_header' ) ) : ?>
								<div class="navbar-item">
									<?php do_action( 'hivetheme/v1/render/site_header' ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</nav>
				<?php
				if ( is_page() ) :
					get_template_part( 'templates/page/header' );
				elseif ( is_singular( 'post' ) ) :
					get_template_part( 'templates/post/header' );
				elseif ( is_tax( 'hp_listing_category' ) ) :
					get_template_part( 'templates/todo/header' );
				endif;
				?>
			</div>
			<div class="site-content section">
				<div class="container">
