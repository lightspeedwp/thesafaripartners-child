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
								<div class="col-md-6 lsx-contact-module-image">
									<div class="lsx-banner-image-wrap">
										<picture>
											<?php echo get_the_post_thumbnail($page->ID,'full'); ?>
											<picture>
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
										</div>

								<div class="col-md-6 outer-container">
									<div class="tab">


												<button class="tablinks" id="page-1" onclick="openCity(event, 'Overview')">Overview</button>
												<button class="tablinks" id="page-2" onclick="openCity(event, 'day')">Day by Day</button>
												<button class="tablinks" id="page-3" onclick="openCity(event, 'page-3')">Accommodation</button>
												</div>



												<div id="Overview" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-contact-module">
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
																				<h2 class="lsx-to-summary-title"><?php the_title(); ?></h2>

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
												<div id="day" class="tabcontent">
													<div class="col-md-12 col-sm-12">
														<div class="lsx-contact-module">
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
																				<h2 class="lsx-to-summary-title">Day by Day</h2>

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
document.getElementById("Overview").click();
</script>
<?php
get_footer();
