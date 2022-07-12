<div class="lsx-wizard-step">
	<h4>3. <?php esc_html_e( 'Where', 'thesafaripartners-child' ); ?></h4>
	<div class="step-content">
		<div class="wizard-where">
			<div class="col-md-12 whereintro">
				<h2><?php esc_html_e( 'Where in Africa?', 'thesafaripartners-child' ); ?></h2>
				<p><?php esc_html_e( 'Let us where you want to travel', 'thesafaripartners-child' ); ?></p>
			</div>
			<div class="col-md-12">
				<div class="safari-styles desinations-landing-style">
					<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid">
						<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
							<div class="lsx-to-slider-wrap">
								<div class="lsx-to-slider-inner" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>
									<?php
									$the_query = new WP_Query(
										array(
											'post_type'   => 'destination',
											'post_parent' => 0,
										)
									);

									while ( $the_query->have_posts() ) :
										global $post;
										$the_query->the_post();
										?>
										<div class="lsx-to-widget-item-wrap col-xs-4 col-sm-3 lsx-travel-style destinations-archive lsx-to-archive-item">
											<div class="lsx-to-widget-thumb">
												<div class="checkbox-wrapper">
													<input class="btn-check"  type="checkbox" value="<?php echo get_the_ID(); ?>" name="fwp_where" />
													<span aria-hidden="true"></span>
												</div>
												<?php lsx_thumbnail( 'lsx-thumbnail-full' ); ?>
											</div>

											<div class="lsx-to-content">
												<?php the_title(); ?>
											</div>
										</div>

										<?php endwhile; ?>
										<?php wp_reset_query(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>