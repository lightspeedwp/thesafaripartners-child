<?php
/**
 * Class FrontEnd
 *
 * @package   tsp_child\classes
 * @author    LightSpeed
 * @license   GPL-2.0+
 * @link
 * @copyright 2020 LightSpeed
 */

namespace tsp_child\classes;

/**
 * Class Frontend
 *
 * @package tsp_child\classes
 */
class Frontend {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object tsp_child\classes\Frontend()
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 11 );
		add_action( 'wp_head', array( $this, 'wp_head' ), 200 );
		add_action( 'pre_get_posts', array( $this, 'set_main_query_arguments' ), 200, 1 );

		add_filter( 'searchwp\query\results', array( $this, 'get_swp_relevance' ), 10, 2 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \tsp_child\classes\Frontend()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Enqueues the parent and the child theme styles.
	 *
	 * @package    thesafaripartners-child
	 * @subpackage setup
	 */
	public function scripts() {
		if ( defined( 'SCRIPT_DEBUG' ) ) {
			$prefix = '';
			$suffix = '';
		} else {
			$prefix = '';
			$suffix = '.min';
		}
		// https://github.com/lightspeeddevelopment/thesafaripartners-child.git
		// Fonts from LSX Theme. Add these lines if your website will use a different font.
		// wp_dequeue_style( 'lsx-header-font' );
		// wp_dequeue_style( 'lsx-body-font' );
		// wp_dequeue_style( 'lsx_font_scheme' );

		// Google Fonts. Add these lines if your website will use a different font.
		// wp_enqueue_style( 'thesafaripartners-child-quattrocento-sans', 'https://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i' );

		wp_enqueue_script( 'thesafaripartners-child-scripts', get_stylesheet_directory_uri() . '/assets/js/' . $prefix . 'custom' . $suffix . '.js', array( 'jquery' ) );

		if ( is_singular( array( 'tour' ) ) ) {
			//wp_enqueue_script( 'thesafaripartners-child-wizard-bootstrap', get_stylesheet_directory_uri() . '/assets/js/wizard.js', array( 'jquery' ), TSP_CHILD_VER, true );
			wp_enqueue_script( 'thesafaripartners-child-tour-wizard', get_stylesheet_directory_uri() . '/assets/js/tour-wizard.js', array( 'jquery' ), TSP_CHILD_VER, true );
			wp_enqueue_script( 'thesafaripartners-child-tour-wizard', get_stylesheet_directory_uri() . '/assets/js/readmore.js', array( 'jquery' ), TSP_CHILD_VER, true );
		}
	}

	public function wp_head() {
		remove_action( 'lsx_content_wrap_before', 'lsx_to_single_content_top', 110 );
		remove_action( 'lsx_content_bottom', 'lsx_to_destination_single_content_bottom' );
		remove_action( 'lsx_content_bottom', 'lsx_to_tour_single_content_bottom' );
		remove_action( 'lsx_to_fast_facts', 'lsx_to_destination_single_fast_facts' );
		remove_action( 'lsx_to_fast_facts', 'lsx_to_tour_single_fast_facts' );
		add_action( 'lsx_content_bottom', 'lsx_to_destination_tours_tsp' );
		add_action( 'lsx-thumbnail-single', 'lsx_to_destination_single_fast_facts' );

	}


	public function set_main_query_arguments( $query ) {
		if ( ! is_admin() && $query->is_main_query() ) {

			$taxonomies = array(
				'who',
				'travel-style',
			);

			if ( true === $query->is_tax( $taxonomies )  ) {
				$query->set( 'posts_per_page', -1 );
				$query->set( 'nopagin', true );
				$query->set( 'post_type', 'tour' );
			}

			if ( $query->is_post_type_archive( 'destination' )  ) {
				$query->set( 'post_type', 'tour' );
				$query->set( 'posts_per_page', -1 );
				$query->set( 'nopagin', true );
			}

			if ( $query->is_page( 'safari-styles' )  ) {
				$query->set( 'post_type', 'tour' );
				$query->set( 'posts_per_page', -1 );
				$query->set( 'nopagin', true );
			}
		}
	}

	public function get_swp_relevance( $results, $query ){
		global $search_relevance;

		if( empty( $results) ){
			return $results;
		}
		$search_relevance = array();
	
		remove_filter( 'searchwp\query\results', array( $this, 'get_swp_relevance' ) );
		$max_relevance_query = new \SearchWP\Query( $query->get_keywords( true ),
			[
				'engine' => $query->get_engine()->get_name(),
				'per_page' => 1
			]
		);
		$max_relevance = (int)$max_relevance_query->results[0]->relevance;
		$posts_relevance = wp_list_pluck( $query->get_raw_results(), 'relevance', 'id' );
		
		foreach( $results as $index => $result ){
			if ( isset( $posts_relevance[$result] ) ) {
				$search_relevance[$result] = round( ( $posts_relevance[$result] * 100 ) / $max_relevance );
			}
		}		
	
		return $results;
	}
}