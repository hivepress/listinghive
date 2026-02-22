				</div>
			</div>
		</div>
		<?php if ( ! is_singular( [ 'post', 'page' ] ) || ! get_post_meta( get_the_ID(), 'ht_hide_footer', true ) ) : ?>
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
						<?php if ( get_theme_mod( 'copyright_notice' ) ) : ?>
							<div class="footer-navbar__start">
								<div class="footer-navbar__copyright">
									<?php echo wp_kses_post( get_theme_mod( 'copyright_notice' ) ); ?>
								</div>
							</div>
						<?php endif; ?>
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
			<?php
		endif;

		wp_footer();
		?>
	</body>
</html>
