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
	return $content;

	tsp_init_wizard();

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
	//tsp_mini_wizard( $panels, $args );
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
			<div id="slider-<?php echo esc_attr( rand( 20, 20000 ) ); ?>" class="lsx-to-slider">
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

function tsp_facet_relevance( $post_id, $overrides = array(), $print = false ) {

	$request = $_REQUEST;
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
			'destination_to_tour' => 'fwp_where',
		);
		
		foreach ( $taxonomies as $taxonomy => $facet ) {
			if ( isset( $request[ $facet ] ) && '' !== $request[ $facet ] ) {
				$string = urldecode( $request[ $facet ] );
				$parts  = explode( ',', $string );
				if ( ! is_array( $parts ) ) {
					$parts = array( $parts );
				}
	
				if ( 'fwp_where' === $facet ) {
					$destinations = get_post_meta( $post_id, $taxonomy );
					if ( ! empty( $destinations ) ) {
						$destinations = array_unique( $destinations );
						$found = array_intersect( $parts, $destinations );
						
						if ( ! empty( $found ) ) {
							$hits = $hits + count( $found );
						}
					}
					$total = $total + count( $parts );
				} else {
					foreach ( $parts as $part ) {
						if ( has_term( $part, $taxonomy, $post_id ) ) {
							$hits++;
						}
						$total++;
					}	
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
		$return     = false;
		$filters    = array();
		$current_id = get_the_ID();

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
			if ( false !== $destinations && '' !== $destinations ) {
				if ( ! is_array( $destinations ) ) {
					$destinations = array( $destinations );
				}
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

			$terms = wp_get_object_terms( get_the_ID(), array( 'budget', 'who' ) );
			//only allow relation by 1 property type term
			if ( is_array( $terms ) && ! empty( $terms ) ) {

				$query_terms = array();

				foreach ( $terms as $term ) {
					$query_terms[ $term->taxonomy ][] = $term->slug;
				}

				if ( 1 < count( $query_terms ) ) {
					$filters['tax_query']['relation'] = 'OR';
				}

				foreach ( $query_terms as $qt_key => $qt_vals ) {
					$filters['tax_query'][] = 
						array(
						'taxonomy' => $qt_key,
						'field'    => 'slug',
						'terms'    => $qt_vals,
					);
				}
			}
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

function tsp_best_time_to_visit( $echo = true ) {
    $best_time_to_visit = get_post_meta( get_the_ID(), 'best_time_to_visit', true );
    if ( false !== $best_time_to_visit && '' !== $best_time_to_visit && is_array( $best_time_to_visit ) && ! empty( $best_time_to_visit ) ) {
        $this_year = array(
                'january' => esc_html__( 'January', 'tour-operator' ),
                'february' => esc_html__( 'February', 'tour-operator' ),
                'march' => esc_html__( 'March', 'tour-operator' ),
                'april' => esc_html__( 'April', 'tour-operator' ),
                'may' => esc_html__( 'May', 'tour-operator' ),
                'june' => esc_html__( 'June', 'tour-operator' ),
                'july' => esc_html__( 'July', 'tour-operator' ),
                'august' => esc_html__( 'August', 'tour-operator' ),
                'september' => esc_html__( 'September', 'tour-operator' ),
                'october' => esc_html__( 'October', 'tour-operator' ),
                'november' => esc_html__( 'November', 'tour-operator' ),
                'december' => esc_html__( 'December', 'tour-operator ' ),
        );

        foreach ( $this_year as $month => $label ) {
            $checked_class = '';

            if ( in_array( $month, $best_time_to_visit ) ) {
                $checked_class = 'tsp-month-check';
            }

            $best_times[] = '<div class="tsp-month ' . $checked_class . '"><small>' . $label . '</small></div>';
        };

        $return = '<div class="tsp-meta tsp-time-to-visit"><i class="tsp-icon tsp-icon-calendar"></i>' .
            '<span><span class="tsp-fast-facts-type">' . esc_html__( 'Best Months For Travel', 'tour-operator' ) . '</span>' .
            '<span class="tsp-best-time-to-visit">' . implode( '', $best_times ) . '</span></span></div>';

        if ( $echo ) {
            echo wp_kses_post( $return );
        } else {
            return $return;
        }
    }
}

function tsp_tour_fast_facts()
{
    $meta_class = 'tsp-fast-facts-type';

    $tour_types = get_the_terms(get_the_ID(), 'tour-type');
    if ($tour_types && !is_wp_error($tour_types)) {
        $tour_type_names = array();
        foreach ($tour_types as $tour_type) {
            $tour_type_names[] = $tour_type->name;
        }
        $tour_type_display = implode(', ', $tour_type_names);
        echo '<div class="tsp-meta tsp-tourtype"><i class="tsp-icon tsp-icon-tour-type"></i><span><span class="' . $meta_class . '">' . esc_html__('Type Of Tour', 'tour-operator') . '</span><span>' . esc_html($tour_type_display) . '</span></span></div>';
    }

    lsx_to_duration('<div class="tsp-meta tsp-duration"><i class="tsp-icon tsp-icon-duration"></i><span><span class="' . $meta_class . '">' . esc_html__('Duration', 'tour-operator') . '</span><span> ',  esc_html__(' Days', 'tour-operator') . '</span></span></div>');
    lsx_to_connected_countries('<div class="tsp-meta tsp-countries"><i class="tsp-icon tsp-icon-countries"></i><span><span class="' . $meta_class . '">' . esc_html__('Countries', 'tour-operator') . '</span><span> ', '</span></span></div>');
}

function tsp_to_itinerary_meals( $before = '', $after = '' ) {
    $meals = get_post_meta( get_the_ID(), 'meals', true );
    if ( ! empty( $meals ) && is_array( $meals ) ) {
        $meals = array_map( 'trim', $meals );
        $meals = array_filter( $meals );

        if ( ! empty( $meals ) ) {
            echo wp_kses_post( $before . implode( ', ', $meals ) . $after );
        }
    }
}

function tsp_itinerary_title( $echo = true ) {
    global $tour_itinerary;

    if ( $tour_itinerary && $tour_itinerary->has_itinerary && ! empty( $tour_itinerary->itinerary ) ) {
        if ( ! empty( $tour_itinerary->itinerary['title'] ) ) {
            $title = apply_filters( 'the_title', $tour_itinerary->itinerary['title'] );

            // Get destinations for this itinerary item
            $destinations = '';
            if ( ! empty( $tour_itinerary->itinerary['destination_to_tour'] ) ) {
                $destination_ids = $tour_itinerary->itinerary['destination_to_tour'];
                if ( ! is_array( $destination_ids ) ) {
                    $destination_ids = array( $destination_ids );
                }

                $destination_names = array();
                foreach ( $destination_ids as $destination_id ) {
                    $destination_name = get_the_title( $destination_id );
                    if ( $destination_name ) {
                        $destination_names[] = $destination_name;
                    }
                }

                if ( ! empty( $destination_names ) ) {
                    $destinations = ' : ' . '<span class="destinations">'.implode( ', ', $destination_names ) . '</span>';
                }
            }

            $title_with_destination = $title . $destinations;
            $title_with_destination = apply_filters( 'lsx_to_itinerary_title', $title_with_destination, $tour_itinerary );

            if ( true === $echo ) {
                echo wp_kses_post( $title_with_destination );
            } else {
                return $title_with_destination;
            }
        }
    }
}

function tsp_itinerary_description() {
    global $tour_itinerary;

    if ( $tour_itinerary && $tour_itinerary->has_itinerary && ! empty( $tour_itinerary->itinerary ) ) {
        if ( ! empty( $tour_itinerary->itinerary['description'] ) ) {
            $full_description = apply_filters( 'the_content', $tour_itinerary->itinerary['description'] );
            $full_description = wp_strip_all_tags( $full_description );

            // Check if description needs trimming (more than 75 words or 500 characters)
            $word_count = str_word_count( $full_description );
            $char_count = strlen( $full_description );

            if ( $word_count > 75 || $char_count > 500 ) {
                // Trim to 75 words, but respect word boundaries
                $words = explode( ' ', $full_description );
                $trimmed_words = array_slice( $words, 0, 75 );
                $trimmed_description = implode( ' ', $trimmed_words );

                // If still over 500 chars, trim by characters
                if ( strlen( $trimmed_description ) > 500 ) {
                    $trimmed_description = substr( $trimmed_description, 0, 500 );
                    $trimmed_description = substr( $trimmed_description, 0, strrpos( $trimmed_description, ' ' ) );
                }

                $unique_id = 'desc-' . uniqid();

                echo '<div class="tsp-itinerary-description-wrapper">';
                echo '<div class="tsp-itinerary-description-short" id="' . esc_attr( $unique_id ) . '-short">';
                echo wp_kses_post( $trimmed_description . '...' );
                echo ' <button type="button" class="tsp-toggle-btn tsp-expand-btn" data-target="' . esc_attr( $unique_id ) . '">' . esc_html__( 'Expand Description', 'tour-operator' ) . ' +</button>';
                echo '</div>';

                echo '<div class="tsp-itinerary-description-full" id="' . esc_attr( $unique_id ) . '-full" style="display: none;">';
                echo wp_kses_post( $full_description );
                echo ' <button type="button" class="tsp-toggle-btn tsp-collapse-btn" data-target="' . esc_attr( $unique_id ) . '">' . esc_html__( 'Collapse Description', 'tour-operator' ) . ' -</button>';
                echo '</div>';
                echo '</div>';
                ?>
                <?php
            } else {
                // Description is short enough, display as-is
                echo wp_kses_post( $full_description );
            }
        }
    }
}

/**
 * Change Summary to Overview in single tour scrollspy navigation
 */
function tsp_modify_tour_page_navigation( $page_links ) {
    if ( is_single() && get_post_type() === 'tour' ) {
        if ( isset( $page_links['itinerary'] ) ) {
            $page_links['itinerary'] = esc_html__('Day by Day', 'thesafaripartners-child' );
        }
        if ( isset( $page_links['when-to-go'] ) ) {
            unset( $page_links['when-to-go'] );
        }
        if ( isset( $page_links['summary'] ) ) {
            unset( $page_links['summary'] );
        }
        if ( isset( $page_links['included-excluded'] ) ) {
            unset( $page_links['included-excluded'] );
        }

        $ordered_links = array();

        $ordered_links['overview'] = esc_html__('Overview', 'thesafaripartners-child');

        if ( isset( $page_links['tour-map'] ) ) {
            $ordered_links['tour-map'] = esc_html__('Map', 'thesafaripartners-child');
        }
        if ( isset( $page_links['gallery'] ) ) {
            $ordered_links['gallery'] = $page_links['gallery'];
        }
        if ( isset( $page_links['itinerary'] ) ) {
            $ordered_links['itinerary'] = esc_html__('Day by Day', 'thesafaripartners-child');
        }
        if ( isset( $page_links['dates-prices'] ) || tsp_has_prices() ) {
            $ordered_links['dates-prices'] = esc_html__( 'Dates & Prices', 'thesafaripartners-child' );
        }

        if ( isset( $page_links['review'] ) ) {
            $ordered_links['review'] = $page_links['review'];
        }
        if ( isset( $page_links['related-tours'] ) ) {
            $ordered_links['related-tours'] = $page_links['related-tours'];
        }

        $page_links = $ordered_links;
    }
    return $page_links;
}
add_filter( 'lsx_to_page_navigation', 'tsp_modify_tour_page_navigation', 20 );

/**
 * Outputs the tours included / not included block
 *
 * @package     tour-operator
 * @subpackage  template-tags
 * @category    tour
 */
function tsp_included_block() {
    $tour_included = lsx_to_included( '', '', false );
    $tour_not_included = lsx_to_not_included( '', '', false );

    if ( null !== $tour_included || null !== $tour_not_included ) {
        $class = 'col-xs-12 col-md-6';

        if ( ( null === $tour_included && null !== $tour_not_included ) || ( null !== $tour_included && null === $tour_not_included ) ) {
            $class = 'col-xs-12';
        }
        ?>
        <div id="included-excluded" class="row">
            <?php if ( null !== $tour_included ) { ?>
                <div class="<?php echo esc_attr( $class ); ?> included">
                    <h3><?php esc_html_e( 'What\'s Included', 'tour-operator' ); ?></h3>
                    <div class="entry-content">
                        <?php echo wp_kses_post( apply_filters( 'the_content', wpautop( $tour_included ) ) ); ?>
                    </div>
                </div>
                <?php
            }
            if ( null !== $tour_not_included ) {
                ?>
                <div class="<?php echo esc_attr( $class ); ?> not-included">
                    <h3><?php esc_html_e( 'What\'s Excluded', 'tour-operator' ); ?></h3>
                    <div class="entry-content">
                        <?php echo wp_kses_post( apply_filters( 'the_content', wpautop( $tour_not_included ) ) ); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}

function tsp_has_gallery()
{
    $gallery = get_post_meta(get_the_ID(), 'gallery', false); // Use false to get all values
    $envira_gallery = get_post_meta(get_the_ID(), 'envira_gallery', true);

    // Check envira gallery first
    if (!empty($envira_gallery)) {
        if (is_array($envira_gallery) && count($envira_gallery) > 0) {
            return true;
        }
        if (is_string($envira_gallery) && $envira_gallery !== '') {
            return true;
        }
    }

    // Check regular gallery
    if (!empty($gallery)) {
        if (is_array($gallery) && count($gallery) > 0) {
            return true;
        }
        if (is_string($gallery) && $gallery !== '') {
            return true;
        }
    }

    return false;
}

function tsp_has_prices()
{
    $price_row_amount = get_post_meta(get_the_ID(), 'price_row', true);

    if (false !== $price_row_amount && 0 !== $price_row_amount) {
        $row_counter = 0;

        do {
            $skip_row = false;

            // Date check - same logic as in single-tour.php
            $start_date = get_post_meta(get_the_ID(), 'price_row_' . $row_counter . '_column_2', true);
            if ('' !== $start_date && false !== $start_date) {
                $now = strtotime('now');
                $start_date2 = strtotime($start_date);
                if ($start_date2 < $now) {
                    $skip_row = true;
                }
            }

            // If we have a valid (non-expired) row, check if it has data
            if (false === $skip_row) {
                $rc_num = 1;
                $has_data = false;

                do {
                    $value = get_post_meta(get_the_ID(), 'price_row_' . $row_counter . '_column_' . $rc_num, true);
                    if ('' !== $value && false !== $value) {
                        $has_data = true;
                        break;
                    }
                    $rc_num++;
                } while (8 > $rc_num);

                if ($has_data) {
                    return true;
                }
            }

            $row_counter++;
        } while ($row_counter < $price_row_amount);
    }

    return false;
}

function tsp_tour_reviews()
{
    global $lsx_archive;

    if (post_type_exists('review') && is_singular('tour')) {
        $args = array(
                'from' => 'review',
                'to' => 'tour',
                'column' => '2',
                'before' => '',
                'after' => '',
        );

        lsx_to_connected_panel_query($args);
    }
}

function tsp_has_tour_reviews() {
    if ( ! post_type_exists( 'review' ) || ! is_singular( 'tour' ) ) {
        return false;
    }

    // Check if there are connected reviews
    $connected_reviews = get_post_meta( get_the_ID(), 'review_to_tour', false );

    if ( ! empty( $connected_reviews ) ) {
        // Filter out empty values
        $connected_reviews = array_filter( $connected_reviews );

        if ( ! empty( $connected_reviews ) ) {
            // Verify that at least one review actually exists and is published
            foreach ( $connected_reviews as $review_id ) {
                if ( get_post_status( $review_id ) === 'publish' ) {
                    return true;
                }
            }
        }
    }

    // Alternative check using WP_Query for connected reviews
    $review_query = new WP_Query( array(
            'post_type' => 'review',
            'post_status' => 'publish',
            'meta_query' => array(
                    array(
                            'key' => 'tour_to_review',
                            'value' => get_the_ID(),
                            'compare' => '='
                    )
            ),
            'posts_per_page' => 1,
            'fields' => 'ids'
    ) );

    wp_reset_postdata();

    return $review_query->have_posts();
}