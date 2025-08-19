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

				<section id="overview" class="content-area clearfix <?php lsx_to_collapsible_class( 'tour', false ); ?>">
                    <h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title text-center visible-xs" <?php lsx_to_collapsible_attributes_not_post( 'collapse-overview' ); ?>><?php esc_html_e( 'Overview', 'tour-operator' ); ?>></h2>
                    <div id="collapse-overview" class="collapse in">
                    <?php get_template_part( 'content', 'tour' ); ?>
                    </div>
				</section>

			<?php endwhile; ?>

			<?php lsx_content_bottom(); ?>

            <?php
            // Maps
            if ( function_exists( 'lsx_to_has_map' ) && lsx_to_has_map() ) {
            ?>
            <section id="tour-map" class="lsx-to-section <?php lsx_to_collapsible_class( 'tour', false ); ?>">
                <h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title text-center" <?php lsx_to_collapsible_attributes_not_post( 'collapse-tour-map' ); ?>><?php esc_html_e( 'Map', 'tour-operator' ); ?></h2>

                <div id="collapse-tour-map" class="collapse in">
                    <div class="collapse-inner">
                        <?php lsx_to_map(); ?>
                    </div>
                </div>
            </section>
            <?php
			}

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
					<h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title" data-toggle="collapse" data-target="#collapse-itinerary" aria-expanded="false"><?php esc_html_e( 'Day-by-Day Itinerary', 'tour-operator' ); ?></h2>

					<div id="collapse-itinerary" class="collapse in">
						<div class="collapse-inner">
							<div class="tsp-itinerary-list">
								<?php while ( lsx_to_itinerary_loop() ) { ?>
									<?php
										lsx_to_itinerary_loop_item();
										$thumb = lsx_to_itinerary_thumbnail();
									?>

									<div id="day-<?php echo esc_attr( $itinerary_count ); ?>" <?php lsx_to_itinerary_class( 'tsp-itinerary-day' ); ?>>
                                            <div class="tsp-itinerary-content">
                                                <h3><?php tsp_itinerary_title(); ?></h3>
                                                <?php
                                                lsx_to_itinerary_accommodation( '<div><i class="tsp-icon tsp-icon-accommodation"></i><span class="tsp-meta-key">' . esc_html__( 'Accommodation', 'tour-operator' ) . ': </span> ', '</div>' );
                                                lsx_to_itinerary_room_basis( '<div><i class="tsp-icon tsp-icon-room-basis"></i><span class="tsp-meta-key">' . esc_html__( 'Room basis', 'tour-operator' ) . ': </span> ', '</div>' );
                                                ?>
                                                <div class="entry-content">
                                                    <?php tsp_itinerary_description(); ?>
                                                </div>
                                            </div>

                                        <div class="tsp-itinerary-thumb">
                                            <?php echo wp_kses_post( '<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="' . $thumb . '">' ); ?>
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
