				</div>
			</div>
		</div>
		<footer class="site-footer footer has-background-white">
			<div class="container">
				<?php if ( is_active_sidebar( 'footer' ) ) : ?>
				<div class="footer-widgets">
					<div class="columns">
						<?php dynamic_sidebar( 'footer' ); ?>
					</div>
				</div>
				<?php endif; ?>
				<nav class="footer-navbar level">
					<div class="level-left">
						<div class="footer-navbar__copyright level-item">
							<?php echo esc_html( get_theme_mod( 'copyright_notice', '&copy; ' . date( 'Y' ) . ' ListingHive' ) ); ?>
						</div>
					</div>
					<div class="level-right">
						<div class="footer-navbar__menu level-item">
							<?php
							wp_nav_menu(
								[
									'theme_location' => 'footer',
									'container'      => 'ul',
									'menu_class'     => '',
								]
							);
							?>
						</div>
					</div>
				</nav>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
