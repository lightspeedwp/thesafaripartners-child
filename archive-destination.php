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
					0 => array( 'who' ),
					1 => array( 'what' ),
					3 => array( 'where' ),
					3 => array( 'when' ),
					4 => array( 'budget' ),
				);
				tsp_mini_wizard( $panels );
			?>

			<?php

				if ( have_posts() ) { 
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

				<div class="slider-container mini-wizard-results lsx-to-widget-items lsx-to-archive-template-grid toptours-posts" >
					<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
						<div class="lsx-to-slider-wrap">
							<div class="lsx-to-slider-inner" data-interval="6000" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }' style="max-width: 100vw;width: 100%;overflow: hidden;" >
							<?php
							while ( have_posts() ) {
								the_post();
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
