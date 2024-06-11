<?php

/**
 * Adding in the popular tour shortcode
 *
 * @param string $content
 * @return string
 */
function tsp_popular_tours_shortcode( $content = '' ) {
	if ( class_exists( '\WordPressPopularPosts\Query' ) ) {
		$popular_posts = new \WordPressPopularPosts\Query([
			//'range' => 'last7days',
			'post_type' => 'tour',
			'order_by' => 'views',
			'limit' => 20
		]);
		if ( isset( $_GET['to_debug'] ) ) {
			var_dump( $popular_posts->get_posts() );
		}
	}
	return $content;
}
add_shortcode( 'tsp_popular_tours', 'tsp_popular_tours_shortcode' );
