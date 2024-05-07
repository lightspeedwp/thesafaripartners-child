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
									<?php tsp_to_tour_single_fast_facts(); ?>

									<div class="row">
									<h4 class="lovetrip">Love this trip?</h4>
									<div class="col-md-6 dropdown-share">
				<button class="btn lsx-btn lsx-share-initiated">Share with a Friend</button>
				<div class="dropdown-content">
											<?php
						if ( class_exists( 'LSX_Sharing' ) ) {
						lsx_content_sharing();
						} else {
						if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
						}
						}
						?>
				</div>
					</div>
									<div class="col-md-6">
				<button class="btn lsx-btn popup-inquire">Book It!</button>
			</div>
</div>
<div class="tabletflex">
			<div class="row reviewssingle">
                    <?php
                    $reviews_args = array(
                        'post_type'      => 'review',
                        'posts_per_page' => 1,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'paged'          => $paged,
                    );
                    $reviews_query = new WP_Query($reviews_args);

                    if ($reviews_query->have_posts()) : 
                        while ($reviews_query->have_posts()) : $reviews_query->the_post();
                    ?>
                     
					 <h4 class="lovetrip">See Tour Reviews</h4>
                            <blockquote class="lsx-to-widget-blockquote">
                            <?php $reviewer_name = get_post_meta( get_the_ID(), 'reviewer_name', true ); ?>
                            <?php $date_of_visit_start = get_post_meta( get_the_ID(), 'date_of_visit_start', true ); ?>
				

                                <h5 class="lsx-to-summary-title extra"><?php the_title(); ?></h5>
                                
                                <div class="lsx-review-summary">
                                    <?php echo wp_trim_words(get_the_content(), 26, '...'); ?>
                                </div>
                                <div class="lsx-review-full" style="display: none;">
                                    <?php the_content(); ?>
                                </div>
                                <a class="lsx-review-read-more">Read More</a>
								<div class="rating-span"><?php

						lsx_to_review_rating( '<span>Rating:</span><span class="' . $meta_class . 'rating"> </span>' );
?></div>
								<p class="lsx-review-author"><?php echo esc_html( $reviewer_name ); ?></p>

                                
                            </blockquote>
                    

                    <?php
                        endwhile; ?>

                        <?php

wp_reset_postdata();
else :
echo '<p>No reviews found.</p>';
endif;

?></div>
			

									<div class="related-tours-wrapper">
										<h4>You may also like:</h4>
										<?php
										$connected_tours = get_post_meta( get_the_ID(), 'related_tours', true );
										if ( empty( $connected_tours ) ) {
											$connected_tours = 'travel-style';
										}
										global $columns;
										$columns = 2;
										tsp_related_items( $connected_tours, '', '' , true, 'tour' );
										?>
									</div>
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
						<script>
document.addEventListener('DOMContentLoaded', function () {
    var readMoreButtons = document.querySelectorAll('.lsx-review-read-more');

    readMoreButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var parentArticle = this.closest('article');
            var fullReview = parentArticle.querySelector('.lsx-review-full');
            var summary = parentArticle.querySelector('.lsx-review-summary');

            // Toggle visibility
            fullReview.style.display = fullReview.style.display === 'none' ? '' : 'none';
            summary.style.display = summary.style.display === 'none' ? '' : 'none';

            // Toggle button text
            this.textContent = this.textContent === 'Read More' ? 'Read Less' : 'Read More';
        });
    });
});
</script>