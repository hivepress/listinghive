				</div>
			</div>
		</div>
		<footer class="site-footer">
			<div class="container">
				<?php if ( is_active_sidebar( 'site_footer' ) ) : ?>
					<div class="footer-widgets">
						<div class="row">
							<?php dynamic_sidebar( 'site_footer' ); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="footer-navbar">
					<div class="footer-navbar__start">
						<div class="footer-navbar__copyright">
							<?php echo esc_html( get_theme_mod( 'copyright_notice', '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) ) ); ?>
						</div>
					</div>
					<div class="footer-navbar__end">
						<nav class="footer-navbar__menu">
							<?php
							wp_nav_menu(
								[
									'theme_location' => 'footer',
									'container'      => 'ul',
								]
							);
							?>
						</nav>
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
