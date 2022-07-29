<?php
/**
 * Destination Single Template
 *
 * @package     tour-operator
 * @category    destination
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<section id="summary" class="lsx-to-section-new <?php lsx_to_collapsible_class( 'destination', false ); ?>">
					<h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title hidden-lg" <?php lsx_to_collapsible_attributes_not_post( 'collapse-summary' ); ?>><?php esc_html_e( 'Summary', 'tour-operator' ); ?></h2>

					<div id="collapse-summary" class="collapse in">
						<div class="collapse-inner">
							<div class="row">
								<?php lsx_to_content( 'content', 'destination' ); ?>
							</div>
						</div>
					</div>
				</section>

			<?php endwhile; ?>

			<?php get_template_part( 'partials/shaman-intro', '1' ); ?>

			<?php 
				$panels = array(
					0 => array( 'who' ),
					1 => array( 'where' ),
					2 => array( 'what' ),
					3 => array( 'when' ),
					4 => array( 'budget' ),
				);
				tsp_mini_wizard( $panels );
			?>

			<?php
				$tours = get_post_meta( get_the_ID(), 'tour_to_destination', false );
				if ( false !== $tours && ! empty( $tours ) ) {
					$query_args = array(
						'post_type' => 'tour',
						'post_status' => 'publish',
						'facetwp' => true,
						'post__id' => $tours,
					);
					$query = new WP_Query( $query_args );
	
					if ( $query->have_posts() ) { 
						?>
						<div class="facetwp-hidden-filters hidden">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'filter-menu',
									)
								);
							?>
						</div>
		
						<div class="slider-container mini-wizard-results lsx-to-widget-items lsx-to-archive-template-grid" style="max-width:1200px;margin-left:auto;margin-right:auto;">
							<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
								<div class="lsx-to-slider-wrap">
									<div class="lsx-to-slider-inner" data-interval="6000" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }' style="max-width: 100vw;width: 100%;overflow: hidden;" >
									<?php
									while ( $query->have_posts() ) {
										$query->the_post();
										?>
										<div class="<?php echo esc_attr( lsx_to_archive_class( 'lsx-to-archive-item' ) ); ?>">
											<?php lsx_to_content( 'content', 'tour' ); ?>
										</div>
									<?php
									}
									?>
									</div>
								</div>
							</div>
						</div>

						<?php
					} else {
						get_template_part( 'partials/content', 'none' );
					} 
					
					wp_reset_query();
				}
			?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php
get_footer();