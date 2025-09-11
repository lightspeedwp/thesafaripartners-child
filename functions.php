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

add_action( 'lsx_banner_inner_top', function() {
    if ( is_singular( 'tour' ) ) {
        // Get the banner image URL using the same filter as the main banner
        $banner_image = apply_filters( 'lsx_banner_image', false );
        if ( ! empty( $banner_image ) ) {
            echo '<div class="page-banner-image banner-blur" style="background-image:url(' . esc_url( $banner_image ) . ');"></div>';
        }
    }
});

add_filter( 'facetwp_is_main_query', function( $is_main_query, $query ) {
    // Identify your custom query, e.g. by checking a variable or query args
    if ( isset( $query->query_vars['facetwp'] ) && $query->query_vars['facetwp'] ) {
        $is_main_query = true;
    }
    return $is_main_query;
}, 10, 2 );

add_filter( 'facetwp_query_args', function( $search_args, $params ) {
    $search_args['posts_per_page'] = 6; // Default: 200. Set to -1 to show all search results.
    return $search_args;
  }, 10, 2 );