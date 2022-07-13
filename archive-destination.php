<?php
/**
 * Destination Archive
 *
 * @package  tour-operator
 * @category destination
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php 
				$panels = array(
					0 => array( 'who', 'where' ),
					1 => array( 'what' ),
					2 => array( 'when' ),
					3 => array( 'budget' ),
				);
				tsp_mini_wizard( $panels );
			?>

			<?php
				$query_args = array (
					'post_type' => 'tour',
					'posts_per_page' => -1,
					'facetwp' => true,
				);
				$query = new WP_Query( $query_args );

				if ( $query->have_posts() ) { 
				?>
				<div class="facetwp-hidden-filters">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'filter-menu',
							)
						);
					?>
				</div>

				<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid" style="max-width:1200px;margin-left:auto;margin-right:auto;">
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
			<?php } else {  ?>
				<?php get_template_part( 'partials/content', 'none' ); ?>
			<?php } ?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();
