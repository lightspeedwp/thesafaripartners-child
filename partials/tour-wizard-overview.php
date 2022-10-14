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
							<span class="tax-title"><?php $terms = get_the_terms( $post->ID, 'tour-type' );

							echo "<span>" . the_date();

							foreach ( $terms as $term ) {
								if ( in_array( $term->name, array( 'Mobile-train', 'Mobile-boat' ) ) ) { continue; }
								echo $term->name;
							}

							echo "</span>";?></span><span>
									<div class="lsx-banner-image-wrap">
								<?php //echo get_the_post_thumbnail($page->ID,'full');
									lsx_thumbnail( 'full' );
								?>

							</div>
							<?php get_template_part( 'partials/mobile-tour-buttons' ); ?>
						</div>

					<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-single' ); ?>>
						<?php lsx_entry_top(); ?>

						<div class="entry-content col-xs-12 col-sm-12 col-md-6">
							<div class="lsx-to-tour-content">
								<div class="lsx-to-summary">
									<h2 class="lsx-to-summary-title"><?php the_title(); ?></h2>
								</div>
								<div class="lsx-to-widget-meta-data">
								<?php
									$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

									lsx_to_duration( '<span class="' . $meta_class . 'duration"><span class="lsx-to-meta-data-key"></span> ', '</span>' );
									lsx_to_connected_countries( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key"></span> ', '</span>' );
									?>
								</div>	
								<?php the_content(); ?>
								<button id="singlelink" class="tablinks" id="page-1" onclick="openCity(event, 'Day')">Day by Day</button>
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
					