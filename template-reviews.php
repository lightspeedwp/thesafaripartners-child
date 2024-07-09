<?php
/**
 * Template Name: Reviews
 * @package lsx
 */

get_header();

// Correctly calculate the 'paged' parameter
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

?>

    <?php lsx_content_wrap_before(); ?>

    <div id="primary" class="content-area col-sm-12 <?php echo esc_attr(lsx_main_class()); ?>">

        <?php lsx_content_before(); ?>

        <main id="main" class="site-main" role="main">

            <?php lsx_content_top(); ?>

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'partials/content', 'page' ); ?>

            <?php endwhile; endif; ?>
            <?php wp_reset_query(); ?>

            <div class="entry-reviews">
                <div class="row">
                    <?php
                    $reviews_args = array(
                        'post_type'      => 'review',
                        'posts_per_page' => 10,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'paged'          => $paged,
                    );
                    $reviews_query = new WP_Query($reviews_args);

                    if ($reviews_query->have_posts()) : 
                        while ($reviews_query->have_posts()) : $reviews_query->the_post();
                    ?>

                            <article <?php post_class(); ?>>
                            <div class="lsx-to-widget-thumb">
                                <?php lsx_thumbnail('lsx-thumbnail-wide'); ?>
                            </div>

                           

                            <blockquote class="lsx-to-widget-blockquote col-sm-6 col-md-6">
                            <?php $reviewer_name = get_post_meta( get_the_ID(), 'reviewer_name', true ); ?>
                            <?php $date_of_visit_start = get_post_meta( get_the_ID(), 'date_of_visit_start', true ); ?>
				<p class="lsx-review-author">By <?php echo esc_html( $reviewer_name ); ?><br/>On <?php echo get_the_date(); ?></p>

                                <h4 class="lsx-to-summary-title extra"><?php the_title(); ?></h4>
                                <div class="rating-span"><?php

						lsx_to_review_rating( '<span>Rating:</span><span class="' . $meta_class . 'rating"> </span>' );
?></div>
                                <div class="lsx-review-summary">
                                    <?php echo wp_trim_words(get_the_content(), 80, '...'); ?>
                                </div>
                                <div class="lsx-review-full" style="display: none;">
                                    <?php the_content(); ?>
                                </div>
                                <a class="lsx-review-read-more">Read More</a>

                                
        <p class="lsx-review-date">Trip date: <?php echo esc_html( $date_of_visit_start ); ?> 
        <?php 
ob_start();
lsx_to_connected_tours('<span class="tours-link"><span class="lsx-to-meta-data-key">' . __('Tours', 'to-reviews') . ':</span> ', '</span>');
$tours_output = ob_get_clean();
// Replacing only the first occurrence of the link text with "View Tour"
$tours_output = preg_replace('/<a href="([^"]+)">.*?<\/a>/', '<a href="$1">View Tour</a>', $tours_output, 1);
echo $tours_output;
?></p>

                            </blockquote>
                            </article>

                    <?php
                        endwhile; ?>

<div class="pagination"><?php   // Pagination
                        echo paginate_links(array(
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $reviews_query->max_num_pages,
                            'prev_text'    => __('« Prev'),
                            'next_text'    => __('Next »'),
                        ));

                        // Featured Tours Section
                        ?> 
                        <?php

wp_reset_postdata();
else :
echo '<p>No reviews found.</p>';
endif;

?></div>


                        <div class="wp-block-tour-operator-block-post-types toptours-posts">
                            <h2 class="lsx-title"><small></small></h2>
                            <div class="lsx-testimonial-body">
                            <?php  echo do_shortcode( '[lsx_to_post_type_widget post_type="tour" columns="4" limit="20" disable_placeholder="0" disable_text="0" order="ASC" orderby="none" carousel="1" include=""]' )?>
                            </div>
                        
                        
                          


                </div>
            </div>
        </main><!-- #main -->

        <?php lsx_content_after(); ?>

    </div><!-- #primary -->

    <?php lsx_content_wrap_after(); ?>

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

<?php get_footer(); ?>
