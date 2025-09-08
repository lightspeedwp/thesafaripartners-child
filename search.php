<?php
/**
 * Template Name: Search Results
 * 
 * The main template file.
 *
 * @package lsx
 */

add_action( 'body_class', 'tsp_search_page_classes' );

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area search-wizard-results <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main search-main" role="main">

		<?php lsx_content_top(); ?>
        <div class="search-sidebar">
            <h2>Filters</h2>
		<?php

			$search_query_args = array(
				'post_type'     => 'tour',
				'post_status'   => 'publish',
				'posts_per_page' => -1,
				'facetwp'       => true,
			);


//			// Handle search query
			if ( isset( $_GET['fwp_search'] ) && !empty( $_GET['fwp_search'] ) ) {
				$search_query_args['s'] = $_GET['fwp_search'];
			}

			$search_query = new WP_Query( $search_query_args );

			if ( $search_query->have_posts() ) { ?>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'filter-menu',
					)
				);
			?>
        </div>
        <div class="search-content">
            <div class="search-header">
                <div class="col-md-6">
                    <?php echo do_shortcode( '[facetwp facet="results_count"]' ); ?>
                </div>
                <div class="col-md-6">
                    <?php echo do_shortcode( '[facetwp facet="sort_"]' ); ?>
                    <?php echo do_shortcode( '[facetwp selections="true"]' ); ?>
                </div>

            </div>

            <div class="post-wrapper facetwp-template <?php echo esc_attr( lsx_post_wrapper_class() ); ?>">
                <?php
                global $wp_query, $post, $relevance_scores;

                if ( isset( $relevance_scores ) && ! empty( $relevance_scores ) ) {
                    $temp_post = $post;

                    if ( ! isset( $_GET['fwp_search'] ) ) {
                        foreach ( $relevance_scores as $search_item => $score ) {
                            preg_match_all('/[0-9]+/', $score, $matches);
                            $score = 0;
                            if ( isset( $matches[0] ) ) {
                                $relevance_scores[ $search_item ] = (int) implode( '', $matches[0] );
                            }
                        }
                        arsort( $relevance_scores );
                    }


                    foreach ( $relevance_scores as $search_item => $score ) {
                        if ( 24 >= $score ) {
                            //continue;
                        }

                        $post = get_post( $search_item );
                        get_template_part('partials/content', 'search');
                    }
                    $post = $temp_post;
                } else {
                    while ( $search_query->have_posts() ) {
                        $search_query->the_post();
                        get_template_part('partials/content', 'search');
                    }
                }
                ?>
            </div>

            <div class="lsx-pagination">
                <?php echo do_shortcode( '[facetwp facet="load_more"]' ); ?>
            </div>
        </div>


		<?php } else { ?>

			<?php get_template_part( 'partials/content', 'search-none' ); ?>

		<?php } ?>

		<?php lsx_content_bottom(); ?>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php get_sidebar( 'sidebar' ); ?>

<?php
get_footer();
