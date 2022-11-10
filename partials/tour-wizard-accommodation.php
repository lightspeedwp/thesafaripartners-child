<div id="Accommodation" class="tabcontent">
	<div class="col-md-12 col-sm-12">
		<div class="lsx-tour-module">
			<?php 
			//$accommodation = get_post_meta( get_the_ID(), 'accommodation_to_tour', false );
			$accommodation   = lsx_to_get_tour_itinerary_ids( 'accommodation_to_tour', true );
			$locations_array = tsp_itinerary_accommodation_locations();

			if ( ! empty( $accommodation ) && false !== $accommodation ) {	
				$accommodation_args = array(
					'post_type'      => 'accommodation',
					'post_status'    => 'publish',
					'post__in'       => $accommodation,
					'posts_per_page' => -1,
					'orderby'        => 'post__in',
				);
				$accom_query = new WP_Query( $accommodation_args );
				if ( $accom_query->have_posts() ) {
					?>
					<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
						<?php lsx_entry_top(); ?>
	
						<div class="entry-content col-xs-12 col-sm-12 col-md-12">
							<div id="wizard2" class="lsx-wizard" style="display: none;">
								<?php
								$active = 'active';
								while ( $accom_query->have_posts() ) {
									$accom_query->the_post();
									?>
									<div class="lsx-wizard-step <?php echo esc_attr( $active ); ?>">
										<div class="step-content">
											<div id="accommodation" class="lsx-to-archive-item itinerary-item col-xs-12">
												<div class="lsx-to-archive-container">
													<div class="col-md-6 lsx-contact-module-image">
														<?php tsp_accommodation_gallery( get_the_ID() ); ?>
														<?php get_template_part( 'partials/mobile-tour-buttons' ); ?>
													</div>
	
													<div class="col-xs-12 col-sm-12 col-md-6">
														<div class="lsx-to-archive-wrapper">
															<div class="lsx-to-tour-content">
																<h2 class="lsx-to-archive-content-title"><?php the_title(); ?></h2>

																<div class="lsx-to-widget-meta-data">
																<?php
																	if ( isset( $locations_array[ get_the_ID() ] ) ) {

																		$titles = array();
																		foreach ( $locations_array[ get_the_ID() ] as $a_local ) {
																			$a_parent = wp_get_post_parent_id( $a_local );
																			if ( 0 !== $a_parent && '0' !== $a_parent && null !== $a_parent ) {
																				$titles[] = get_the_title( $a_local );
																			}
																		}
																		if ( ! empty( $titles ) ) {
																			?>
																			<span class="lsx-to-meta-data lsx-to-meta-data-destinations">
																				<span class="lsx-to-meta-data-key"><?php esc_html_e( 'Location:', 'thesafaripartners-child' ); ?> <?php echo implode( ',', $titles ); ?></span>
																				
																			</span>
																			<?php
																		}
																	}
																?>
																</div>
	
																<div class="entry-content lsx-readmore">
																	<?php lsx_to_entry_content_top(); ?>

																	<?php the_content(); ?>

																	<?php lsx_to_entry_content_bottom(); ?>
																
																</div>
																<button id="singlelink" class="tablinks" id="page-4" onclick="openCity(event, 'Price')">Dates &amp; Prices</button>
															</div>
														</div>
													</div>
												</div>
											</div>
	
										</div>
									</div>
									<?php
									if ( '' !== $active ) {
										$active = '';
									}
								}
								?>
							</div>
						</div>
						<?php lsx_entry_bottom(); ?>
					</article>
					<?php
				}
				wp_reset_query();
			}
			?>
		</div>
	</div>
	<?php get_template_part( 'partials/tour-buttons' ); ?>
</div>