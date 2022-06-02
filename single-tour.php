<?php
/**
 * Tour Single Template
 *
 * @package     tour-operator
 * @category    tour
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area wizard-landing col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

					<div id="collapse-summary" class="collapse in">
						<div class="collapse-inner">
							<div class="row">


								<div class="col-md-12 outer-container">
									<div class="tab">

												<button class="tablinks" id="Open" onclick="openCity(event, 'Overview')">Overview</button>
												<button class="tablinks" id="page-1" onclick="openCity(event, 'Day')">Day by Day</button>
												<button class="tablinks" id="page-3" onclick="openCity(event, 'Accommodation')">Accommodation</button>
										</div>
									</div>

												<div id="Overview" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-tour-module">
															<?php if ( have_posts() ) : ?>

																<?php
																while ( have_posts() ) :
																	the_post();
																?>

																<?php lsx_entry_before(); ?>
																<div class="col-md-6 lsx-tour-module-image">
																	<div class="lsx-banner-image-wrap">
																		<picture>
																			<?php echo get_the_post_thumbnail($page->ID,'full'); ?>
																			<picture>
																			</div>

																		</div>


																<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
																	<?php lsx_entry_top(); ?>


																		<div class="entry-content col-xs-12 col-sm-12 col-md-6">
																			<div class="lsx-to-summary">
																				<h2 class="lsx-to-summary-title"><?php the_title(); ?></h2>

																			</div>

																			<?php lsx_to_price( '<p class="lsx-to-meta-data lsx-to-meta-data-big lsx-to-meta-data-price"><span class="lsx-to-meta-data-key">' . esc_html__( 'From price', 'tour-operator' ) . ':</span> ', '</p>' ); ?>
																			<?php the_content(); ?>

																		</div>

																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>
												</div>


												<div id="Day" class="tabcontent">
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


																		<div class="entry-content col-xs-12 col-sm-12 col-md-12">

																		<div class="itenary">
																		<?php 	if ( lsx_to_has_itinerary() ) {
			$itinerary_count = 1;
			?>
			<section id="itinerary" class="lsx-to-section <?php lsx_to_collapsible_class( 'tour', false ); ?>">

				<div id="collapse-itinerary" class="collapse in">
					<div class="collapse-inner">
						<div class="row lsx-to-archive-items lsx-to-archive-template-list lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?> itinerary-list">
							<?php while ( lsx_to_itinerary_loop() ) { ?>
								<?php
									lsx_to_itinerary_loop_item();
									$thumb = lsx_to_itinerary_thumbnail();
								?>

								<div id="day-<?php echo esc_attr( $itinerary_count ); ?>" <?php lsx_to_itinerary_class( 'lsx-to-archive-item itinerary-item col-xs-12' ); ?>>
									<div class="lsx-to-archive-container">
										<div class="lsx-to-archive-thumb">
											<div class="lsx-to-thumb-slot" style="background-image: url('<?php echo esc_url( $thumb ); ?>');">
												<?php echo wp_kses_post( '<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="' . $thumb . '">' ); ?>
											</div>
										</div>

										<div class="lsx-to-archive-wrapper">
											<div class="lsx-to-archive-content">
												<h3 class="lsx-to-archive-content-title"><?php lsx_to_itinerary_title(); ?></h3>
												<p class="lsx-to-archive-content-tagline"><?php lsx_to_itinerary_tagline(); ?></p>

												<div class="entry-content">
													<?php lsx_to_itinerary_description(); ?>
												</div>
											</div>

											<div class="lsx-to-archive-meta-data">
												<?php
													$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

													lsx_to_itinerary_destinations( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Destination', 'tour-operator' ) . ':</span> ', '</span>' );
													lsx_to_itinerary_accommodation( '<span class="' . $meta_class . 'accommodations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Accommodation', 'tour-operator' ) . ':</span> ', '</span>' );
													lsx_to_itinerary_activities( '<span class="' . $meta_class . 'activities"><span class="lsx-to-meta-data-key">' . esc_html__( 'Activities', 'tour-operator' ) . ':</span> ', '</span>' );
													lsx_to_itinerary_includes( '<span class="' . $meta_class . 'day-includes"><span class="lsx-to-meta-data-key">' . esc_html__( 'Included', 'tour-operator' ) . ':</span> ', '</span>' );
													lsx_to_itinerary_excludes( '<span class="' . $meta_class . 'day-excludes"><span class="lsx-to-meta-data-key">' . esc_html__( 'Excluded', 'tour-operator' ) . ':</span> ', '</span>' );
												?>
											</div>
										</div>
									</div>
								</div>
								<?php
								$itinerary_count++;
							}
							?>
						</div>
					</div>
				</div>

				<?php lsx_to_itinerary_read_more(); ?>
			</section>

		<?php } ?>
																		</div>
																		</div>



																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>
												</div>


												<div id="Accommodation" class="tabcontent">
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


																		<div class="entry-content col-xs-12 col-sm-12 col-md-12">
																			<div class="lsx-to-summary">
																				<h2 class="lsx-to-summary-title">Accommodation</h2>

																			</div>

																			<?php lsx_to_price( '<p class="lsx-to-meta-data lsx-to-meta-data-big lsx-to-meta-data-price"><span class="lsx-to-meta-data-key">' . esc_html__( 'From price', 'tour-operator' ) . ':</span> ', '</p>' ); ?>
																			<?php the_content(); ?>
																			<?php lsx_to_sharing(); ?>
																		</div>



																	<?php lsx_entry_bottom(); ?>

																</article>

																<?php
																lsx_entry_after(); ?>

																<?php endwhile; ?>

															<?php endif; ?>
															<?php	wp_reset_query(); ?>
													</div>
												</div>
												</div>

												<div class="tours-nav">
													<div class="col-md-4">
														<button class="btn lsx-btn">Book It!</button>
														</div>
														<div class="col-md-4">
															<button class="btn lsx-btn">Find out more</button>
															</div>
															<div class="col-md-4">
																<button class="btn lsx-btn">Share with a Friend</button>
																</div>
												</div>

</div></div></div>
			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php //get_sidebar(); ?>
<?php //get_sidebar( 'alt' ); ?>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("Open").click();
</script>
<?php
get_footer();
