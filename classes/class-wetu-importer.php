<?php
/**
 * Class Setup
 *
 * @package   tsp_child\classes
 * @author    LightSpeed
 * @license   GPL-2.0+
 * @link
 * @copyright 2020 LightSpeed
 */

namespace tsp_child\classes;

/**
 * Class Setup
 *
 * @package tsp_child\classes
 */
class WETU_Importer {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object tsp_child\classes\WETU_Importer()
	 */
	protected static $instance = null;

	public $tag_mapping = array(
		'who' => array(
			'Seasoned Traveller',
			'Group of Friends',
			'Romance Seeker', //Romance Seeker
			'Solo Traveller',
			'Family', // Family
			'Currency-ZAR',
			'Currency-EUR',
			'Currency-USD',
		),
		'travel-style' => array(
			'Wildlife Safaris',
			'Epic Luxury',
			'Rail Journeys',
			'Flying Safaris',
			'Water Based Safaris',
			'Walking Safaris',
			'Cultural',
			'Romantic & Private',
			'Group Travel',
			'Migration Experiences',
			'Gorillas',
			'Beach & Relaxation',
			'Flying',
		),
		'tour-type' => array(
			'Tailored Tour',
			'Group Tour',
			'Scheduled Tour',
			'Mobile-train',
			'Mobile-boat',
		),
		'budget' => array(
			'Budget-low',
			'Budget-medium',
			'Budget-high',
		),
		'when' => array(
			'January',
			'February',
			'March',
			'April',
			'May',
			'June',
			'July',
			'August',
			'September',
			'October',
			'November',
			'December',
		),
	);

	public $what_terms = array(
		'beach-relaxation',
		'cultural',
		'epic-luxury',
		'flying-safaris',
		'gorillas',
		'gorillas-trekking',
		'group-travel',
		'migration-experiences',
		'rail-journeys',
		'romantic-private',
		'walking-safaris',
		'water-based-safari',
		'wildlife-safaris'
	);

	public $budget_terms = array(
		'on-a-budget',
		'i-am-flexible',
		'going-all-out'
	);

	public $who_terms = array(
		'family-experiences',
		'group-of-friends',
		'romance-seekers',
		'seasoned-travellers',
		'solo-traveller'
	);

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function __construct() {
		add_filter( 'lsx_wetu_importer_tour_travel_styles', array( $this, 'filter_travel_styles' ), 10, 3 );

		// Facet Display Filters.
		add_filter( 'facetwp_facet_render_args', array( $this, 'restrict_where' ), 10, 1 );

		add_filter( 'lsx_wetu_tour_refresh_url', array( $this, 'set_importer_defaults' ), 10, 1 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \tsp_child\classes\Setup()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Filters the travel style tags and assigns the items.
	 *
	 * @param array $tags
	 * @return array
	 */
	public function filter_travel_styles( $tags = array(), $id, $importer ) {

		if ( ! empty( $tags ) ) {
			wp_set_object_terms( $id, array(), 'travel-style' );
			wp_set_object_terms( $id, array(), 'who' );
			wp_set_object_terms( $id, array(), 'tour-type' );
			wp_set_object_terms( $id, array(), 'budget' );
			wp_set_object_terms( $id, array(), 'when' );

			foreach ( $this->tag_mapping as $key => $terms ) {
				if ( ! taxonomy_exists( $key ) ) {
					continue;
				}
				$found_terms = array_intersect( $tags, $terms );

				if ( ! empty( $found_terms ) ) {
					foreach ( $found_terms as $found_term ) {

						if ( in_array( $found_term, array( 'Currency-ZAR', 'Currency-USD', 'Currency-EUR' ) ) ) {
							if ( 'Currency-ZAR' === $found_term ) {
								$currency = 'ZAR';
							} else if ( 'Currency-EUR' === $found_term ) {
								$currency = 'EUR';
							} else {
								$currency = 'USD';
							}
							delete_post_meta( $id, 'currency' );
							add_post_meta( $id, 'currency', $currency );
							continue;
						}

						if ( 'Family' === $found_term ) {
							$found_term = 'Family Experiences';
						}

						if ( 'who' === $key ) {
							switch ( $found_term ) {
								case 'Romance Seeker':
									$found_term = 'Romance Seekers';
								break;

								case 'Seasoned Traveller':
									$found_term = 'Seasoned Travellers';
								break;
							}
						}

						if ( 'travel-style' === $key ) {
							switch ( $found_term ) {
								case 'Flying':
									$found_term = 'Flying Safaris';
								break;

								case 'Water Based Safaris':
									$found_term = 'Water Based Safari';
								break;

								case 'Gorillas':
									$found_term = 'Gorillas Trekking';
								break;
							}
						}

						if ( 'budget' === $key ) {
							$found_term = ucwords( str_replace( 'Budget-', '', $found_term ) );

							switch ( $found_term ) {
								case 'low':
								case 'Low':
									$found_term = 'On a budget';
								break;

								case 'medium':
								case 'Medium':	
									$found_term = 'I am flexible';
								break;

								case 'high':
								case 'High':
									$found_term = 'Going all out';
								break;
							}
						}
						$importer->set_term( $id, $found_term, $key );
					}
				}
			}
		}
		return array();
	}

	public function restrict_where( $args ) {
		if ( 'where' == $args['facet']['name'] ) { // Change 'country' to the name of your facet
			if ( ! empty( $args['values'] ) ) {
				foreach ( $args['values'] as $key => $val ) {
					$display_value = $val['facet_value'];
					$args['values'][ $key ]['facet_display_value'] = get_the_title( $display_value );
				}
				return $args;
			}
		}

		if ( 'when' == $args['facet']['name'] && isset( $this->tag_mapping['when'] ) ) { // Change 'country' to the name of your facet
			if ( ! empty( $args['values'] ) ) {
				foreach ( $args['values'] as $key => $val ) {
					if ( ! in_array( $val['facet_display_value'], $this->tag_mapping['when'] ) ) {
						unset( $args['values'][ $key ] );
					}
				}
				return $args;
			}
		}

		if ( 'budget' == $args['facet']['name'] ) { // Change 'country' to the name of your facet
			if ( ! empty( $args['values'] ) ) {

				foreach ( $args['values'] as $key => $val ) {
					if ( ! in_array( sanitize_title( $val['facet_display_value'] ), $this->budget_terms ) ) {
						unset( $args['values'][ $key ] );
					}
				}
				return $args;
			}
		}

		if ( 'what' == $args['facet']['name'] ) { // Change 'country' to the name of your facet
			if ( ! empty( $args['values'] ) ) {
				foreach ( $args['values'] as $key => $val ) {
					if ( ! in_array( sanitize_title( $val['facet_display_value'] ), $this->what_terms ) ) {
						unset( $args['values'][ $key ] );
					}
				}
				return $args;
			}
		}

		if ( 'who' == $args['facet']['name'] ) { // Change 'country' to the name of your facet
			if ( ! empty( $args['values'] ) ) {

				foreach ( $args['values'] as $key => $val ) {
					if ( ! in_array( sanitize_title( $val['facet_display_value'] ), $this->who_terms ) ) {
						unset( $args['values'][ $key ] );
					}
				}
				return $args;
			}
		}

		return $args;
	}

	/**
	 * The tour URL to ping.
	 *
	 * @param string $url
	 * @return string
	 */
	public function set_importer_defaults( $url ) {
		$url = str_replace( '&type=Sample', '&type=personal', $url );
		$url = str_replace( '&type', '&operatorid=3487&type', $url );
		return $url;
	}
}
