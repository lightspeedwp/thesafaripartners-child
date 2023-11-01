<?php
namespace tsp_child\classes;

/**
 * Class Setup
 *
 * @package tsp_child\classes
 */
class WETU_Endpoints {

	var $namespace = 'wetu/v1/';

	/**
	 * Contructor
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_endpoints' ) );
	}

	/**
	 * Register the endpoints
	 */
	public function register_endpoints() {
		register_rest_route( 
			$this->namespace,
			'/get_tour_destinations',
			array(
				'methods'  => 'GET',
				'callback' => '\tsp_child\classes\WETU_Endpoints::get_destinations',
				'args'     => array(
					'wetu_id' => array(
						'validate_callback' => '\tsp_child\classes\WETU_Endpoints::validate_empty',
					),
				)
			)
		);
	}

	/**
	 * Connect to the calendly API, and generate a Web Hook
	 * @param $data \WP_REST_Request()
	 *
	 * @return boolean
	 */
	public static function get_destinations( $data ) {
		$return = 'false';

		if ( ! isset( $data['wetu_id'] ) || '' === $data['wetu_id'] ) {
			return $return;
		}

		//get the data
		$return = 'teststring';

		return $return;
	}

	/**
	 * Check to see if there is a reference present.
	 * @param $param
	 * @param $request
	 * @param $key
	 *
	 * @return bool | object
	 */
	public static function validate_empty ( $param, $request, $key ) {
		if ( '' !== $param && null !== $param ) {
			return true;
		} else {
			return false;
		}
	}
}
