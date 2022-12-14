<?php
/**
 * LSX Starter Child functions
 *
 * @package thesafaripartners-child
 */


function tsp_init_wizard() {
	wp_enqueue_script( 'thesafaripartners-child-wizard', get_stylesheet_directory_uri() . '/assets/js/wizard.js', array( 'jquery', 'jquery-ui-core' ), TSP_CHILD_VER, true );
	$param_array = array(
		'auth'    => 'bGlnaHRzcGVlZDpkM3ZvbnN0ckBAdDQ2',
		'homeURL' => home_url('/'),
	);
	wp_localize_script( 'thesafaripartners-child-wizard', 'tsp_wizard_params', $param_array );
}



/**
 * Calls the wizard results and the wizard js
 *
 * @param array $args
 * @param string $content
 * @return string
 */
function tsp_mini_wizard_shortcode( $args = array(), $content = '' ) {
	$defaults = array(
		'taxonomy' => '',
		'post_type' => 'tour',
		'post_status' => 'publish',
		'panels' => 'who,what,where,when,budget',
		'selected' => '',
	);
	$args   = wp_parse_args( $args, $defaults );
	$panels = explode( ',', $args['panels'] );

	$panel_args = array();
	if ( isset( $args['selected'] ) ) {
		$panel_args = array( $args['selected'] );
	}
	if ( isset( $args['title'] ) ) {
		$panel_args = array( $args['title'] );
	}
	if ( isset( $args['tagline'] ) ) {
		$panel_args = array( $args['tagline'] );
	}

	ob_start();
	tsp_mini_wizard( $panels, $args );
	tsp_mini_wizard_results( $args, $panel_args );

	$return = ob_get_clean();

	return $content . $return;
}
add_shortcode( 'mini_wizard', 'tsp_mini_wizard_shortcode' );

function tsp_mini_wizard( $panels = array(), $args = array() ) {
	if ( empty( $panels ) ) {
		return;
	}
	?>
	<form class="mini-wizard-wrapper" action="<?php echo home_url('/'); ?>" method="GET">

		<?php 
		if ( isset( $panels['intro'] ) ) {
			get_template_part( 'partials/mini-wizard', $panels['intro'] );
		}
		?>

		<div id="wizard" class="lsx-wizard mini-wizard-form" style="display: none;">
			<?php
			$counter = 0;
			foreach ( $panels as $panel_key => $panel  ) {

				if ( 'intro' === $panel_key ) {
					continue;
				}

				if ( 0 === $counter ) {
					$active = 'active';
				} else {
					$active = '';
				}
				if ( is_array( $panel ) ) {
					echo '<div class="lsx-wizard-step ' . $active . '">';
					echo wp_kses_post( '<h4>' . implode( '-', $panel ) . '</h4>' );
					foreach ( $panel as $panel_content ) {
						get_template_part( 'partials/mini-wizard', $panel_content, $args );
					}
					echo '</div>';
				} else {
					echo '<div class="lsx-wizard-step ' . $active . '">';
					echo wp_kses_post( '<h4>' . $panel . '</h4>' );
					get_template_part( 'partials/mini-wizard', $panel, $args );
					echo '</div>';
				}

				$counter++;
			}

			tsp_init_wizard();
			?>
		</div>
	</form>
	<?php
}

function tsp_mini_wizard_results( $query_args = array(), $panel_args = array() ) {
	if ( empty( $query_args ) ) {
		return;
	}

	$tours = new WP_Query( $query_args );
	if ( $tours->have_posts() ) {
		global $lsx_to_archive;
		$lsx_to_archive = 1;

		$selected = array();
		if ( ! empty( $panel_args ) && isset( $panel_args['selected'] ) && ! empty( $panel_args['selected'] ) ) {
			$selected = $panel_args['selected'];
		}

		?>
		<div class="facetwp-hidden-filters hidden">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'filter-menu',
				)
			);
			?>
		</div>
		<div class="tsp-seperator"></div>

		<div class="slider-container mini-wizard-results lsx-to-widget-items lsx-to-archive-template-grid toptours-posts" >
			<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>">
			<div class="lsx-to-slider-wrap">
				<div class="lsx-to-slider-inner slick-slider" data-interval="6000" data-slick='{ "slidesToShow": 4, "slidesToScroll": 4 }'>
					<?php
					while ( $tours->have_posts() ) {
						$tours->the_post();

						if ( ! empty( $selected ) && in_array( get_the_ID(), $selected ) ) {
							continue;
						}
						?>
						<div class="<?php echo esc_attr( lsx_to_archive_class( 'lsx-to-widget-item-wrap lsx-tour' ) ); ?>">
							<?php lsx_to_content( 'content-widget', 'tour' ); ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			</div>
		</div>

		<?php
	} else {
	get_template_part( 'partials/content', 'none' );
	} 
	wp_reset_query();
}

