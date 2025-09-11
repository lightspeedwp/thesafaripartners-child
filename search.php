<?php
/**
 * Template Name: Search Results
 * 
 * The main template file.
 *
 * @package lsx
 */

add_action( 'body_class', 'tsp_search_page_classes' );
// get search term from fwp_search param
$fwp_search = isset( $_GET['fwp_search'] ) ? sanitize_text_field( $_GET['fwp_search'] ) : '';
if($fwp_search){
    $fwp_search = '"'.$fwp_search.'"';
}
get_header(); ?>

<?php lsx_content_wrap_before(); ?>


<div id="primary" class="content-area search-wizard-results <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>
    <div class="search-header">
        <div class="search-header-title"><?php echo esc_html__( 'Search Results', 'thesafaripartners-child' ); ?></div>
        <div class="search-header-term" id="search-header-term"><?php echo esc_html( $fwp_search ); ?></div>
        <?php echo do_shortcode( '[facetwp facet="search"]' ); ?>
        <?php echo do_shortcode( '[facetwp selections="true"]' ); ?>
    </div>
	<main id="main" class="site-main search-main" role="main">
        
		<?php lsx_content_top(); ?>
        <div class="search-sidebar">
            <button id="hide-search-filters" class="hide-search-filters">X</button>
            <h2>Filters</h2>
		    <?php if ( have_posts() ) { ?>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'filter-menu',
					)
				);

                echo do_shortcode( '[facetwp facet="reset"]' );
			?>
            <button id="apply-search-filters" class="apply-search-filters">Apply Filters</button>
        </div>
        <div class="search-content">
            <div class="search-widget-header">
                <div class="search-widget-results">
                    <button id="show-search-filters" class="show-search-filters"><?php esc_html_e( 'Filters', 'thesafaripartners-child' ); ?></button>
                    <?php echo do_shortcode( '[facetwp facet="results_count"]' ); ?>
                </div>
                <div class="search-widget-sort">
                    <?php echo do_shortcode( '[facetwp facet="sort_"]' ); ?>
                </div>
            </div>

            <div class="post-wrapper facetwp-template <?php echo esc_attr( lsx_post_wrapper_class() ); ?>">
                <?php
                global $wp_query, $post, $relevance_scores;
                while ( have_posts() ) {
                    the_post();
                    get_template_part('partials/content', 'search');
                }
                
                ?>
            </div>

            <div class="tsp-pagination">
                <?php echo do_shortcode( '[facetwp facet="pagination"]' ); ?>
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
