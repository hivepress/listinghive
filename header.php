<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- todo remove -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
		<link rel="stylesheet/less" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.less" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="site-container">
			<nav class="navbar is-spaced">
				<div class="navbar-brand">
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
					<div class="navbar-start">
						<a class="navbar-item">Home</a>
						<a class="navbar-item">Documentation</a>
						<div class="navbar-item has-dropdown is-hoverable">
							<a class="navbar-link">More</a>
							<div class="navbar-dropdown">
								<a class="navbar-item">About</a>
								<a class="navbar-item">Jobs</a>
								<a class="navbar-item">Contact</a>
							</div>
						</div>
					</div>
					<div class="navbar-end">
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
						<h1 class="title">Primary bold title</h1>
						<h2 class="subtitle">Primary bold subtitle</h2>
					</div>
				</div>
			</section>
			<?php endif; ?>
			<section class="section">
				<div class="container">
