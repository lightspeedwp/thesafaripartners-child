<?php
/**
 * Destination Single Template
 *
 * @package     tour-operator
 * @category    destination
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<section id="summary" class="lsx-to-section-new <?php lsx_to_collapsible_class( 'destination', false ); ?>">
					<h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title hidden-lg" <?php lsx_to_collapsible_attributes_not_post( 'collapse-summary' ); ?>><?php esc_html_e( 'Summary', 'tour-operator' ); ?></h2>

					<div id="collapse-summary" class="collapse in">
						<div class="collapse-inner">
							<div class="row">
								<?php lsx_to_content( 'content', 'destination' ); ?>
							</div>
						</div>
					</div>
				</section>


			<?php endwhile; ?>

		<section id="who-single" class="lsx-to-section-new">
			<div class="row">
			<div class="wp-block-tour-operator-block-taxonomy who-slide who-image-display">
				<h2 class="lsx-title left">Tell us what type of traveler are you?</h2>
				<div id="myBtnContainer">
  <button style="display:none;" class="btn-check active" onclick="filterSelection('all')"> Show all</button>
						<?php
						$terms = get_terms('who');
						$post_tags = wp_get_post_terms($post->ID,'who',array('fields' => 'slugs'));
				?>
			<?php foreach( $terms as $term ): ?>
								<!-- post -->

						<div class="lsx-to-widget-item-wrap lsx-who col-xs-12 col-sm-2 term-<?php echo esc_attr( $term->slug ); ?> <?php echo esc_attr( $taxonomy ); ?> type-<?php echo esc_attr( $taxonomy ); ?> status-publish hentry">
									<div class="checkbox-wrapper">
										<input class="btn-check"  type="checkbox" onclick="filterSelection('who-<?php echo esc_html( apply_filters( 'the_title', $term->slug ) ); ?>')" />
										<span aria-hidden="true"></span>
									</div>

						<?php lsx_to_content( 'content-widget', 'who' ); ?>
					</div>
			<?php endforeach; ?>

					</div></div></div>
			</section>

			<?php lsx_content_bottom(); ?>

			<div class="row travel-style-destinations">
						<div class="wp-block-tour-operator-block-post-types tours-posts lsx-to-archive-template-<?php echo esc_attr( tour_operator()->archive_layout ); ?> lsx-to-archive-template-image-<?php echo esc_attr( tour_operator()->archive_list_layout_image_style ); ?>">
							<div class="slider-container lsx-to-widget-items lsx-to-archive-template-grid">
								<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
									<div class="lsx-to-slider-wrap">
										<div class="lsx-to-slider-inner" data-slick='{ "slidesToShow": 2, "slidesToScroll": 2 }'>

						<?php
				    $terms = get_terms('travel-style');
				    $post_tags = wp_get_post_terms($post->ID,'travel-style',array('fields' => 'slugs'));
				?>
			<?php foreach( $terms as $term ): ?>
						    <!-- post -->

						<article class="term-<?php echo esc_attr( $term->term_id ); ?> <?php echo esc_attr( $taxonomy ); ?> type-<?php echo esc_attr( $taxonomy ); ?> status-publish hentry">
									<div class="checkbox-wrapper">
	    							<input class="btn-check"  type="checkbox" onclick="filterSelection('who-<?php echo esc_html( apply_filters( 'the_title', $term->slug ) ); ?>')" />
    								<span aria-hidden="true"></span>
									</div>

								<?php if ( lsx_to_has_term_thumbnail( $term->term_id ) ) : ?>
									<div class="lsx-to-widget-thumb">
										<?php
										if ( ! empty( $title_link ) ) {
											?>
						<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
											<?php lsx_to_term_thumbnail( $term->term_id, 'lsx-thumbnail' ); ?>

										<?php
										if ( ! empty( $title_link ) ) {
											?>
						</a><?php } ?>
									</div>
								<?php else : ?>
									<div class="lsx-to-widget-thumb">
										<?php
										if ( ! empty( $title_link ) ) {
											?>
						<a href="<?php echo esc_url( $title_link ); ?>"><?php } ?>
											<img alt="Placeholder" class="attachment-responsive wp-post-image lsx-responsive" src="<?php echo esc_url( lsx\legacy\Placeholders::placeholder_url( null, null, array( 750, 350 ) ) ); ?>">
										<?php
										if ( ! empty( $title_link ) ) {
											?>
						</a><?php } ?>
									</div>
								<?php endif; ?>


							<div class="lsx-to-widget-content bottom">
								<h4 class="lsx-to-widget-title text-left">

						<a href="<?php echo esc_url( $title_link ); ?>">
										<?php echo esc_html( apply_filters( 'the_title', $term->name ) ); ?>

						</a>
						</h4>

							</div>
						</article>
			<?php endforeach; ?>

					<?php	wp_reset_query(); ?>
				</div>
				</div>
			</div>
			</div>
			</div>
			</div>

							<section id="wizard-template" class="lsx-to-section-new">
								<div class="row">
								<?php	$id=134126;
	$post = get_post($id);
	$content = apply_filters('the_content', $post->post_content);
	echo $content; ?>
							</section>
		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php // get_sidebar(); ?>
<?php // get_sidebar( 'alt' ); ?>
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
