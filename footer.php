<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package lsx
 */

if ( isset( $_GET['set_tour'] ) ) {
	$action_id = as_enqueue_async_action(
		'lsx_wetu_sync_tour', 
		array(
			'tour_id' => $_GET['set_tour'],
			'overrides' => array(),
		),
		'lsx_wetu_sync' // . date('dmy')
	);
}

?>

			</div><!-- .content -->
		</div><!-- .wrap -->

		<div id="travel-footer">
			<div id="footer-sub" class="container">
			<?php if ( is_active_sidebar( 'footer_sub' ) ) : ?>


				<div class="footer-sub-area" role="complementary">
				<?php dynamic_sidebar( 'footer_sub' ); ?>
				</div><!-- #primary-sidebar -->
				<?php endif; ?>
			</div>

			<?php lsx_footer_before(); ?>

			<footer id="colophon" class="content-info" role="contentinfo">
				<div class="container">
					<div class="row">

						<div class="col-sm-12">
							<?php lsx_footer_top(); ?>

							<p class="credit
							<?php
							if ( has_nav_menu( 'social' ) || has_nav_menu( 'footer' ) ) {
								echo 'credit-float';}
							?>
							">
                                Developed by <a href="https://lightspeedwp.agency/" rel="noreferrer noopener" title="LightSpeed – WordPress & WooCommerce Development" target="_blank">LightSpeed</a><br>
								<?php
									printf(
										/* Translators: 1: current year, 2: blog name */
										esc_html__( '&#169; %1$s %2$s All Rights Reserved', 'lsx' ),
										esc_html( date_i18n( 'Y' ) ),
										esc_html( get_bloginfo( 'name' ) )
									);
									?>

								<?php if ( apply_filters( 'lsx_credit_link', true ) ) : ?>
									<?php
										printf(
											/* Translators: 1: theme name, 2: author name and link */
											esc_html__( ' | %1$s is a WordPress theme developed by %2$s.', 'lsx' ),
											'LSX',
											'<a href="https://www.lsdev.biz/" rel="nofollow noreferrer noopener" title="LightSpeed WordPress Development - Unlocking the full value of your business, online" rel="author nofollow noopener noreferrer" >LightSpeed</a>'
										);
									?>
								<?php endif; ?>
							</p>

							<?php if ( has_nav_menu( 'social' ) ) : ?>
								<nav id="social-navigation" class="social-navigation">
									<?php
										wp_nav_menu(
											array(
												'theme_location' => 'social',
												'depth' => 1,
											)
										);
									?>
								</nav><!-- .social-navigation -->
							<?php endif; ?>

							<?php if ( has_nav_menu( 'footer' ) ) : ?>
								<nav id="footer-navigation" class="footer-navigation">
									<?php
										wp_nav_menu(
											array(
												'theme_location' => 'footer',
												'depth' => 1,
											)
										);
									?>
								</nav><!-- .footer-navigation -->
							<?php endif; ?>

							<?php lsx_footer_bottom(); ?>
						</div>
					</div>
				</div>
			</footer>

		<?php lsx_footer_after(); ?>
		<?php lsx_body_bottom(); ?>
		</div>
	</div>
	<?php wp_footer(); ?>
	</body>
</html>
