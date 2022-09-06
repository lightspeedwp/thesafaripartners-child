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
			'Romance Seekers', //Romance Seeker
			'Solo Traveller',
			'Family Experiences', // Family
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
			'Gorillas Trekking',
			'Beach & Relaxation',
		),
		'tour-type' => array(
			'Tailored Tour',
			'Group Tour',
			'Scheduled Tour',
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

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function __construct() {
		add_filter( 'lsx_wetu_importer_tour_travel_styles', array( $this, 'filter_travel_styles' ), 10, 3 );
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
			foreach ( $this->tag_mapping as $key => $terms ) {
				if ( ! taxonomy_exists( $key ) ) {
					continue;
				}
				$found_terms = array_intersect( $tags, $terms );
				if ( ! empty( $found_terms ) ) {
					foreach ( $found_terms as $found_term ) {



						if ( 'Family' === $found_term ) {
							$found_term = 'Family Experiences';
						}

						if ( 'travel-style' === $key ) {
							switch ( $found_term ) {
								case 'Flying':
									$found_term = 'Flying Safaris';
								break;

								case 'Romance Seeker':
									$found_term = 'Romance Seekers';
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
	
}
