<?php
/**
 * Class Admin
 *
 * @package   tsp_child\classes
 * @author    LightSpeed
 * @license   GPL-2.0+
 * @link
 * @copyright 2020 LightSpeed
 */

namespace tsp_child\classes;

use WP_Query;

/**
 * Class Admin
 *
 * @package tsp_child\classes
 */
class WETU_Automation {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object tsp_child\classes\WETU_Automation()
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
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'init', array( $this, 'tester_init' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \tsp_child\classes\WETU_Automation()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Register the initian functions
	 *
	 * @return void
	 */
	public function init() {
		if ( function_exists( 'as_enqueue_async_action' ) ) {
			$this->schedule_main_action();
			add_action( 'lsx_wetu_master_sync', array( $this, 'run_main_actions' ), 10 );

			// These are the actions which sync the individual items.
			add_action( 'lsx_wetu_sync_tour', array( $this, 'tour_sync_action' ), 10, 2 );
		}
	}

	/**
	 * Register the test functions.
	 *
	 * @return void
	 */
	public function tester_init() {
		if ( isset( $_GET['wetu_main_debug'] ) ) {
			$this->run_main_actions();
		}

		if ( isset( $_GET['wetu_tour_debug'] ) ) {
			$this->tour_sync_action( $_GET['wetu_tour_debug'] );
		}
	}

	/**
	 * This will schedule our main action if it is not found.
	 * It will run daily.
	 *
	 * @return void
	 */
	public function schedule_main_action() {
		//master scheduled actions
		if ( ! wp_next_scheduled( 'lsx_wetu_master_sync' ) ) {
			$master_sync_scheduler = strtotime( '01:00:00' );
			wp_schedule_event( $master_sync_scheduler, 'daily', 'lsx_wetu_master_sync' );
		}
	}

	/**
	 * Grab the tours and compare them to the 
	 *
	 * @return void
	 */
	public function run_main_actions() {
		$tours      = $this->get_current_tours();
		//$wetu_tours = $this->get_wetu_tours();

		/*print_r('<pre>');
		print_r($wetu_tours);
		print_r('</pre>');
		die();*/

		if ( ! empty( $wetu_tours ) ) {

			/*print_r('<pre>');
			print_r($wetu_tours);
			print_r('</pre>');
			die();*/

			foreach ( $tours as $tour ) {
				$action_id = as_enqueue_async_action(
					'lsx_wetu_sync_tour', 
					array(
						'tour_id' => $tour,
					),
					'lsx_wetu_sync' // . date('dmy')
				);
				update_post_meta( $tour, 'lsx_wetu_sync_action_id', $action_id);
			}
		} else {
			// Reschedule the main actions till it runs.
		}
	}

	/**
	 * Gets the current tours in the system.
	 *
	 * @return array
	 */
	public function get_current_tours() {
		$tours = array();
		$args = array(
			'post_type' => 'tour',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'posts_per_page' => 5,
			'meta_key' => 'lsx_wetu_id',
			'meta_compare' => 'EXISTS',
			'fields' => 'ids',
		);
		$tour_query = new \WP_Query( $args );
		if ( $tour_query->have_posts() ) {
			$tours = $tour_query->posts;
		}
		return $tours;
	}

	public function get_wetu_tours() {
		$tours = array();
		$data = wp_remote_get( 'https://wetu.com/API/Itinerary/ROARLEMOUP5IENOE/V8/List?type=Personal&own=true' );
		if ( ! is_wp_error( $data ) && ! empty( $data ) && isset( $data['response'] ) && isset( $data['response']['code'] ) && 200 === $data['response']['code'] ) {
			$jdata  = json_decode( $data['body'], true );
			var_dump('here');
			if ( isset( $jdata['itineraries'] ) && ! empty( $jdata['itineraries'] ) ) {
				foreach ( $jdata['itineraries'] as $jata ) {
					if ( isset( $jata['operator_id'] ) && '3487' === (string) $jata['operator_id'] ) {
						$tours[] = $jata;
					}
				}
			}
		}
		return $tours;
	}

	public function tour_sync_action( $tour_id ) {
		$return = false;

		$wetu_id = get_post_meta( $tour_id, 'lsx_wetu_id', true );

		$importable = array(
			'price',
			'duration',
			'group_size',
			'category',
			'itineraries',
			'start_end_point',
			'itinerary_description',
			'itinerary_included',
			'itinerary_excluded',
			'room_basis',
			'drinks_basis',
			'accommodation',
			'destination',
		);

		if ( false !== $wetu_id && '' !== $wetu_id ) {
			$jdata = wp_remote_get( 'https://wetu.com/API/Itinerary/V8/Get?id=' . $wetu_id );
	
			if ( ! is_wp_error( $jdata ) && ! empty( $jdata ) && isset( $jdata['response'] ) && isset( $jdata['response']['code'] ) && 200 === $jdata['response']['code'] ) {
				$jdata             = json_decode( $jdata['body'], true );
				$lsx_wetu_importer = new \LSX_WETU_Importer_Tours();
				$response          = $lsx_wetu_importer->import_row( $jdata, $wetu_id, $tour_id, array(), $importable );

			}
			if ( null !== $response ) {
				$return = true;
				update_post_meta( $tour_id, 'lsx_wetu_sync_date', strtotime( 'now' ) );
			} else {

				// If the above didnt complete, run the action again.
				$action_id = as_enqueue_async_action(
					'lsx_wetu_sync_tour', 
					array(
						'tour_id' => $tour_id,
					),
					'lsx_wetu_sync' // . date('dmy')
				);
				update_post_meta( $tour_id, 'lsx_wetu_sync_action_id', $action_id);
			}
		}

		return $return;
	}
}
