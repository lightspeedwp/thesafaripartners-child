<?php
/**
 * Tour Single Template
 *
 * @package     tour-operator
 * @category    tour
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">
			<?php lsx_content_top(); ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>
					
				<div class="content-area col-sm-12">
                    <?php get_template_part( 'content', 'tour' ); ?>
				</div>
					
			<?php endwhile; ?>

			<?php lsx_content_bottom(); ?>
			
			<?php
			// Gallery
			lsx_to_gallery( '<section id="gallery" class="lsx-to-section ' . lsx_to_collapsible_class() . '"><h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title" ' . lsx_to_collapsible_attributes( 'collapse-gallery' ) . '>' . esc_html__( 'Gallery', 'tour-operator' ) . '</h2><div id="collapse-gallery" class="collapse in"><div class="collapse-inner">', '</div></div></section>' );

			if ( function_exists( 'lsx_to_videos' ) ) {
				lsx_to_videos( '<section id="videos" class="lsx-to-section ' . lsx_to_collapsible_class() . '"><h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title" ' . lsx_to_collapsible_attributes( 'collapse-videos' ) . '>' . esc_html__( 'Videos', 'tour-operator' ) . '</h2><div id="collapse-videos" class="collapse in"><div class="collapse-inner">', '</div></div></section>' );
			} elseif ( class_exists( 'Envira_Videos' ) ) {
				lsx_to_envira_videos( '<section id="videos" class="lsx-to-section ' . lsx_to_collapsible_class() . '"><h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title" ' . lsx_to_collapsible_attributes( 'collapse-videos' ) . '>' . esc_html__( 'Videos', 'tour-operator' ) . '</h2><div id="collapse-videos" class="collapse in"><div class="collapse-inner">', '</div></div></section>' );
			}

			// Itinerary
			if ( lsx_to_has_itinerary() ) {
				$itinerary_count = 1;
				?>
				<section id="itinerary" class="lsx-to-section <?php lsx_to_collapsible_class( 'tour', false ); ?>">
					<h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title" data-toggle="collapse" data-target="#collapse-itinerary" aria-expanded="false"><?php esc_html_e( 'Full Day by Day Itinerary', 'tour-operator' ); ?></h2>

					<div id="collapse-itinerary" class="collapse in">
						<div class="collapse-inner">
							<div class="row lsx-to-archive-items lsx-to-archive-template-list lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?> itinerary-list">
								<?php while ( lsx_to_itinerary_loop() ) { ?>
									<?php
										lsx_to_itinerary_loop_item();
										$thumb = lsx_to_itinerary_thumbnail();
									?>

									<div id="day-<?php echo esc_attr( $itinerary_count ); ?>" <?php lsx_to_itinerary_class( 'lsx-to-archive-item itinerary-item col-xs-12' ); ?>>
										<div class="lsx-to-archive-container">
											<div class="lsx-to-archive-thumb">
												<div class="lsx-to-thumb-slot" style="background-image: url('<?php echo esc_url( $thumb ); ?>');">
													<?php echo wp_kses_post( '<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="' . $thumb . '">' ); ?>
												</div>
											</div>

											<div class="lsx-to-archive-wrapper">
												<div class="lsx-to-archive-content">
													<h3 class="lsx-to-archive-content-title"><?php lsx_to_itinerary_title(); ?></h3>
													<p class="lsx-to-archive-content-tagline"><?php lsx_to_itinerary_tagline(); ?></p>

													<div class="entry-content">
														<?php lsx_to_itinerary_description(); ?>
													</div>
												</div>

												<div class="lsx-to-archive-meta-data">
													<?php
														$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

														lsx_to_itinerary_destinations( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Destination', 'tour-operator' ) . ':</span> ', '</span>' );
														lsx_to_itinerary_accommodation( '<span class="' . $meta_class . 'accommodations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Accommodation', 'tour-operator' ) . ':</span> ', '</span>' );
														lsx_to_itinerary_activities( '<span class="' . $meta_class . 'activities"><span class="lsx-to-meta-data-key">' . esc_html__( 'Activities', 'tour-operator' ) . ':</span> ', '</span>' );
														lsx_to_itinerary_includes( '<span class="' . $meta_class . 'day-includes"><span class="lsx-to-meta-data-key">' . esc_html__( 'Included', 'tour-operator' ) . ':</span> ', '</span>' );
														lsx_to_itinerary_excludes( '<span class="' . $meta_class . 'day-excludes"><span class="lsx-to-meta-data-key">' . esc_html__( 'Excluded', 'tour-operator' ) . ':</span> ', '</span>' );
													?>
												</div>
											</div>
										</div>
									</div>
									<?php
									$itinerary_count++;
								}
								?>
							</div>
						</div>
					</div>

					<?php lsx_to_itinerary_read_more(); ?>
				</section>
			<?php 
			}

			// Dates and prices

			// WHats included
			lsx_to_included_block();

			// Maps
			if ( function_exists( 'lsx_to_has_map' ) && lsx_to_has_map() ) { 
			?>
				<section id="tour-map" class="lsx-to-section <?php lsx_to_collapsible_class( 'tour', false ); ?>">
					<h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title hidden-lg" <?php lsx_to_collapsible_attributes_not_post( 'collapse-tour-map' ); ?>><?php esc_html_e( 'Map', 'tour-operator' ); ?></h2>

					<div id="collapse-tour-map" class="collapse in">
						<div class="collapse-inner">
							<?php lsx_to_map(); ?>
						</div>
					</div>
				</section>
			<?php 
			}

			if ( function_exists( 'lsx_to_tour_specials' ) ) {
				lsx_to_tour_specials();
			}

			if ( function_exists( 'lsx_to_tour_reviews' ) ) {
				lsx_to_tour_reviews();
			}

			//lsx_to_related_items( 'travel-style', '<section id="related-items" class="lsx-to-section ' . lsx_to_collapsible_class() . '"><h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title" ' . lsx_to_collapsible_attributes( 'collapse-related-items' ) . '>' . lsx_to_get_post_type_section_title( 'tour', 'related', esc_html__( 'Related Tours', 'tour-operator' ) ) . '</h2><div id="collapse-related-items" class="collapse in"><div class="collapse-inner">', '</div></div></section>' );
			?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>
<?php
get_footer();
