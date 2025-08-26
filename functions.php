<?php
/**
 * LSX Starter Child functions
 *
 * @package thesafaripartners-child
 */

define( 'TSP_CHILD_VER', '1.0' );

require get_stylesheet_directory() . '/classes/class-core.php';
$theme_instance = \tsp_child\classes\Core::get_instance();

function tsp_search_page_classes( $classes ) {
	$classes[] = 'lsx-body-list-layout lsx-body-grid-layout';
	return $classes;
}

function prefix_conditional_body_class( $classes ) {
	if ( is_page_template( 'template-travel-style.php' ) ) {
		$classes[] = 'archive';
	}
	if ( is_page( 'search' ) || is_page_template( 'search.php' ) ) {
		$classes[] = 'search-results';
		$classes[] = 'lsx-body-list-layout';
	}

    return $classes;
}
add_filter( 'body_class', 'prefix_conditional_body_class' );

if ( apply_filters( 'lsx_to_page_navigation_disable', false, get_post_type() ) ) {
		return false;
	}


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

add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', function () {
	return array( 138455, 133252 );
  } );

add_filter('body_class','alter_search_classes');
function alter_search_classes($classes) {
    if(is_search()){
       return array('search search-results lsx-body-list-layout');
    } else {
       return $classes;
    }

}
function tsp_replace_accommodation_meta() {
    remove_action('lsx_to_modal_meta', 'lsx_to_accommodation_meta');
    add_action('lsx_to_modal_meta', 'tsp_custom_accommodation_meta');
}
add_action('wp_loaded', 'tsp_replace_accommodation_meta');

function tsp_custom_accommodation_meta() {
    if ( 'accommodation' === get_post_type() ) {
        $meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

        tsp_custom_connected_countries_inline( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Location', 'tour-operator' ) . ':</span> ', '</span>' );
        lsx_to_accommodation_room_total( '<span class="' . $meta_class . 'rooms"><span class="lsx-to-meta-data-key">' . esc_html__( 'Rooms', 'tour-operator' ) . ':</span> ', '</span>' );
    }
}

function tsp_custom_connected_countries_inline( $before = '', $after = '' ) {
    ob_start();
    lsx_to_connected_countries( $before, $after );
    $original_output = ob_get_clean();

    // Strip all anchor tags but keep the content inside them
    $stripped_output = preg_replace('/<a[^>]*>(.*?)<\/a>/is', '$1', $original_output);

    echo $stripped_output;
}

add_action( 'wp_footer', 'childtheme_modify_lsx_modals', 9 ); // Before plugin's output_modals
add_action( 'wp_footer', 'childtheme_modify_lsx_modals_end', 11 ); // After plugin's output_modals

function childtheme_modify_lsx_modals() {
    ob_start();
}

function childtheme_modify_lsx_modals_end() {
    $output = ob_get_clean();

    // Add post type class to each modal
    $output = preg_replace_callback(
        '/(<div class="lsx-modal modal fade" id="lsx-modal-(\d+)"[^>]*>)/',
        function( $matches ) {
            $post_id = $matches[2];
            $post = get_post( $post_id );
            if ( $post && isset( $post->post_type ) ) {
                $class = ' modal-post-type-' . sanitize_html_class( $post->post_type );
                return str_replace('lsx-modal modal fade', 'lsx-modal modal fade' . $class, $matches[1]);
            }
            return $matches[1];
        },
        $output
    );

    echo $output;
}