/**
 * Adding in afunction to call the search relevance.
 *
 * @param integer $post_id
 * @return string
 */
function tsp_get_search_relevance( $post_id = 0, $overrides = array() ) {
	global $search_relevance, $relevance_scores;
	$return          = '';
	$relevance_class = '';

	if ( ( is_search() || ! empty( $overrides ) ) && 0 !== $post_id ) {
		if ( null !== $search_relevance && isset( $search_relevance[ $post_id ] ) ) {
			switch ( $search_relevance[ $post_id ] ) {
				case $search_relevance[ $post_id ] > 80 :
					$relevance_class = 'red';
					break;
				default:
					$relevance_class = 'orange';
					break;
			}
			$return = $search_relevance[ $post_id ];
		} else if ( null !== $relevance_scores && isset( $relevance_scores[ $post_id ] ) ) {
			switch ( $relevance_scores[ $post_id ] ) {
				case $relevance_scores[ $post_id ] > 80 :
					$relevance_class = 'red';
					break;
				default:
					$relevance_class = 'orange';
					break;
			}
			$return = $relevance_scores[ $post_id ];
		} else {
			$return = tsp_facet_relevance( $post_id, $overrides );
		}
	}
	if ( '' !== $return ) {
		$return = '<span class="' . $relevance_class . '">' . $return . '%</span>';
	}
	return $return;
}

function tsp_facet_relevance( $post_id, $overrides = array() ) {
	global $search_request_vars;
	
	$request = $_REQUEST;
	if ( null !== $search_request_vars && false !== $search_request_vars && ! empty( $search_request_vars ) ) {
		$request = $search_request_vars;
	}

	if ( ! empty( $overrides ) ) {
		$request = $overrides;
	}

	$relevance = '';
	if ( isset( $request['fwp_who'] ) || isset( $request['fwp_what'] ) || isset( $request['fwp_where'] ) || isset( $request['fwp_when'] ) || isset( $request['fwp_budget'] ) ) {

		$hits  = 0;
		$total = 0;

		$taxonomies = array(
			'who'          => 'fwp_who',
			'travel-style' => 'fwp_what',
			'when'          => 'fwp_when',
			'budget'          => 'fwp_budget',
		);
		foreach ( $taxonomies as $taxonomy => $facet ) {
			if ( isset( $request[ $facet ] ) && '' !== $request[ $facet ] ) {
				$string = urldecode( $request[ $facet ] );
				$parts  = explode( ',', $string );
				if ( ! is_array( $parts ) ) {
					$parts = array( $parts );
				}
	
				foreach ( $parts as $part ) {
					if ( has_term( $part, $taxonomy, $post_id ) ) {
						$hits++;
					}
					$total++;
				}
			}
		}

		if ( 0 !== $hits ) {
			$relevance = round( ( $hits / $total ) * 100 );
		}
	}
	return $relevance;
}

/**
 * Outputs the accommodation gallery ready as a slider.
 *
 * @param integer $post_id
 * @return string
 */
