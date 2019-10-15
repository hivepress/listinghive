<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>

		<!-- todo remove -->
		<link rel="stylesheet/less" type="text/css" href="'http://localhost/hivepress/wp-content/themes/listinghive/style.less" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
	</head>
	<body <?php body_class(); ?>>
		<?php
		if ( function_exists( 'wp_body_open' ) ) :
			wp_body_open();
		endif;

		get_template_part( 'templates/common/loader' );
		?>
		<a href="#content" class="skip-link screen-reader-text"><?php esc_html_e( 'Skip to content', 'listinghive' ); ?></a>
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
						<?php if ( has_action( 'hivetheme/v1/render/site_header' ) ) : ?>
							<div class="header-navbar__actions">
								<?php do_action( 'hivetheme/v1/render/site_header' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php
				if ( is_page() ) :
					get_template_part( 'templates/page/header' );
				elseif ( is_singular( 'post' ) ) :
					get_template_part( 'templates/post/single/header' );
				elseif ( is_tax( 'hp_listing_category' ) ) :
					get_template_part( 'templates/listing-category/header' );
				endif;
				?>
			</header>
			<div class="site-content" id="content">
				<div class="container">
