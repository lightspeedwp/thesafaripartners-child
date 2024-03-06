<div id="Day" class="tabcontent">
	<div class="col-md-12 col-sm-12">
		<div class="lsx-tour-module">
			<?php
			if ( have_posts() ) {
				
				while ( have_posts() ) {
				the_post();
				
				lsx_entry_before();
				?>
				<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
					<?php lsx_entry_top(); ?>

					<div class="entry-content col-xs-12 col-sm-12 col-md-12">
						<div class="itenary">
							<div id="wizard" class="lsx-wizard" style="display: none;">
								<?php
								if ( lsx_to_has_itinerary() ) {
									$itinerary_count   = 1;
									$total_itineraries = lsx_to_itinerary_count( false );
									?>
									<div id="itinerary" class="<?php lsx_to_collapsible_class( 'tour', false ); ?>">
										<div id="collapse-itinerary" class="collapse in">
											<div class="collapse-inner">
												<div class="row lsx-to-archive-items lsx-to-archive-template-list lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?> itinerary-list">
													<?php
													$active = 'active';
													while ( lsx_to_itinerary_loop() ) {
														
														lsx_to_itinerary_loop_item();
														$thumb = lsx_to_itinerary_thumbnail( 'large','destination_to_tour');
														?>

														<div class="lsx-wizard-step <?php echo esc_attr( $active ); ?>">
															<h4><?php lsx_to_itinerary_title(); ?></h4>
															<div class="step-content">
																<div id="day-<?php echo esc_attr( $itinerary_count ); ?>" <?php lsx_to_itinerary_class( 'lsx-to-archive-item itinerary-item col-xs-12' ); ?>>
																	<div class="lsx-to-archive-container">
																	<div class="col-md-6 lsx-contact-module-image">
																			<div class="lsx-banner-image-wrap">
																			
																					<?php echo wp_kses_post( '<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="' . $thumb . '">' ); ?>
																			</div>
																			<?php get_template_part( 'partials/mobile-tour-buttons' ); ?>
																		</div>

																		<div class="col-xs-12 col-sm-12 col-md-6">
																			<div class="lsx-to-archive-wrapper">
																				<div class="lsx-to-tour-content">
																					<h3 class="lsx-to-archive-content-title"><?php lsx_to_itinerary_title(); ?></h3>
																					<p class="lsx-to-archive-content-tagline"><?php lsx_to_itinerary_tagline(); ?></p>
																					
																					<div class="lsx-to-archive-meta-data">
																					<?php
																					$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';
																					if ( $total_itineraries === $itinerary_count ) {
																						echo '<span class="heading-destinations">' . __( 'Departure Day', 'thesafaripartners-child' ) . '</span><br/>';
																					} else {

																						$itinerary_title = strip_tags( lsx_to_itinerary_destinations( '<span class="heading-destinations">' . lsx_to_itinerary_title( false ) . ' - ' , '</span><br/>', false ), array( 'span', 'br' ) );
																						if ( has_term( array( 'mobile-train', 'mobile-boat' ), 'tour-type' ) && '' === $itinerary_title ) {
																							if ( has_term( array( 'mobile-train' ), 'tour-type' ) ) {
																								$itinerary_title = esc_html__( 'On train', 'thesafaripartners-child' );
																							} else {
																								$itinerary_title = esc_html__( 'On boat', 'thesafaripartners-child' );
																							}
																							$itinerary_title = '<span class="heading-destinations">' . lsx_to_itinerary_title( false ) . ' - ' . $itinerary_title . '</span>';
																						}

																						echo $itinerary_title;

																					}
																					echo strip_tags( lsx_to_itinerary_accommodation( '<span class="' . $meta_class . 'accommodations"><span class="lsx-to-meta-data-key">' . esc_html__( '', 'tour-operator' ) . '</span> ', '</span><br/>', false ), array( 'span', 'br' ) );
																					echo strip_tags( lsx_to_itinerary_destinations( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( '', 'tour-operator' ) . '</span> ', '</span><br/>', false ), array( 'span', 'br' ) );
																					?>
																					<?php
				$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

				lsx_to_itinerary_room_basis( '<span class="' . $meta_class . 'day-includes"><span class="lsx-to-meta-data-key">' . esc_html__( '', 'tour-operator' ) . '</span> ', '</span>' );

			?>
																				</div>
																					<div class="entry-content lsx-readmore">
																						<?php lsx_to_itinerary_description(); ?>
																					</div>
																					<div class="extra-cta">
				<button class="btn btn-primary pull-right lsx-wizard-button-next lsx-btn popmake-253235 pum-trigger pum-triggercta"><span>Request more information</span></button>
				</div>
																					<button style="display:none;" class="tablinks accommodation-tablink" id="singlelink" onclick="openCity(event, 'Accommodation')">Accommodation</button>
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
														$itinerary_count++;
													}
													?>
												</div>

												<?php lsx_to_itinerary_read_more(); ?>
												
											</div>
											


											
										</div>
									</div>
								<?php
								}
							?>
							</div>
						</div>
					</div>
					<?php lsx_entry_bottom(); ?>
				</article>

				<?php
				lsx_entry_after();
				}
			}
			wp_reset_query();
			?>
		</div>
	</div>
	<?php get_template_part( 'partials/tour-buttons' ); ?>
						</div>
						