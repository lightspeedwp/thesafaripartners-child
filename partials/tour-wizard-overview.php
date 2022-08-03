<div id="Overview" class="tabcontent tours-wizard" style="display: block;">
	<div class="col-md-12 col-sm-12">
		<div class="lsx-tour-module">
			<?php 
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					lsx_entry_before();
					?>
					<div class="col-md-6 lsx-contact-module-image">
					<div class="lsx-banner-image-wrap">
							<picture>
							<?php echo get_the_post_thumbnail($page->ID,'full'); ?>
							<picture>
						</div>
					</div>

					<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-single' ); ?>>
						<?php lsx_entry_top(); ?>

						<div class="entry-content col-xs-12 col-sm-12 col-md-6">
							<div class="lsx-to-tour-content">
								<div class="lsx-to-summary">
									<h2 class="lsx-to-summary-title"><?php the_title(); ?></h2>
								</div>
								<?php
				$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

				lsx_to_duration( '<span class="' . $meta_class . 'duration"><span class="lsx-to-meta-data-key"></span> ', '</span>' );
				the_terms( get_the_ID(), 'travel-style', '<span class="' . $meta_class . 'style"><span class="lsx-to-meta-data-key">' . esc_html__( 'Travel Style', 'tour-operator' ) . ':</span> ', ', ', '</span><br/>' );
				lsx_to_connected_countries( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key"></span> ', '</span>' );

				if ( function_exists( 'lsx_to_connected_activities' ) ) {
					lsx_to_connected_activities( '<span class="' . $meta_class . 'activities"><span class="lsx-to-meta-data-key">' . esc_html__( 'Activities', 'tour-operator' ) . ':</span> ', '</span>' );
				}
				?>
								<?php the_content(); ?>
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