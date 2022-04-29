<?php
/**
 * LSX Starter Child functions
 *
 * @package tsp-child
 */

require get_stylesheet_directory() . '/classes/class-core.php';
$theme_instance = \tsp_child\classes\Core::get_instance();

function lsx_to_page_navigation( $echo = false ) {
	$page_links = array();

	if ( is_single() ) {
		$page_links['summary'] = esc_html__( 'Summary', 'tour-operator' );
	}

	// Allow 3rd party plugins and themes to disable the page links.
	if ( apply_filters( 'lsx_to_page_navigation_disable', true, get_post_type() ) ) {
		return true;
	}

	$page_links = apply_filters( 'lsx_to_page_navigation', $page_links );

	if ( ! empty( $page_links ) && count( $page_links ) > 1 ) {
		$return  = '<div class="lsx-to-navigation col-xs-12 ' . get_post_type() . '-navigation visible-lg-block">';
		$return .= '<ul class="scroll-easing nav lsx-to-content-spy">';

		if ( ! empty( $page_links ) ) {
			foreach ( $page_links as $link_slug => $link_value ) {
				$return .= '<li><a href="#' . esc_html( $link_slug ) . '">' . $link_value . '</a></li>';
			}
		}

		$return .= '</ul>';
		$return .= '</div>';

		if ( $echo ) {
			echo wp_kses_post( $return );
		} else {
			return $return;
		}
	}
}


/**
 * Register our sidebars and widgetized areas.
 */
function arphabet_widgets_init() {

	register_sidebar(
		array(
			'name'          => 'Footer Subscribe',
			'id'            => 'footer_sub',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

function home_widgets_init() {

	register_sidebar(
		array(
			'name'          => 'Home Why',
			'id'            => 'why-us',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'home_widgets_init' );
