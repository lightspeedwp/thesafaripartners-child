<div id="Accommodation" class="tabcontent">
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
						<div class="col-md-6 lsx-tour-module-image">
							<div class="lsx-banner-image-wrap">
								<div class="lsx-to-thumb-slot" >
									<?php lsx_to_gallery(); ?>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="lsx-to-archive-wrapper">
								<div class="lsx-to-tour-content">
									<div class="entry-content col-xs-12 col-sm-12 col-md-12 lsx-to-tour-content">
										<div class="lsx-to-summary">
											<h2 class="lsx-to-summary-title">Accommodation</h2>
										</div>
										<?php
										lsx_to_connected_accommodation();
										lsx_to_accommodation_posts();
										?>
									</div>
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
</div>