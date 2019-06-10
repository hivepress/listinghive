<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>

		<!-- todo remove -->
		<link rel="stylesheet/less" type="text/css" href="<?php echo esc_url( HT_THEME_URL ); ?>/style.less" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>

		<link href="https://fonts.googleapis.com/css?family=Poppins:500&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	</head>
	<body <?php body_class(); ?>>
		<div class="site-container">
			<div class="site-header">
				<nav class="header-navbar navbar is-spaced">
					<div class="header-navbar__logo navbar-brand">
						<a href="<?php echo esc_url( home_url() ); ?>" class="navbar-item">
							<?php
							if ( has_custom_logo() ) :
								the_custom_logo();
							else :
								?>
								<img src="<?php echo esc_url( HT_THEME_URL ); ?>/assets/images/logo.svg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
							<?php endif; ?>
						</a>
					</div>
					<div class="navbar-menu">
						<div class="navbar-end">
							<div class="header-navbar__menu navbar-item">
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
							<div class="navbar-item">
								<?php do_action( 'hivepress/v1/todo' ); ?>
							</div>
						</div>
					</div>
				</nav>
				<?php
				// todo
				if ( is_front_page() ) :
				?>
				<section class="header-hero hero is-medium is-primary">
					<div class="header-hero__content hero-body">
						<div class="container">
							<h1 style="text-align:center;">Find a place to call home.</h1>
							<p style="text-align:center;">Yep yu can simply find anything here.</p>
						</div>
					</div>
				</section>
				<?php endif; ?>
			</div>
			<section class="site-content section">
				<div class="container">
