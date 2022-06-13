<?php
/**
 * Template Name: Honeymoon
 *
 * @package lsx
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area bannerup <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) :
				the_post();
			?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

		<?php lsx_content_bottom(); ?>
<div id="myBtnContainer">
		<div id="wizard" class="lsx-wizard" style="display: none;">
				<div class="lsx-wizard-step">
						<h4>2. What</h4>
						<div class="step-content">
							<div class="wizard-what">
								<div class="col-md-3">
									<h2>What interests you?</h2>
									<p>Let us what interests you</p>
									</div>
									<div class="col-md-9">

											<?php
											$terms = get_terms('travel-style');
											$post_tags = wp_get_post_terms($post->ID,'travel-style',array('fields' => 'slugs'));?>
											<?php foreach( $terms as $term ): ?>
													<!-- post -->

											<article class="col-md-2 status-publish hentry">
														<div class="checkbox-wrapper">
															<input class="btn-check"  type="checkbox" onclick="filterSelection('travel-style-<?php echo esc_html( apply_filters( 'the_title', $term->slug ) ); ?>')" />
															<span aria-hidden="true"></span>
														</div>

													<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
														<div class="lsx-to-widget-thumb">
																<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-full' ); ?>
														</div>

													<?php else : ?>
														<div class="lsx-to-widget-thumb">
																<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
														</div>

													<?php endif; ?>

													<div class="lsx-to-content">
															<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>
															</div>



											</article>
										<?php endforeach; ?>

										<?php	wp_reset_query(); ?>

										</div>
									</div>
								</div>
							</div>

				<div class="lsx-wizard-step">
						<h4>3. Where</h4>
						<div class="step-content">
							<div class="wizard-where">
								<div class="col-md-12 whereintro">
									<h2>Where in Africa?</h2>
									<p>Let us where you want to travel</p>
									</div>
									<div class="col-md-12">

										<div class="safari-styles desinations-landing-style">
											<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid">
												<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
													<div class="lsx-to-slider-wrap">
														<div class="lsx-to-slider-inner" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>
											<?php
											$the_query = new WP_Query( array(
											'post_type' => 'destination',
											'post_parent' => 0,
										) );

										while ( $the_query->have_posts() ) :
											$the_query->the_post();?>


															<div class="lsx-to-widget-item-wrap col-xs-4 col-sm-3 lsx-travel-style destinations-archive lsx-to-archive-item">
																<div class="lsx-to-widget-thumb">

																	<div class="checkbox-wrapper">
																		<input class="btn-check"  type="checkbox" onclick="filterSelection('destination-<?php the_title();?>')" />
																		<span aria-hidden="true"></span>
																	</div>
																		<?php lsx_thumbnail( 'lsx-thumbnail-full' ); ?>
																</div>

																	<div class="lsx-to-content">
																			<?php the_title(); ?>
																		</div>
																	</div>

															<?php endwhile; ?>
															<?php	wp_reset_query(); ?>
															</div>
															</div>
															</div>
															</div>
															</div>


								</div>
						</div>
				</div>
				</div>

			</div>
	</div>

	<div class="tour-display col-md-12">

		<div class="toptours-posts">
			<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid">
				<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
					<div class="lsx-to-slider-wrap">
						<div class="lsx-to-slider-inner" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>
			<?php
			$the_query = new WP_Query( array(
			'post_type' => 'tour',
		) );

		while ( $the_query->have_posts() ) :
			$the_query->the_post();?>
			<?php lsx_to_content( 'content-widget', 'tour' ); ?>


							<?php endwhile; ?>
							<?php	wp_reset_query(); ?>
							</div>
							</div>
							</div>
							</div>
							</div>
						</div>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

	<?php
	if ( comments_open() ) {
		comments_template();
	}
	?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php get_sidebar(); ?>


<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current control button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn-check");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
<?php
get_footer();
