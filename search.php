<?php
/**
 * Template Name: Search Results
 * 
 * The main template file.
 *
 * @package lsx
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php 
		
			$search_query_args = array(
				'post_type'     => 'tour',
				'post_status'   => 'publish',
				'post_per_page' => -1,
				'nopagin'       => 'tour',
				'orderby'       => 'post__in',
				'facetwp'       => true,
			);
			if ( isset( $_GET['fwp_search'] ) ) {
				$search_query_args['s'] = $_GET['fwp_search'];
			} else {
				$search_query_args['s'] = '';
			}
			$search_query = new WP_Query( $search_query_args );

			if ( $search_query->have_posts() && ! empty( $search_query_args['s'] ) ) { ?>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'filter-menu',
					)
				);
			?>
			<div class="search-header col-md-12">
			
			<p>Click above to change your answers and show different results.</p>
			
			<div class="col-md-6">
				<h3>The Shaman Says...</h3>
			</div>
			<div class="col-md-6">
			<div class="right-align"> <?php echo do_shortcode( '[facetwp facet="results_count"]' ); ?> </div>
				</div>
			<div class="clear"></div>
				</div>

			<div class="post-wrapper facetwp-template col-md-12 <?php echo esc_attr( lsx_post_wrapper_class() ); ?>">
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
						lsx_get_template_part();
					}
					$post = $temp_post;
				} else {	
					while ( $search_query->have_posts() ) {
						$search_query->the_post();
						lsx_get_template_part();
					}
				}
				?>
			</div>

			<div class="lsx-pagination">
				<?php echo do_shortcode( '[facetwp facet="load_more"]' ); ?>
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