function tsp_accommodation_gallery( $post_id = 0 ) {
	$return = '';
	if ( 0 !== $post_id ) {
		?>
		<div class="tour-accommodation-gallery" data-slider-id="<?php echo esc_attr( $post_id ); ?>">
			<div class="lsx-banner-image-wrap placeholder-image">
				<?php //echo get_the_post_thumbnail( $post_id, 'full' ); ?>
			</div>
			<div class="slider-content accom-slider-<?php echo esc_attr( $post_id ); ?>" style="display:none;">
				<?php
					$gallery_images = get_post_meta( $post_id, 'gallery', false );
					if ( ! empty( $gallery_images ) ) {
						$slider_content = array( '<div class="accomodation-slider lsx-to-slider-inner">' );
						//$slider_nav     = array( '<div class="accomodation-nav lsx-to-slider-inner">' );

						foreach ( $gallery_images as $gallery_image ) {
							$slider_content[] = '<div class="image-slide">' . wp_get_attachment_image( $gallery_image, 'large' ) . '</div>';
							//$slider_nav[]     = '<div class="nav-slide">' . wp_get_attachment_image( $gallery_image, 'thumbnail-wide' ) . '</div>';
						}

						$slider_content[] = '</div>';
						//$slider_nav[]     = '</div>';

						echo wp_kses_post( implode( '', $slider_content ) );
						//echo wp_kses_post( implode( '', $slider_nav ) );
					}
				?>
			</div>
		</div>
		<?php
	}
	return $return;
}

