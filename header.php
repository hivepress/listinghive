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
				<nav class="header-navbar navbar">
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
							<div class="header-navbar__menu navbar-item" data-component="dropdown-menu">
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
				<section class="header-hero hero is-medium is-primary" data-component="parallax">
					<div class="header-hero__content hero-body">
						<div class="container">
							<h1 style="text-align:center;">Find a place to call home.</h1>
							<p style="text-align:center;">Handpicked houses, apartments and rooms for long-term rent.</p>
						</div>
					</div>
				</section>
				<?php endif; ?>
				<?php
				// todo
				if ( is_singular( [ 'post', 'page' ] ) && has_post_thumbnail() && ! is_front_page() ) :
					the_post();
					?>
				<section class="header-hero hero is-medium is-primary" data-component="parallax">
					<div class="header-hero__content hero-body">
						<div class="container">
							<div class="columns">
								<div class="column is-8 is-offset-2">
									<?php if ( has_category() ) : ?>
										<div class="post__categories">
											<?php the_category( ' ' ); ?>
										</div>
										<?php
									endif;

if ( '' !== get_the_title() ) :
	?>
										<h1 class="post__title title is-1 has-text-centered"><?php the_title(); ?></h1>
									<?php endif; ?>
									<div class="post__details">
										<time datetime="<?php echo esc_attr( get_the_time( 'Y-m-d' ) ); ?>" class="post__date"><?php echo esc_html( get_the_date() ); ?></time>
										<div class="post__author"><?php printf( esc_html__( 'By %s', 'listinghive' ), get_the_author() ); ?></div>
										<div class="post__comments"><?php comments_number(); ?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<?php endif; ?>
			</div>
			<div class="site-content section">
				<div class="container">
