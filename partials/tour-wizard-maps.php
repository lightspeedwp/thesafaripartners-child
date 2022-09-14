<div id="Maps" class="tabcontent">
	<div class="col-md-12 col-sm-12">
		<div class="lsx-tour-module">
			<?php if ( have_posts() ) : ?>

				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<?php lsx_entry_before(); ?>

					<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
						<?php lsx_entry_top(); ?>
						<div class="col-md-6 lsx-tour-module-map">
							<div class="lsx-banner-map-wrap">
								<div class="lsx-to-thumb-slot" >
									<?php lsx_to_map(); ?>
								</div>
							</div>
							<?php get_template_part( 'partials/mobile-tour-buttons' ); ?>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="lsx-to-archive-wrapper">
								<div class="lsx-to-tour-content">
									<div class="entry-content col-xs-12 col-sm-12 col-md-12 lsx-to-tour-content">
										<h3 class="lsx-to-summary-title"><?php the_title(); ?></h3>
									</div>

									<?php lsx_to_price( '<p class="lsx-to-meta-data lsx-to-meta-data-big lsx-to-meta-data-price"><span class="lsx-to-meta-data-key">' . esc_html__( 'From price', 'tour-operator' ) . ':</span> ', '</p>' ); ?>
									<?php lsx_to_tour_single_fast_facts(); ?>

									<h4>Love this trip?</h4>
									<button class="btn lsx-cta popup-inquire">MAKE AN INQUIRY</button>

									<div class="related-tours-wrapper">
										<h4>You may also like:</h4>
										<?php
										$connected_tours = get_post_meta( get_the_ID(), 'related_tours', true );
										if ( empty( $connected_tours ) ) {
											$connected_tours = 'travel-style';
										}
										global $columns;
										$columns = 2;
										lsx_to_related_items( $connected_tours, '', '' , true, 'tour' );
										?>
									</div>
								</div>
							</div>
						</div>

						<?php lsx_entry_bottom(); ?>

					</article>

					<?php
					lsx_entry_after(); ?>

				<?php endwhile; ?>

			<?php endif; ?>
		<?php wp_reset_query(); ?>
		</div>
	</div>
	<?php get_template_part( 'partials/tour-buttons' ); ?>
						</div>
