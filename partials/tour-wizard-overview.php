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
								<?php lsx_to_price( '<p class="lsx-to-meta-data lsx-to-meta-data-big lsx-to-meta-data-price"><span class="lsx-to-meta-data-key">' . esc_html__( 'From price', 'tour-operator' ) . ':</span> ', '</p>' ); ?>
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