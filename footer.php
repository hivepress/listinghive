				</div>
			</div>
		</div>
		<footer class="site-footer">
			<div class="footer-navbar">
				<div class="footer-navbar__copyright">
					<?php echo esc_html( get_theme_mod( 'copyright_notice', '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) ) ); ?>
				</div>
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
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
