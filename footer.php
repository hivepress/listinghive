				</div>
			</section>
		</div>
		<footer class="site-footer footer has-background-white">
			<div class="container">
				<nav class="level">
					<div class="level-left">
						<div class="level-item">
							<?php echo esc_html( get_theme_mod( 'copyright_notice', '&copy; ' . date( 'Y' ) . ' ListingHive' ) ); ?>
						</div>
					</div>
					<div class="level-right">
						<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer',
								'container'      => 'ul',
								'menu_class'     => 'level-item',
							]
						);
						?>
					</div>
				</nav>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
