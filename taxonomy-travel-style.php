<?php
/**
 * Travel Style Archive.
 *
 * @package  tour-operator
 * @category travel-style
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main entry-content" role="main">



			<div class="archive-intro col-sm-12">
				<div class="col-sm-8">
					<div class="lsx-to-widget-description">
						<?php $term = get_queried_object(); ?>

						<h2 class="category-title"><?php echo $term->name; ?></h2>

						<p class="category-description"><?php echo $term->description; ?></p>
					</div>
				</div>

				<div class="col-sm-4">
					<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) { ?>
						<div class="lsx-to-widget-thumb">
							<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-thumbnail-wide' ); ?>
						</div>
					<?php } else { ?>
						<div class="lsx-to-widget-thumb">
							<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
						</div>
					<?php } ?>
					<?php wp_reset_query(); ?>
				</div>
			</div>


			<?php 
				if ( have_posts() ) {

					$panels = array(
						0 => array( 'who', 'where' ),
						1 => array( 'when' ),
						2 => array( 'budget' ),
					);
					tsp_mini_wizard( $panels );

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
						<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider2">
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
				?>
		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();
