<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- todo remove -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">

		<link rel="stylesheet/less" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.less" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>

		<link href="https://fonts.googleapis.com/css?family=Quicksand:500&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="site-container">
			<nav class="header-navbar navbar is-spaced">
				<div class="header-navbar__logo navbar-brand">
					<a href="<?php echo esc_url( home_url() ); ?>" class="navbar-item">
						<?php
						if ( has_custom_logo() ) :
							the_custom_logo();
						else :
							?>
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<?php endif; ?>
					</a>
				</div>
				<div class="navbar-menu">
					<div class="navbar-end">
						<?php
						wp_nav_menu(
							[
								'theme_location' => 'header',
								'container'      => 'ul',
								'menu_class'     => 'navbar-item',
							]
						);
						?>
						<div class="navbar-item">
							<div class="buttons">
								<a class="button is-primary"><strong>Sign up</strong></a>
								<a class="button is-light">Log in</a>
							</div>
						</div>
					</div>
				</div>
			</nav>
			<?php if ( is_home() ) : ?>
			<section class="hero is-large is-primary is-bold">
				<div class="hero-body">
					<div class="container">
						<h1 class="title is-1">Primary bold title</h1>
						<h2 class="subtitle">Primary bold subtitle</h2>
					</div>
				</div>
			</section>
			<?php endif; ?>
			<section class="section">
				<div class="container">
