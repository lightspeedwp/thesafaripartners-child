<?php
/**
 * LSX Starter Child functions
 *
 * @package thesafaripartners-child
 */

define( 'TSP_CHILD_VER', '1.0' );

require get_stylesheet_directory() . '/classes/class-core.php';
$theme_instance = \tsp_child\classes\Core::get_instance();

function prefix_conditional_body_class( $classes ) {
    if( is_page_template('template-travel-style.php') )
        $classes[] = 'archive';

    return $classes;
}
add_filter( 'body_class', 'prefix_conditional_body_class' );

if ( apply_filters( 'lsx_to_page_navigation_disable', false, get_post_type() ) ) {
		return false;
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


/**
* Outputs the destinations attached tours
*
* @package     tour-operator
* @subpackage  template-tags
* @category    destination
*/
function lsx_to_destination_tours_tsp() {
global $lsx_to_archive, $wp_query;

if ( post_type_exists( 'tour' ) && is_singular( 'destination' ) ) {
	$args = array(
		'from'      => 'tour',
		'to'        => 'destination',
		'column'    => '4',
		'before'    => '<section id="tours" class="lsx-to-section toptours-posts' . lsx_to_collapsible_class() . '"><h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title left" ' . lsx_to_collapsible_attributes( 'collapse-tours' ) . '>' . lsx_to_get_post_type_section_title( 'tour', '', esc_html__( 'Featured Tours', 'tour-operator' ) ) . '</h2><div id="collapse-tours" class="collapse in"><div class="collapse-inner">',
		'after'     => '</div></div></section>',
	);

	lsx_to_connected_panel_query( $args );
}
}

function remove_post_type_from_wp_sitemap( $post_types ) {
	unset( $post_types['accommodation,facilities,brands'] ); // Change page to any post type name
	return $post_types;
}

add_filter( 'wp_sitemaps_post_types', 'remove_post_type_from_wp_sitemap' );

add_filter('body_class','alter_search_classes');
function alter_search_classes($classes) {
    if(is_search()){
       return array('search search-results lsx-body-list-layout');
    } else {
       return $classes;
    }

}