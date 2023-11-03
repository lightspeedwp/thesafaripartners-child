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
				'callback' => '\tsp_child\classes\WETU_Endpoints::get_tour_destinations',
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
	 * Test URL: https://thesafaripartners.local/wp-json/wetu/v1/get_tour_destinations?wetu_id=6205c52e-f2f6-46ab-a972-0abfa6ad5e1c
	 *
	 * @return boolean
	 */
	public static function get_tour_destinations( $data ) {
		$return = '';

		if ( ! isset( $data['wetu_id'] ) || '' === $data['wetu_id'] ) {
			return $return;
		}

		$tour_id = WETU_Endpoints::get_tour_by_wetu_id( $data['wetu_id'] );
		if ( 0 !== $tour_id ) {
			$destinations = get_post_meta( $tour_id, 'destination_to_tour' );
			if ( ! empty( $destinations ) ) {
				$return = WETU_Endpoints::format_destinations( $destinations );
			}
		}
		return $return;
	}

/**
	 * Connect to the calendly API, and generate a Web Hook
	 * @param $data \WP_REST_Request()
	 * 
	 * Test URL: https://thesafaripartners.local/wp-json/wetu/v1/get_tour_destinations?wetu_id=6205c52e-f2f6-46ab-a972-0abfa6ad5e1c
	 *
	 * @return boolean
	 */
	public static function get_tour_destinations_old( $data ) {
		$return = '';

		if ( ! isset( $data['wetu_id'] ) || '' === $data['wetu_id'] ) {
			return $return;
		}

		$args     = array(
			'headers' => array(
				'content-type' => 'application/json'
			),
			'id' => $data['wetu_id'],
		);
		//$response = wp_remote_get( 'https://wetu.com/API/Itinerary/V8/Get', $args );
		
		$response = wp_remote_get( 'https://wetu.com/API/Itinerary/V8/Get?id=' . $data['wetu_id'] );
		
		print_r('<pre>');
		print_r('https://wetu.com/API/Itinerary/V8/Get?id=' . $data['wetu_id']);
		print_r($response);
		print_r('</pre>');

		if ( ! is_wp_error( $response ) && ! empty( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {			
			$tour_info = json_decode( $response['body'] );
			if ( isset( $tour_info->legs ) ) {
				$return = WETU_Endpoints::get_destinations_from_legs( $tour_info->legs );
			}
		}

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

	public static function get_destinations_from_legs( $legs = array() ) {
		$return = '';
		if ( ! empty( $legs ) ) {
			$destination_ids = array();
			// Run through each leg and get all the destinations.
			foreach ( $legs as $leg ) {
				if ( ! isset( $leg->destination_content_entity_id ) ) {
					continue;
				}
				$destination_ids[] = $leg->destination_content_entity_id;
			}

			if ( ! empty( $destination_ids ) ) {
				$args = array(
					'ids' => $destination_ids,
				);
				$response = wp_remote_get( 'https://wetu.com/API/Pins/' . $this->api_key . '/Get', $args );
				if ( ! is_wp_error( $response ) && ! empty( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {			
					$destinations      = array();
					$destinations_info = json_decode( $response['body'] );

					foreach ( $destinations_info as $destination_info ) {
						if ( isset( $destination_info->name ) && isset( $destination_info->position->country ) ) {
							$destinations[ $destination_info->position->country ] = $destination_info->name;
						}
					}

					// Finally format the destination array into a useable text area.
					if ( ! empty( $destinations ) ) {
						$temp = array();
						foreach ( $destinations as $country => $regions ) {
							$temp[] = $country . ': ' . implode( $regions );
						}
						$return = implode( '\n', $temp );
					}
				}
			}
		}
		return $return;
	}

	public static function get_tour_by_wetu_id( $wetu_id ) {
		global $wpdb;
		$return = 0;
		$query  = "SELECT `post_id`
			FROM `{$wpdb->postmeta}`
			WHERE `meta_key` = 'lsx_wetu_id' AND `meta_value` = '{$wetu_id}'
			LIMIT 50";

		$results = $wpdb->get_var( $query );
		if ( ! empty( $results ) ) {
			$return = $results;
		}
		return $return;
	}

	public static function format_destinations( $destinations = array() ) {
		$return = '';

		if ( empty( $destinations ) ) {
			return $return;
		}

		$sorted_destinations = array();
		$destinations        = array_unique( $destinations );

		foreach ( $destinations as $destination ) {

			$is_country   = false;
			$country_name = '';
			$post_parent  = get_post_parent( $destination );

			if ( null === $post_parent ) {
				$is_country = true;
			} else {
				$country_name = get_the_title( $post_parent );
			}

			$destination_title = get_the_title( $destination);

			if ( $is_country ) {
				if ( ! isset( $sorted_destinations[ $destination_title ] ) ) {
					$sorted_destinations[ $destination_title ] = array();
				}
			} else {
				$sorted_destinations[ $country_name ][] = $destination_title;
			}
		}

		if ( ! empty( $sorted_destinations ) ) {
			$to_format = array();
			foreach ( $sorted_destinations as $country => $regions ) {
				$to_format[] = $country . ': ' . implode( ', ', $regions );
			}
			$return = implode( "\n---------\n", $to_format );
		}
		return $return;
	}
}
