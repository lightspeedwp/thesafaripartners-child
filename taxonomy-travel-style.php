<?php
/**
 * Travel Style Archive.
 *
 * @package  tour-operator
 * @category travel-style
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main entry-content" role="main">
<div class="archive-intro col-sm-12">
	<div class="col-sm-9">
	<p class="lsx-to-widget-description">
		<?php $term = get_queried_object();  ?>

	<h2 class="category-title"><?php echo $term->name; ?></h2>

	<p class="category-description"><?php echo $term->description; ?></p>
	</p>
</div>
<div class="col-sm-3">
				<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
					<div class="lsx-to-widget-thumb">

							<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-thumbnail-wide' ); ?>

					</div>
				<?php else : ?>
					<div class="lsx-to-widget-thumb">

							<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">

					</div>
				<?php endif; ?>
				<?php	wp_reset_query(); ?>

			</div>
		</div>

			<?php if ( have_posts() ) : ?>
<div class="row lsx-to-archive-items">
				<div class="wp-block-tour-operator-block-post-types toptours-posts lsx-to-archive-template-<?php echo esc_attr( tour_operator()->archive_layout ); ?> lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?>">
					<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid">
						<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
							<div class="lsx-to-slider-wrap">
								<div class="lsx-to-slider-inner" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>
					<?php
					while ( have_posts() ) :
						the_post();
						?>

						<div class="lsx-to-widget-item-wrap <?php echo esc_attr( lsx_to_archive_class( 'lsx-to-archive-item' ) ); ?>">
							<article <?php post_class(); ?>>

								<?php lsx_widget_entry_top(); ?>

									<div class="lsx-to-widget-thumb">

							<a href="<?php the_permalink() ?>">
											<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>

							</a>
									</div>


								<div class="lsx-to-widget-content">

									<?php lsx_widget_entry_content_top(); ?>

									<h4 class="lsx-to-widget-title text-center">

							<a href="<?php the_permalink() ?>">
											<?php the_title(); ?></a>
									</h4>

									<?php
									ob_start();
									lsx_to_widget_entry_content_top();
									the_excerpt();
									$excerpt = ob_get_clean();
										echo wp_kses_post( $excerpt );
									?>
										<div class="lsx-to-widget-meta-data">
											<?php
											$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

											lsx_to_price( '<span class="' . $meta_class . 'price"><span class="lsx-to-meta-data-key">' . esc_html__( 'from', 'tour-operator' ) . ':</span> ', '</span>' );
											lsx_to_duration( '<span class="' . $meta_class . 'duration"><span class="lsx-to-meta-data-key">' . esc_html__( 'Duration', 'tour-operator' ) . ':</span> ', '</span>' );
											lsx_to_connected_countries( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Destinations', 'tour-operator' ) . ':</span> ', '</span>' );

											if ( function_exists( 'lsx_to_connected_activities' ) ) {
												lsx_to_connected_activities( '<span class="' . $meta_class . 'activities"><span class="lsx-to-meta-data-key">' . esc_html__( 'Activities', 'tour-operator' ) . ':</span> ', '</span>' );
											}
											?>
											<p class="moretag-wrapper tourslink"><a href="<?php the_permalink() ?>" class="moretag"><?php esc_html_e( 'VIEW TRIP', 'tour-operator' ); ?></a></p>
										</div>



									<?php lsx_widget_entry_content_bottom(); ?>
								</div>

								<?php lsx_widget_entry_bottom(); ?>

							</article>
						</div>


					<?php endwhile; ?>
				</div>
				</div>
				</div>
			</div>
		</div>
	</div>

					<div class="row lsx-to-archive-items lsx-to-archive-template-<?php echo esc_attr( tour_operator()->archive_layout ); ?> lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?>">
						<div class="safari-styles desinations-landing-style">

							<?php
							$term = get_queried_object();
							$the_query = new WP_Query( array(
					    'post_type' => 'destination',
					    'tax_query' => array(
					        array (
					            'taxonomy' => 'travel-style',
					            'field' => 'slug',
					            'terms' => $term,
					        	)
					    	),
						) );

						while ( $the_query->have_posts() ) :
					    $the_query->the_post();?>

							<div class="lsx-to-widget-item-wrap col-xs-12 col-sm-3 lsx-travel-style destinations-archive lsx-to-archive-item">
								<div class="lsx-to-widget-thumb">

									<a href="<?php the_permalink() ?>">
										<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>

									</a>
								</div>

								<div class="lsx-to-widget-content">
									<h4 class="lsx-to-widget-title text-center">

										<a href="<?php the_permalink() ?>">
											<?php the_title(); ?>
										</a>
									</h4>


									<?php
									ob_start();
									lsx_to_widget_entry_content_top();
									the_excerpt();
									lsx_to_widget_entry_content_bottom();
									$excerpt = ob_get_clean();
									echo wp_kses_post( $excerpt );?>
									<p class="moretag-wrapper"><a href="<?php the_permalink() ?>" class="moretag"><?php esc_html_e( 'View more', 'tour-operator' ); ?></a></p>
								</div></div>

							<?php endwhile; ?>
							<?php	wp_reset_query(); ?>
						</div></div>
					</div>

					<?php else : ?>
						<?php get_template_part( 'partials/content', 'none' ); ?>
					<?php endif; ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>

<?php
get_footer();