function tsp_to_tour_single_fast_facts() {
	if ( is_singular( 'tour' ) ) {
		?>
		<section style="display: none;" id="fast-facts">
			<div class="lsx-to-section-inner">
				<div class="lsx-to-single-meta-data">
					<?php
						$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';
						lsx_to_duration( '<span class="' . $meta_class . 'duration"><span class="lsx-to-meta-data-key">' . esc_html__( 'Duration', 'tour-operator' ) . ':</span> ', '</span>' );
						lsx_to_departure_point( '<span class="' . $meta_class . 'pin"><span class="lsx-to-meta-data-key">' . esc_html__( 'Departs from', 'tour-operator' ) . ':</span> ', '</span>' );
						lsx_to_connected_countries( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Destinations', 'tour-operator' ) . ':</span> ', '</span>' );
						the_terms( get_the_ID(), 'travel-style', '<span class="' . $meta_class . 'style"><span class="lsx-to-meta-data-key">' . esc_html__( 'Safari Style', 'tour-operator' ) . ':</span> ', ', ', '</span>' );
					?>
				</div>
			</div>
		</section>
	<?php 
    }
}

/**
 * Retrieves the accommodations location from its itinerary day.
 * the itinerary loop.
 *
 * @package       tour-operator
 * @subpackage    template-tags
 * @category      itinerary
 *
 * @param string $item_id
 * @param string $meta_key
 * @return array
 */
function tsp_itinerary_accommodation_locations() {
	$tour_itinerary = new \lsx\legacy\Itinerary_Query();
	
	$locations = array();
	$a_ids     = array();
	$d_ids     = array();
	if ( $tour_itinerary->has_itinerary() ) {
		while ( $tour_itinerary->while_itinerary() ) {
			$tour_itinerary->current_itinerary_item();

			if ( ! empty( $tour_itinerary->itinerary['destination_to_tour'] ) && '' !== $tour_itinerary->itinerary['destination_to_tour'] ) {				
				if ( ! is_array( $tour_itinerary->itinerary['destination_to_tour'] ) ) {
					$d_ids = array( $tour_itinerary->itinerary['destination_to_tour'] );
				} else {
					$d_ids = $tour_itinerary->itinerary['destination_to_tour'];
				}
			}

			if ( ! empty( $tour_itinerary->itinerary['accommodation_to_tour'] ) && '' !== $tour_itinerary->itinerary['accommodation_to_tour'] ) {				
				if ( ! is_array( $tour_itinerary->itinerary['accommodation_to_tour'] ) ) {
					$a_ids = array( $tour_itinerary->itinerary['accommodation_to_tour'] );
				} else {
					$a_ids = $tour_itinerary->itinerary['accommodation_to_tour'];
				}
			}

			if ( ! empty( $d_ids ) && ! empty( $a_ids ) ) {				
				foreach ( $a_ids as $a_id ) {
					$locations[ $a_id ] = $d_ids;
				}
			}
		}
	}
	return $locations;
}

function tsp_map_meta() {
	if ( 'accommodation' === get_post_type() ) {
		$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';
		lsx_to_connected_destinations( '<span class="' . $meta_class . 'destinations"><span class="lsx-to-meta-data-key">' . esc_html__( 'Location', 'tour-operator' ) . ':</span> ', '</span>' );
	}
}


/**
 * Returns items tagged in the same terms for the taxonomy you select.
 *
 * @param		$taxonomy	| string
 * @return		string
 *
 * @package 	tour-operator
 * @subpackage	template-tags
 * @category 	helper
 */
function tsp_related_items( $taxonomy = false, $before = '', $after = '', $echo = true, $post_type = false ) {
	if ( false !== $taxonomy ) {
		$return = false;
		$filters = array();

		if ( false === $post_type ) {
			$post_type = get_post_type();
		}

		$filters['post_type'] = $post_type;

		if ( is_array( $taxonomy ) ) {
			$filters['post__in'] = $taxonomy;
		} else {
			$filters['posts_per_page'] = 15;
			//Exclude the current post
			$filters['post__not_in'] = array( get_the_ID() );
			//if its set to related then we need to check by the type.
			$filters['orderby'] = 'rand';

			// Destinations
			$destinations = get_post_meta( get_the_ID(), 'destination_to_tour', true );
			if ( false !== $destinations && is_array( $destinations ) ) {
				$filters['meta_query'] = array(
					array(
						'key'     => 'destination_to_tour',
						'compare' => 'IN',
						'value'   => $destinations,
					),
				);
			}
			// Budget Level
			// Traveller Type

			$terms = wp_get_object_terms( get_the_ID(), $taxonomy );
			
			//only allow relation by 1 property type term
			/*if ( is_array( $terms ) && ! empty( $terms ) ) {
				$filters['tax_query'] = array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => array(),
					),
				);

				foreach ( $terms as $term ) {
					$filters['tax_query'][0]['terms'][] = $term->slug;
				}
			}*/
		}

		$related_query = new WP_Query( $filters );

		if ( $related_query->have_posts() ) :
			global $wp_query, $columns;

			$wp_query->is_single = 0;
			$wp_query->is_singular = 0;
			$wp_query->is_post_type_archive = 1;

			if ( null ===  $columns || empty( $columns ) || '' === $columns ) {
				$columns = 3;
			}

			ob_start();

			//Setting some carousel variables
			$carousel_id = rand( 20, 20000 );
			$interval = '6000';
			$post_type = get_post_type();

			$slider_atts = array(
				'slidesToShow'   => esc_attr( $columns ),
				'slidesToScroll' => esc_attr( $columns ),
			);
			$slider_atts = apply_filters( 'lsx_to_related_slider_attributes', $slider_atts );

			echo '<div class="slider-container lsx-to-widget-items">';
			echo '<div id="slider-' . esc_attr( $carousel_id ) . '" class="lsx-to-slider">';
			echo '<div class="lsx-to-slider-wrap">';
			
			//echo '<div class="lsx-to-slider-inner" data-interval="' . esc_attr( $interval ) . '" data-slick=\'' . json_encode( $slider_atts ) .'\'>';
			echo "<div class='lsx-to-slider-inner' data-interval='{$interval}' data-slick='{ \"slidesToShow\": {$columns}, \"slidesToScroll\": {$columns} }'>";

			while ( $related_query->have_posts() ) :
				$related_query->the_post();

				global $disable_placeholder, $disable_text;

				$disable_placeholder = apply_filters( 'lsx_to_widget_disable_placeholder', false, $post_type, false, $taxonomy );
				$disable_text = apply_filters( 'lsx_to_widget_disable_text', false, $post_type, false, $taxonomy );

				echo '<div class="lsx-to-widget-item-wrap lsx-' . esc_attr( $post_type ) . '">';
				lsx_to_content( 'content-widget', $post_type );
				echo '</div>';
			endwhile;

			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';

			$return = ob_get_clean();

			$wp_query->is_single = 1;
			$wp_query->is_singular = 1;
			$wp_query->is_post_type_archive = 0;

			wp_reset_postdata();

			$return = $before . $return . $after;
		endif;

		if ( $echo ) {
			echo wp_kses_post( $return );
		} else {
			return $return;
		}
	}
}

