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
    $search_args['posts_per_page'] = 12;
    return $search_args;
  }, 10, 2 );

add_filter( 'facetwp_shortcode_html', function( $output, $atts ) {
    if ( isset( $atts['template'] ) && 'travel_types' === $atts['template'] ) {
        // Add .post-wrapper to the topmost div, preserving existing classes and attributes
        $output = preg_replace(
            '/<div([^>]*)class="([^"]*)facetwp-template([^"]*)"([^>]*)>/',
            '<div$1class="post-wrapper $2facetwp-template$3"$4>',
            $output,
            1 // Only replace the first/topmost div
        );
    }
    return $output;
}, 10, 2 );

add_filter( 'facetwp_facet_render_args', 'tsp_sort_when_facet_chronologically' );
function tsp_sort_when_facet_chronologically( $args ) {
    // Only apply to the 'when' facet
    if ( 'when' === $args['facet']['name'] ) {
        if ( ! empty( $args['values'] ) ) {
            // Define month order for sorting
            $month_order = array(
                'january' => 1,
                'february' => 2,
                'march' => 3,
                'april' => 4,
                'may' => 5,
                'june' => 6,
                'july' => 7,
                'august' => 8,
                'september' => 9,
                'october' => 10,
                'november' => 11,
                'december' => 12
            );
            
            // Sort the values array by month order
            usort( $args['values'], function( $a, $b ) use ( $month_order ) {
                $month_a = strtolower( $a['facet_value'] );
                $month_b = strtolower( $b['facet_value'] );
                
                $order_a = isset( $month_order[ $month_a ] ) ? $month_order[ $month_a ] : 999;
                $order_b = isset( $month_order[ $month_b ] ) ? $month_order[ $month_b ] : 999;
                
                return $order_a - $order_b;
            });
        }
    }
    
    return $args;
}

if ( ! function_exists( 'tsp_map' ) ) {
	/**
	 * Outputs the current post type map.
	 *
	 * @param string  $before
	 * @param string  $after
	 * @param boolean $echo
	 * @return void
	 */
	function tsp_map( $before = '', $after = '', $echo = true ) {
		global $wp_query, $post;
		$location = get_transient( get_the_ID() . '_location' );
		
		if ( false !== $location ) {
			$map = '';
			$map_override = apply_filters( 'lsx_to_map_override', false );
			if ( false === $map_override ) {
				$zoom = 15;
				if ( is_array( $location ) && isset( $location['zoom'] ) ) {
					$zoom = $location['zoom'];
				}

				$zoom = apply_filters( 'lsx_to_map_zoom', $zoom );
				$map_type = 'default';
				$parent_id = false;
				$connections = false;

				$args = array(
                    'zoom' => $zoom,
                    'width' => '100%',
                    'height' => '500px',
                    'type' => 'route',
                );

                if ( isset( $location['kml'] ) ) {
                    $args['kml'] = $location['kml'];
                } elseif ( isset( $location['connections'] ) ) {
                    // Check if we have duplicate accommodations (train tours)
                    $unique_connections = array_unique( $location['connections'] );
                    // If we only have one unique accommodation or all are the same
                    if ( count( $unique_connections ) <= 1 ) {
                        // Get itinerary locations instead
                        $itinerary_connections = tsp_get_itinerary_locations( get_the_ID() );
                        if ( ! empty( $itinerary_connections ) ) {
                            $args['connections'] = $itinerary_connections;
                        } else {
                            $args['connections'] = $location['connections'];
                        }
                    } else {
                        $args['connections'] = $location['connections'];
                    }
                }

				$args = apply_filters( 'lsx_to_maps_args', $args, get_the_ID() );
				$map  = tour_operator()->frontend->maps->map_output( get_the_ID(), $args );
			} else {
				$map = $map_override;
			}

			// @codingStandardsIgnoreLine
			echo $map;
		}
	}
}

/**
 * Get locations from tour itinerary days for mapping
 *
 * @return array Array of destination IDs from itinerary days
 */
function tsp_get_itinerary_locations() {
    global $tour_itinerary;
    $connections = array();

    if ( ! empty( $tour_itinerary->itineraries ) && is_array( $tour_itinerary->itineraries ) ) {
        foreach ( $tour_itinerary->itineraries as $day ) {
            // Check for destination connection in the day
            if ( isset( $day['destination_to_tour'] ) && ! empty( $day['destination_to_tour'] ) ) {
                
                if ( is_array( $day['destination_to_tour'] ) ) {
                    // Handle CMB2 field structure (e.g., ['cmb-field-0' => '136260'])
                    foreach ( $day['destination_to_tour'] as $key => $value ) {
                        if ( strpos( $key, 'cmb-field-' ) === 0 && ! empty( $value ) ) {
                            $connections[] = $value;
                        } elseif ( is_numeric( $value ) ) {
                            // Handle direct numeric values in array
                            $connections[] = $value;
                        }
                    }
                } else {
                    // Handle direct value (string or number)
                    $connections[] = $day['destination_to_tour'];
                }
            }
        }
    }
    
    // Remove duplicates and return unique destination IDs
    return array_unique( array_filter( $connections ) );
}
