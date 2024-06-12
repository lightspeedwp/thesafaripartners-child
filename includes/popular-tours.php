<?php

/**
 * Adding in the popular tour shortcode
 *
 * @param string $content
 * @return string
 */
function tsp_popular_tours_shortcode( $args = array(), $content = '' ) {
	if ( class_exists( '\WordPressPopularPosts\Query' ) ) {
		$popular_posts = new \WordPressPopularPosts\Query([
			//'range' => 'last7days',
			'post_type' => 'tour',
			'order_by' => 'views',
			'limit' => 20
		]);

		$post_ids = wp_list_pluck( $popular_posts->get_posts(), 'id' );

		$atts = array(
			'post_type' => 'tour',
			'columns' => 4,
			'limit' => 20,
			'disable_placeholder' => 0,
			'disable_text' => 0,
			'order' => 'DESC',
			'orderby' => 'post__in',
			'carousel' => 1,
			'include' => implode( ',', $post_ids ),
		);
		$content = '<div class="wp-block-tour-operator-block-post-types toptours-posts"><div class="lsx-testimonial-body">' . lsx_to_post_type_widget_shortcode( $atts ) . '</div></div>';
	}
	return $content;
}
add_shortcode( 'tsp_popular_tours', 'tsp_popular_tours_shortcode' );
