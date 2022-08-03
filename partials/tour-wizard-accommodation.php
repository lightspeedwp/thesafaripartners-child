<div id="Accommodation" class="tabcontent">
	<div class="col-md-12 col-sm-12">
		<div class="lsx-tour-module">
			<?php 
			$accommodation = get_post_meta( get_the_ID(), 'accommodation_to_tour', false );
			if ( ! empty( $accommodation ) && false !== $accommodation ) {
				$accommodation_args = array(
					'post_type'      => 'accommodation',
					'post_status'    => 'publish',
					'post__in'       => $accommodation,
					'posts_per_page' => -1,
				);
				$accom_query = new WP_Query( $accommodation_args );
				if ( $accom_query->have_posts() ) {
					?>
					<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
						<?php lsx_entry_top(); ?>
	
						<div class="entry-content col-xs-12 col-sm-12 col-md-12">
							<div id="wizard2" class="lsx-wizard" style="display: none;">
								<?php
								while ( $accom_query->have_posts() ) {
									$accom_query->the_post();
									?>
									<div class="lsx-wizard-step">
										<div class="step-content">
											<div id="accommodation" class="lsx-to-archive-item itinerary-item col-xs-12">
												<div class="lsx-to-archive-container">
												<div class="col-md-6 lsx-contact-module-image">
													<div class="lsx-banner-image-wrap">
															<?php echo get_the_post_thumbnail($page->ID,'full'); ?>
															
														</div>
													</div>
	
													<div class="col-xs-12 col-sm-12 col-md-6">
														<div class="lsx-to-archive-wrapper">
															<div class="lsx-to-tour-content">
																<h3 class="lsx-to-archive-content-title"><?php the_title(); ?></h3>
	
																<div class="entry-content">
																	<?php lsx_to_entry_content_top(); ?>

																	<?php the_content(); ?>

																	<?php lsx_to_entry_content_bottom(); ?>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
	
										</div>
									</div>
									<?php
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
	<div class="lsx-single-contact">
						<div class="tours-nav">
							<div class="col-md-4">
								<button class="btn lsx-btn popup-inquire">Book It!</button>
							</div>
							<div class="col-md-4">
								<button class="btn lsx-btn">DOWNLOAD ITINERY</button>
							</div>
							<div class="col-md-4 dropdown-share">
								<button class="btn lsx-btn -lsx-share-initiated">Share with a Friend</button>
								<div class="dropdown-content">
								<?php
				if ( class_exists( 'LSX_Sharing' ) ) {
					lsx_content_sharing();
				} else {
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}
				}
				?>
 								 </div>
							</div>
						</div>
						</div>
</div>